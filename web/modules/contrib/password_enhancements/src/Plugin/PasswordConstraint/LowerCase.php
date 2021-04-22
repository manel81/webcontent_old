<?php

declare(strict_types = 1);

namespace Drupal\password_enhancements\Plugin\PasswordConstraint;

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

/**
 * Lower-case password constraint plugin.
 *
 * @PasswordConstraint(
 *   id = "lower_case",
 *   name = @Translation("Lower-case"),
 *   description = @Translation("Checks if the password has at least a specified number of lower-cased character."),
 *   unique = TRUE,
 *   jsLibrary = "password_enhancements/plugin.lower_case",
 * )
 */
final class LowerCase extends MinimumCharacters {

  /**
   * {@inheritdoc}
   */
  public function defaultDescriptionSingular(): string {
    return 'Add at least one lower-cased letter.';
  }

  /**
   * {@inheritdoc}
   */
  public function defaultDescriptionPlural(): string {
    return 'Add @minimum_characters more lower-cased letters.';
  }

  /**
   * {@inheritdoc}
   */
  public function validate(string $value): void {
    parent::validate(preg_replace('/([^a-z])/', '', $value));
  }

}
