<?php

declare(strict_types = 1);

namespace Drupal\Tests\dp_faq\Functional\Update;

use Drupal\Component\Utility\NestedArray;
use Drupal\FunctionalTests\Update\UpdatePathTestBase;

/**
 * Base class for DpFAQ update tests.
 */
abstract class DpFaqViewsUpdateTestBase extends UpdatePathTestBase {

  /**
   * The name of the configuration under test.
   */
  protected const CONFIG_NAME = 'views.view.devportal_faq';

  /**
   * The name of the post_update hook.
   */
  private const POST_UPDATE_HOOK_NAME = 'dp_faq_post_update_remove_pager_add_sort_by_title';

  /**
   * Returns the configuration array as it should look like after the update.
   *
   * @return array
   *   The updated configuration array.
   */
  protected function createTargetConfig(): array {
    $target_data = $this->config(self::CONFIG_NAME)->get();
    $target_data['display']['default']['display_options']['pager']['type'] = 'none';
    unset($target_data['display']['default']['display_options']['pager']['options']);
    $target_data['display']['default']['display_options']['pager']['options']['offset'] = 0;
    $target_data['display']['default']['display_options']['sorts']['title'] = [
      'id' => 'title',
      'table' => 'node_field_data',
      'field' => 'title',
      'relationship' => 'none',
      'group_type' => 'group',
      'admin_label' => '',
      'order' => 'ASC',
      'exposed' => FALSE,
      'expose' => [
        'label' => '',
      ],
      'entity_type' => 'node',
      'entity_field' => 'title',
      'plugin_id' => 'standard',
    ];
    $target_data = NestedArray::filter($target_data, static function ($value) {
      return !in_array($value, ['extensions', 'url.query_args'], TRUE);
    });
    foreach ($target_data['display'] as &$reindex) {
      $reindex['cache_metadata']['contexts'] = array_values($reindex['cache_metadata']['contexts']);
    }
    return $target_data;
  }

  /**
   * Remove a post_update hook from the list of existing updates.
   */
  protected function removePostUpdateHookFromExistingUpdatesList(): void {
    $key_value = \Drupal::keyValue('post_update');
    $existing_updates = $key_value->get('existing_updates');
    $key = array_search(self::POST_UPDATE_HOOK_NAME, $existing_updates, TRUE);
    if ($key !== FALSE) {
      unset($existing_updates[$key]);
      $key_value->set('existing_updates', $existing_updates);
    }
  }

  /**
   * The update test.
   */
  protected function doUpdateTest(): void {
    $target_config = $this->createTargetConfig();
    $this->runUpdates();
    $updated_config = $this->config(self::CONFIG_NAME)->get();
    static::assertSame($target_config, $updated_config);
    $this->assertSession()->pageTextContains('Devportal FAQ View updated.');
    $this->removePostUpdateHookFromExistingUpdatesList();
  }

}
