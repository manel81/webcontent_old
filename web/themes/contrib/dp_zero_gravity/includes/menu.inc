<?php

/**
 * @file
 * Theme and preprocess functions for menus.
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

use Drupal\Component\Render\FormattableMarkup;
use Drupal\Core\Template\Attribute;

/**
 * Implements hook_preprocess_HOOK().
 */
function dp_zero_gravity_preprocess_menu__account(array &$variables): void {
  $variables['#attached']['library'][] = 'dp_zero_gravity/zero_gravity_active_links';

  $link_icons = [
    'apigee_edge.user.apps' => 'grid',
    'entity.team.collection' => 'members',
    'user.page' => 'user',
    'user.logout' => 'log-out',
    'search.view' => 'search',
  ];

  foreach ($variables['items'] as &$item) {
    $item['link_attributes'] = new Attribute();

    if (isset($item['url']) && $item['url']->isRouted()) {
      $route_name = $item['url']->getRouteName();

      if ($route_name === 'user.login') {
        $item['link_attributes']->addClass([
          'button',
          'button--secondary--inverted',
        ]);
      }

      if (array_key_exists($route_name, $link_icons)) {
        $icon = $link_icons[$route_name];
        $title = render($item['title']);
        $item['title'] = new FormattableMarkup('<span class="menu__item-icon zg-icon--@icon"></span><span class="menu__item-title">@title</span>', [
          '@icon' => $icon,
          '@title' => $title,
        ]);
        $item['url']->setOptions([
          'attributes' => [
            'aria-label' => $title,
            'data-route' => $route_name,
            'data-tooltip' => $title,
          ],
        ]);
      }
    }
  }
}

/**
 * Implements hook_preprocess_HOOK().
 */
function dp_zero_gravity_preprocess_menu_local_action(array &$variables): void {
  $link = $variables['link'];
  /** @var \Drupal\Core\Url $url */
  $url = $link['#url'];
  $route_names = [
    'entity.developer_app.add_form_for_developer',
    'entity.developer_app.add_form',
    'entity.team_app.add_form_for_team',
    'entity.team_app.add_form',
    'entity.team.add_form',
    'entity.team.add_members',
  ];

  if (in_array($url->getRouteName(), $route_names)) {
    // Add class to "Add" button.
    $url->setOption('attributes', ['class' => ['button--primary']]);
    // Add icon to "Add" button.
    $variables['link']['#title'] = new FormattableMarkup('<span class="button__icon zg-icon--add"></span>' . (string) $link['#title'], []);
  }
}

/**
 * Implements hook_preprocess_HOOK().
 */
function dp_zero_gravity_preprocess_links__dropbutton__operations(array &$variables): void {
  $variables['attributes']['class'] = [
    'zg-operations',
  ];

  foreach ($variables['links'] as $operation => $link) {
    $variables['links'][$operation]['link']['#title'] = new FormattableMarkup('<span class="zg-icon--@icon"></span>', [
      '@icon' => $operation,
    ]);
    $variables['links'][$operation]['link']['#attributes']['data-tooltip'] = $link['text'];
    $variables['links'][$operation]['link']['#attributes']['aria-label'] = $link['text'];
  }
}
