<?php

declare(strict_types = 1);

namespace Drupal\allianz_api_product;

/**
 * Copyright (C) 2020 PRONOVIX GROUP BVBA.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301,
 * USA.
 */

use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\StringTranslation\TranslationInterface;
use Drupal\node\NodeStorageInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * API Product form handler.
 */
final class ApiProductFormHandler implements ContainerInjectionInterface {

  use StringTranslationTrait;

  /**
   * The node storage.
   *
   * @var \Drupal\node\NodeStorageInterface
   */
  protected $nodeStorage;

  /**
   * API Product form handler constructor.
   *
   * @param \Drupal\node\NodeStorageInterface $node_storage
   *   The node storage interface.
   * @param \Drupal\Core\StringTranslation\TranslationInterface $string_translation
   *   The string translation service.
   */
  public function __construct(NodeStorageInterface $node_storage, TranslationInterface $string_translation) {
    $this->nodeStorage = $node_storage;
    $this->stringTranslation = $string_translation;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container): self {
    return new static(
      $container->get('entity_type.manager')->getStorage('node'),
      $container->get('string_translation')
    );
  }

  /**
   * Lists the contents that are referencing the API Product to be deleted.
   *
   * @param array $form
   *   The form definition array for the block configuration form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   * @param string $form_id
   *   String representing the name of the form itself.
   *
   * @throws \Drupal\Core\Entity\EntityMalformedException
   */
  public function alterDeleteForm(array &$form, FormStateInterface $form_state, string $form_id): void {
    $api_product_nid = $form_state->getFormObject()->getEntity()->id();

    $related_nodes = $this->nodeStorage->loadByProperties([
      'field_api_product' => $api_product_nid,
    ]);

    if (!empty($related_nodes)) {
      $node_links = [];
      foreach ($related_nodes as $related_node) {
        $node_links[] = $related_node->toLink()->toRenderable();
      }

      $form['description'] = [
        '#theme' => 'item_list',
        '#title' => $this->t('This action cannot be undone and will also delete the following content item(s):'),
        '#items' => $node_links,
      ];
    }
  }

}
