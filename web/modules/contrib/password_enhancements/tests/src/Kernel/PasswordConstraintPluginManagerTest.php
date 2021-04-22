<?php

declare(strict_types = 1);

namespace Drupal\Tests\password_enhancements\Kernel;

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

use Drupal\KernelTests\KernelTestBase;

/**
 * The PasswordConstraintPluginManagerTest test class.
 *
 * @group password_enhancements
 * @coversDefaultClass \Drupal\password_enhancements\PasswordConstraintPluginManager
 * @see \Drupal\Tests\aggregator\Kernel\AggregatorPluginManagerTest
 */
final class PasswordConstraintPluginManagerTest extends KernelTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'password_enhancements',
    'password_enhancements_constraint_plugin_manager_test',
  ];

  /**
   * Tests that the info alter hook works.
   *
   * @covers ::__construct
   */
  public function testPasswordConstraintPluginManager(): void {
    $widget_definition = $this->container->get('plugin.manager.password_enhancements.constraint')->getDefinition('password_enhancements_constraint_plugin_manager_test');

    // Test if hook_password_enhancements_constraint_info_alter is being called.
    $this->assertTrue($widget_definition['definition_altered'], "The 'password_enhancements_constraint_plugin_manager_test' plugin definition was updated in `hook_password_enhancements_constraint_info_alter()`");
  }

}
