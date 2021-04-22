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
use Symfony\Component\Routing\Route;

/**
 * Tests the PasswordConstraintTypeParamConverter class.
 *
 * @group password_enhancements
 * @coversDefaultClass \Drupal\password_enhancements\Routing\PasswordConstraintTypeParamConverter
 */
class PasswordConstraintTypeParamConverterTest extends KernelTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'password_enhancements',
  ];

  /**
   * Tests all the methods.
   *
   * @covers ::convert
   * @covers ::applies
   */
  public function testMethods(): void {
    /** @var \Drupal\password_enhancements\Routing\PasswordConstraintTypeParamConverter $constraint_type_paramconverter */
    $constraint_type_paramconverter = $this->container->get('password_enhancements.paramconverter.password_constraint_type');
    $plugin_definition = $this->container->get('plugin.manager.password_enhancements.constraint')->getDefinition('minimum_characters');

    $converted = $constraint_type_paramconverter->convert('minimum_characters', NULL, NULL, []);
    $this->assertEquals($plugin_definition, $converted, 'Make sure minimum_characters is properly paramconverted from string to plugin definition');

    /** @var \Symfony\Component\Routing\Route $mock_route */
    $mock_route = $this->createMock(Route::class);
    $definition = ['type' => 'password_constraint_type'];
    $actual = $constraint_type_paramconverter->applies($definition, 'password_constraint', $mock_route);
    $this->assertTrue($actual, 'Make sure paramconverter applies to proper definition type');
    $definition['type'] = 'foo';
    $this->assertFalse($constraint_type_paramconverter->applies($definition, 'password_constraint', $mock_route), 'Make sure paramconverter does not apply to improper definition type');
    $definition['type'] = '';
    $this->assertFalse($constraint_type_paramconverter->applies($definition, 'password_constraint', $mock_route), 'Make sure paramconverter does not apply to empty definition type');
  }

}
