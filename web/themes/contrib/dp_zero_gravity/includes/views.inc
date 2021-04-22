<?php

/**
 * @file
 * Theme and preprocess functions for views.
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

/**
 * Implements hook_preprocess_HOOK().
 */
function dp_zero_gravity_preprocess_views_view(array &$variables): void {
  if ($variables['view']->id() === 'devportal_faq') {
    if (!isset($variables['css_class'])) {
      $variables['css_class'] = 'has-shadow';
    }
    else {
      $css_classes = explode(' ', $variables['css_class']);
      if (!in_array('has-shadow', $css_classes)) {
        $css_classes[] = 'has-shadow';
        $variables['css_class'] = implode(' ', $css_classes);
      }
    }
    if (theme_get_setting('faq_accordion_quicklinks')) {
      $variables['attributes']['class'][] = 'accordion-quicklinks-on';
      $variables['#attached']['library'][] = 'dp_zero_gravity/views_accordion_quicklink';
      $variables['#attached']['drupalSettings']['quicklinkConfig'] = [
        'iconClass' => 'feather-copy',
      ];
    }
  }

  // Rename default filter option (- Any -) to 'All'.
  if (!empty($variables['exposed'])) {
    foreach ($variables['exposed']['#info'] as $exposed_filter) {
      $exposed_filter_id = $exposed_filter['value'];
      if ($variables['exposed'][$exposed_filter_id]['#type'] === 'select') {
        $variables['exposed'][$exposed_filter_id]['#options']['All'] = t('All');
      }
    }
  }
}
