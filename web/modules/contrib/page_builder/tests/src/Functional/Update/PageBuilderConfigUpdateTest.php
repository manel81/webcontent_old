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

namespace Drupal\Tests\page_builder\Functional\Update;

use Drupal\FunctionalTests\Update\UpdatePathTestBase;

/**
 * Page Builder update path test for update hook 8008.
 *
 * This class tests two scenarios:
 * 1.)  The project was started after page_builder.settings was taken out of
 *      the page_builder module (after 2019-09-23, commit c1a06f7). In this case
 *      the update hook must not delete anything.
 * 2.)  The project was started when page_builder.settings was still in the
 *      page_builder module (before 2019-09-23, commit c1a06f7). In this
 *      case the update hook must delete the page_builder.settings
 *      configuration object.
 *
 * @group page_builder
 * @group Update
 * @group legacy
 */
final class PageBuilderConfigUpdateTest extends UpdatePathTestBase {

  /**
   * A dummy array of how page_builder.settings looks like in the wild.
   *
   * @var string[]
   */
  private $configValues = [
    'collection' => '',
    'name' => 'page_builder.settings',
    'data' => 'a:4:{s:15:"grid_column_gap";s:0:"";s:12:"grid_row_gap";s:0:"";s:11:"icon_source";s:0:"";s:12:"color_source";s:37:"themes/devportal/dp-theme-zerogravity";}',
  ];

  /**
   * {@inheritdoc}
   */
  protected function setDatabaseDumpFiles(): void {
    $this->databaseDumpFiles = [
      __DIR__ . '/../../../fixtures/update/page_builder_update_8008/drupal-8.8.4-standard--page_builder-8007.php.gz',
    ];
  }

  /**
   * The site does not have page_builder.settings in its active configuration.
   */
  public function testUpdateHook8008onDbWithoutConfigObject(): void {
    $this->assertConfigDoesNotExist();
    $this->runUpdates();
    $this->assertSession()->pageTextContains('No leftover page builder configuration was found.');
    $this->assertConfigDoesNotExist();
  }

  /**
   * The site has page_builder.settings in its active configuration.
   */
  public function testUpdateHook8008onDbWithConfigObject(): void {
    $this->insertDummyConfigIntoDatabase();
    $this->assertConfigDoesExist();
    $this->runUpdates();
    $this->assertSession()->pageTextContains('Leftover page builder configuration has been removed.');
    $this->assertConfigDoesNotExist();
  }

  /**
   * Asserts that the configurations we are testing for do not exist.
   */
  private function assertConfigDoesNotExist(): void {
    /** @var \Drupal\Core\Config\Config $config */
    $config = $this->config($this->configValues['name']);
    $this->assertTrue($config->isNew());
    $this->assertSame([], $config->get());
  }

  /**
   * Asserts that the configurations we are testing for do exist.
   */
  private function assertConfigDoesExist(): void {
    /** @var \Drupal\Core\Config\Config $config */
    $config = $this->config($this->configValues['name']);
    $this->assertFalse($config->isNew());
    $this->assertSame(unserialize($this->configValues['data']), $config->get());
  }

  /**
   * Inserts dummy page_builder.settings config object.
   */
  private function insertDummyConfigIntoDatabase(): void {
    /** @var \Drupal\Core\Config\Config $config */
    $config = $this->config($this->configValues['name']);
    $config_data = unserialize($this->configValues['data']);
    foreach ($config_data as $key => $value) {
      $config->set($key, $value);
    }
    $config->save();
  }

}
