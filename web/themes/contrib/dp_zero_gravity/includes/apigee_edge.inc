<?php

/**
 * @file
 * Theme and preprocess functions for apigee_edge.
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
use Drupal\Component\Utility\Html;
use Drupal\Core\Link;
use Drupal\apigee_edge\Element\StatusPropertyElement;

/**
 * Implements hook_preprocess_HOOK().
 */
function dp_zero_gravity_preprocess_status_property(array &$variables): void {
  if (\Drupal::service('module_handler')->moduleExists('apigee_edge')) {
    $variables['element']['attributes']['class'][] = 'status';

    switch ($variables['element']['#indicator_status']) {
      case StatusPropertyElement::INDICATOR_STATUS_OK:
        $variables['element']['attributes']['class'][] = 'status--ok';
        break;

      case StatusPropertyElement::INDICATOR_STATUS_WARNING:
        $variables['element']['attributes']['class'][] = 'status--warning';
        break;

      case StatusPropertyElement::INDICATOR_STATUS_ERROR:
        $variables['element']['attributes']['class'][] = 'status--error';
        break;
    }
  }
}

/**
 * Implements hook_preprocess_HOOK().
 */
function dp_zero_gravity_preprocess_app_credential_product_list(array &$variables): void {
  $class = 'button button--secondary';
  $variables['show_more_btn_attrs']['class'][] = $class;
  $variables['show_less_btn_attrs']['class'][] = $class;

  foreach ($variables['content'] as &$product) {
    if (!isset($product['#attributes'])) {
      $product['#attributes'] = [];
    }
    $product['#attributes']['class'] = ['zg-apigee-app-credential__product'];
  }
}

/**
 * Implements hook_preprocess_HOOK().
 */
function dp_zero_gravity_preprocess_apigee_entity__app(array &$variables): void {
  /** @var \Drupal\apigee_edge\Entity\AppInterface $apigee_entity */
  $apigee_entity = $variables['entity'];

  // Add local tasks on the app canonical route as additional tabs.
  $variables['operations'] = [];
  $route_name = $apigee_entity->toUrl()->getRouteName();

  switch ($apigee_entity->getEntityTypeId()) {
    case 'developer_app':
      $route_name = 'entity.developer_app.canonical_by_developer';
      $route_parameters = [
        'user' => $apigee_entity->getOwnerId(),
        'app' => $apigee_entity->getName(),
      ];
      break;

    case 'team_app':
      $route_parameters = [
        'team' => $apigee_entity->getAppOwner(),
        'app' => $apigee_entity->getName(),
      ];
      break;
  }

  // Add class to "Add" button.
  $variables['content']['add_keys']['#url']->setOption('attributes', [
    'class' => [
      'button',
      'button--primary',
    ],
  ]);
  // Add icon to "Add" button.
  $variables['content']['add_keys']['#title'] = new FormattableMarkup('<span class="button__icon zg-icon--add"></span>' . (string) $variables['content']['add_keys']['#title'], []);

  $tasks = \Drupal::service('plugin.manager.menu.local_task')->getLocalTasks($route_name);
  if ($tasks) {
    foreach ($tasks['tabs'] as $tab) {
      $link = $tab['#link'];

      /** @var \Drupal\Core\Url $url */
      $url = $link['url'];
      $url->setRouteParameters($route_parameters);
      $icon = new FormattableMarkup('<span class="zg-icon--' . Html::cleanCssIdentifier(strtolower($link['title'])) . '"></span>', []);
      $variables['operations'][] = Link::fromTextAndUrl($icon, $url->setOptions([
        'attributes' => [
          'data-tooltip' => $link['title'],
          'class' => ['zg-apigee-app__operation'],
          'aria-label' => $link['title'],
        ],
      ]))->toRenderable();
    }
  }

  unset($variables['content']['credentials']['#type']);
  unset($variables['content']['credentials']['#weight']);
  unset($variables['content']['credentials']['revoked']['#type']);
  unset($variables['content']['credentials']['revoked']['#weight']);
  unset($variables['content']['credentials']['revoked']['#title']);

  foreach ($variables['content']['credentials']['revoked']['credentials'] as &$credential) {
    if (!isset($credential['#attributes'])) {
      $credential['#attributes'] = [];
    }
    $credential['#attributes']['class'] = ['zg-apigee-app-credential--revoked'];
  }

  if ($variables['view_mode'] === 'default') {
    $variables['content']['status']['#label_display'] = 'hidden';
  }

  if ($variables['view_mode'] !== 'full') {
    $warnings = [];

    foreach ($variables['content']['warnings']['#message_list']['warning'] as $warning) {
      $warnings[] = [
        '#type' => 'markup',
        '#markup' => $warning,
      ];
    }

    $variables['content']['warnings'] = $warnings;
  }
}

/**
 * Implements hook_preprocess_HOOK().
 */
function dp_zero_gravity_preprocess_app_credential(array &$variables): void {
  unset($variables['secondary_wrapper']['title']);
  if (!isset($variables['primary_wrapper']['#attributes'])) {
    $variables['primary_wrapper']['#attributes'] = [];
  }

  $variables['primary_wrapper']['#attributes']['class'] = [
    'zg-panel__items',
    'zg-apigee-app-credential__details',
  ];

  if (!isset($variables['secondary_wrapper']['#attributes'])) {
    $variables['secondary_wrapper']['#attributes'] = [];
  }

  $variables['secondary_wrapper']['#attributes']['class'] = ['zg-apigee-app-credential__products'];

  foreach ($variables['primary_wrapper'] as $key => &$wrapper) {
    if ($key[0] !== '#' && is_array($wrapper)) {
      if (!isset($wrapper['#attributes'])) {
        $wrapper['#attributes'] = [];
      }

      $wrapper['#attributes']['class'] = [
        'zg-panel__item',
      ];
    }
  }
}
