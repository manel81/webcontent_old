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

namespace Drupal\Tests\in_page_navigation\Unit;

use Drupal\Core\Config\Config;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\DependencyInjection\Container;
use Drupal\Core\Extension\Extension;
use Drupal\Core\Extension\ThemeHandlerInterface;
use Drupal\Core\Theme\ActiveTheme;
use Drupal\Core\Theme\ThemeManagerInterface;
use Drupal\Tests\UnitTestCase;
use Drupal\in_page_navigation\Exception\InvalidArgumentException;
use Drupal\in_page_navigation\InPageNavigationConfiguration;
use Drupal\in_page_navigation\Service\InPageNavigationConfigurationManager;

/**
 * Tests the in page navigation configuration manager.
 *
 * @group in_page_navigation
 * @covers \Drupal\in_page_navigation\Service\InPageNavigationConfigurationManager
 * phpcs:disable SlevomatCodingStandard.Namespaces.RequireOneNamespaceInFile.MoreNamespacesInFile
 */
final class InPageNavigationConfigurationManagerTest extends UnitTestCase {

  /**
   * The mocked config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface|\PHPUnit\Framework\MockObject\MockObject
   */
  private $configFactory;

  /**
   * The mocked theme handler.
   *
   * @var \Drupal\Core\Extension\ThemeHandlerInterface|\PHPUnit\Framework\MockObject\MockObject
   */
  private $themeHandler;

  /**
   * The theme manager.
   *
   * @var \Drupal\Core\Theme\ThemeManagerInterface|\PHPUnit\Framework\MockObject\MockObject
   */
  private $themeManager;

  /**
   * The in page navigation config manager.
   *
   * @var \Drupal\in_page_navigation\Service\InPageNavigationConfigurationManager
   */
  private $inPageNavigationConfigManager;

  /**
   * Theme with no settings config object.
   *
   * @var \Drupal\Core\Extension\Extension|\PHPUnit\Framework\MockObject\MockObject
   */
  private $themeWithNoSettings;

  /**
   * Config for theme with no settings.
   *
   * @var \PHPUnit\Framework\MockObject\MockObject
   */
  private $configForThemeWithNoSettings;

  /**
   * Theme with settings config object.
   *
   * @var \Drupal\Core\Extension\Extension|\PHPUnit\Framework\MockObject\MockObject
   */
  private $themeWithSettings;

  /**
   * Config for theme with settings.
   *
   * @var \PHPUnit\Framework\MockObject\MockObject
   */
  private $configForThemeWithSettings;

  /**
   * In page navigation configuration mock.
   *
   * @var \Drupal\Core\Config\Config|\PHPUnit\Framework\MockObject\MockObject
   */
  private $configInPageNavigationSettings;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    $this->themeHandler = $this->createMock(ThemeHandlerInterface::class);
    $this->themeManager = $this->createMock(ThemeManagerInterface::class);
    $this->configFactory = $this->createMock(ConfigFactoryInterface::class);

    $this->themeWithNoSettings = $this->createMock(Extension::class);
    $this->themeWithNoSettings->method('getName')->willReturn('theme_with_no_settings');
    $this->configForThemeWithNoSettings = $this->createMock(Config::class);
    $this->configForThemeWithNoSettings->method('isNew')->willReturn(TRUE);

    $this->themeWithSettings = $this->createMock(Extension::class);
    $this->themeWithSettings->method('getName')->willReturn('theme_with_settings');
    $this->configForThemeWithSettings = $this->createMock(Config::class);
    $this->configForThemeWithSettings->method('isNew')->willReturn(FALSE);

    $this->configInPageNavigationSettings = $this->createMock(Config::class);

    $config_factory_return_map = [
      [
        'in_page_navigation.settings',
        $this->configInPageNavigationSettings,
      ],
      [
        $this->themeWithNoSettings->getName() . '.settings',
        $this->configForThemeWithNoSettings,
      ],
      [
        $this->themeWithSettings->getName() . '.settings',
        $this->configForThemeWithSettings,
      ],
      [
        'system.theme.global', [],
      ],
    ];

    $this->configFactory
      ->method('get')
      ->willReturnMap($config_factory_return_map);
    $this->configFactory
      ->method('getEditable')
      ->willReturnMap($config_factory_return_map);

