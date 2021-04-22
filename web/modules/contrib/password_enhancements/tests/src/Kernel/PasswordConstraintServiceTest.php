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

/**
 * The PasswordConstraintServiceTest test class.
 *
 * @group password_enhancements
 * @coversDefaultClass \Drupal\password_enhancements\PasswordConstraintService
 */
final class PasswordConstraintServiceTest extends KernelTestBase {

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
   * Tests all methods.
   *
   * @covers ::getPasswordRulesForRoles
   * @covers ::getPluginSettings
   */
  public function testAllMethods(): void {
    /** @var \Drupal\password_enhancements\PasswordConstraintService $constraint_service */
    $constraint_service = $this->container->get('password_enhancements.password_constraint');

    $random_string_1 = $this->randomString();
    $random_string_2 = $this->randomString();
    $config_for_uuid_1 = [
      'required' => FALSE,
      'minimum_characters' => 3,
      'descriptionSingular' => 'Add at least one character. ' . $random_string_1,
      'descriptionPlural' => 'Add @minimum_characters more characters. ' . $random_string_1,
    ];
    $config_for_uuid_2 = [
      'required' => FALSE,
      'minimum_characters' => 3,
      'descriptionSingular' => 'Add at least one special character. ' . $random_string_1,
      'descriptionPlural' => 'Add @minimum_characters more special characters. ' . $random_string_1,
      'use_custom_special_characters' => TRUE,
      'special_characters' => '()',
    ];
    $config_for_uuid_3 = [
      'required' => FALSE,
      'minimum_characters' => 3,
      'descriptionSingular' => 'Add at least one special character. ' . $random_string_2,
      'descriptionPlural' => 'Add @minimum_characters more special characters. ' . $random_string_2,
      'use_custom_special_characters' => TRUE,
      'special_characters' => '[]',
    ];
    /** @var \Drupal\user\Entity\Role $role_foo */
    $role_foo = Role::create([
      'id' => 'foo',
      'label' => 'Foo',
      'weight' => 0,
      'third_party_settings' => [
        'password_enhancements' => [
          'minimumRequiredConstraints' => 1,
          'expireSeconds' => PasswordPolicy::PASSWORD_NO_EXPIRY,
          'expireWarnSeconds' => PasswordPolicy::PASSWORD_NO_WARNING,
          'expiryWarningMessage' => NULL,
          'constraints' => [
            'uuid-1' => [
              'uuid' => 'uuid-1',
              'id' => 'minimum_characters',
              'data' => $config_for_uuid_1,
            ],
            'uuid-2' => [
              'uuid' => 'uuid-2',
              'id' => 'special_character',
              'data' => $config_for_uuid_2,
            ],
            'uuid-3' => [
              'uuid' => 'uuid-3',
              'id' => 'special_character',
              'data' => $config_for_uuid_3,
            ],
          ],
        ],
      ],
    ]);
    $role_foo->save();
    /** @var \Drupal\user\Entity\Role $role_bar */
    $config_for_uuid_4 = [
      'required' => TRUE,
      'minimum_characters' => 2,
      'descriptionSingular' => 'Add at least one character. ' . $random_string_2,
      'descriptionPlural' => 'Add @minimum_characters more characters. ' . $random_string_2,
    ];
    $role_bar = Role::create([
      'id' => 'bar',
      'label' => 'Bar',
      'weight' => 1,
      'third_party_settings' => [
        'password_enhancements' => [
          'minimumRequiredConstraints' => 2,
          'expireSeconds' => PasswordPolicy::PASSWORD_NO_EXPIRY,
          'expireWarnSeconds' => PasswordPolicy::PASSWORD_NO_WARNING,
          'expiryWarningMessage' => NULL,
          'constraints' => [
            'uuid-4' => [
              'uuid' => 'uuid-4',
              'id' => 'minimum_characters',
              'data' => $config_for_uuid_4,
            ],
          ],
        ],
      ],
    ]);
    $role_bar->save();

    // Too bad PHPCS can't recognize this type of assignments.
    // phpcs:disable DrupalPractice.CodeAnalysis.VariableAnalysis.UndefinedVariable
    [
      $minimum_required_constraints,
      $constraints,
    ] = $constraint_service->getPasswordRulesForRoles(
      [$role_foo->id(), $role_bar->id()]
    );
    $this->assertEquals(2, $minimum_required_constraints, 'Make sure the number of minimum required constraints is calculated properly');
    $this->assertCount(3, $constraints, 'Make sure correct number of constraints are returned');
    $this->assertArrayHasKey('uuid-2', $constraints, 'Make sure first expected constraint is returned');
    $this->assertArrayHasKey('uuid-3', $constraints, 'Make sure second expected constraint is returned');
    $this->assertArrayHasKey('uuid-4', $constraints, 'Make sure third expected constraint is returned');
    $this->assertArrayNotHasKey('uuid-1', $constraints, 'Make sure incorrect constraint is not returned');
    // phpcs:enable DrupalPractice.CodeAnalysis.VariableAnalysis.UndefinedVariable

    $settings = $constraint_service->getPluginSettings([
      $role_foo->id(),
      $role_bar->id(),
    ]);
    $this->assertTrue(isset($settings['configs']['minimum_characters']) && count($settings['configs']['minimum_characters']) === 1, 'Make sure only one minimum characters config is present');
    $this->assertTrue(isset($settings['configs']['minimum_characters']['uuid-4']) && $settings['configs']['minimum_characters']['uuid-4'] === $config_for_uuid_4, 'Make sure minimum characters config is returned properly');
    $this->assertTrue(isset($settings['configs']['special_character']) && count($settings['configs']['special_character']) === 2, 'Make sure only two special character configs are present');
    $this->assertTrue(isset($settings['configs']['special_character']['uuid-2']) && $settings['configs']['special_character']['uuid-2'] === $config_for_uuid_2, 'Make sure first special character config is returned properly');
    $this->assertTrue(isset($settings['configs']['special_character']['uuid-3']) && $settings['configs']['special_character']['uuid-3'] === $config_for_uuid_3, 'Make sure second special character config is returned properly');
    $this->assertCount(3, $settings['constraints'], 'Make sure the correct number of constraints is returned');
    $seen = [];
    // Tests shouldn't have t(), but PHPCS fails to recognize this.
    // phpcs:disable DrupalPractice.General.DescriptionT.DescriptionT
    foreach ($settings['constraints'] as $constraint) {
      $id = $constraint['#attributes']['id'];
      $seen[$id] = TRUE;
      $expected = [];
      switch ($id) {
        case 'uuid-2':
          $expected = [
            '#theme' => 'password_enhancements_policy_constraint',
            '#description' => 'Add <span data-key="minimum_characters">3</span> more special characters. ' . $random_string_1,
            '#attributes' => [
              'id' => 'uuid-2',
              'class' => [
                0 => 'constraint',
              ],
              'data-required' => 'no',
              'data-validation-passed' => 'no',
              'data-constraint' => 'special_character',
            ],
          ];
          break;

        case 'uuid-3':
          $expected = [
            '#theme' => 'password_enhancements_policy_constraint',
            '#description' => 'Add <span data-key="minimum_characters">3</span> more special characters. ' . $random_string_2,
            '#attributes' => [
              'id' => 'uuid-3',
              'class' => [
                0 => 'constraint',
              ],
              'data-required' => 'no',
              'data-validation-passed' => 'no',
              'data-constraint' => 'special_character',
            ],
          ];
          break;

        case 'uuid-4':
          $expected = [
            '#theme' => 'password_enhancements_policy_constraint',
            '#description' => 'Add <span data-key="minimum_characters">2</span> more characters. ' . $random_string_2 . ' (required)',
            '#attributes' => [
              'id' => 'uuid-4',
              'class' => [
                0 => 'constraint',
              ],
              'data-required' => 'yes',
              'data-validation-passed' => 'no',
              'data-constraint' => 'minimum_characters',
            ],
          ];
          break;
      }
      $this->assertEquals($expected, $constraint, 'Make sure constraint with ' . $id . ' is returned properly');
    }
    // phpcs:enable DrupalPractice.General.DescriptionT.DescriptionT
    $this->assertCount(3, $seen, 'Make sure all three constraints are returned');
    $this->assertTrue(array_search('password_enhancements/plugin.minimum_characters', $settings['libraries'], TRUE) !== FALSE, 'Make sure minimum characters JS library is present');
    $this->assertTrue(array_search('password_enhancements/plugin.special_character', $settings['libraries'], TRUE) !== FALSE, 'Make sure special character JS library is present');
    $this->assertEquals(2, $settings['minimumRequiredConstraints'], 'Make sure the correct number of minimum required constraints is returned');
  }

}
