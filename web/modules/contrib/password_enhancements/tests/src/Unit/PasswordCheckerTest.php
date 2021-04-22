<?php

declare(strict_types = 1);

namespace Drupal\Tests\password_enhancements\Unit;

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

use Drupal\Component\Datetime\TimeInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Tests\UnitTestCase;
use Drupal\password_enhancements\PasswordChecker;
use Drupal\password_enhancements\PasswordPolicyInterface;
use Drupal\user\UserInterface;
use Drupal\user\UserStorageInterface;

/**
 * The PasswordCheckerTest test class.
 *
 * @group password_enhancements
 * @coversDefaultClass \Drupal\password_enhancements\PasswordChecker
 */
final class PasswordCheckerTest extends UnitTestCase {

  /**
   * Provides a list of values to test for testIsExpired().
   *
   * @see testIsExpired()
   */
  public function providerIsExpired(): array {
    return [
      [FALSE, NULL, 500, PasswordPolicyInterface::PASSWORD_NO_EXPIRY, FALSE],
      [FALSE, NULL, 500, 100, TRUE],
      [FALSE, NULL, 950, PasswordPolicyInterface::PASSWORD_NO_EXPIRY, FALSE],
      [FALSE, NULL, 950, 100, FALSE],

      [FALSE, FALSE, 500, PasswordPolicyInterface::PASSWORD_NO_EXPIRY, FALSE],
      [FALSE, FALSE, 500, 100, TRUE],
      [FALSE, FALSE, 950, PasswordPolicyInterface::PASSWORD_NO_EXPIRY, FALSE],
      [FALSE, FALSE, 950, 100, FALSE],

      [FALSE, TRUE, 500, PasswordPolicyInterface::PASSWORD_NO_EXPIRY, TRUE],
      [FALSE, TRUE, 500, 100, TRUE],
      [FALSE, TRUE, 950, PasswordPolicyInterface::PASSWORD_NO_EXPIRY, TRUE],
      [FALSE, TRUE, 950, 100, TRUE],

      [TRUE, NULL, 500, PasswordPolicyInterface::PASSWORD_NO_EXPIRY, FALSE],
      [TRUE, NULL, 500, 100, TRUE],
      [TRUE, NULL, 950, PasswordPolicyInterface::PASSWORD_NO_EXPIRY, FALSE],
      [TRUE, NULL, 950, 100, FALSE],

      [TRUE, FALSE, 500, PasswordPolicyInterface::PASSWORD_NO_EXPIRY, FALSE],
      [TRUE, FALSE, 500, 100, TRUE],
      [TRUE, FALSE, 950, PasswordPolicyInterface::PASSWORD_NO_EXPIRY, FALSE],
      [TRUE, FALSE, 950, 100, FALSE],

      [TRUE, TRUE, 500, PasswordPolicyInterface::PASSWORD_NO_EXPIRY, TRUE],
      [TRUE, TRUE, 500, 100, TRUE],
      [TRUE, TRUE, 950, PasswordPolicyInterface::PASSWORD_NO_EXPIRY, TRUE],
      [TRUE, TRUE, 950, 100, TRUE],
    ];
  }

  /**
   * Tests the isExpired() method.
   *
   * @covers ::isExpired
   *
   * @dataProvider providerIsExpired
   */
  public function testIsExpired(bool $provide_user, ?bool $password_enhancements_password_change_required, int $password_enhancements_password_changed_date, int $expire_seconds, bool $expected): void {
    $user = $this->createMock(AccountProxyInterface::class);
    $user->method('id')
      ->willReturn(1);

    $time = $this->createMock(TimeInterface::class);
    $time->method('getRequestTime')
      ->willReturn(1000);

    $mock_password_enhancements_password_change_required = $this->createMock(FieldItemListInterface::class);
    $mock_password_enhancements_password_change_required->method('getValue')
      ->willReturn(is_bool($password_enhancements_password_change_required) ? [0 => ['value' => $password_enhancements_password_change_required]] : NULL);

    $mock_password_enhancements_password_changed_date = $this->createMock(FieldItemListInterface::class);
    $mock_password_enhancements_password_changed_date->method('getValue')
      ->willReturn([0 => ['value' => $password_enhancements_password_changed_date]]);

    $mock_user = $this->createMock(UserInterface::class);
    $mock_user->method('get')
      ->will(
        $this->returnValueMap(
          [
            [
              'password_enhancements_password_change_required',
              $mock_password_enhancements_password_change_required,
            ],
            [
              'password_enhancements_password_changed_date',
              $mock_password_enhancements_password_changed_date,
            ],
          ]
        )
      );

    $mock_user_storage = $this->createMock(UserStorageInterface::class);
    $mock_user_storage->method('load')
      ->with(1)
      ->willReturn($mock_user);

    $entity_type_manager = $this->createMock(EntityTypeManagerInterface::class);
    $entity_type_manager->method('getStorage')
      ->with('user')
      ->willReturn($mock_user_storage);
    /** @var \Drupal\Core\Session\AccountProxyInterface $user */
    /** @var \Drupal\Component\Datetime\TimeInterface $time */
    /** @var \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager */
    $password_checker = new PasswordChecker($user, $time, $entity_type_manager);

    $policy = $this->createMock(PasswordPolicyInterface::class);
    $policy->method('getExpireSeconds')
      ->willReturn($expire_seconds);
    /** @var \Drupal\password_enhancements\PasswordPolicyInterface $policy */
    if ($provide_user) {
      /** @var \Drupal\user\UserInterface $mock_user */
      $this->assertEquals($expected, $password_checker->isExpired($policy, $mock_user));
    }
    else {
      $this->assertEquals($expected, $password_checker->isExpired($policy, NULL));
    }
  }

