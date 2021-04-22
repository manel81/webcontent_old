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

use Drupal\Core\Url;
use Drupal\Tests\BrowserTestBase;

/**
 * Tests the password constraint forms' base class.
 *
 * @group password_enhancements
 * @coversDefaultClass \Drupal\password_enhancements\Form\PasswordConstraintFormBase
 */
final class PasswordConstraintFormTest extends BrowserTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'password_enhancements',
    'password_enhancements_editor_role_test',
  ];

  /**
   * Tests the password constraint edit and delete forms.
   */
  public function testPasswordConstraintEditAndDeleteForm(): void {
    // It's safe to hardcode the UUID here as it's also hardcoded in the test
    // module's config (this role is coming from there with all its
    // constraints).
    $this->drupalLogin($this->rootUser);
    $this->drupalGet(Url::fromRoute('password_enhancements.constraint_edit_form', [
      'user_role' => 'editor',
      'password_constraint' => 'c20516e5-7baa-4197-9150-07b0bf6fb6d0',
    ]));
    $session = $this->assertSession();
    $session->responseContains('Edit Minimum characters constraint');
    $session->buttonExists('Update constraint');
    $this->drupalGet(Url::fromRoute('password_enhancements.constraint_delete_form', [
      'user_role' => 'editor',
      'password_constraint' => 'c20516e5-7baa-4197-9150-07b0bf6fb6d0',
    ]));
    $session->responseContains('Are you sure you want to delete the Minimum characters constraint from the Editor role?');
    $role_edit_url = Url::fromRoute('entity.user_role.edit_form', ['user_role' => 'editor'])->toString();
    $session->linkByHrefExists($role_edit_url);
    $this->getSession()->getPage()->pressButton('Delete');
    $this->assertUrl($role_edit_url);
    $session->responseNotContains('Add at least one character. M');
    $this->drupalGet(Url::fromRoute('password_enhancements.constraint_delete_form', [
      'user_role' => 'editor',
      'password_constraint' => 'nonexistent-uuid',
    ]));
    $session->responseContains('Page not found');
  }

}
