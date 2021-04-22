<?php

/**
 * @file
 * Theme and preprocess functions for blocks.
 *
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

declare(strict_types = 1);

use Drupal\block\Entity\Block;

/**
 * Implements hook_preprocess_HOOK().
 */
function dp_zero_gravity_preprocess_block(array &$variables): void {
  $variables['title_attributes']['class'][] = 'block-title';
  if ($variables['base_plugin_id'] === 'system_menu_block' && isset($variables['elements']['#id'])) {
    /** @var \Drupal\block\BlockInterface $block */
    $block = Block::load($variables['elements']['#id']);
    if ($block && $block->getRegion() === 'sidebar_first' && $block->getThirdPartySetting('in_page_navigation', 'ip_navigation')) {
      $variables['#attached']['drupalSettings']['affix_block'][] = [
        '.attach_ip_navigation',
        '#toolbar-item-administration, #toolbar-item-administration-tray',
        '.region--footer, .divider',
        '.ip-navigation-item a',
        FALSE,
      ];
    }
  }
}
