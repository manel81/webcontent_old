<?php

/**
 * @file
 * Theme and preprocess functions for forms.
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

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element;
use Jenssegers\Agent\Agent;

/**
 * Implements hook_form_alter().
 */
function dp_zero_gravity_form_alter(array &$form, FormStateInterface $form_state, string $form_id): void {
  $ie_warn = [
    'user_login_form',
    'user_register_form',
  ];

  if (in_array($form_id, $ie_warn, TRUE)) {
    $agent = new Agent();
    if ($agent->browser() === 'IE') {
      \Drupal::messenger()->addWarning(t('Please note that Internet Explorer does not display all functionalities on this developer portal. We suggest switching to Edge, Chrome, Firefox or Safari instead.'), TRUE);
    }
  }

  $thinner_forms = [
    'user_login_form',
    'user_pass',
    'user_register_form',
  ];

  $no_panel_forms = [
    'search_block_form',
    'search_form',
    'developer_app_edit_for_developer_form',
    'developer_app_edit_form',
    'team_app_edit_form',
  ];

  $compact_forms = ['search_block_form'];

  $classes = [];
  $form['#attributes']['class'][] = 'form';
  $form['#attributes']['class'][] = in_array($form_id, $thinner_forms, TRUE) ? 'thinner' : 'thin';

  if (!in_array($form_id, $no_panel_forms, TRUE)) {
    $classes[] = 'zg-panel';
  }

  if (!in_array($form_id, $compact_forms, TRUE)) {
    $classes[] = 'form__fields';

    $form['dp_zero_gravity_form_wrapper_start'] = [
      '#type' => 'markup',
      '#markup' => '<div class="' . implode(' ', $classes) . '">',
      '#weight' => -1000000,
    ];
    $form['dp_zero_gravity_form_wrapper_end'] = [
      '#type' => 'markup',
      '#markup' => '</div>',
      '#weight' => 1000000,
    ];
    $form['actions']['#weight'] = 1000010;

    if (!isset($form['actions']['#attributes'])) {
      $form['actions']['#attributes'] = [];
    }

    if (!isset($form['actions']['#attributes']['class'])) {
      $form['actions']['#attributes']['class'] = [];
    }

    $form['actions']['#attributes']['class'][] = 'form__actions';
  }

  if ($form_id === 'search_block_form') {
    $form['actions']['submit']['#attributes']['class'][] = 'zg-search__submit';
  }

  // Apigee related.
  $app_edit_form_ids = [
    'developer_app_edit_for_developer_form',
    'developer_app_edit_form',
    'team_app_edit_form',
  ];

  $app_add_form_ids = [
    'developer_app_add_for_developer_form',
    'developer_app_add_form',
    'team_app_add_form',
  ];

  if (in_array($form_id, array_merge($app_add_form_ids, $app_edit_form_ids), TRUE)) {
    $form['#attributes']['class'][] = 'zg-apigee-app-form';
  }

  if (in_array($form_id, $app_add_form_ids)) {
    if (isset($form['api_products'])) {
      $form['api_products']['#attributes']['class'][] = 'zg-apigee-app-form__products';
    }
    $form['#attributes']['class'][] = 'zg-apigee-app-form--add';
  }
  elseif (in_array($form_id, $app_edit_form_ids)) {
    $app_label = \Drupal::service('entity_type.manager')
      ->getDefinition('developer_app')
      ->getSingularLabel();
    $form['actions']['submit']['#value'] = t('Save @app', ['@app' => $app_label]);
    $form['actions']['delete']['#title'] = t('Delete @app', ['@app' => $app_label]);
    $form['actions']['delete']['#weight'] = 1;
    $form['#attributes']['class'][] = 'zg-apigee-app-form--edit';

    $detail_fields = [
      'callbackUrl',
      'description',
      'displayName',
    ];

    // Add details wrapper to non-credential info fields.
    $form['details'] = [
      '#type' => 'fieldset',
      '#title' => t('Details'),
      '#tag' => 'div',
      '#attributes' => [
        'class' => [
          'zg-apigee-app-form__details',
        ],
      ],
    ];

    foreach ($detail_fields as $field) {
      $form['details'][$field] = $form[$field];
      hide($form[$field]);
    }

    if (isset($form['credential'])) {
      foreach (Element::children($form['credential']) as $credential) {
        $form['credential'][$credential]['#attributes']['class'][] = 'zg-apigee-app-form__credential';
        $form['credential'][$credential]['api_products']['#attributes']['class'][] = 'zg-apigee-app-form__products';
      }
    }
  }
}

