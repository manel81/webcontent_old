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
use Drupal\Core\Database\Connection;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\StringTranslation\TranslationInterface;
use Drupal\Core\Url;
use Drupal\node\NodeInterface;
use Drupal\node\NodeStorageInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides an 'API Product Tab' block.
 *
 * @Block(
 *   id = "api_product_tab_block",
 *   admin_label = @Translation("API Product Tab block"),
 *   category = @Translation("API Product Tab block"),
 * )
 */
class ApiProductTabBlock extends BlockBase implements ContainerFactoryPluginInterface {

  use StringTranslationTrait;

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
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('current_route_match'),
      $container->get('entity_type.manager')->getStorage('node'),
      $container->get('database'),
      $container->get('string_translation')
    );
  }

  /**
   * Creates tabs for the API Product related pages.
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
   * @param \Drupal\Core\StringTranslation\TranslationInterface $string_translation
   *   The string translation service.
   */
  public function __construct(array $configuration, string $plugin_id, $plugin_definition, RouteMatchInterface $route_match, NodeStorageInterface $node_storage, Connection $connection, TranslationInterface $string_translation) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->routeMatch = $route_match;
    $this->nodeStorage = $node_storage;
    $this->connection = $connection;
    $this->stringTranslation = $string_translation;
  }

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $node = $this->routeMatch->getParameter('node');
    if ($node instanceof NodeInterface) {
      // Doesn't check access here, because if the user doesn't have access to
      // the API Reference they can have access to the API related pages.
      if ($node->bundle() === 'api_product') {
        $api_product = $node;
      }
      elseif ($node->hasField('field_api_product') && !$node->get('field_api_product')->isEmpty()) {
        $api_product = $node->get('field_api_product')->entity;
      }
      else {
        return [];
      }

      $tabs = [];

      // Add API Product Description page.
      $api_product_description_page = $this->nodeStorage
        ->loadByProperties([
          'field_api_product' => $api_product->id(),
          'type' => 'api_product_description_page',
        ]);

      if (!empty($api_product_description_page)) {
        // Get the first array element as only one API Product Description page
        // should reference an API product.
        $api_product_description_page = reset($api_product_description_page);
        if ($api_product_description_page && $api_product_description_page->access('view')) {
          $nid = $api_product_description_page->id();
          $tabs[] = [
            'id' => $nid,
            'is_active' => $nid === $node->id(),
            'link' => [
              '#title' => $this->t('Overview'),
              '#type' => 'link',
              '#url' => Url::fromRoute('entity.node.canonical', ['node' => $nid]),
              '#cache' => [
                'tags' => $api_product_description_page->getCacheTags(),
              ],
            ],
          ];
        }
      }

      // Add API Product page.
      if ($api_product->access('view')) {
        $tabs[] = [
          'id' => $api_product->id(),
          'is_active' => $api_product->id() === $node->id(),
          'link' => [
            '#title' => $this->t('Documentation'),
            '#type' => 'link',
            '#url' => Url::fromRoute('entity.node.canonical', ['node' => $api_product->id()]),
            '#cache' => [
              'tags' => $api_product->getCacheTags(),
            ],
          ],
        ];
      }

      // Add API Product release note page.
      $api_product_release_note = $this->nodeStorage
        ->loadByProperties([
          'field_api_product' => $api_product->id(),
          'type' => 'api_product_release_note',
        ]);

      if (!empty($api_product_release_note)) {
        $api_product_release_note = reset($api_product_release_note);
        if ($api_product_release_note && $api_product_release_note->access('view')) {
          $tabs[] = [
            'id' => $api_product_release_note->id(),
            'is_active' => $api_product_release_note->id() === $node->id(),
            'link' => [
              '#title' => $this->t('Release Notes'),
              '#type' => 'link',
              '#url' => $api_product_release_note->toUrl('canonical'),
              '#cache' => [
                'tags' => $api_product_release_note->getCacheTags(),
              ],
            ],
          ];
        }
      }

      // Sort the pages by weight if provided by Draggable Views.
      // Every API page can appear in a single sorting table because API Product
      // related pages can reference only one API Product.
      if ($this->connection->schema()->tableExists('draggableviews_structure') && $tabs) {
        /** @var \Drupal\Core\Database\Query\SelectInterface $query */
        $query = $this->connection
          ->select('draggableviews_structure', 'dw')
          ->fields('dw', ['entity_id', 'weight'])
          ->condition('view_name', 'api_product_pages')
          ->condition('view_display', 'api_product_tabs_sorting')
          ->condition('entity_id', array_column($tabs, 'id'), 'IN');
        $result = $query->execute();
        $weights = $result->fetchAllKeyed();

        uasort($tabs, static function (array $a, array $b) use ($weights): int {
          if (!array_key_exists($a['id'], $weights)) {
            return -1;
          }
          if (!array_key_exists($b['id'], $weights)) {
            return 1;
          }
          if ($weights[$a['id']] == $weights[$b['id']]) {
            return 0;
          }
          return $weights[$a['id']] <=> $weights[$b['id']];
        });
      }

      return [
        '#theme' => 'api_product_tab_block',
        '#tabs' => $tabs,
      ];
    }

    return [];
  }

  /**
   * Grant access to API Prodcut Tab block based on the node type.
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
