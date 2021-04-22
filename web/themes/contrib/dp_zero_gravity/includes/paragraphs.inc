<?php

/**
 * @file
 * Theme and preprocess functions for paragraphs.
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
use Drupal\Core\Link;

/**
 * Implements hook_preprocess_HOOK() for paragraph.html.twig.
 */
function dp_zero_gravity_preprocess_paragraph(array &$variables): void {
  /** @var \Drupal\paragraphs\Entity\Paragraph $paragraph */
  $paragraph = $variables['elements']['#paragraph'];
  $bundle = $paragraph->bundle();
  switch ($bundle) {
    case 'grid':
      $grid_element_bundles = [];
      foreach ($paragraph->get('field_grid_elements')->referencedEntities() as $grid_element) {
        $grid_element_bundles[] = $grid_element->getType();
      }
      // - if there is no card in the grid then the grid should have the shadow
      // - if the grid has no background color/transparent then the grid
      //   shouldn't have shadow
      $has_card = in_array('card', $grid_element_bundles) || in_array('benefit', $grid_element_bundles);
      $has_background = $paragraph->hasField('field_background_color') && !$paragraph->get('field_background_color')->isEmpty();
      if (!$has_card && $has_background) {
        $variables['attributes']['class'][] = 'has-shadow';
      }
      break;

    case 'benefit':
      $variables['attributes']['class'][] = 'card';
      $variables['attributes']['class'][] = 'card--summary';
      break;

    case 'card':
      $variables['attributes']['class'][] = 'card';
      $variables['attributes']['class'][] = 'has-shadow';
      $field = $paragraph->get('field_image_as_background')->first();
      if ($field) {
        $image_as_bg = (bool) $field->value;
        if ($image_as_bg) {
          $variables['attributes']['class'][] = 'card--quicklink';
          /** @var \Drupal\link\Plugin\Field\FieldType\LinkItem $target */
          $target = $paragraph->get('field_target')->first();
          if ($target) {
            /** @var \Drupal\Core\Url $url */
            $url = $target->getUrl();
            $text = new FormattableMarkup('<span class="feather-chevron-right"></span>', []);
            $variables['content']['field_target'][0] = Link::fromTextAndUrl($text, $url)
              ->toRenderable();
          }
          break;
        }
      }
      $variables['attributes']['class'][] = 'card--summary';
      break;
  }
}
