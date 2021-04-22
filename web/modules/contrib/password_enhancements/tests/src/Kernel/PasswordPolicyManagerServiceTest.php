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
use Drupal\password_enhancements\Plugin\PasswordConstraint\MinimumCharacters;
use Drupal\user\Entity\Role;
use Drupal\user\RoleInterface;

/**
 * The PasswordPolicyManagerServiceTest test class.
 *
 * @group password_enhancements
 * @coversDefaultClass \Drupal\password_enhancements\PasswordPolicyManagerService
 */
final class PasswordPolicyManagerServiceTest extends KernelTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'user',
    'password_enhancements',
    // To be able to save a policy/role.
    'system',
  ];

  /**
   * Tests non-loading methods.
   *
   * @covers ::addPasswordConstraint
   * @covers ::savePolicy
   * @covers ::deletePasswordConstraint
   */
  public function testNonLoadingMethods(): void {
    /** @var \Drupal\password_enhancements\PasswordPolicyManagerService $policy_manager_service */
    $policy_manager_service = $this->container->get('password_enhancements.password_policy_manager');

    // Create a role with a policy, but without any constraints.
    /** @var \Drupal\user\Entity\Role $role */
    $role = Role::create([
      'id' => 'foo',
      'label' => 'Foo',
      'weight' => 0,
      'third_party_settings' => [
        'password_enhancements' => [
          'minimumRequiredConstraints' => 1,
          'expireSeconds' => PasswordPolicy::PASSWORD_NO_EXPIRY,
          'expireWarnSeconds' => PasswordPolicy::PASSWORD_NO_WARNING,
          'expiryWarningMessage' => NULL,
        ],
      ],
    ]);
    /** @var \Drupal\password_enhancements\PasswordConstraintPluginManager $constraint_plugin_manager */
    $constraint_plugin_manager = $this->container->get('plugin.manager.password_enhancements.constraint');
    $policy = PasswordPolicy::createFromRole($constraint_plugin_manager, $role);

    $this->assertCount(0, $policy->getConstraints(), 'Make sure no constraint exists before adding one');

    $config_created = [
      'id' => 'minimum_characters',
      'data' => [
        'required' => FALSE,
        'minimum_characters' => 1,
        'descriptionSingular' => 'foo',
        'descriptionPlural' => 'bar',
      ],
    ];
    $policy_manager_service->addPasswordConstraint($policy, $config_created);

    $this->assertCount(1, $policy->getConstraints(), 'Make sure one constraint exists after adding one');

    $constraint_ids = $policy->getConstraints()->getInstanceIds();
    $constraint_id = reset($constraint_ids);
    $constraint = $policy->getConstraint($constraint_id);

    $this->assertTrue($constraint instanceof MinimumCharacters, 'Make sure created constraint has proper type');
    $config_returned = $constraint->getConfiguration();
    unset($config_returned['uuid']);
    $this->assertEquals($config_created, $config_returned, 'Make sure created config is returned properly');

    $policy_manager_service->savePolicy($policy);
    $third_party_settings = $role->getThirdPartySettings('password_enhancements');
    $this->assertCount(1, $third_party_settings['constraints'], 'Make sure one constraint exists on the role after saving the policy');
    unset($third_party_settings['constraints'][$constraint_id]['uuid']);
    $this->assertEquals($config_created, $third_party_settings['constraints'][$constraint_id], 'Make sure created config is saved properly');

    $policy_manager_service->deletePasswordConstraint($policy, $constraint);
    $this->assertCount(0, $policy->getConstraints(), 'Make sure no constraint exists after deleting the single one');
  }

  /**
   * Creates a role with a skeleton policy.
   *
   * @param string $id
   *   The role's ID.
   * @param string $label
   *   The role's label (ie. displayed name).
   * @param int $weight
   *   The role's weight.
   *
   * @return \Drupal\user\RoleInterface
   *   The created role.
   *
   * @throws \Drupal\Core\Entity\EntityStorageException
   */
  private function createRole(string $id, string $label, int $weight): RoleInterface {
    $role = Role::create([
      'id' => $id,
      'label' => $label,
      'weight' => $weight,
      'third_party_settings' => [
        'password_enhancements' => [
          'minimumRequiredConstraints' => 1,
          'expireSeconds' => PasswordPolicy::PASSWORD_NO_EXPIRY,
          'expireWarnSeconds' => PasswordPolicy::PASSWORD_NO_WARNING,
          'expiryWarningMessage' => NULL,
        ],
      ],
    ]);
    $role->save();
    return $role;
  }

  /**
   * Tests the loading methods.
   *
   * @covers ::loadMultiplePoliciesByRoles
   * @covers ::loadPolicyByRoles
   */
  public function testLoadingMethods(): void {
    /** @var \Drupal\password_enhancements\PasswordPolicyManagerService $policy_manager_service */
    $policy_manager_service = $this->container->get('password_enhancements.password_policy_manager');

    $role_bare = Role::create([
      'id' => 'bare',
      'label' => 'Bare',
      'weight' => 0,
      'third_party_settings' => [
        'foo' => [],
      ],
    ]);
    $role_bare->save();

    $role_skeleton = $this->createRole('skeleton', 'Skeleton', 2);

    $policies = $policy_manager_service->loadMultiplePoliciesByRoles([
      $role_bare->id(),
      $role_skeleton->id(),
    ]);
    $this->assertCount(1, $policies, 'Make sure only roles with policies are returned');

    $role_authenticated = $this->createRole(RoleInterface::AUTHENTICATED_ID, RoleInterface::AUTHENTICATED_ID, 1);

    $policies = $policy_manager_service->loadMultiplePoliciesByRoles([
      $role_skeleton->id(),
      $role_authenticated->id(),
    ]);
    $last_policy = end($policies);
    $this->assertEquals($role_authenticated->id(), $last_policy->getRole()->id(), 'Make sure authenticated always comes last');

    $role_foo = $this->createRole('foo', 'Foo', 0);
    $role_bar = $this->createRole('bar', 'Bar', 1);
    $role_baz = $this->createRole('baz', 'Baz', 2);
    $policies = $policy_manager_service->loadMultiplePoliciesByRoles([
      $role_bare->id(),
      $role_skeleton->id(),
      $role_baz->id(),
      $role_bar->id(),
      $role_foo->id(),
      $role_authenticated->id(),
    ]);
    $policy_ids = array_map(static function (PasswordPolicy $policy) {
      return $policy->getRole()->id();
    }, $policies);
    $this->assertEquals([
      $role_skeleton->id(),
      $role_baz->id(),
      $role_bar->id(),
      $role_foo->id(),
      $role_authenticated->id(),
    ], $policy_ids, 'Make sure multiple policies are ordered correctly by loadMultiplePoliciesByRoles');

    $policy = $policy_manager_service->loadPolicyByRoles([
      $role_bare->id(),
      $role_skeleton->id(),
      $role_baz->id(),
      $role_bar->id(),
      $role_foo->id(),
      $role_authenticated->id(),
    ]);
    $this->assertEquals($role_skeleton->id(), $policy->getRole()->id(), 'Make sure the most important policy is returned by loadPolicyByRoles');
  }

}
