<?php

declare(strict_types = 1);

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

namespace Drupal\Tests\page_builder\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Test class for the template_preprocess_field() function.
 *
 * @group page_builder
 */
final class PageBuilderPreprocessFieldTest extends BrowserTestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'page_builder',
    'page_builder_test',
  ];

  /**
   * User with the 'create page_builder content' permission.
   *
   * @var \Drupal\user\UserInterface
   */
  private $adminUser;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    // Create admin user.
    $this->adminUser = $this->drupalCreateUser(['create page_builder content']);
  }

  /**
   * Tests that template_preprocess_field() is called.
   */
  public function testPageBuilderPreprocessField(): void {
    $this->drupalLogin($this->adminUser);
    $this->drupalGet('node/add/page_builder');
    $page = $this->getSession()->getPage();
    $page->fillField('Title', 'Test page builder');
    $page->pressButton('Save');
    $this->assertSession()->pageTextContains('Emeralds are ripped away.');
  }

}
