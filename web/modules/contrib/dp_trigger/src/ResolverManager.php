<?php

declare(strict_types = 1);

namespace Drupal\dp_trigger;

/**
 * Devportal Pro module for Drupal.
 *
 * Copyright (C) 2018 PRONOVIX GROUP BVBA.
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

use Drupal\Component\Plugin\Factory\DefaultFactory;
use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\Core\Routing\RouteMatchInterface;

/**
 * Resolver plugin manager.
 */
class ResolverManager extends DefaultPluginManager {

  /**
   * {@inheritdoc}
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct(
      'Plugin/TriggerResolver',
      $namespaces,
      $module_handler,
      ResolverInterface::class
    );

    $this->alterInfo('dp_trigger_resolver_info');
    $this->setCacheBackend($cache_backend, 'dp_trigger_resolver_info_plugins');
    $this->factory = new DefaultFactory($this->getDiscovery());
  }

  /**
   * Finds an entity for a route match.
   *
   * @param \Drupal\Core\Routing\RouteMatchInterface $routeMatch
   *   Input route match.
   *
   * @return \Drupal\Core\Entity\EntityInterface|null
   *   Entity if found.
   */
  public function findEntity(RouteMatchInterface $routeMatch): ?EntityInterface {
    foreach ($this->getDefinitions() as $id => $definition) {
      $entity = $routeMatch->getParameter($id);
      if ($entity) {
        return $entity;
      }
    }

    return NULL;
  }

}
