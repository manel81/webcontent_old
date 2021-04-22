<?php

declare(strict_types = 1);

namespace Drupal\dp_api_docs\Plugin\Block;

/**
 * Copyright (C) 2019 PRONOVIX GROUP BVBA.
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

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\Cache;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\node\NodeInterface;
use Drupal\node\NodeStorageInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides an 'API Header' block.
 *
 * @Block(
 *   id = "api_header_block",
 *   admin_label = @Translation("API Header block"),
 *   category = @Translation("API Header block"),
 * )
 */
class ApiHeaderBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The current route match.
   *
   * @var \Drupal\Core\Routing\RouteMatchInterface
   */
  protected $routeMatch;

  /**
   * The node storage.
   *
   * @var \Drupal\node\NodeStorageInterface
   */
  protected $nodeStorage;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition): self {
    /** @var \Drupal\Core\Routing\RouteMatchInterface $route_match */
    $route_match = $container->get('current_route_match');
    /** @var \Drupal\node\NodeStorageInterface $node_storage */
    $node_storage = $container->get('entity_type.manager')->getStorage('node');

    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $route_match,
      $node_storage
    );
  }

  /**
   * The ApiTabBlock constructor.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Routing\RouteMatchInterface $route_match
   *   The current route match interface.
   * @param \Drupal\node\NodeStorageInterface $node_storage
   *   The node storage interface.
   */
  public function __construct(array $configuration, string $plugin_id, $plugin_definition, RouteMatchInterface $route_match, NodeStorageInterface $node_storage) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->routeMatch = $route_match;
    $this->nodeStorage = $node_storage;
  }

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $node = $this->routeMatch->getParameter('node');
    if ($node instanceof NodeInterface) {
      // Check the node access because if the user doesn't have access to the
      // API Reference they shouldn't see the API Header block at all.
      if ($node->bundle() === 'api_reference' && $node->access('view')) {
        $api_ref = $node;
      }
      elseif ($node->hasField('field_api_reference') && !$node->field_api_reference->isEmpty() && $node->get('field_api_reference')->entity && $node->get('field_api_reference')->entity->access('view')) {
        $api_ref = $node->get('field_api_reference')->entity;
      }
      else {
        return [];
      }

      return [
        '#theme' => 'api_header_block',
        '#title' => $api_ref->getTitle(),
        '#version' => $api_ref->hasField('field_version') && !$api_ref->get('field_version')->isEmpty() ? $api_ref->get('field_version')->getString() : '',
        '#tags' => $api_ref->hasField('field_api_category') && !$api_ref->get('field_api_category')->isEmpty() ? $api_ref->get('field_api_category')->view() : NULL,
        '#content' => $api_ref->hasField('field_api_header_content') && !$api_ref->get('field_api_header_content')->isEmpty() ? $api_ref->get('field_api_header_content')->view(['label' => 'hidden']) : '',
        '#cache' => [
          'tags' => $api_ref->getCacheTags(),
        ],
      ];
    }

    return [];
  }

  /**
   * Grant access to API Header block based on the node type.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The currently logged in account.
   *
   * @return \Drupal\Core\Access\AccessResult
   *   The access result.
   */
  protected function blockAccess(AccountInterface $account): AccessResult {
    $nid = $this->routeMatch->getRawParameter('node');
    $api_nodes = $this->nodeStorage->getQuery()
      ->condition('nid', $nid)
      ->condition('type', 'api_', 'STARTS_WITH')
      ->execute();
    if ($nid) {
      return AccessResult::allowedIf($api_nodes);
    }
    return AccessResult::forbiddenIf(!$api_nodes);
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheContexts(): array {
    return Cache::mergeContexts(parent::getCacheContexts(), ['route']);
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheTags(): array {
    return Cache::mergeTags(parent::getCacheTags(), ['node_list']);
  }

}
