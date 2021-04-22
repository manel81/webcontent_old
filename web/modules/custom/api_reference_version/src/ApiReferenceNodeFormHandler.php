<?php

declare(strict_types = 1);

/**
 * Copyright (C) 2020 PRONOVIX GROUP BVBA.
 *
 *  This program is free software; you can redistribute it and/or
 *  modify it under the terms of the GNU General Public License
 *  as published by the Free Software Foundation; either version 2
 *  of the License, or (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program; if not, write to the Free Software
 *  Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301,
 *  USA.
 */

namespace Drupal\api_reference_version;

use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\DependencyInjection\DependencySerializationTrait;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\devportal_api_reference\ReferenceTypeManager;
use Drupal\file\FileStorageInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * API reference node form handler.
 */
final class ApiReferenceNodeFormHandler implements ContainerInjectionInterface {

  use DependencySerializationTrait;
  use StringTranslationTrait;

  /**
   * File storage.
   *
   * @var \Drupal\file\FileStorageInterface
   */
  private $fileStorage;

  /**
   * Messenger.
   *
   * @var \Drupal\pathauto\MessengerInterface
   */
  private $messenger;

  /**
   * Reference type manager.
   *
   * @var \Drupal\devportal_api_reference\ReferenceTypeManager
   */
  private $referenceTypeManager;

  /**
   * Constructs a new node API Reference form handler.
   *
   * @param \Drupal\file\FileStorageInterface $file_storage
   *   File storage.
   * @param \Drupal\Core\Messenger\MessengerInterface $messenger
   *   Messenger.
   * @param \Drupal\devportal_api_reference\ReferenceTypeManager $reference_type_manager
   *   Reference type manager.
   */
  public function __construct(FileStorageInterface $file_storage, MessengerInterface $messenger, ReferenceTypeManager $reference_type_manager) {
    $this->fileStorage = $file_storage;
    $this->messenger = $messenger;
    $this->referenceTypeManager = $reference_type_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container): self {
    return new static(
      $container->get('entity_type.manager')->getStorage('file'),
      $container->get('messenger'),
      $container->get('plugin.manager.reference')
    );
  }

  /**
   * Alters the node API reference form.
   *
   * @param array $form
   *   The form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current form state.
   */
  public function alter(array &$form, FormStateInterface $form_state): void {
    $form['#validate'][] = [$this, 'validate'];
    array_unshift($form['actions']['submit']['#submit'], [$this, 'submit']);
  }

  /**
   * Custom validation for the API reference node form.
   *
   * @param array $form
   *   The form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current form state.
   */
  public function validate(array &$form, FormStateInterface $form_state): void {
    if ($form_state->hasValue('field_source_file')) {
      $source = $form_state->getValue('field_source_file');
      $fid = $source[0]['fids'][0] ?? NULL;
      if (!empty($fid)) {
        $file = $this->fileStorage->load($fid);

        if (!empty($file)) {
          $file_uri = $file->getFileUri();
          $instance = $this->referenceTypeManager->lookupPlugin($file_uri);
          $data = $instance->parse($file_uri);

          if (!empty($data) && empty($data->{'x-project-id'})) {
            $this->messenger->addWarning($this->t('The versioning may not work because the [x-project-id] property is missing.<br>If you want to enable versioning you need to add it to the document and upload the file again.'));
          }
          elseif (!empty($data)) {
            $storage = $form_state->getStorage();
            $form_state->setStorage($storage + [
              'x_project_id' => $data->{'x-project-id'},
            ]);
          }
        }
      }
    }
  }

  /**
   * Custom submit callback for the API reference node form.
   *
   * @param array $form
   *   The form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current form state.
   */
  public function submit(array &$form, FormStateInterface $form_state): void {
    $storage = $form_state->getStorage();
    if (!empty($storage['x_project_id'])) {
      $form_state->setValue('field_project_id', $storage['x_project_id']);
    }
  }

}
