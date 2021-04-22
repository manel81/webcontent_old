<?php

declare(strict_types = 1);

namespace Drupal\Tests\dp_faq\FunctionalJavascript;

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
use Drupal\FunctionalJavascriptTests\WebDriverTestBase;

/**
 * Test the Devportal FAQ module.
 *
 * @group dp_faq
 */
class DpFaqBlockTest extends WebDriverTestBase {

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'classy';

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'dp_faq',
    'block',
  ];

  /**
   * Tests the DP Faq block.
   *
   * Assert rendering, attaching of drupalSettings based on block settings and
   * the block settings values passed to drupalSettings.
   *
   * @covers \Drupal\dp_faq\Plugin\Block\DpFaqBlock
   */
  public function testDpFaqBlockSettings(): void {
    $web_assert = $this->assertSession();
    $block1_quicklinks = TRUE;
    $block2_quicklinks = FALSE;
    $block1 = $this->drupalPlaceBlock('dp_faq_block', [
      'quicklinks' => $block1_quicklinks,
    ]);
    $block1_id = "block-{$block1->id()}";
    $block2 = $this->drupalPlaceBlock('dp_faq_block', [
      'quicklinks' => $block2_quicklinks,
    ]);
    $block2_id = "block-{$block2->id()}";
    $this->drupalGet(Url::fromRoute('<front>'));

    $dp_faq_settings = $this->getDrupalSettings()['dp_faq'];
    self::assertEquals($dp_faq_settings[$block1_id]['quicklinks'], $block1_quicklinks, 'Asserting that block 1 quicklink settings passed correctly to the frontend.');
    self::assertEquals($dp_faq_settings[$block2_id]['quicklinks'], $block2_quicklinks, 'Asserting that block 2 quicklink settings passed correctly to the frontend.');
    $web_assert->elementExists('css', "#{$block1_id}");
    $web_assert->elementExists('css', "#{$block2_id}");
  }

}
