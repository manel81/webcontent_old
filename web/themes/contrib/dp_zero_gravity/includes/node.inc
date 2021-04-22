<?php

/**
 * @file
 * Theme and preprocess functions for nodes.
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

use Drupal\node\NodeInterface;
use Jenssegers\Agent\Agent;

/**
 * Implements hook_preprocess_HOOK() for node.html.twig.
 */
function dp_zero_gravity_preprocess_node(array &$variables): void {
  /** @var \Drupal\Core\Datetime\DateFormatter $date_formatter */
  $date_formatter = \Drupal::service('date.formatter');
  $node = $variables['node'];

  if ($node->getType() === 'page_builder' || $variables['view_mode'] === 'card') {
    if (theme_get_setting('cards_interactive')) {
      $variables['#attached']['library'][] = 'dp_zero_gravity/zero_gravity_cards';
    }
  }

  if ($node->getType() === 'blog_post') {
    $variables['formatted_user_name_and_date'] = $node->getOwner()->getUserName() . ' | ' . $date_formatter->format($node->getCreatedTime(), 'blog_post_date');
  }

  if ($node->getType() === 'api_reference') {
    $agent = new Agent();
    if ($agent->browser() === 'IE') {
      if ($variables['content']['field_source_file']['#formatter'] === 'swagger_ui_file') {
        $variables['content'] = [
          '#theme' => 'status_messages',
          '#message_list' => [
            'warning' => [
              t('Swagger UI pages do not support Internet Explorer. Please switch to Edge, Chrome, Firefox or Safari to see the content.'),
            ],
          ],
        ];
      }
    }
    // Add API reference in-page navigation to the affix array.
    $variables['#attached']['drupalSettings']['affix_node'][] = [
      '#block-ipnavigationinpagenavigationblock',
      '#toolbar-item-administration, #toolbar-item-administration-tray',
      '.region--footer, .divider',
      '.ip-navigation-item a',
      FALSE,
    ];
  }
}

/**
 * Implements hook_preprocess_HOOK() for node--api-reference--card.html.twig.
 */
function dp_zero_gravity_preprocess_node__api_reference__card(array &$variables): void {
  // @todo Consider moving this to a module.
  // If we're on the card view of an api_reference node, create a link to the
  // API Description page to be used in the template.
  // Invalidate the cache of _this specific_ API Reference node's card view
  // mode.
  // @todo Only do this when absolutely needed.
  // (This approach invalidates this cache if/when _any_ node gets changed in
  // any way.)
  $variables['#cache']['tags'][] = 'node_list';

  // Only change the api_landing_page_path if the Description page is
  // published.
  $description_page_id = \Drupal::entityQuery('node')
    ->condition('status', NodeInterface::PUBLISHED)
    ->condition('type', 'api_description_page')
    ->condition('field_api_reference.target_id', $variables['node']->id())
    ->execute();
  if (!empty($description_page_id)) {
    $variables['api_landing_page_path'] = \Drupal::service('path.alias_manager')
      ->getAliasByPath('/node/' . reset($description_page_id));
  }
}
