<?php

declare(strict_types = 1);

/**
 * @file
 * Config filter file for Allianz Error pages.
 *
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

namespace Drupal\allianz_error_pages\Plugin\ConfigFilter;

use Drupal\Core\Config\StorageInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\config_filter\Config\StorageFilterInterface;
use Drupal\config_filter\Plugin\ConfigFilterBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a custom block placement filter.
 *
 * @ConfigFilter(
 *   id = "allianz_error_pages_filter",
 *   label = "Filters Allianz Error pages from configuration"
 * )
 */
class ContactBlockFilter extends ConfigFilterBase implements ContainerFactoryPluginInterface {

  /**
   * The active configuration storage.
   *
   * @var \Drupal\Core\Config\StorageInterface
   */
  protected $active;

  /**
   * Constructs a new CustomBlockFilter.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param array $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Config\StorageInterface $active
   *   The active configuration store with the configuration on the site.
   */
  public function __construct(array $configuration, string $plugin_id, array $plugin_definition, StorageInterface $active) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->active = $active;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition): self {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('config.storage')
    );
  }

  /**
   * Checks if the name matches a custom block.
   *
   * @param string $name
   *   The configuration name.
   *
   * @return bool
   *   TRUE if it matches.
   */
  public function isIgnoredBlock(string $name): bool {
    return $name === 'allianz_error_pages.settings';
  }

  /**
   * {@inheritdoc}
   */
  public function filterRead($name, $data) {
    if ($this->isIgnoredBlock($name)) {
      return $this->active->read($name);
    }
    return $data;
  }

  /**
   * {@inheritdoc}
   */
  public function filterWrite($name, array $data): ?array {
    return $this->isIgnoredBlock($name) ? NULL : $data;
  }

  /**
   * {@inheritdoc}
   */
  public function filterExists($name, $exists): bool {
    return $exists || ($this->isIgnoredBlock($name) && $this->active->exists($name));
  }

  /**
   * {@inheritdoc}
   */
  public function filterReadMultiple(array $names, array $data): array {
    $names = array_filter($names, [$this, 'isIgnoredBlock']);
    $active_data = [];
    foreach ($names as $name) {
      $active_data[$name] = $this->active->read($name);
    }

    return array_merge($data, $active_data);
  }

  /**
   * {@inheritdoc}
   */
  public function filterListAll($prefix, array $data): array {
    $active_names = array_filter($this->active->listAll($prefix), [$this, 'isIgnoredBlock']);

    return array_unique(array_merge($data, $active_names));
  }

  /**
   * {@inheritdoc}
   */
  public function filterCreateCollection($collection): StorageFilterInterface {
    return new static($this->configuration, $this->pluginId, $this->pluginDefinition, $this->active->createCollection($collection));
  }

  /**
   * {@inheritdoc}
   */
  public function filterGetAllCollectionNames(array $collections): array {
    return array_merge($collections, $this->active->getAllCollectionNames());
  }

}
