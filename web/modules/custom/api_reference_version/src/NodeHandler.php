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
use Drupal\node\NodeInterface;
use Drupal\node\NodeStorageInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Node hook handler.
 */
final class NodeHandler implements ContainerInjectionInterface {

  /**
   * Node storage.
   *
   * @var \Drupal\node\NodeStorageInterface
   */
  private $nodeStorage;

  /**
   * Constructs a new node handler.
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
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager')->getStorage('node')
    );
  }

  /**
   * Acts on node pre-save.
   *
   * @param \Drupal\node\NodeInterface $node
   *   The node that is being saved.
   */
  public function preSave(NodeInterface $node): void {
    // Make sure that all of the fields that are mandatory for the versioning
    // are exist on the current node.
    // Also check if the source file changed as it may effect the project_id
    // renaming.
    if ($node->hasField('field_api_name') && $node->hasField('field_version') && $node->hasField('field_source_file') && !$node->get('field_source_file')->isEmpty() && (empty($node->original) || $node->original->get('field_source_file')->target_id !== $node->get('field_source_file')->target_id)) {
      // Update api_name and project_id only after the file is available.
      if ($node->hasField('field_project_id')) {
        $project_id = $node->get('field_project_id')->value;

        // Check if the project ID is set as it is not a mandatory field.
        if (!empty($project_id)) {
          $node->set('field_project_id', "{$project_id}__" . $node->get('field_version')->value);
          $term = devportal_api_reference_ensure_term('api_name', $project_id, $project_id);

          if (!empty($term)) {
            $node->set('field_api_name', $term->id());
          }
        }
      }
    }

    // Set latest version indicator.
    if ($node->hasField('field_api_name') && !$node->get('field_api_name')->isEmpty() && $node->hasField('field_latest_version') && ($node->isNew() || $node->isPublished() !== $node->original->isPublished())) {
      /** @var \Drupal\node\NodeInterface[] $nodes */
      $nodes = [$node->id() => $node] + ($this->nodeStorage->loadByProperties([
        'field_api_name' => $node->get('field_api_name')->target_id,
        'type' => 'api_reference',
      ]) ?: []);

      $latest_version = $this->getLatestVersion($nodes);
      foreach ($nodes as $other_node) {
        if ($latest_version === $other_node->get('field_version')->value) {
          $other_node->set('field_latest_version', TRUE);
        }
        else {
          $other_node->set('field_latest_version', FALSE);
        }

        // Save only the other nodes, the current node is the one that is
        // being saved anyway.
        if ($node->id() !== $other_node->id()) {
          $other_node->save();
        }
      }
    }
  }

  /**
   * Gets the latest version of a published API reference node.
   *
   * @param \Drupal\node\NodeInterface[] $nodes
   *   API reference nodes.
   *
   * @return string
   *   The latest version of an API reference node.
   */
  private function getLatestVersion(array $nodes): string {
    $latest = '0';
    foreach ($nodes as $node) {
      $version = $node->get('field_version')->value;
      if (version_compare($latest, $version, '<') && $node->isPublished()) {
        $latest = $version;
      }
    }
    return $latest;
  }

}
