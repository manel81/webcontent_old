<?php

declare(strict_types = 1);

namespace Drupal\dp_faq\Plugin\Block;

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

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a FAQ Block.
 *
 * @Block(
 *   id = "dp_faq_block",
 *   admin_label = @Translation("DP FAQ block"),
 *   category = @Translation("DP FAQ"),
 * )
 */
final class DpFaqBlock extends BlockBase implements BlockPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    return [
      '#attached' => [
        'library' => [
          'dp_faq/dp_faq_block',
        ],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration(): array {
    return [
      'quicklinks' => FALSE,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state): array {
    $form['quicklinks'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Add copy links to FAQ items'),
      '#description' => $this->t('A link icon will appear next to FAQ items, clicking on them will copy a link to the corresponding FAQ item.'),
      '#default_value' => $this->configuration['quicklinks'],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state): void {
    $this->configuration['quicklinks'] = (bool) $form_state->getValue('quicklinks');
  }

}
