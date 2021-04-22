<?php

declare(strict_types = 1);

namespace Drupal\boom_enhancements;

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

use Drupal\Component\Utility\Color;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Extension\ThemeHandler;
use Drupal\Core\Link;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\StringTranslation\TranslationInterface;
use Drupal\Core\Url;
use Drupal\boom_enhancements\Exceptions\InvalidArgumentException;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

/**
 * The service to manage devportal theme brand assets.
 *
 * @internal
 */
final class BoomEnhancementsManager {

  use StringTranslationTrait;

  /**
   * ConfigFactory service.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  private $configFactory;

  /**
   * The theme handler service.
   *
   * @var \Drupal\Core\Extension\ThemeHandler
   */
  private $themeHandler;

  /**
   * BoomEnhancementsJsonManager object.
   *
   * @var \Drupal\boom_enhancements\BoomEnhancementsJsonManager
   */
  private $boomEnhancementsJsonManager;

  /**
   * The expected file name for the brand colors JSON file.
   */
  public const BRAND_COLORS_JSON = 'brandColors-lock.json';

  /**
   * The expected file name for the icon definitions JSON file.
   */
  public const BRAND_ICONS_JSON = 'selection.json';

  /**
   * The expected file name for icon CSS file.
   */
  public const BRAND_ICONS_CSS = 'style.css';

  /**
   * BoomEnhancementsManager constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The Config factory service.
   * @param \Drupal\Core\Extension\ThemeHandler $theme_handler
   *   Theme handler service.
   * @param \Drupal\boom_enhancements\BoomEnhancementsJsonManager $boom_enhancements_json_manager
   *   The BoomEnhancementsJsonManager service.
   * @param \Drupal\Core\StringTranslation\TranslationInterface $string_translation
   *   The translation manager.
   */
  public function __construct(ConfigFactoryInterface $config_factory, ThemeHandler $theme_handler, BoomEnhancementsJsonManager $boom_enhancements_json_manager, TranslationInterface $string_translation) {
    $this->themeHandler = $theme_handler;
    $this->configFactory = $config_factory;
    $this->boomEnhancementsJsonManager = $boom_enhancements_json_manager;
    $this->stringTranslation = $string_translation;
  }

  /**
   * Returns the link of the settings form.
   *
   * @return \Drupal\Core\Link
   *   The Url object leading to the settings form.
   */
  public function getSettingsLink(): Link {
    return Link::createFromRoute($this->t('Devportal Theme Enhancements Settings'), 'boom_enhancements.settings', [], ['query' => ['destination' => Url::fromRoute('<current>')->getInternalPath()]]);
  }

  /**
   * Get color definitions from JSON files.
   *
   * @param string $colors_json
   *   The name of the JSON file with the color definitions.
   *
   * @return array
   *   The array of colors from the configured path or the default theme based
   *   on the provided file name which defaults to 'brandColors-lock.json'.
   *
   * @throws \Drupal\boom_enhancements\Exceptions\InvalidArgumentException
   *   Thrown when the given path is an empty string.
   * @throws \Drupal\guides\Exception\FileNotFoundException
   *   Thrown when no JSON file is found.
   * @throws \Drupal\boom_enhancements\Exceptions\InvalidJsonException
   *   Thrown when the parsed JSON file is invalid.
   */
  public function getBrandColors(string $colors_json = self::BRAND_COLORS_JSON): array {
    $source_dir = $this->configFactory->get('boom_enhancements.settings')->get('colors_source');

    if (empty($source_dir)) {
      $source_dir = $this->themeHandler->getTheme($this->themeHandler->getDefault())->getPath();
    }

    // Throw an exception if the source dir is an empty string.
    if ($source_dir === '') {
      throw new InvalidArgumentException("The given path: '{$source_dir}' is invalid.");
    }

    $color_definitions = $this->boomEnhancementsJsonManager->decode($source_dir, $colors_json);

    foreach ($color_definitions as $key => $color) {
      $color_definitions[$key] = Color::rgbToHex($color);
    }

    return $color_definitions;
  }

  /**
   * Get icon definitions from JSON files.
   *
   * Only font file structures that can be obtained from https://icomoon.io/
   * are supported.
   *
   * @param string $icons_json
   *   The name of the JSON file with the icon definitions.
   * @param string $icons_css
   *   The name of the CSS file with the icon styles.
   *
   * @return array
   *   The array of icons from the configured path or the Boom theme based
   *   on the provided file name which defaults to 'selection.json'.
   *
   * @throws \Drupal\boom_enhancements\Exceptions\InvalidArgumentException
   *   Thrown when the source dir is an empty string.
   * @throws \Drupal\guides\Exception\FileNotFoundException
   *   Thrown when no JSON or CSS file is found.
   * @throws \Drupal\boom_enhancements\Exceptions\InvalidJsonException
   *   Thrown when the parsed JSON file is invalid.
   */
  public function getBrandIcons(string $icons_json = self::BRAND_ICONS_JSON, string $icons_css = self::BRAND_ICONS_CSS): array {
    $source_dir = $this->configFactory->get('boom_enhancements.settings')->get('icons_source');

    if (empty($source_dir)) {
      $source_dir = $this->themeHandler->themeExists('boom')
          ? $this->themeHandler->getTheme('boom')->getPath() . DIRECTORY_SEPARATOR . 'icons' . DIRECTORY_SEPARATOR . 'feather'
          : '';
    }

    // Throw an exception if the source dir is an empty string.
    if ($source_dir === '') {
      throw new InvalidArgumentException("The given path: '{$source_dir}' is invalid.");
    }

    $css_path = $source_dir . DIRECTORY_SEPARATOR . $icons_css;

    if (!file_exists($css_path)) {
      throw new FileNotFoundException($css_path);
    }

    return $this->boomEnhancementsJsonManager->decode($source_dir, $icons_json);
  }

}
