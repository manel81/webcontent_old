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
use Drupal\password_enhancements\PasswordPolicy;
use Drupal\user\Entity\Role;
use Symfony\Component\Routing\Route;

/**
 * Tests the PasswordConstraintParamConverter class.
 *
 * @group password_enhancements
 * @coversDefaultClass \Drupal\password_enhancements\Routing\PasswordConstraintParamConverter
 */
class PasswordConstraintParamConverterTest extends KernelTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'user',
    'password_enhancements',
    'system',
  ];

  /**
   * Tests all the methods.
   *
   * @covers ::convert
   * @covers ::applies
   */
  public function testMethods(): void {
    /** @var \Drupal\password_enhancements\Routing\PasswordConstraintParamConverter $constraint_paramconverter */
    $constraint_paramconverter = $this->container->get('password_enhancements.paramconverter.password_constraint');

    /** @var \Drupal\user\Entity\Role $role */
    $role = Role::create([
      'id' => 'foo' . $this->randomMachineName(),
      'label' => $this->randomString(),
    ]);
    $role->save();

    $converted = $constraint_paramconverter->convert(NULL, NULL, NULL, ['user_role' => $role->id()]);
    $this->assertNull($converted, 'Make sure no conversion happens without a constraint UUID');

    $converted = $constraint_paramconverter->convert('bar', NULL, NULL, ['user_role' => NULL]);
    $this->assertNull($converted, 'Make sure no conversion happens without a role ID');

    $converted = $constraint_paramconverter->convert('bar', NULL, NULL, ['user_role' => 'baz']);
    $this->assertNull($converted, 'Make sure no conversion happens with an unknown role');

    $converted = $constraint_paramconverter->convert('bar', NULL, NULL, ['user_role' => $role->id()]);
    $this->assertNull($converted, 'Make sure no conversion happens with a role without a policy');

    $role->setThirdPartySetting('password_enhancements', 'minimumRequiredConstraints', 1);
    $role->setThirdPartySetting('password_enhancements', 'expireSeconds', PasswordPolicy::PASSWORD_NO_EXPIRY);
    $role->setThirdPartySetting('password_enhancements', 'expireWarnSeconds', PasswordPolicy::PASSWORD_NO_WARNING);
    $role->setThirdPartySetting('password_enhancements', 'expiryWarningMessage', NULL);
    $role->save();
    $converted = $constraint_paramconverter->convert('bar', NULL, NULL, ['user_role' => $role->id()]);
    $this->assertNull($converted, 'Make sure no conversion happens with a role with a policy without any constraint');

    $config_for_uuid_1 = [
      'required' => FALSE,
      'minimum_characters' => 3,
      'descriptionSingular' => 'Add at least one character. ' . $this->randomString(),
      'descriptionPlural' => 'Add @minimum_characters more characters. ' . $this->randomString(),
    ];
    $role->setThirdPartySetting('password_enhancements', 'constraints', [
      'uuid-1' => [
        'uuid' => 'uuid-1',
        'id' => 'minimum_characters',
        'data' => $config_for_uuid_1,
      ],
    ]);
    $role->save();
    $converted = $constraint_paramconverter->convert('bar', NULL, NULL, ['user_role' => $role->id()]);
    $this->assertNull($converted, 'Make sure no conversion happens with a role with a policy with an unknown constraint UUID');

    $converted = $constraint_paramconverter->convert('uuid-1', NULL, NULL, ['user_role' => $role->id()]);
    $policy = PasswordPolicy::createFromRole($this->container->get('plugin.manager.password_enhancements.constraint'), $role);
    $this->assertEquals($policy->getConstraint('uuid-1'), $converted, 'Make sure constraint UUID is properly paramconverted from string to constraint object');

    /** @var \Symfony\Component\Routing\Route $mock_route */
    $mock_route = $this->createMock(Route::class);
    $definition = ['type' => 'password_constraint'];
    $actual = $constraint_paramconverter->applies($definition, 'password_constraint', $mock_route);
    $this->assertTrue($actual, 'Make sure paramconverter applies to proper definition type');
    $definition['type'] = 'foo';
    $this->assertFalse($constraint_paramconverter->applies($definition, 'password_constraint', $mock_route), 'Make sure paramconverter does not apply to improper definition type');
    $definition['type'] = '';
    $this->assertFalse($constraint_paramconverter->applies($definition, 'password_constraint', $mock_route), 'Make sure paramconverter does not apply to empty definition type');
  }

}
