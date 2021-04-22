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

namespace Drupal\in_page_navigation\Service;

use Drupal\Core\Cache\CacheableDependencyInterface;
use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Extension\ThemeHandlerInterface;
use Drupal\Core\Theme\ThemeManagerInterface;
use Drupal\in_page_navigation\Exception\InPageNavigationConfigurationSaveException;
use Drupal\in_page_navigation\Exception\InvalidArgumentException;
use Drupal\in_page_navigation\InPageNavigationConfiguration;

/**
 * Default in page navigation configuration manager.
 *
 * @group infrastructure
 */
final class InPageNavigationConfigurationManager implements InPageNavigationConfigurationManagerInterface, CacheableDependencyInterface {

  /**
   * Default in page navigation DOM selector.
   */
  private const IN_PAGE_NAVIGATION_DEFAULT_SELECTOR = 'main .layout-content h2';

  /**
   * Third party settings configuration sequential array.
   *
   * The configuration sequence under which the in_page_navigation third party
   * settings will go. The config structure must follow this formula:
   * third_party_settings.[sequence].[mapping]
   * See: theme_settings in core.data_types.schema.yml.
   */
  private const THIRD_PARTY_SETTINGS_CONFIG_SELECTOR = 'third_party_settings.in_page_navigation';

  /**
   * The configuration key also used for the form and the config schema.
   *
   * The JS frontend uses the value named "top_offset" in the drupalSettings
   * object (line 20 in in_page_navigation.es6.js).
   */
  private const TPS_SCROLL_OFFSET = self::THIRD_PARTY_SETTINGS_CONFIG_SELECTOR . '.top_offset';

  private const CONFIG_IN_PAGE_NAVIGATION_SETTINGS = 'in_page_navigation.settings';

  /**
   * The theme handler.
   *
   * @var \Drupal\Core\Extension\ThemeHandlerInterface
   */
  private $themeHandler;

  /**
   * The config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  private $configFactory;

  /**
   * The theme manager.
   *
   * @var \Drupal\Core\Theme\ThemeManagerInterface
   */
  private $themeManager;

  /**
   * Constructs a new object.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory.
   * @param \Drupal\Core\Extension\ThemeHandlerInterface $theme_handler
   *   The theme handler.
   * @param \Drupal\Core\Theme\ThemeManagerInterface $theme_manager
   *   The theme manager.
   */
  public function __construct(ConfigFactoryInterface $config_factory, ThemeHandlerInterface $theme_handler, ThemeManagerInterface $theme_manager) {
    $this->configFactory = $config_factory;
    $this->themeHandler = $theme_handler;
    $this->themeManager = $theme_manager;
  }

  /**
   * {@inheritdoc}
   */
  public function getConfigurationForTheme(string $theme_name): InPageNavigationConfiguration {
    if (!$this->themeHandler->themeExists($theme_name)) {
      throw new InvalidArgumentException("Theme does not exist: {$theme_name}.");
    }

    return new InPageNavigationConfiguration($this->getDomSelectorForTheme($theme_name), $this->getScrollOffsetForTheme($theme_name));
  }

  /**
   * Returns the theme-specific DOM selector.
   *
   * @param string $theme_name
   *   (Machine) Name of the theme.
   *
   * @return string
   *   The DOM selector.
   */
  private function getDomSelectorForTheme(string $theme_name): string {
    $dom_selector = trim($this->configFactory->get(self::CONFIG_IN_PAGE_NAVIGATION_SETTINGS)->get('in_page_navigation_selector')[$theme_name] ?? '');
    return $dom_selector === '' ? self::IN_PAGE_NAVIGATION_DEFAULT_SELECTOR : $dom_selector;
  }

  /**
   * Returns the theme-specific scroll offset.
   *
   * @param string $theme_name
   *   (Machine) Name of the theme.
   *
   * @return int
   *   The scroll offset.
   */
  private function getScrollOffsetForTheme(string $theme_name): int {
    return theme_get_setting(self::TPS_SCROLL_OFFSET, $theme_name) ?? 0;
  }

  /**
   * {@inheritdoc}
   */
  public function saveConfigurationForTheme(string $theme_name, InPageNavigationConfiguration $config): void {
    if (!$this->themeHandler->themeExists($theme_name)) {
      throw new InvalidArgumentException("Theme does not exist: {$theme_name}.");
    }

    try {
      $in_page_nav_settings = $this->configFactory->getEditable(self::CONFIG_IN_PAGE_NAVIGATION_SETTINGS);
      $in_page_nav_settings->set('in_page_navigation_selector', [$theme_name => $config->domSelector()]);
      $in_page_nav_settings->save();
      // system.theme.global is intentionally not supported as this
      // configuration is always theme specific. (Even if theme_get_setting()
      // calculates with with that config.)
      $theme_settings = $this->configFactory->getEditable("{$theme_name}.settings");
      $theme_settings->set(self::TPS_SCROLL_OFFSET, $config->scrollOffset());
      $theme_settings->save();
      // This should have been done by Drupal core when a theme settings
      // changes.
      // @see theme_get_setting()
      drupal_static_reset('theme_get_setting');
    }
    catch (\Exception $e) {
      throw new InPageNavigationConfigurationSaveException(sprintf('The provided configuration could not be saved. %s', $e->getMessage()), $e->getCode(), $e);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function removeConfigurationForTheme(string $theme_name): void {
    if (!$this->themeHandler->themeExists($theme_name)) {
      throw new InvalidArgumentException("Theme does not exist: {$theme_name}.");
    }

    try {
      $in_page_nav_settings = $this->configFactory->getEditable(self::CONFIG_IN_PAGE_NAVIGATION_SETTINGS);
      if (!$in_page_nav_settings->isNew()) {
        $in_page_navigation_selector = $in_page_nav_settings->get('in_page_navigation_selector');
        unset($in_page_navigation_selector[$theme_name]);
        $in_page_nav_settings->set('in_page_navigation_selector', $in_page_navigation_selector);
        $in_page_nav_settings->save();
      }

      $theme_settings = $this->configFactory->getEditable($theme_name . '.settings');
      if (!$theme_settings->isNew()) {
        $theme_settings->clear(self::THIRD_PARTY_SETTINGS_CONFIG_SELECTOR)->save();
      }
    }
    catch (\Exception $e) {
      throw new InPageNavigationConfigurationSaveException(sprintf('The provided configuration could not be saved. %s', $e->getMessage()), $e->getCode(), $e);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheContexts(): array {
    return $this->calculateCacheableMetada()->getCacheContexts();
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheTags(): array {
    return $this->calculateCacheableMetada()->getCacheTags();
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheMaxAge(): int {
    return $this->calculateCacheableMetada()->getCacheMaxAge();
  }

  /**
   * Calculates the cacheable metadata for the configuration.
   *
   * @return \Drupal\Core\Cache\CacheableMetadata
   *   The calculated cacheable metadata.
   */
  private function calculateCacheableMetada(): CacheableMetadata {
    $data = new CacheableMetadata();

    $data = $data->merge(CacheableMetadata::createFromObject($this->configFactory->get(self::CONFIG_IN_PAGE_NAVIGATION_SETTINGS)));

    $active_theme_config_name = $this->themeManager->getActiveTheme()->getName() . '.settings';
    $active_theme_settings = $this->configFactory->get($active_theme_config_name);
    if (!$active_theme_settings->isNew()) {
      $data = $data->merge(CacheableMetadata::createFromObject($active_theme_settings));
    }

    return $data;
  }

}