    $this->inPageNavigationConfigManager = new InPageNavigationConfigurationManager($this->configFactory, $this->themeHandler, $this->themeManager);
  }

  /**
   * Tests that an exception is thrown for a non-existing theme.
   */
  public function testItThrowsAnExceptionWhenYouTryToRetrieveConfigurationForNonExistingTheme(): void {
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage('Theme does not exist: foo.');
    $this->themeHandler->method('themeExists')->with('foo')->willReturn(FALSE);
    $this->inPageNavigationConfigManager->getConfigurationForTheme('foo');
  }

  /**
   * Tests that the correct in page navigation configuration can be retrieved.
   */
  public function testItCanRetrieveCorrectConfigurationForTheme(): void {
    $this->themeHandler->method('themeExists')->willReturnMap([
      [
        $this->themeWithNoSettings->getName(),
        TRUE,
      ],
      [
        $this->themeWithSettings->getName(),
        TRUE,
      ],
    ]);
    $in_page_nav_config = $this->inPageNavigationConfigManager->getConfigurationForTheme($this->themeWithNoSettings->getName());
    $this->assertEquals('main .layout-content h2', $in_page_nav_config->domSelector());
    $this->assertEquals(0, $in_page_nav_config->scrollOffset());

    $theme_with_settings_dom_selector = '.foo .bar';
    $this->configInPageNavigationSettings->method('get')->with('in_page_navigation_selector')->willReturn([
      $this->themeWithSettings->getName() => $theme_with_settings_dom_selector,
    ]);
    $in_page_nav_config = $this->inPageNavigationConfigManager->getConfigurationForTheme($this->themeWithSettings->getName());
    $this->assertEquals($theme_with_settings_dom_selector, $in_page_nav_config->domSelector());
    $this->assertEquals(100, $in_page_nav_config->scrollOffset());
  }

  /**
   * Tests that an exception is thrown for a non-existing theme.
   */
  public function testItThrowsAnExceptionWhenYouTryToSaveConfigurationForNonExistingTheme(): void {
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage('Theme does not exist: foo.');
    $this->themeHandler->method('themeExists')->with('foo')->willReturn(FALSE);
    $this->inPageNavigationConfigManager->saveConfigurationForTheme('foo', new InPageNavigationConfiguration('', 0));
  }

  /**
   * Tests that a configuration can be saved for a theme.
   */
  public function testItCanSaveConfigurationForTheme(): void {
    $this->themeHandler->method('themeExists')->willReturnMap([
      [
        $this->themeWithSettings->getName(),
        TRUE,
      ],
    ]);

    $in_page_nav_config = new InPageNavigationConfiguration($this->randomMachineName(), random_int(-100, 100));
    $this->configInPageNavigationSettings->expects($this->once())->method('set')
      ->with('in_page_navigation_selector', [$this->themeWithSettings->getName() => $in_page_nav_config->domSelector()])
      ->willReturnSelf();
    $this->configInPageNavigationSettings->expects($this->once())->method('save');
    $this->configForThemeWithSettings->expects($this->once())->method('set')->with('third_party_settings.in_page_navigation.top_offset', $in_page_nav_config->scrollOffset())->willReturnSelf();
    $this->configForThemeWithSettings->expects($this->once())->method('save');
    $this->expectExceptionMessage('Drupal\in_page_navigation\Service\drupal_static_reset is called.');

    $this->inPageNavigationConfigManager->saveConfigurationForTheme($this->themeWithSettings->getName(), $in_page_nav_config);
  }

  /**
   * Tests that an exception is thrown for a non-existing theme.
   */
  public function testItThrowsAnExceptionWhenYouTryToRemoveConfigurationOfNonExistingTheme(): void {
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage('Theme does not exist: foo.');
    $this->themeHandler->method('themeExists')->with('foo')->willReturn(FALSE);
    $this->inPageNavigationConfigManager->removeConfigurationForTheme('foo');
  }

  /**
   * Tests that a configuration remove does not fail there is no saved config.
   */
  public function testConfigurationRemoveOfThemeDoesNotFailIfNoConfigSaved(): void {
    $this->themeHandler->method('themeExists')->willReturnMap([
      [
        $this->themeWithNoSettings->getName(),
        TRUE,
      ],
    ]);
    $this->configInPageNavigationSettings->method('isNew')->willReturn(TRUE);
    $this->configInPageNavigationSettings->expects($this->never())->method('save');
    $this->configForThemeWithNoSettings->expects($this->never())->method('save');

    $this->inPageNavigationConfigManager->removeConfigurationForTheme($this->themeWithNoSettings->getName());
  }

  /**
   * Tests that configuration of a theme can be removed.
   */
  public function testItCanRemoveConfigurationOfTheme(): void {
    $this->themeHandler->method('themeExists')->willReturnMap([
      [
        $this->themeWithSettings->getName(),
        TRUE,
      ],
    ]);

    $this->configInPageNavigationSettings->expects($this->once())->method('isNew')->willReturn(FALSE);
    $this->configInPageNavigationSettings->expects($this->once())->method('get')
      ->with('in_page_navigation_selector')
      ->willReturn(
        [$this->themeWithSettings->getName() => 'foo', 'bar' => 'baz']
      );
    $this->configInPageNavigationSettings->expects($this->once())->method('set')
      ->with('in_page_navigation_selector', ['bar' => 'baz'])
      ->willReturnSelf();
    $this->configInPageNavigationSettings->expects($this->once())->method('save');

    $this->configForThemeWithSettings->expects($this->once())->method('isNew')->willReturn(FALSE);
    $this->configForThemeWithSettings->expects($this->once())->method('clear')->with('third_party_settings.in_page_navigation')->willReturnSelf();
    $this->configForThemeWithSettings->expects($this->once())->method('save');

    $this->inPageNavigationConfigManager->removeConfigurationForTheme($this->themeWithSettings->getName());
  }

  /**
   * Tests caching related methods.
   */
  public function testItCanCalculateCacheableMetadata(): void {
    $cache_contexts_manager = $this->getMockBuilder('Drupal\Core\Cache\Context\CacheContextsManager')
      ->disableOriginalConstructor()
      ->getMock();
    $cache_contexts_manager->method('assertValidTokens')->willReturn(TRUE);
    $container = new Container();
    $container->set('cache_contexts_manager', $cache_contexts_manager);
    \Drupal::setContainer($container);

    $in_page_nav_config_cache_max_age = 60;
    $in_page_nav_config_cache_tags = ['in_page_nav_cache_tag1'];
    $in_page_nav_config_cache_contexts = ['in_page_nav_cache_context1'];
    $this->configInPageNavigationSettings->method('getCacheMaxAge')->willReturn($in_page_nav_config_cache_max_age);
    $this->configInPageNavigationSettings->method('getCacheTags')->willReturn($in_page_nav_config_cache_tags);
    $this->configInPageNavigationSettings->method('getCacheContexts')->willReturn($in_page_nav_config_cache_contexts);

    $theme_with_settings_config_cache_max_age = 30;
    $theme_with_settings_config_cache_tags = ['theme_with_config_cache_tag1'];
    $theme_with_settings_config_cache_contexts = ['theme_with_config_cache_context1'];
    $this->configForThemeWithSettings->method('getCacheMaxAge')->willReturn($theme_with_settings_config_cache_max_age);
    $this->configForThemeWithSettings->method('getCacheTags')->willReturn($theme_with_settings_config_cache_tags);
    $this->configForThemeWithSettings->method('getCacheContexts')->willReturn($theme_with_settings_config_cache_contexts);

    $active_theme_with_no_settings = new ActiveTheme(['name' => $this->themeWithNoSettings->getName()]);
    $active_theme_with_settings = new ActiveTheme(['name' => $this->themeWithSettings->getName()]);
    $this->themeManager->method('getActiveTheme')->willReturnOnConsecutiveCalls(
      $active_theme_with_no_settings,
      $active_theme_with_no_settings,
      $active_theme_with_no_settings,
      $active_theme_with_settings,
      $active_theme_with_settings,
      $active_theme_with_settings
    );
    $this->assertEquals($in_page_nav_config_cache_max_age, $this->inPageNavigationConfigManager->getCacheMaxAge());
    $this->assertEquals($in_page_nav_config_cache_tags, $this->inPageNavigationConfigManager->getCacheTags());
    $this->assertEquals($in_page_nav_config_cache_contexts, $this->inPageNavigationConfigManager->getCacheContexts());
    // Lower TTL should win.
    $this->assertEquals($theme_with_settings_config_cache_max_age, $this->inPageNavigationConfigManager->getCacheMaxAge());
    $this->assertEquals(array_merge($in_page_nav_config_cache_tags, $theme_with_settings_config_cache_tags), $this->inPageNavigationConfigManager->getCacheTags());
    $this->assertEquals(array_merge($in_page_nav_config_cache_contexts, $theme_with_settings_config_cache_contexts), $this->inPageNavigationConfigManager->getCacheContexts());
  }

}

namespace Drupal\in_page_navigation\Service;

/**
 * Mocked version of \theme_get_setting().
 *
 * @param string $setting_name
 *   The name of the setting to be retrieved.
 * @param string|null $theme
 *   The name of a given theme; defaults to the current theme.
 *
 * @return mixed
 *   Theme settings.
 */
function theme_get_setting(string $setting_name, ?string $theme = NULL) {
  if ($setting_name !== 'third_party_settings.in_page_navigation.top_offset') {
    throw new \RuntimeException("Unexpected setting name: {$setting_name}.");
  }

  if ($theme === 'theme_with_no_settings') {
    return NULL;
  }

  if ($theme === 'theme_with_settings') {
    return 100;
  }

  throw new \RuntimeException("Unexpected theme: {$theme}.");
}

/**
 * Mocked version of \drupal_static_reset().
 *
 * @param string $name
 *   Name of the static variable to reset.
 */
function drupal_static_reset(string $name): void {
  throw new \RuntimeException(__FUNCTION__ . ' is called.');
}
