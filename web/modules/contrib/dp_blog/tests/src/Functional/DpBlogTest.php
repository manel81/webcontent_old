<?php

declare(strict_types = 1);

namespace Drupal\Tests\dp_blog\Functional;

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
use Drupal\node\NodeInterface;

/**
 * Test the Devportal Blog module.
 *
 * @group dp_blog
 */
final class DpBlogTest extends BrowserTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'dp_blog',
    'block',
  ];

  /**
   * Test content and block placements.
   *
   * @covers \Drupal\dp_blog\Plugin\Block\AuthorAndDateBlock
   */
  public function testBlogCreation(): void {
    $this->drupalLogin($this->rootUser);

    // Create a published blog post.
    $blog_body = $this->randomString();
    $blog_node = $this->drupalCreateNode([
      'type' => 'blog_post',
      'title' => $this->randomMachineName(),
      'status' => NodeInterface::PUBLISHED,
      'body' => [
        [
          'value' => $blog_body,
        ],
      ],
    ]);

    // Create a page node that shouldn't appear in the 'Blog posts' block.
    $this->createContentType(['type' => 'page']);
    $page_node_title = $this->randomMachineName();
    $this->drupalCreateNode([
      'type' => 'page',
      'title' => $page_node_title,
      'status' => NodeInterface::PUBLISHED,
      'body' => [
        [
          'value' => $this->randomString(),
        ],
      ],
    ]);

    // Place the 'Blog posts' and the 'Author and date block' blocks.
    $this->drupalPlaceBlock('views_block:blog_posts-recent_blog_posts');
    $this->drupalPlaceBlock('author_and_date_block');

    // Assert that the 'Blog posts' and the 'Author and date block' are
    // placed on the page, verify that the blog's body field's value is visible
    // on the page, and assert that the page node isn't listed in the block.
    $this->drupalGet($blog_node->toUrl()->toString());
    $this->assertSession()
      ->pageTextContains('Recent blog posts');
    $this->assertSession()
      ->pageTextContains($this->rootUser->getAccountName() . ' | ' . date('m.d.Y', $blog_node->getCreatedTime()));
    $this->assertSession()
      ->pageTextContains($blog_body);
    $this->assertSession()
      ->pageTextNotContains($page_node_title, 'Make sure that the page title is not visible.');
  }

}
