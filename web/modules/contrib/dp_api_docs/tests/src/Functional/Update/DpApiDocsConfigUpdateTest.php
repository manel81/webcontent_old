<?php

declare(strict_types = 1);

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

namespace Drupal\Tests\dp_api_docs\Functional\Update;

use Drupal\FunctionalTests\Update\UpdatePathTestBase;

/**
 * Update hook tests for dp_api_docs.
 *
 * @group Update
 * @group legacy
 */
class DpApiDocsConfigUpdateTest extends UpdatePathTestBase {

  /**
   * These are the configurations that need to be tested.
   *
   * @var string[]
   */
  private $configNames = [
    'core.entity_form_display.paragraph.featured_api.default',
    'core.entity_view_display.paragraph.featured_api.default',
    'field.field.paragraph.featured_api.field_api_reference',
    'field.storage.paragraph.field_api_reference',
    'paragraphs.paragraphs_type.featured_api',
  ];

  /**
   * {@inheritdoc}
   */
  protected function setDatabaseDumpFiles(): void {
    $this->databaseDumpFiles = [
      __DIR__ . '/../../../fixtures/update/dp_api_docs_update_8013/d8.dp_api_docs.initial-state.php.gz',
    ];
  }

  /**
   * Test dp_api_docs_update_8013.
   */
  public function testUpdateHook8013(): void {
    foreach ($this->configNames as $config_name) {
      $config = $this->config($config_name)->get('dependencies.enforced.module');
      $this->assertNull($config);
    }

    $this->runUpdates();

    foreach ($this->configNames as $config_name) {
      $config = $this->config($config_name)->get('dependencies.enforced.module');
      $this->assertSame(['dp_api_docs'], $config);
    }
  }

}