  /**
   * Provides a list of values to test for testIsWarningMessageNeeded().
   *
   * @see testIsWarningMessageNeeded()
   */
  public function providerIsWarningMessageNeeded(): array {
    // Having these admittedly long lines broken into multiple shorter ones
    // per Drupal's CS would significantly decrease their readability.
    // phpcs:disable Drupal.Arrays.Array.LongLineDeclaration
    return [
      [FALSE, 900, PasswordPolicyInterface::PASSWORD_NO_EXPIRY, PasswordPolicyInterface::PASSWORD_NO_WARNING, FALSE],
      [FALSE, 900, 200, PasswordPolicyInterface::PASSWORD_NO_WARNING, FALSE],
      [FALSE, 900, 200, 50, FALSE],

      [FALSE, 800, PasswordPolicyInterface::PASSWORD_NO_EXPIRY, PasswordPolicyInterface::PASSWORD_NO_WARNING, FALSE],
      [FALSE, 800, 200, PasswordPolicyInterface::PASSWORD_NO_WARNING, FALSE],
      [FALSE, 800, 200, 50, TRUE],

      [FALSE, 700, PasswordPolicyInterface::PASSWORD_NO_EXPIRY, PasswordPolicyInterface::PASSWORD_NO_WARNING, FALSE],
      [FALSE, 700, 200, PasswordPolicyInterface::PASSWORD_NO_WARNING, FALSE],
      [FALSE, 700, 200, 50, TRUE],

      [TRUE, 900, PasswordPolicyInterface::PASSWORD_NO_EXPIRY, PasswordPolicyInterface::PASSWORD_NO_WARNING, FALSE],
      [TRUE, 900, 200, PasswordPolicyInterface::PASSWORD_NO_WARNING, FALSE],
      [TRUE, 900, 200, 50, FALSE],

      [TRUE, 800, PasswordPolicyInterface::PASSWORD_NO_EXPIRY, PasswordPolicyInterface::PASSWORD_NO_WARNING, FALSE],
      [TRUE, 800, 200, PasswordPolicyInterface::PASSWORD_NO_WARNING, FALSE],
      [TRUE, 800, 200, 50, TRUE],

      [TRUE, 700, PasswordPolicyInterface::PASSWORD_NO_EXPIRY, PasswordPolicyInterface::PASSWORD_NO_WARNING, FALSE],
      [TRUE, 700, 200, PasswordPolicyInterface::PASSWORD_NO_WARNING, FALSE],
      [TRUE, 700, 200, 50, TRUE],
      // phpcs:enable Drupal.Arrays.Array.LongLineDeclaration
    ];
  }

  /**
   * Tests the isWarningMessageNeeded() method.
   *
   * @covers ::isWarningMessageNeeded
   *
   * @dataProvider providerIsWarningMessageNeeded
   */
  public function testIsWarningMessageNeeded(bool $provide_user, int $password_enhancements_password_changed_date, int $expire_seconds, int $expire_warn_seconds, bool $expected): void {
    $user = $this->createMock(AccountProxyInterface::class);
    $user->method('id')
      ->willReturn(1);

    $time = $this->createMock(TimeInterface::class);
    $time->method('getRequestTime')
      ->willReturn(1000);

    $mock_password_enhancements_password_changed_date = $this->createMock(FieldItemListInterface::class);
    $mock_password_enhancements_password_changed_date->method('getValue')
      ->willReturn([0 => ['value' => $password_enhancements_password_changed_date]]);

    $mock_user = $this->createMock(UserInterface::class);
    $mock_user->method('get')
      ->with('password_enhancements_password_changed_date')
      ->willReturn($mock_password_enhancements_password_changed_date);

    $mock_user_storage = $this->createMock(UserStorageInterface::class);
    $mock_user_storage->method('load')
      ->with(1)
      ->willReturn($mock_user);

    $entity_type_manager = $this->createMock(EntityTypeManagerInterface::class);
    $entity_type_manager->method('getStorage')
      ->with('user')
      ->willReturn($mock_user_storage);
    /** @var \Drupal\Core\Session\AccountProxyInterface $user */
    /** @var \Drupal\Component\Datetime\TimeInterface $time */
    /** @var \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager */
    $password_checker = new PasswordChecker($user, $time, $entity_type_manager);

    $policy = $this->createMock(PasswordPolicyInterface::class);
    $policy->method('getExpireSeconds')
      ->willReturn($expire_seconds);
    $policy->method('getExpireWarnSeconds')
      ->willReturn($expire_warn_seconds);
    /** @var \Drupal\password_enhancements\PasswordPolicyInterface $policy */
    if ($provide_user) {
      /** @var \Drupal\user\UserInterface $mock_user */
      $this->assertEquals($expected, $password_checker->isWarningMessageNeeded($policy, $mock_user));
    }
    else {
      $this->assertEquals($expected, $password_checker->isWarningMessageNeeded($policy, NULL));
    }
  }

}
