<?php

declare(strict_types = 1);

namespace Drupal\in_page_navigation\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a block with a simple div to attach in-page navigation to it.
 *
 * @Block(
 *   id = "in_page_navigation_block",
 *   admin_label = @Translation("IP Navigation: In-page navigation block")
 * )
 */
class IPNavigationBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    return [
      '#theme' => 'in_page_navigation',
      '#attributes' => [
        'class' => ['block--in-page-navigation'],
      ],
    ];
  }

}
