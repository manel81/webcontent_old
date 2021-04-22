<?php

declare(strict_types = 1);

namespace Drupal\Tests\password_enhancements\Functional;

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

use Drupal\Tests\user\Functional\UserRegistrationTest;

/**
 * Tests user registration under different configurations with pw enhancements.
 *
 * @group password_enhancements
 */
class PasswordEnhancementsUserRegistrationTest extends UserRegistrationTest {

  /**
   * {@inheritdoc}
   */
  public static $modules = ['password_enhancements', 'field_test'];

}
