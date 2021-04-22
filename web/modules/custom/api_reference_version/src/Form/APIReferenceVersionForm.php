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

namespace Drupal\api_reference_version\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\NodeInterface;
use Drupal\node\NodeStorageInterface;
use Drupal\taxonomy\TermInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a API version selector form.
 */
final class APIReferenceVersionForm extends FormBase {

  /**
   * Node storage.
   *
   * @var \Drupal\node\NodeStorageInterface
   */
  private $nodeStorage;

  /**
   * Creates a new APIReferenceVersionForm instance.
   *
   * @param \Drupal\node\NodeStorageInterface $node_storage
   *   Node storage.
   */
  public function __construct(NodeStorageInterface $node_storage) {
    $this->nodeStorage = $node_storage;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container): self {
    return new static(
      $container->get('entity_type.manager')->getStorage('node')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'api_reference_version_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, NodeInterface $node = NULL): array {
    if ($node === NULL) {
      return [];
    }

    $node_type = $node->bundle();
    if ($node_type === 'api_reference') {
      $api_reference_node = $node;
    }
    else {
      $api_reference_node = $node->get('field_api_reference')->entity;
    }

    // Get all API References with the same API Name.
    $api_name = $api_reference_node->get('field_api_name')->entity;
    $api_references = [];
    if ($api_name instanceof TermInterface && $api_name->bundle() === 'api_name') {
      $api_references = $this->nodeStorage->loadByProperties([
        'type' => 'api_reference',
        'field_api_name' => $api_name->id(),
      ]);
    }

    $options = [];
    if ($api_reference_node->bundle() === $node_type) {
      foreach ($api_references as $nid => $api_reference) {
        $options[$nid] = $api_reference->get('field_version')->value;
      }
    }
    else {
      $api_nodes = $this->nodeStorage->loadByProperties([
        'title' => $node->label(),
        'type' => $node->bundle(),
        'field_api_reference' => array_keys($api_references),
      ]);
      foreach ($api_nodes as $nid => $api_node) {
        $api_reference = $api_node->get('field_api_reference')->entity;
        $options[$nid] = $api_reference->get('field_version')->value;
      }
    }

    uasort($options, 'version_compare');
    $form['api_reference_version_select'] = [
      '#title' => $this->t('Version'),
      '#type' => 'select',
      '#options' => $options,
      '#default_value' => $node->id(),
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    $form['#attached']['library'][] = 'api_reference_version/autosubmit';

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    $form_state->setRedirect('entity.node.canonical', [
      'node' => $form_state->getValue('api_reference_version_select'),
    ]);
  }

}
