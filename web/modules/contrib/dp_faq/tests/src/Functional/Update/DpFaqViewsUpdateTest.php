<?php

declare(strict_types = 1);

namespace Drupal\Tests\dp_faq\Functional\Update;

use Drupal\Core\Serialization\Yaml;

/**
 * Dp_faq update path test.
 */
final class DpFaqViewsUpdateTest extends DpFaqViewsUpdateTestBase {

  /**
   * The fixtures directory.
   */
  private const FIXTURES_DIR = __DIR__ . '/../../../fixtures/update/dp_faq_remove_pager_sort_title/';

  /**
   * {@inheritdoc}
   */
  protected function setDatabaseDumpFiles(): void {
    $this->databaseDumpFiles = [
      self::FIXTURES_DIR . 'd8.8.4.dp_faq.initial-state.php.gz',
    ];
  }

  /**
   * Dp_faq post update test.
   */
  public function testPostUpdateRemovePagerAddSortByTitle(): void {
    foreach (glob(self::FIXTURES_DIR . '*.yml', GLOB_NOSORT) as $filename) {
      $this->importConfigFile($filename);
      $this->doUpdateTest();
    }
  }

  /**
   * Dp_faq post update test if devportal_faq view not found.
   */
  public function testDevportalFaqViewMissing(): void {
    $this->config('views.view.devportal_faq')->delete();
    $this->runUpdates();
    $this->assertSession()->pageTextContains('Devportal FAQ View not found!');
  }

  /**
   * Import a configuration file.
   *
   * @param string $filename
   *   The name of the configuration file to import.
   */
  private function importConfigFile(string $filename): void {
    $data = Yaml::decode(file_get_contents($filename));
    /** @var \Drupal\Core\Config\FileStorage $sync */
    $sync = \Drupal::service('config.storage.sync');
    $this->copyConfig(\Drupal::service('config.storage'), $sync);
    $sync->write(self::CONFIG_NAME, $data);
    $this->configImporter()->import();
  }

}
