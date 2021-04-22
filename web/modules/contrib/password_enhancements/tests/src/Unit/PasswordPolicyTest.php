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

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Tests\UnitTestCase;
use Drupal\password_enhancements\Exception\PolicyInvalidArgumentException;
use Drupal\password_enhancements\PasswordConstraintPluginManager;
use Drupal\password_enhancements\PasswordPolicy;
use Drupal\password_enhancements\PasswordPolicyInterface;
use Drupal\user\RoleInterface;

/**
 * The PasswordPolicyTest test class.
 *
 * @group password_enhancements
 * @coversDefaultClass \Drupal\password_enhancements\PasswordPolicy
 */
final class PasswordPolicyTest extends UnitTestCase {

  /**
   * Creates a password policy with the (mocked) role.
   *
   * @param \Drupal\user\RoleInterface $role
   *   The role.
   *
   * @return \Drupal\password_enhancements\PasswordPolicyInterface|null
   *   The generated password policy or NULL.
   */
  private function createPolicy(RoleInterface $role): ?PasswordPolicyInterface {
    /** @var \Traversable $traversable */
    $traversable = $this->createMock(\Traversable::class);
    /** @var \Drupal\Core\Cache\CacheBackendInterface $cache_backend */
    $cache_backend = $this->createMock(CacheBackendInterface::class);
    /** @var \Drupal\Core\Extension\ModuleHandlerInterface $module_handler */
    $module_handler = $this->createMock(ModuleHandlerInterface::class);
    $constraint_plugin_manager = new PasswordConstraintPluginManager($traversable, $cache_backend, $module_handler);
    return PasswordPolicy::createFromRole($constraint_plugin_manager, $role);
  }

  /**
   * Tests the createFromRole() method.
   *
   * @covers ::createFromRole
   */
  public function testNoPasswordPolicy(): void {
    /** @var \Drupal\user\RoleInterface $role */
    $role = $this->createMock(RoleInterface::class);
    $policy = $this->createPolicy($role);
    $this->assertNull($policy, 'Make sure no policy is generated without data.');
  }

  /**
   * Tests the basic password policy methods.
   *
   * @covers ::createFromRole
   * @covers ::getExpireSeconds
   * @covers ::getExpiryWarningMessage
   * @covers ::getMinimumRequiredConstraints
   * @covers ::getPriority
   * @covers ::getRole
   * @covers ::setExpireWarnSeconds
   */
  public function testPasswordPolicyBasics(): void {
    $role = $this->createMock(RoleInterface::class);
    $role->method('getThirdPartySettings')
      ->with('password_enhancements')
      ->willReturn(['foo' => 'bar']);
    /** @var \Drupal\user\RoleInterface $role */
    $policy = $this->createPolicy($role);

    $this->assertEquals(PasswordPolicy::PASSWORD_NO_EXPIRY, $policy->getExpireSeconds(), 'Make sure no expiry is set without such data.');
    $this->assertEquals(PasswordPolicy::PASSWORD_NO_WARNING, $policy->getExpireWarnSeconds(), 'Make sure no expiry warning is set without such data.');
    $this->assertEquals('Your password will expire on @date_time, please <a href="@url">change your password</a> before it expires to prevent any potential data loss.', $policy->getExpiryWarningMessage(), 'Make sure the default expiry warning message is used without such data.');
    $this->assertEquals(1, $policy->getMinimumRequiredConstraints(), 'Make sure one constraint is required without such data.');
    $this->assertEquals($role, $policy->getRole(), 'Make sure the role is known from the policy.');

    $role->method('getWeight')
      // @see https://xkcd.com/221/
      ->willReturn(4);
    $this->assertEquals(4, $policy->getPriority(), 'Make sure the role weight is returned as the priority of the policy.');

    $this->expectException(PolicyInvalidArgumentException::class);
    $this->expectExceptionMessage('The expiry warning in seconds must be a positive integer or zero.');
    $policy->setExpireWarnSeconds(-1);
  }

