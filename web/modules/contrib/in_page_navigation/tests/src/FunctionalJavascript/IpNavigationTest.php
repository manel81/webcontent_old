<?php

declare(strict_types = 1);

namespace Drupal\Tests\in_page_navigation\FunctionalJavascript;

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

use Drupal\FunctionalJavascriptTests\WebDriverTestBase;
use Drupal\filter\Entity\FilterFormat;
use Drupal\menu_link_content\Entity\MenuLinkContent;
use Drupal\node\NodeInterface;
use Drupal\system\Entity\Menu;

/**
 * Tests for the In-page Navigation module.
 *
 * @group in_page_navigation
 */
class IpNavigationTest extends WebDriverTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'in_page_navigation',
    'node',
    'block',
    'menu_ui',
    'menu_link_content',
  ];

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'stark';

  /**
   * {@inheritdoc}
   */
  protected static $configSchemaCheckerExclusions = [
    'classy.settings',
  ];

  /**
   * A node used for testing.
   *
   * @var \Drupal\node\NodeInterface
   */
  protected $page1;

  /**
   * Another node used for testing.
   *
   * @var \Drupal\node\NodeInterface
   */
  protected $page2;

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();

    $full_html_format = FilterFormat::create([
      'format' => 'full_html',
      'name' => 'Full HTML',
    ]);
    $full_html_format->save();

    $this->drupalCreateContentType(['type' => 'page']);
    // Node 1.
    $page_1_title = $this->randomString();
    $this->page1 = $this->drupalCreateNode([
      'type' => 'page',
      'title' => $page_1_title,
      'body' => [
        [
          'value' => '<h2>The sun did not shine.</h2><p>It was too wet to play.</p><p>So we sat in the house</p><h2>All that cold, cold, wet day.</h2><p>I sat there with Sally.</p><h2>We sat there, we two.</h2><p>And I said, “How I wish</p><p>We had something to do!”</p>',
          'format' => 'full_html',
        ],
      ],
    ]);

    // Node 2.
    $page_2_title = $this->randomString();
    $this->page2 = $this->drupalCreateNode([
      'type' => 'page',
      'title' => $page_2_title,
      'body' => [
        [
          'value' => '<h2>Too wet to go out</h2><p>And too cold to play ball.</p><p>So we sat in the house.</p><h2>We did nothing at all.</h2><p>So all we could do was to</p><p>sit! sit! sit! sit!</p><h2>And we did not like it.</h2><p>Not one little bit.</p>',
          'format' => 'full_html',
        ],
      ],
    ]);
  }

  /**
   * Tests the h2 links on a given page.
   *
   * Tests that the headings exist or not as links on a given page.
   *
   * @param \Drupal\node\NodeInterface $page_to_visit
   *   The node to visit.
   * @param bool $is_visible_on_page_1
   *   Whether the $page_1 headings should be visible as links.
   * @param bool $is_visible_on_page_2
   *   Whether the $page_2 headings should be visible as links.
   * @param string|null $ip_navigation_block_title
   *   The "In page navigation" block title if it should be visible.
   */
  private function assertLinks(NodeInterface $page_to_visit, bool $is_visible_on_page_1, bool $is_visible_on_page_2, string $ip_navigation_block_title = NULL): void {
    $this->drupalGet($page_to_visit->toUrl()->toString());
    $this->assertSession()->assertWaitOnAjaxRequest();
    if ($ip_navigation_block_title) {
      // Checks that the title of the In page navigation block appears on
      // the page.
      $this->assertSession()->pageTextContains($ip_navigation_block_title);
    }

    $page_1_links = [
      'The sun did not shine.',
      'All that cold, cold, wet day.',
      'We sat there, we two.',
    ];
    $page_2_links = [
      'Too wet to go out',
      'We did nothing at all.',
      'And we did not like it.',
    ];

    if ($is_visible_on_page_1) {
      // Checks that the h2 level headings from the content of $page1 appear
      // as links if we are on $page1.
      foreach ($page_1_links as $page_1_link) {
        $this->assertSession()->linkExistsExact($page_1_link);
      }
    }
    else {
      // Checks that the h2 level headings from the content of $page1 don't
      // appear as if we are not on $page1.
      foreach ($page_1_links as $page_1_link) {
        $this->assertSession()->linkNotExists($page_1_link);
      }
    }
    if ($is_visible_on_page_2) {
      // Checks that the h2 level headings from the content of $page2 appear
      // as links if we are on $page2.
      foreach ($page_2_links as $page_2_link) {
        $this->assertSession()->linkExistsExact($page_2_link);
      }
    }
    else {
      // Checks that the h2 level headings from the content of $page2 don't
      // appear as links if we are not on $page2.
      foreach ($page_2_links as $page_2_link) {
        $this->assertSession()->linkNotExists($page_2_link);
      }
    }
  }

  /**
   * Tests the In page navigation menu block.
   *
   * Tests that the menu block renders the h2 level headings properly.
   */
  public function testIpNavigationMenuBlock(): void {
    $menu_label = $this->randomString();
    $menu = Menu::create([
      'id' => 'menu_id',
      'label' => $menu_label,
      'description' => 'Menu description',
    ]);
    $menu->save();

    $titles = [
      $this->page1->id() => $this->randomString(),
      $this->page2->id() => $this->randomString(),
    ];

    foreach ($titles as $nid => $title) {
      $menu_link = MenuLinkContent::create([
        'title' => $title,
        'link' => ['uri' => 'internal:/node/' . $nid],
        'menu_name' => $menu->id(),
        'expanded' => TRUE,
      ]);
      $menu_link->save();
    }

    $this->drupalPlaceBlock('system_menu_block:' . $menu->id());

    $block_array = \Drupal::entityTypeManager()->getStorage('block')->loadByProperties(['plugin' => 'system_menu_block:' . $menu->id()]);
    $block = reset($block_array);
    $this->drupalLogin($this->rootUser);
    $this->drupalGet('admin/structure/block/manage/' . $block->id());
    $this->submitForm(['ip_navigation' => TRUE], 'Save block');
    $this->drupalLogout();

    $this->assertLinks($this->page1, TRUE, FALSE, $block->label());
    $this->assertLinks($this->page2, FALSE, TRUE, $block->label());

    // Change the DOM selector where the navigation collects the headings from.
    $this->drupalLogin($this->rootUser);
    $this->drupalGet('/admin/appearance/settings/' . \Drupal::theme()->getActiveTheme()->getName());
    $this->submitForm(['in_page_navigation_selector' => 'test'], 'Save configuration');
    $this->drupalLogout();

    $this->assertLinks($this->page1, FALSE, FALSE, $block->label());
    $this->assertLinks($this->page2, FALSE, FALSE, $block->label());
  }

  /**
   * Tests the In page navigation block.
   *
   * Tests that the In Page Navigation block renders the h2 level headings
   * properly.
   */
  public function testIpNavigationBlock(): void {
    $ip_navigation_block_title = $this->randomString();
    $this->drupalPlaceBlock('in_page_navigation_block',
      [
        'label' => $ip_navigation_block_title,
        'region' => 'header',
      ]);

    $this->assertLinks($this->page1, TRUE, FALSE, $ip_navigation_block_title);
    $this->assertLinks($this->page2, FALSE, TRUE, $ip_navigation_block_title);

    // Change the DOM selector where the navigation collects the headings from.
    $this->drupalLogin($this->rootUser);
    $this->drupalGet('/admin/appearance/settings/' . \Drupal::theme()->getActiveTheme()->getName());
    $this->submitForm(['in_page_navigation_selector' => 'test'], 'Save configuration');
    $this->drupalLogout();

    $this->assertLinks($this->page1, FALSE, FALSE);
    $this->assertLinks($this->page2, FALSE, FALSE);
  }

}
