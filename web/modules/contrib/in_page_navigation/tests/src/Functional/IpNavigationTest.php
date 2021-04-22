<?php

declare(strict_types = 1);

namespace Drupal\Tests\in_page_navigation\Functional;

/**
 * Copyright (C) 2019 PRONOVIX GROUP BVBA.
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

use Drupal\Tests\BrowserTestBase;

/**
 * Tests for the In-page Navigation module.
 *
 * @group in_page_navigation
 */
class IpNavigationTest extends BrowserTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'in_page_navigation',
    'node',
    'block',
  ];

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'stark';

  /**
   * Tests the creation of the block and the placement of it in the content.
   */
  public function testCreateIpNavigationBlock(): void {
    $block_title = $this->randomString();
    $this->drupalPlaceBlock('in_page_navigation_block', [
      'label' => $block_title,
    ]);
    // Create a node.
    $this->drupalCreateContentType(['type' => 'page']);
    $node = $this->drupalCreateNode(
      [
        'type' => 'page',
        'title' => 'Test',
        'body' => [
          [
            'value' => 'Testing',
          ],
        ],
      ]
    );
    $this->drupalGet($node->toUrl()->toString());
    // Checks whether the block is placed into the content.
    $this->assertSession()->pageTextContains($block_title);

    // Log in as admin for the block UI related tests.
    $this->drupalLogin($this->rootUser);

    // Tests if the ip_navigation field is visible in the Menus category.
    $this->drupalGet('admin/structure/block');
    $this->click('a[id="edit-blocks-region-header-title"]');
    $this->click('a[href^="/admin/structure/block/add/system_menu_block%3Amain"]');
    $this->assertFieldByName('ip_navigation');

    // Tests if the ip_navigation field is not visible in the other categories.
    $this->drupalGet('admin/structure/block');
    $this->click('a[id="edit-blocks-region-header-title"]');
    $this->click('a[href^="/admin/structure/block/add/user_login_block"]');
    $this->assertNoFieldByName('ip_navigation');
  }

}