  /**
   * Tests the constructor of the PasswordPolicy class.
   *
   * @covers ::createFromRole
   * @covers ::getExpireSeconds
   * @covers ::getExpireWarnSeconds
   * @covers ::getExpiryWarningMessage
   * @covers ::getMinimumRequiredConstraints
   */
  public function testPasswordPolicyConstructor(): void {
    $role = $this->createMock(RoleInterface::class);
    $expireSeconds = 2;
    $expireWarnSeconds = 3;
    $expiryWarningMessage = 'No @url, no change';
    $minimumRequiredConstraints = 4;
    $role->method('getThirdPartySettings')
      ->with('password_enhancements')
      ->willReturn([
        'expireSeconds' => $expireSeconds,
        'expireWarnSeconds' => $expireWarnSeconds,
        'expiryWarningMessage' => $expiryWarningMessage,
        'minimumRequiredConstraints' => $minimumRequiredConstraints,
      ]);
    /** @var \Drupal\user\RoleInterface $role */
    $policy = $this->createPolicy($role);

    $this->assertEquals($expireSeconds, $policy->getExpireSeconds(), 'Make sure expiry is properly set via the constructor.');
    $this->assertEquals($expireWarnSeconds, $policy->getExpireWarnSeconds(), 'Make sure the expiry warning is properly set via the constructor.');
    $this->assertEquals($expiryWarningMessage, $policy->getExpiryWarningMessage(), 'Make sure the expiry warning message is properly set via the constructor.');
    $this->assertEquals($minimumRequiredConstraints, $policy->getMinimumRequiredConstraints(), 'Make sure the number of minimum required constraints is properly set via the constructor.');
  }

  /**
   * Tests the expiry on policy objects.
   *
   * @covers ::getExpireDays
   * @covers ::getExpireWarnDays
   * @covers ::getExpiryWarningMessage
   * @covers ::setExpireSeconds
   */
  public function testExpiry(): void {
    $role = $this->createMock(RoleInterface::class);
    $role->method('getThirdPartySettings')
      ->with('password_enhancements')
      ->willReturn([
        'expireSeconds' => 2 * 24 * 60 * 60 + 1,
        'expireWarnSeconds' => 3 * 24 * 60 * 60 + 1,
        'expiryWarningMessage' => 'foo',
      ]);
    /** @var \Drupal\user\RoleInterface $role */
    $policy = $this->createPolicy($role);

    $this->assertEquals(2, $policy->getExpireDays(), 'Make sure expiry is returned properly in days.');
    $this->assertEquals(3, $policy->getExpireWarnDays(), 'Make sure expiry warning is returned properly in days.');

    $policy->setExpireSeconds(0);
    $this->assertEquals(0, $policy->getExpireWarnSeconds(), 'Make sure expiry warning seconds is set to zero seconds when expiry is set to zero seconds.');
    $this->assertNull($policy->getExpiryWarningMessage(), 'Make sure expiry warning message is nulled out when expiry is set to zero seconds.');

    $this->expectException(PolicyInvalidArgumentException::class);
    $this->expectExceptionMessage('The expiry warning in seconds must be lower than or equal to the expiry in seconds.');
    $policy->setExpireWarnSeconds(1);
  }

  /**
   * Tests the setExpireSeconds() method.
   *
   * @covers ::setExpireSeconds
   */
  public function testNonNegativeExpiry(): void {
    $role = $this->createMock(RoleInterface::class);
    $role->method('getThirdPartySettings')
      ->with('password_enhancements')
      ->willReturn(['foo' => 'bar']);
    /** @var \Drupal\user\RoleInterface $role */
    $policy = $this->createPolicy($role);

    $this->expectException(PolicyInvalidArgumentException::class);
    $this->expectExceptionMessage('The expiry given in seconds must be a positive integer or zero.');
    $policy->setExpireSeconds(-1);
  }

