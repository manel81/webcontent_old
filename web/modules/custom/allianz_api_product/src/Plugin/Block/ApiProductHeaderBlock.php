<?php

declare(strict_types = 1);

namespace Drupal\allianz_api_product\Plugin\Block;

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
 * Provides an 'API Product Header' block.
 *
 * @Block(
 *   id = "api_product_header_block",
 *   admin_label = @Translation("API Product Header block"),
 *   category = @Translation("API Product Header block"),
 * )
 */
class ApiProductHeaderBlock extends BlockBase implements ContainerFactoryPluginInterface {

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
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('current_route_match'),
      $container->get('entity_type.manager')->getStorage('node')
    );
  }

  /**
   * Creates API Product Header block for the API Product related pages.
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
      // API Product they shouldn't see the API Product Header block at all.
      if ($node->bundle() === 'api_product' && $node->access('view')) {
        $api_product = $node;
      }
      elseif ($node->hasField('field_api_product') && !$node->get('field_api_product')->isEmpty() && $node->get('field_api_product')->entity->access('view')) {
        $api_product = $node->get('field_api_product')->entity;
      }
      else {
        return [];
      }

      $categories = [];
      if ($api_product->hasField('field_api_product_category') && !$api_product->get('field_api_product_category')->isEmpty()) {
        /** @var \Drupal\taxonomy\TermInterface $category */
        foreach ($api_product->get('field_api_product_category')->referencedEntities() as $category) {
          if ($category->access('view')) {
            $categories[] = [
              '#plain_text' => $category->getName(),
              '#cache' => [
                'tags' => $category->getCacheTags(),
              ],
            ];
          }
        }
      }

      return [
        '#theme' => 'api_product_header_block',
        '#title' => $api_product->getTitle(),
        '#version' => $api_product->hasField('field_version') && !$api_product->get('field_version')->isEmpty() ? $api_product->get('field_version')->getString() : '',
        '#tags' => $categories,
        '#content' => $api_product->hasField('field_api_header_content') && !$api_product->get('field_api_header_content')->isEmpty() ? $api_product->get('field_api_header_content')->view(['label' => 'hidden']) : '',
        '#cache' => [
          'tags' => $api_product->getCacheTags(),
        ],
      ];
    }

    return [];
  }

  /**
   * Grant access to API Product Header block based on the node type.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The currently logged in account.
   *
   * @return \Drupal\Core\Access\AccessResult
   *   The access result.
   */
  protected function blockAccess(AccountInterface $account): AccessResult {
    $nid = $this->routeMatch->getRawParameter('node');
    if (!empty($nid)) {
      $api_nodes = $this->nodeStorage->getQuery()
        ->condition('nid', $nid)
        ->condition('type', 'api_product', 'STARTS_WITH')
        ->count()
        ->execute();
      return AccessResult::allowedIf($api_nodes > 0);
    }
    return AccessResult::forbidden();
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
