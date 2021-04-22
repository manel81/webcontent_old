<?php

declare(strict_types = 1);

namespace Drupal\dp_blog\Plugin\Block;

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

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Datetime\DateFormatter;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\node\NodeInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides an 'Author and date' Block.
 *
 * @Block(
 *   id = "author_and_date_block",
 *   admin_label = @Translation("Author and date block"),
 *   category = @Translation("Author and date block"),
 * )
 */
class AuthorAndDateBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The date formatter service.
   *
   * @var \Drupal\Core\Datetime\DateFormatter
   */
  protected $dateFormatter;

  /**
   * The route match service.
   *
   * @var \Drupal\Core\Routing\RouteMatchInterface
   */
  protected $routeMatch;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition): self {
    $date_formatter = $container->get('date.formatter');
    $route_match = $container->get('current_route_match');

    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $date_formatter,
      $route_match
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
   * @param \Drupal\Core\Datetime\DateFormatter $date_formatter
   *   The date formatter service.
   * @param \Drupal\Core\Routing\RouteMatchInterface $route_match
   *   The route match service.
   */
  public function __construct(array $configuration, string $plugin_id, $plugin_definition, DateFormatter $date_formatter, RouteMatchInterface $route_match) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->dateFormatter = $date_formatter;
    $this->routeMatch = $route_match;
  }

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    $node = $this->routeMatch->getParameter('node');
    if ($node instanceof NodeInterface) {
      return [
        '#markup' => $node->getOwner()->getAccountName() . ' | ' . $this->dateFormatter->format($node->getCreatedTime(), 'blog_post_date'),
      ];
    }
    return [];
  }

}
