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
use Drupal\Core\Database\Connection;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Url;
use Drupal\node\NodeInterface;
use Drupal\node\NodeStorageInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides an 'API Tab' block.
 *
 * @Block(
 *   id = "api_tab_block",
 *   admin_label = @Translation("API Tab block"),
 *   category = @Translation("API Tab block"),
 * )
 */
class ApiTabBlock extends BlockBase implements ContainerFactoryPluginInterface {

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
   * The database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $connection;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition): self {
    /** @var \Drupal\Core\Routing\RouteMatchInterface $route_match */
    $route_match = $container->get('current_route_match');
    /** @var \Drupal\node\NodeStorageInterface $node_storage */
    $node_storage = $container->get('entity_type.manager')->getStorage('node');
    /** @var \Drupal\Core\Database\Connection $connection */
    $connection = $container->get('database');

    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $route_match,
      $node_storage,
      $connection
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
   * @param \Drupal\Core\Database\Connection $connection
   *   The database connection object.
   */
  public function __construct(array $configuration, string $plugin_id, $plugin_definition, RouteMatchInterface $route_match, NodeStorageInterface $node_storage, Connection $connection) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->routeMatch = $route_match;
    $this->nodeStorage = $node_storage;
    $this->connection = $connection;
  }

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $node = $this->routeMatch->getParameter('node');
    if ($node instanceof NodeInterface) {
      // Doesn't check access here, because if the user doesn't have access to
      // the API Reference they can have access to the API related pages.
      if ($node->bundle() === 'api_reference') {
        $api_reference = $node;
      }
      elseif ($node->hasField('field_api_reference') && !$node->field_api_reference->isEmpty() && $node->get('field_api_reference')->entity) {
        $api_reference = $node->get('field_api_reference')->entity;
      }
      else {
        return [];
      }

      $tabs = [];

      // Add API Description page.
      $query = $this->nodeStorage
        ->getQuery()
        ->condition('field_api_reference', $api_reference->id())
        ->condition('type', 'api_description_page');
      $api_description_page_array = $query->execute();

      if (!empty($api_description_page_array)) {
        // Get the first array element as only one API Description page should
        // reference an API reference.
        $api_description_page_nid = array_pop($api_description_page_array);
        $api_description_page = $this->nodeStorage->load($api_description_page_nid);
        if ($api_description_page && $api_description_page->access('view')) {
          $tabs[] = [
            'id' => $api_description_page_nid,
            'is_active' => $api_description_page_nid === $node->id(),
            'link' => [
              '#title' => $this->t('API Description'),
              '#type' => 'link',
              '#url' => Url::fromRoute('entity.node.canonical', ['node' => $api_description_page_nid]),
              '#cache' => [
                'tags' => $api_description_page->getCacheTags(),
              ],
            ],
          ];
        }
      }

      // Add API Reference page.
      if ($api_reference->access('view')) {
        $tabs[] = [
          'id' => $api_reference->id(),
          'is_active' => $api_reference->id() === $node->id(),
          'link' => [
            '#title' => $this->t('Reference documentation'),
            '#type' => 'link',
            '#url' => Url::fromRoute('entity.node.canonical', ['node' => $api_reference->id()]),
            '#cache' => [
              'tags' => $api_reference->getCacheTags(),
            ],
          ],
        ];
      }

      // Add other API related pages.
      $query = $this->nodeStorage
        ->getQuery()
        ->condition('field_api_reference', $api_reference->id());
      $group = $query->orConditionGroup()
        ->condition('type', 'api_basic_page')
        ->condition('type', 'api_page_builder');
      $api_other_pages_id = $query->condition($group)->execute();

      if (!empty($api_other_pages_id)) {
        foreach ($this->nodeStorage->loadMultiple($api_other_pages_id) as $api_other_page) {
          if ($api_other_page->access('view')) {
            $tabs[] = [
              'id' => $api_other_page->id(),
              'is_active' => $api_other_page->id() === $node->id(),
              'link' => [
                '#title' => $api_other_page->getTitle(),
                '#type' => 'link',
                '#url' => $api_other_page->toUrl('canonical'),
                '#cache' => [
                  'tags' => $api_other_page->getCacheTags(),
                ],
              ],
            ];
          }
        }
      }

      // Sort the pages by weight if provided by Draggable Views.
      // Every API page can appear in a single sorting table because API
      // related pages can reference only one API Reference.
      if ($this->connection->schema()->tableExists('draggableviews_structure') && $tabs) {
        /** @var \Drupal\Core\Database\Query\SelectInterface $query */
        $query = $this->connection
          ->select('draggableviews_structure', 'dw')
          ->fields('dw', ['entity_id', 'weight'])
          ->condition('view_name', 'api_pages')
          ->condition('view_display', 'api_tabs_sorting')
          ->condition('entity_id', array_column($tabs, 'id'), 'IN');
        $result = $query->execute();
        $weights = $result->fetchAllKeyed();

        uasort($tabs, static function (array $a, array $b) use ($weights): int {
          $id_a = $a['id'];
          $id_b = $b['id'];
          if (!array_key_exists($id_a, $weights)) {
            return -1;
          }
          if (!array_key_exists($id_b, $weights)) {
            return 1;
          }
          if ($weights[$id_a] == $weights[$id_b]) {
            return 0;
          }
          return $weights[$id_a] > $weights[$id_b] ? 1 : -1;
        });
      }

      return [
        '#theme' => 'api_tab_block',
        '#tabs' => $tabs,
      ];
    }

    return [];
  }

  /**
   * Grant access to API Tab block based on the node type.
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
