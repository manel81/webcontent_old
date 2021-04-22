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

namespace Drupal\Tests\in_page_navigation\FunctionalJavascript;

use Drupal\FunctionalJavascriptTests\WebDriverTestBase;
use Drupal\filter\Entity\FilterFormat;
use Drupal\in_page_navigation\InPageNavigationConfiguration;

/**
 * Tests scroll offset feature of the In-page Navigation module.
 *
 * @group in_page_navigation
 */
final class ScrollOffsetValueLoadedTest extends WebDriverTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'dynamic_page_cache',
    'in_page_navigation',
    'page_cache',
  ];

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'stark';

  /**
   * {@inheritdoc}
   */
  protected static $configSchemaCheckerExclusions = [
    'seven.settings',
  ];

  /**
   * The in page nav. configuration manager.
   *
   * @var \Drupal\in_page_navigation\Service\InPageNavigationConfigurationManagerInterface
   */
  private $inPageNavConfigurationManager;

  /**
   * A logged-in user.
   *
   * @var \Drupal\user\UserInterface
   */
  private $authUser;

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();

    FilterFormat::create([
      'format' => 'full_html',
      'name' => 'Full HTML',
    ])->save();

    $this->drupalCreateContentType(['type' => 'page']);

    $this->inPageNavConfigurationManager = $this->container->get('in_page_navigation.configuration_manager');

    $this->drupalPlaceBlock('in_page_navigation_block');

    $this->authUser = $this->drupalCreateUser();
  }

  /**
   * Test that top_offset has a value passed into it.
   */
  public function testScrollOffsetValueLoaded(): void {
    $scroll_offset = 0;

    $page = $this->drupalCreateNode([
      'type' => 'page',
      'title' => $this->randomString(),
      'body' => [
        [
          'value' => file_get_contents(__DIR__ . '/../../fixtures/scroll_offset/DocumentationPageExample.html'),
          'format' => 'full_html',
        ],
      ],
    ]);

    $this->drupalGet($page->toUrl()->toString());
    $this->assertScrollOffsetDrupalSettings($scroll_offset, "Asserting that scroll offset is {$scroll_offset} for anonymous with Stark.");

    $this->drupalLogin($this->authUser);
    $this->assertScrollOffsetDrupalSettings($scroll_offset, "Asserting that scroll offset is {$scroll_offset} for authenticated with Stark.");
    $this->drupalLogout();

    // Changing the scroll offset for Stark.
    $scroll_offset = $this->generateRandomScrollOffset();
    $in_page_configuration = $this->inPageNavConfigurationManager->getConfigurationForTheme('stark');
    $this->inPageNavConfigurationManager->saveConfigurationForTheme('stark', new InPageNavigationConfiguration($in_page_configuration->domSelector(), $scroll_offset));
    $this->assertSame($scroll_offset, $this->inPageNavConfigurationManager->getConfigurationForTheme('stark')->scrollOffset(), 'Updated scroll offset saved successfully for Stark.');

    // Revisiting pages, making sure that cache invalidation works properly.
    $this->drupalGet($page->toUrl()->toString());
    $this->assertScrollOffsetDrupalSettings($scroll_offset, "Asserting that scroll offset is {$scroll_offset} for anonymous with Stark.");

    $this->drupalLogin($this->authUser);
    $this->assertScrollOffsetDrupalSettings($scroll_offset, "Asserting that scroll offset is {$scroll_offset} for authenticated with Stark.");
    $this->drupalLogout();

    // Sanity check, when the default theme changes, all pages with in page
    // navigation must use the new theme settings.
    $this->drupalLogin($this->rootUser);
    $this->drupalGet('admin/appearance');
    $this->clickLink('Install Seven as default theme');
    // This is required otherwise the theme "does not exist" even if it does.
    \Drupal::service('theme_handler')->reset();
    $this->drupalLogout();

    // Changing the scroll offset for Seven.
    $scroll_offset = $this->generateRandomScrollOffset();
    $in_page_configuration = $this->inPageNavConfigurationManager->getConfigurationForTheme('seven');
    $this->inPageNavConfigurationManager->saveConfigurationForTheme('seven', new InPageNavigationConfiguration($in_page_configuration->domSelector(), $scroll_offset));
    $this->assertSame($scroll_offset, $this->inPageNavConfigurationManager->getConfigurationForTheme('seven')->scrollOffset(), 'Updated scroll offset saved successfully for Seven.');

    // Revisiting pages, making sure that cache invalidation works properly.
    $this->drupalGet($page->toUrl()->toString());
    $this->assertScrollOffsetDrupalSettings($scroll_offset, "Asserting that scroll offset is {$scroll_offset} for anonymous with Seven.");

    $this->drupalLogin($this->authUser);
    $this->assertScrollOffsetDrupalSettings($scroll_offset, "Asserting that scroll offset is {$scroll_offset} for authenticated with Seven.");
    $this->drupalLogout();
  }

  /**
   * Generates a valid, random scroll offset.
   *
   * @return int
   *   A random scroll offset.
   */
  private function generateRandomScrollOffset(): int {
    return random_int(-100, 100);
  }

  /**
   * Validates that the expected scroll offset is passed to the front-end.
   *
   * @param int $expected_offset
   *   The expected scroll offset.
   * @param string $message
   *   The assertion message.
   */
  private function assertScrollOffsetDrupalSettings(int $expected_offset, string $message = ''): void {
    $script = <<<JS
    (function() {
      return drupalSettings.ip_navigation.top_offset === $expected_offset;
    }());
JS;
    $this->assertTrue($this->getSession()->evaluateScript($script), $message);
  }

}
