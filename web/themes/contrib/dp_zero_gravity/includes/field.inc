<?php

/**
 * @file
 * Theme and preprocess functions for fields.
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

use Drupal\Component\Utility\Html;
use Drupal\Core\Link;
use Drupal\Core\Url;

define('DP_ZERO_GRAVITY_SWAGGER_UI_SUPPORTED_VERSION', '3.26.2');

/**
 * Implements hook_preprocess_HOOK().
 */
function dp_zero_gravity_preprocess_field(array &$variables): void {
  $field = $variables['field_name'];

  switch ($field) {
    case 'field_icon':
      $variables['attributes']['class'][] = 'icon--content';
      break;
  }

  if (in_array($variables['element']['#formatter'], [
    'swagger_ui_file',
    'swagger_ui_link',
  ])) {
    if (\Drupal::currentUser()->hasPermission('administer site configuration') && _swagger_ui_formatter_get_library_version() !== DP_ZERO_GRAVITY_SWAGGER_UI_SUPPORTED_VERSION) {
      \Drupal::messenger()
        ->addWarning(t('The currently installed Swagger UI library version is not supported by Zero Gravity theme so the rendered Swagger UI might be broken. Please use @version to be fully compatible with plugins in Zero Gravity.', [
          '@version' => DP_ZERO_GRAVITY_SWAGGER_UI_SUPPORTED_VERSION,
        ]));
    }
    $swagger_ui_config = $variables['#attached']['drupalSettings']['swaggerUiConfig'] ?? [];

    // Attach Info section related plugin.
    $variables['#attached']['library'][] = 'dp_zero_gravity/swagger_ui_plugins.info';
    $swagger_ui_config['info']['showTitle'] = theme_get_setting('swagger_ui_info_show_title');
    $swagger_ui_config['info']['showDescription'] = theme_get_setting('swagger_ui_info_show_description');
    $swagger_ui_config['info']['postmanButtonEnabled'] = theme_get_setting('swagger_ui_info_postman');
    $swagger_ui_config['infoUrl']['alterToButton'] = theme_get_setting('swagger_ui_info_download');
    $swagger_ui_config['infoUrl']['title'] = t('Download OpenAPI Specification');
    $swagger_ui_config['infoUrl']['className'] = 'button button--primary';
    $swagger_ui_config['postmanButton']['title'] = t('Run in Postman');
    $swagger_ui_config['postmanButton']['className'] = 'button button--postman';

    // Attach Code highlight related plugin.
    if (theme_get_setting('swagger_ui_highlight_enable')) {
      $variables['#attached']['library'][] = 'dp_zero_gravity/swagger_ui_plugins.highlight';
      $swagger_ui_config['lowlight']['langs'] = array_map('trim', explode(',', Html::escape(theme_get_setting('swagger_ui_highlight_langs')) ?? 'javascript, shell'));
      $swagger_ui_config['highlight']['downloadable'] = theme_get_setting('swagger_ui_highlight_download');
      $swagger_ui_config['highlight']['copiable'] = theme_get_setting('swagger_ui_highlight_copy');
      $swagger_ui_config['highlight']['downloadIcon'] = 'feather-download';
      $swagger_ui_config['highlight']['copyIcon'] = 'feather-copy';
    }

    // Attach Code samples related plugin.
    if (theme_get_setting('swagger_ui_code_samples_manual') || theme_get_setting('swagger_ui_code_samples_generate')) {
      $variables['#attached']['library'][] = 'dp_zero_gravity/swagger_ui_plugins.code_samples';
      $swagger_ui_config['parameters']['manualCodeSamplesEnabled'] = theme_get_setting('swagger_ui_code_samples_manual');
      $swagger_ui_config['parameters']['generatedCodeSamplesEnabled'] = theme_get_setting('swagger_ui_code_samples_generate');
      if (theme_get_setting('swagger_ui_code_samples_generate')) {
        $swagger_ui_config['generatedCodeSamples']['targets'] = theme_get_setting('swagger_ui_code_samples_generate_langs');
      }
    }

    $variables['#attached']['drupalSettings']['swaggerUiConfig'] = $swagger_ui_config;
    $theme_path = \Drupal::service('theme_handler')->getTheme('dp_zero_gravity')->getPath();
    $variables['#attached']['drupalSettings']['assetPath'] = DIRECTORY_SEPARATOR . $theme_path . DIRECTORY_SEPARATOR . 'dist' . DIRECTORY_SEPARATOR;
  }

  $field_type = $variables['field_type'];
  $text_fields = [
    'text',
    'text_long',
    'text_with_summary',
  ];

  if (!in_array($field_type, $text_fields)) {
    return;
  }

  $variables['attributes']['class'][] = 'has-button';
}

