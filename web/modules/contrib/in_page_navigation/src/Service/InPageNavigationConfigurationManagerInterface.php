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

use Drupal\in_page_navigation\InPageNavigationConfiguration;

/**
 * Defines the in page navigation configuration manager.
 *
 * @group domain
 */
interface InPageNavigationConfigurationManagerInterface {

  /**
   * Returns the in page navigation for a theme.
   *
   * @param string $theme_name
   *   (Machine) Name of the theme.
   *
   * @return \Drupal\in_page_navigation\InPageNavigationConfiguration
   *   The in page navigation configuration.
   *
   * @throws \Drupal\in_page_navigation\Exception\InvalidArgumentException
   *   When the provided $theme_name is invalid.
   */
  public function getConfigurationForTheme(string $theme_name): InPageNavigationConfiguration;

  /**
   * Saves the in page navigation for a theme.
   *
   * @param string $theme_name
   *   (Machine) Name of the theme.
   * @param \Drupal\in_page_navigation\InPageNavigationConfiguration $config
   *   The in page navigation configuration.
   *
   * @throws \Drupal\in_page_navigation\Exception\InvalidArgumentException
   *   When the provided $theme_name is invalid.
   * @throws \Drupal\in_page_navigation\Exception\InPageNavigationConfigurationSaveException
   *   When the provided configuration could not be saved.
   */
  public function saveConfigurationForTheme(string $theme_name, InPageNavigationConfiguration $config): void;

  /**
   * Removes stored configuration for a theme.
   *
   * @param string $theme_name
   *   (Machine) Name of the theme.
   *
   * @throws \Drupal\in_page_navigation\Exception\InvalidArgumentException
   *   When the provided $theme_name is invalid.
   * @throws \Drupal\in_page_navigation\Exception\InPageNavigationConfigurationSaveException
   *   When the provided configuration could not be saved.
   */
  public function removeConfigurationForTheme(string $theme_name): void;

}