  /**
   * Tests the expiry warning messages.
   *
   * @covers ::createFromRole
   * @covers ::setExpiryWarningMessage
   * @covers ::setExpireWarnSeconds
   * @covers ::setExpireSeconds
   */
  public function testExpiryWarningMessage(): void {
    $message = $this->getRandomGenerator()->string();
    $role = $this->createMock(RoleInterface::class);
    $role->method('getThirdPartySettings')
      ->with('password_enhancements')
      ->willReturn([
        'expireSeconds' => 2,
        'expireWarnSeconds' => 1,
        'expiryWarningMessage' => 'foo' . $message,
      ]);
    /** @var \Drupal\user\RoleInterface $role */
    $policy = $this->createPolicy($role);

    $policy->setExpiryWarningMessage($message);
    $this->assertEquals($message, $policy->getExpiryWarningMessage(), 'Make sure expiry warning message is properly updated.');
    $policy->setExpireWarnSeconds(0);
    $policy->setExpiryWarningMessage(NULL);
    $this->assertNull($policy->getExpiryWarningMessage(), 'Make sure expiry warning message can be nulled out when expiry warning is set to zero seconds.');

    $policy->setExpireSeconds(0);
    $policy->setExpiryWarningMessage(NULL);
    $this->assertNull($policy->getExpiryWarningMessage(), 'Make sure expiry warning message can be nulled out when expiry is set to zero seconds.');

    $seconds = 2;
    $policy->setExpireSeconds($seconds);
    $policy->setExpireWarnSeconds($seconds);
    $this->assertEquals($seconds, $policy->getExpireWarnSeconds(), 'Make sure expiry warning seconds can be as high as expiry seconds.');

    $this->expectException(PolicyInvalidArgumentException::class);
    $this->expectExceptionMessage('Expiry warning message cannot be empty for expiring passwords.');
    $policy->setExpiryWarningMessage(NULL);
  }

  /**
   * Tests the minimum required constraints.
   *
   * @covers ::createFromRole
   * @covers ::setMinimumRequiredConstraints
   * @covers ::getMinimumRequiredConstraints
   */
  public function testMinimumRequiredConstraints(): void {
    $role = $this->createMock(RoleInterface::class);
    $role->method('getThirdPartySettings')
      ->with('password_enhancements')
      ->willReturn([
        'minimumRequiredConstraints' => 1,
      ]);
    /** @var \Drupal\user\RoleInterface $role */
    $policy = $this->createPolicy($role);

    $policy->setMinimumRequiredConstraints(0);
    $this->assertEquals(0, $policy->getMinimumRequiredConstraints(), 'Make sure the number of minimum required constraints can be set properly to zero.');

    $this->expectException(PolicyInvalidArgumentException::class);
    $this->expectExceptionMessage('The minimum requirements cannot be less than zero.');
    $policy->setMinimumRequiredConstraints(-1);
  }

  /**
   * Tests the constraints of a policy.
   *
   * @covers ::createFromRole
   * @covers ::getConstraints
   */
  public function testConstraints(): void {
    $uuid = $this->getRandomGenerator()->name(40, TRUE);
    $role = $this->createMock(RoleInterface::class);
    $role->method('getThirdPartySettings')
      ->with('password_enhancements')
      ->willReturn([
        'constraints' => [
          $uuid => [
            'uuid' => $uuid,
            'id' => 'foo',
            'data' => [
              'required' => FALSE,
            ],
          ],
        ],
      ]);
    /** @var \Drupal\user\RoleInterface $role */
    $policy = $this->createPolicy($role);

    $this->assertEquals(1, count($policy->getConstraints()), 'Make sure exactly one constraint is returned.');
    // Since we are not mocking the whole plugin-discovery stack, we cannot test
    // here that $policy->getConstraint($uuid) returns a
    // PasswordConstraintInterface nor that an exception is thrown when this
    // method gets called with an invalid UUID. Instead, these will be tested at
    // a place where Drupal's booted.
    // @see \Drupal\Tests\password_enhancements\Functional\PasswordConstraintFormTest::testPasswordConstraintEditAndDeleteForm()
  }

}
