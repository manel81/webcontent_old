<?php

declare(strict_types = 1);

namespace Drupal\Tests\dp_faq\Functional\Update;

/**
 * Tests special case of config11.
 */
final class DpFaqViewsUpdateForConfig11Test extends DpFaqViewsUpdateTestBase {

  /**
   * The fixtures directory.
   */
  private const FIXTURES_DIR = __DIR__ . '/../../../fixtures/update/dp_faq_remove_pager_sort_title/db_with_config11/';

  /**
   * {@inheritdoc}
   */
  protected function setDatabaseDumpFiles(): void {
    $this->databaseDumpFiles = [
      self::FIXTURES_DIR . 'd8.8.4.dp_faq.config11.initial-state.php.gz',
    ];
  }

  /**
   * Dp_faq post update test.
   */
  public function testPostUpdateRemovePagerAddSortByTitle(): void {
    $this->doUpdateTest();
  }

}
