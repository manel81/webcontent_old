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
use Drupal\Core\Entity\EntityInterface;
use Drupal\node\NodeStorageInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * API Product entity handler.
 */
final class ApiProductEntityHandler implements ContainerInjectionInterface {

  /**
   * The node storage.
   *
   * @var \Drupal\node\NodeStorageInterface
   */
  protected $nodeStorage;

  /**
   * API Product entity handler constructor.
   *
   * @param \Drupal\node\NodeStorageInterface $node_storage
   *   The node storage interface.
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
   * Deletes all the content that are referencing the API Product to be deleted.
   *
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   The entity object for the entity that has been deleted.
   *
   * @throws \Drupal\Core\Entity\EntityStorageException
   */
  public function nodeDelete(EntityInterface $entity): void {
    if ($entity->bundle() !== 'api_product') {
      return;
    }
    $related_nodes = $this->nodeStorage->loadByProperties([
      'field_api_product' => $entity->id(),
    ]);

    if (!empty($related_nodes)) {
      $this->nodeStorage->delete($related_nodes);
    }
  }

}
