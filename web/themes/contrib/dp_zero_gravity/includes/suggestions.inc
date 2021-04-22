<?php

/**
 * @file
 * Theme suggestions.
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
 * Implements hook_theme_suggestions_HOOK_alter() for input templates.
 */
function dp_zero_gravity_theme_suggestions_input_alter(array &$suggestions, array $variables): void {
  if (isset($variables['element']['#parent_form_id'])) {
    $suggestions[] = 'input__' . $variables['element']['#parent_form_id'];

    if (isset($variables['element']['#name'])) {
      $suggestions[] = 'input__' . $variables['element']['#parent_form_id'] . '__' . $variables['element']['#name'];
    }
  }
}

/**
 * Implements hook_theme_suggestions_HOOK() for field.
 */
function dp_zero_gravity_theme_suggestions_field_alter(array &$suggestions, array $variables): void {
  if ($variables['element']['#entity_type'] === 'rate_plan' && $variables['element']['#view_mode'] === 'full') {
    $suggestions[] = 'field__rate_plan__full';
  }
}

/**
 * Implements hook_theme_suggestions_HOOK_alter() for forms.
 *
 * There's a core issue https://www.drupal.org/project/drupal/issues/2486267
 * which causes the following problem:
 * If a block returns a render array and the array has direct #attributes
 * they will be "stolen" from the original $content and merged into the
 * top-level element (the block itself). You cannot directly add
 * a new class to the form element using a form_alter if it is in a block.
 * You need to give theme suggestions for forms, to be able to add
 * forms a specific class.
 */
function dp_zero_gravity_theme_suggestions_form_alter(array &$suggestions, array $variables): void {
  $suggestions[] = "{$variables['theme_hook_original']}__{$variables['element']['#form_id']}";
}
