<?php

declare(strict_types = 1);

namespace Drupal\dp_api_docs;

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

use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Config\ConfigFactoryOverrideInterface;
use Drupal\Core\Config\StorableConfigBase;
use Drupal\Core\Config\StorageInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Config factory override.
 *
 * @deprecated in dp_api_docs:2.11.0 and is removed from dp_api_docs:3.0.0
 *   Upstream shouldn't alter or override config on the downstream.
 * @see https://www.drupal.org/project/drupal/issues/2996114
 */
class DpApiDocsConfigOverrides implements ConfigFactoryOverrideInterface {

  /**
   * The config factory object.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * The DpApiDocsConfigOverrides constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface|null $config_factory
   *   The config factory.
   */
  public function __construct(ConfigFactoryInterface $config_factory) {
    $this->configFactory = $config_factory;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container): DpApiDocsConfigOverrides {
    return new static(
      $container->get('config.factory')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function loadOverrides($names): array {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheSuffix(): string {
    return 'DpApiDocsOverrider';
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheableMetadata($name): CacheableMetadata {
    return new CacheableMetadata();
  }

  /**
   * {@inheritdoc}
   */
  public function createConfigObject($name, $collection = StorageInterface::DEFAULT_COLLECTION): ?StorableConfigBase {
    return NULL;
  }

}