/**
 * Implements hook_preprocess_HOOK().
 */
function dp_zero_gravity_preprocess_field__field_grid_elements(array &$variables): void {
  if ($variables['element']['#entity_type'] === 'paragraph') {
    $paragraph = $variables['element']['#object'];
    $bundle = $paragraph->bundle();
    $variables['attributes']['class'][] = 'grid';

    switch ($bundle) {
      case 'grid':
        if ($paragraph->hasField('field_grid_layout')) {
          $grid_layout = $paragraph->get('field_grid_layout')->first();
          if (!$grid_layout) {
            break;
          }

          $grid_layout = $grid_layout->getValue()['value'];

          switch ($grid_layout) {
            case 'one-column':
              foreach ($variables['items'] as $key => $item) {
                $variables['items'][$key]['attributes']->addClass('col--12');
              }
              $variables['attributes']['class'][] = 'grid--1';
              break;

            case 'two-columns':
              foreach ($variables['items'] as $key => $item) {
                $variables['items'][$key]['attributes']->addClass('col--tablet--6');
              }
              $variables['attributes']['class'][] = 'grid--2';
              break;

            case 'two-columns-33-66':
              foreach ($variables['items'] as $key => $item) {
                if ($key % 2 === 1) {
                  $variables['items'][$key]['attributes']->addClass('col--tablet--8');
                }
                else {
                  $variables['items'][$key]['attributes']->addClass('col--tablet--4');
                }
              }
              $variables['attributes']['class'][] = 'grid--2';
              break;

            case 'two-columns-66-33':
              foreach ($variables['items'] as $key => $item) {
                if ($key % 2 === 1) {
                  $variables['items'][$key]['attributes']->addClass('col--tablet--4');
                }
                else {
                  $variables['items'][$key]['attributes']->addClass('col--tablet--8');
                }
              }
              $variables['attributes']['class'][] = 'grid--2';
              break;

            case 'three-columns':
              foreach ($variables['items'] as $key => $item) {
                $variables['items'][$key]['attributes']->addClass('col--tablet--4');
              }
              $variables['attributes']['class'][] = 'grid--3';
              break;

            case 'four-columns':
              foreach ($variables['items'] as $key => $item) {
                $variables['items'][$key]['attributes']->addClass('col--tablet--3');
              }
              $variables['attributes']['class'][] = 'grid--4';
              break;
          }
        }
        break;
    }
  }
}

/**
 * Implements hook_preprocess_HOOK().
 */
function dp_zero_gravity_preprocess_field__rate_plan__purchase(array &$variables): void {
  if ($variables['element']['#view_mode'] === 'teaser') {
    $variables['items'][0]['content']['#attributes']['class'][] = 'card__link';
    $variables['items'][0]['content']['#attributes']['class'][] = 'card__link--arrow';
  }
}

/**
 * Implements hook_preprocess_HOOK().
 */
function dp_zero_gravity_preprocess_field__field_api_category(array &$variables): void {
  /** @var \Drupal\taxonomy\Entity\Term $item */
  foreach ($variables['element']['#items']->referencedEntities() as $key => $item) {
    $variables['items'][$key]['content'] = Link::fromTextAndUrl($item->getName(), Url::fromRoute('view.api_catalog.api_catalog', ['field_api_category_target_id' => $item->id()]))->toRenderable();
  }
}
