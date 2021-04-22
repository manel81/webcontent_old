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

use Drupal\user\RoleInterface;

/**
 * Defines required methods for the password policy.
 */
interface PasswordPolicyInterface {

  /**
   * Password with no expiry.
   *
   * @var int
   */
  public const PASSWORD_NO_EXPIRY = 0;

  /**
   * Do not show error message.
   *
   * @var int
   */
  public const PASSWORD_NO_WARNING = 0;

  /**
   * Creates a Password Policy object from a Role.
   *
   * @param \Drupal\password_enhancements\PasswordConstraintPluginManager $constraint_plugin_manager
   *   The password constraint plugin manager.
   * @param \Drupal\user\RoleInterface $role
   *   The role.
   *
   * @return \Drupal\password_enhancements\PasswordPolicyInterface|null
   *   The password policy object initialized from the role, or NULL if the role
   *   doesn't have password policy info.
   */
  public static function createFromRole(PasswordConstraintPluginManager $constraint_plugin_manager, RoleInterface $role): ?PasswordPolicyInterface;

  /**
   * Gets the expiry in days.
   *
   * @return int
   *   The expiry in days.
   */
  public function getExpireDays(): int;

  /**
   * Gets the expiry in seconds.
   *
   * @return int
   *   The expiry in seconds.
   */
  public function getExpireSeconds(): int;

  /**
   * Gets how long before the warning message should be shown in seconds.
   *
   * @return int
   *   The seconds how long before the warning should be shown.
   */
  public function getExpireWarnSeconds(): int;

  /**
   * Gets the expire warning in days.
   *
   * @return int
   *   The expire warning in days.
   */
  public function getExpireWarnDays(): int;

  /**
   * Gets expiry warning message.
   *
   * @return string|null
   *   The expiry warning message.
   */
  public function getExpiryWarningMessage(): ?string;

  /**
   * Gets the minimally required constraint number.
   *
   * @return int
   *   The minimally required constraint number.
   */
  public function getMinimumRequiredConstraints(): int;

  /**
   * Gets the priority of the policy.
   *
   * @return int
   *   The policy's priority.
   */
  public function getPriority(): int;

  /**
   * Gets the related user role.
   *
   * @return \Drupal\user\RoleInterface
   *   The user role.
   */
  public function getRole(): RoleInterface;

  /**
   * Sets the expiry in seconds.
   *
   * @param int $seconds
   *   The expiry in seconds.
   *
   * @return \Drupal\password_enhancements\PasswordPolicyInterface
   *   The current object.
   *
   * @throws \Drupal\password_enhancements\Exception\PolicyInvalidArgumentException
   *   If the the given seconds value is negative.
   */
  public function setExpireSeconds(int $seconds): PasswordPolicyInterface;

  /**
   * Sets how long before the warning message should be shown in seconds.
   *
   * @param int $seconds
   *   The seconds how long before the warning message should be shown.
   *
   * @return \Drupal\password_enhancements\PasswordPolicyInterface
   *   The current object.
   *
   * @throws \Drupal\password_enhancements\Exception\PolicyInvalidArgumentException
   *   If the the given seconds value is negative.
   */
  public function setExpireWarnSeconds(int $seconds): PasswordPolicyInterface;

  /**
   * Sets expiry warning message.
   *
   * @param string|null $message
   *   The expiry warning message or NULL if none.
   *
   * @return \Drupal\password_enhancements\PasswordPolicyInterface
   *   The current object.
   */
  public function setExpiryWarningMessage(?string $message): PasswordPolicyInterface;

  /**
   * Sets the minimally required constraints.
   *
   * @param int $number
   *   The number of the minimally required constraints.
   *
   * @return \Drupal\password_enhancements\PasswordPolicyInterface
   *   The current object.
   *
   * @throws \Drupal\password_enhancements\Exception\PolicyInvalidArgumentException
   *   If the given number is negative.
   */
  public function setMinimumRequiredConstraints(int $number): PasswordPolicyInterface;

  /**
   * Returns a specific password constraint.
   *
   * @param string $constraint
   *   The password constraint ID.
   *
   * @return \Drupal\password_enhancements\PasswordConstraintInterface
   *   The password constraint object.
   */
  public function getConstraint(string $constraint): PasswordConstraintInterface;

  /**
   * Returns the password constraints for this policy.
   *
   * @return \Drupal\password_enhancements\PasswordConstraintPluginCollection
   *   The password constraint plugin collection.
   *
   * @internal
   *   Use addPasswordConstraint() and deletePasswordConstraint() from
   *   \Drupal\password_enhancements\PasswordPolicyManagerService instead.
   */
  public function getConstraints(): PasswordConstraintPluginCollection;

}
