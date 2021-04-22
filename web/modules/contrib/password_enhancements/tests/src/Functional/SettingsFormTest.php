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
 * Tests the settings form.
 *
 * @group password_enhancements
 * @coversDefaultClass \Drupal\password_enhancements\Form\SettingsForm
 */
final class SettingsFormTest extends BrowserTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'password_enhancements',
  ];

  /**
   * The admin user for tests.
   *
   * @var \Drupal\user\UserInterface
   */
  protected $adminUser;

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
    $this->adminUser = $this->drupalCreateUser([
      'administer user password enhancements settings',
    ]);
  }

  /**
   * Tests the system-wide settings form.
   */
  public function testSettingsForm(): void {
    $this->drupalLogin($this->adminUser);
    $url = Url::fromRoute('password_enhancements.settings');

    $this->drupalGet($url);
    $this->assertSession()->elementTextContains('css', '.messages--warning', 'The built-in password strength indicator is enabled, it is recommended to disable it.');
    $config = $this->config('user.settings');
    $config->set('password_strength', FALSE);
    $config->save();

    $this->drupalGet($url);
    $this->assertSession()->pageTextNotContains('The built-in password strength indicator is enabled, it is recommended to disable it.');
    $this->assertFieldByName('constraint_update_effect', 'strikethrough');
    $this->assertFieldByName('require_password');
    // @todo Uncomment these lines when the accompanying feature is implemented.
    // $this->assertFieldByName('require_password_change');
    $this->assertNoFieldChecked('require_password');
    // $this->assertNoFieldChecked('require_password_change');
    $this->drupalPostForm(NULL, [
      'constraint_update_effect' => 'hide',
      'require_password' => 1,
      // 'require_password_change' => 1,
    ], 'Save configuration');
    $config = $this->config('password_enhancements.settings');
    $this->assertEqual($config->get('constraint_update_effect'), 'hide');
    $this->assertEqual($config->get('require_password'), TRUE);
    // $this->assertEqual($config->get('require_password_change'), TRUE);
  }

}
