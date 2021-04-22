<?php

declare(strict_types = 1);

namespace Drupal\password_enhancements;

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

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\password_enhancements\Annotation\PasswordConstraint;

/**
 * Manages password constraint plugins.
 *
 * @see hook_password_enhancements_constraint_info_alter()
 * @see \Drupal\password_enhancements\Annotation\PasswordConstraint
 * @see \Drupal\password_enhancements\PasswordConstraintInterface
 * @see \Drupal\password_enhancements\Plugin\PasswordConstraint\PasswordConstraintBase
 * @see plugin_api
 */
final class PasswordConstraintPluginManager extends DefaultPluginManager {

  /**
   * Constructs a new PasswordConstraintPluginManager.
   *
   * @param \Traversable $namespaces
   *   An object that implements \Traversable which contains the root paths
   *   keyed by the corresponding namespace to look for plugin implementations.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   Cache backend instance to use.
   * @param \Drupal\Core\Extension\ModuleHandlerInterface $module_handler
   *   The module handler.
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct(
      'Plugin/PasswordConstraint',
      $namespaces,
      $module_handler,
      PasswordConstraintInterface::class,
      PasswordConstraint::class
    );

    $this->alterInfo('password_enhancements_constraint_info');
    $this->setCacheBackend($cache_backend, 'password_enhancements_constraint_plugins');
  }

}
