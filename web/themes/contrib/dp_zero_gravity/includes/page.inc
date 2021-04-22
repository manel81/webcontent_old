<?php

/**
 * @file
 * Theme and preprocess functions for pages.
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

use Drupal\Core\Template\Attribute;
use Drupal\node\Entity\Node;

/**
 * Implements hook_page_attachments_alter().
 */
function dp_zero_gravity_page_attachments_alter(array &$attachments): void {
  // Create CSS custom properties from overridden colors.
  $css = '';
  $color_overrides = theme_get_setting('color_overrides') ?? [];
  foreach ($color_overrides as $color_name => $value) {
    $css .= "--{$color_name}: {$value};";
  }
  if ($css === '') {
    return;
  }

  $css = "body { {$css} }";
  $attachments['#attached']['html_head'][] = [
    [
      '#tag' => 'style',
      '#value' => $css,
    ],
    'dp_zero_gravity',
  ];
}

/**
 * Implements hook_preprocess_HOOK() for page.html.twig.
 */
function dp_zero_gravity_preprocess_page(array &$variables): void {
  $variables['container'] = TRUE;
  $variables['navigation_inside'] = FALSE;
  $style = '';
  /** @var \Drupal\node\Entity\Node $node */
  $node = \Drupal::routeMatch()->getParameter('node');
  $is_node_page = $node && $node instanceof Node;
  $header_first_blocks = [];

  $variables['content_attributes'] = new Attribute(['class' => ['has-bottom-margin']]);
  $variables['site_content_attributes'] = new Attribute([
    'id' => 'site-content',
    'class' => ['site-content'],
  ]);
  $variables['header_attributes'] = new Attribute([
    'class' => ['zg-page-header'],
  ]);

  if (theme_get_setting('navigation_position')) {
    $variables['navigation_inside'] = TRUE;
  }

  // The blocks in the region are prerendered to determine if there are any
  // other blocks besides page title.
  //
  // @see https://www.drupal.org/project/drupal/issues/953034
  foreach ($variables['page']['header_first'] as $key => $block) {
    if ($key[0] !== '#' && is_array($block)) {
      if ($is_node_page && $node->bundle() === 'page_builder' && $node->hasField('field_header') && !$node->get('field_header')
        ->isEmpty() && isset($block['#base_plugin_id']) && $block['#base_plugin_id'] === 'page_title_block') {
        unset($variables['page']['header_first'][$key]);
        $variables['header_attributes']->addClass('zg-page-header--max');
      }
      $header_first_blocks[$block['#base_plugin_id'] ?? $key] = render($block);
    }
  }
  $title_only = in_array('page_title_block', array_keys($header_first_blocks), TRUE) && count($header_first_blocks) === 1;

  if ($is_node_page) {
    // @todo make this configurable.
    $paragraph_node_types = [
      'page_builder',
      'api_page_builder',
      'api_description_page',
    ];

    if (in_array($node->bundle(), $paragraph_node_types)) {
      $variables['container'] = FALSE;
      $variables['content_attributes']->removeClass('has-bottom-margin');
    }

    if (theme_get_setting('blog_post_header')) {
      // Add field_teaser_picture as header image if we are on a blog_post page.
      if ($node->bundle() === 'blog_post') {
        $entity = $node->field_teaser_picture->entity;
        if ($entity) {
          $variables['header_image_path'] = file_create_url($entity->getFileUri());
        }
      }
    }
  }

  $variables['header_attributes']->addClass($title_only ? 'zg-page-header--title-only' : 'zg-page-header--hero');

  if (isset($variables['header_image_path'])) {
    if ($title_only) {
      $variables['header_attributes']->addClass('zg-page-header--min');
    }

    $variables['header_attributes']->addClass('has-background-image');
    $variables['header_attributes']->addClass('zg-page-header--overlay');
    $style .= 'background-image: url("' . $variables['header_image_path'] . '");';
  }

  if (isset($variables['header_image_focus'])) {
    $focus = $variables['header_image_focus'];
    $style .= "background-position: {$focus['x']}% {$focus['y']}%;";
  }

  // Add header image related style.
  if ($style) {
    $variables['header_attributes']->setAttribute('style', $style);
  }

  if (theme_get_setting('shift_homepage_content') && \Drupal::service('path.matcher')->isFrontPage()) {
    $variables['#cache']['contexts'][] = 'url.path.is_front';
    $variables['#attached']['library'][] = 'dp_zero_gravity/shift_homepage_content';
  }

  // Load the boom/boom_affix library to use affix feature on elements.
  $variables['#attached']['library'][] = 'boom/boom_affix';
}

/**
 * Implements hook_preprocess_HOOK() for page_title.
 */
function dp_zero_gravity_preprocess_page_title(array &$variables): void {
  $routes = [
    'entity.user.canonical',
    'user.page',
    'entity.user.edit_form',
  ];
  $on_user_page = in_array(\Drupal::routeMatch()
    ->getRouteName(), $routes, TRUE);

  if ($on_user_page) {
    $variables['title']['#markup'] = t('Profile');
  }
}
