<?php

declare(strict_types = 1);

namespace Drupal\allianz_api_product\Plugin\Validation\Constraint;

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
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\node\NodeInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Validates the UniqueInteger constraint.
 */
class SingleReferencingNodeValidator extends ConstraintValidator implements ContainerInjectionInterface {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The Single Refererencing Node Validator constructor.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager) {
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container): self {
    return new static(
      $container->get('entity_type.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function validate($items, Constraint $constraint): void {
    $entity = $items->getEntity();
    if (!$entity instanceof NodeInterface) {
      return;
    }

    $bundle = $entity->bundle();

    /** @var \Drupal\node\NodeTypeInterface[] $node_types */
    $node_types = $this->entityTypeManager->getStorage('node_type')->loadMultiple();
    foreach ($items->referencedEntities() as $referenced_node) {
      /** @var \Drupal\node\NodeInterface $referenced_node */
      // Fetch the entities that reference the same entity.
      $query = $this->entityTypeManager->getStorage($entity->getEntityTypeId())->getQuery()
        ->condition('type', $bundle)
        ->condition($items->getName(), $referenced_node->id());
      if ($entity->id()) {
        $query->condition('nid', $entity->id(), '<>');
      }
      $nodes = $query->count()->execute();

      if (!$nodes) {
        continue;
      }

      $this->context->addViolation($constraint->notSingle, [
        '%title' => $referenced_node->getTitle(),
        '%bundle' => $node_types[$bundle]->label(),
      ]);
    }
  }

}