/**
 * Implements hook_form_FORM_ID_alter().
 */
function dp_zero_gravity_form_views_ui_edit_display_form_alter(array &$form, FormStateInterface $form_state, string $form_id): void {
  $current_display = $form_state->getStorage()['view']->getDisplay($form_state->getStorage()['display_id']);
  $display_format = $current_display['display_options']['style']['type'] ?? $form_state->getStorage()['view']->getDisplay('default')['display_options']['style']['type'];
  if ($display_format === 'grid') {
    $form['options']['style_options']['automatic_width']['#access'] = FALSE;
    $form['options']['style_options']['automatic_width']['#default_value'] = FALSE;
    $form['options']['style_options']['alignment']['#access'] = FALSE;
    $form['options']['style_options']['row_class_default']['#access'] = FALSE;
    $form['options']['style_options']['row_class_custom']['#access'] = FALSE;
    $form['options']['style_options']['col_class_default']['#access'] = FALSE;
    $form['options']['style_options']['col_class_custom']['#title'] = t('Custom content class');
    $form['options']['style_options']['col_class_custom']['#description'] = t('Additional classes to provide on each column content. Separated by a space.');
    $form['options']['style_options']['columns']['#max'] = 4;
  }
}

/**
 * Implements hook_form_FORM_ID_alter().
 */
function dp_zero_gravity_form_user_login_form_alter(array &$form, FormStateInterface $form_state, string $form_id): void {
  foreach (['name', 'pass'] as $key) {
    if (isset($form[$key]['#description'])) {
      unset($form[$key]['#description']);
    }
    $form[$key]['#parent_form_id'] = $form['#form_id'];
  }
}

/**
 * Implements hook_form_FORM_ID_alter().
 */
function dp_zero_gravity_form_user_register_form_alter(array &$form, FormStateInterface $form_state, string $form_id): void {
  foreach (['mail', 'name', 'pass'] as $key) {
    if (isset($form['account'][$key]['#description'])) {
      unset($form['account'][$key]['#description']);
    }
  }
}

/**
 * Implements hook_form_FORM_ID_alter().
 */
function dp_zero_gravity_form_user_pass_alter(array &$form, FormStateInterface $form_state, string $form_id): void {
  $form['mail']['#access'] = FALSE;
  $form['message'] = [
    '#type' => 'container',
    '#attributes' => [
      'class' => [
        'messages',
        'messages--info',
        'has-shadow',
      ],
    ],
    '#weight' => $form['dp_zero_gravity_form_wrapper_start']['#weight'] - 1,
  ];
  $form['message']['message_text'] = $form['mail'];
  $form['message']['message_text']['#prefix'] = '<div class="messages__text"><span class="messages__icon icon--content"><span class="feather-' . DP_ZERO_GRAVITY_MESSAGE_INFO_ICON . '"></span></span><span>';
  $form['message']['message_text']['#suffix'] = '</span></div>';
  $form['message']['message_text']['#access'] = TRUE;
}

/**
 * Implements hook_form_FORM_ID_alter().
 */
function dp_zero_gravity_form_user_form_alter(array &$form, FormStateInterface $form_state): void {
  $edited_user = $form_state->getFormObject()->getEntity();
  $current_user = \Drupal::currentUser();
  if ($current_user->hasPermission('change own username') === TRUE || $current_user->id() === $edited_user->id()) {
    $form['account']['name']['#disabled'] = TRUE;
    $form['account']['name']['#required'] = FALSE;
    $form['account']['name']['#description'] = t('The username can not be changed');
    $form['account']['name']['#access'] = TRUE;
  }
}

/**
 * Implements hook_preprocess_HOOK().
 */
function dp_zero_gravity_preprocess_input(array &$variables): void {
  if (isset($variables['element']['#parent_form_id']) && $variables['element']['#parent_form_id'] === 'user_login_form') {
    $variables['input_group'] = TRUE;

    $name = $variables['element']['#name'];

    switch ($name) {
      case 'name':
        $variables['icon'] = 'user';
        break;

      case 'pass':
        $variables['icon'] = 'lock';
        break;
    }
  }

  if (!isset($variables['element']['#type']) || $variables['element']['#type'] !== 'submit') {
    return;
  }

  $variables['attributes']['class'][] = 'button--primary';
}
