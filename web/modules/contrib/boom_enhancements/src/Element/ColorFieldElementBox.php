<?php

declare(strict_types = 1);

namespace Drupal\boom_enhancements\Element;

/**
 * Copyright (C) 2019 PRONOVIX GROUP BVBA.
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

use Drupal\Component\Utility\Html;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element\FormElement;

/**
 * Provide a color box form element.
 *
 * Usage example:
 * @code
 * $form['color'] = [
 *   '#type' => 'color_field_element_box',
 *   '#title' => t('Color'),
 *   '#color_options' => [rgb(255,255,255), rgb(0,0,0)],
 *   '#required' => TRUE,
 *   '#default_value' => [
 *     'color' => rgb(255,255,255),
 *     'opacity' => 0.5,
 *   ],
 * ];
 * @endcode
 *
 * @FormElement("color_field_element_box")
 */
class ColorFieldElementBox extends FormElement {

  /**
   * {@inheritdoc}
   */
  public function getInfo(): array {
    $class = static::class;
    return [
      '#input' => TRUE,
      '#process' => [
        [$class, 'processColorFieldElementBox'],
      ],
    ];
  }

  /**
   * Create form element for color boxes provided by color_field module.
   *
   * @param array $element
   *   The form element to process.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   * @param array $form
   *   The complete form structure.
   *
   * @return array
   *   The form element.
   */
  public static function processColorFieldElementBox(array &$element, FormStateInterface $form_state, array &$form): array {
    $element['#uid'] = Html::getUniqueId($element['#name']);

    // Create fieldset of color and opacity.
    $element['settings'] = [
      '#type' => 'fieldset',
      '#title' => $element['#title'],
    ];
    $element['settings']['color'] = [
      '#type' => 'textfield',
      '#required' => $element['#required'],
      '#default_value' => $element['#default_value']['color'],
      '#suffix' => "<div class='color-field-widget-box-form' id='" . $element['#uid'] . "'></div>",
    ];
    if (isset($element['#default_value']['opacity'])) {
      $element['settings']['opacity'] = [
        '#title' => t('Opacity'),
        '#type' => 'number',
        '#min' => 0,
        '#max' => 1,
        '#step' => 0.01,
        '#required' => $element['#required'],
        '#default_value' => $element['#default_value']['opacity'],
        '#placeholder' => 1.0,
      ];
    }

    // Set Drupal settings.
    $settings = [
      $element['#uid'] => [
        'required' => $element['#required'],
      ],
    ];

    // Add allowed colors for color boxes.
    foreach ($element['#color_options'] as $color) {
      $settings[$element['#uid']]['palette'][] = $color;
    }

    // Attach color_field module's library.
    $element['#attached']['library'][] = 'color_field/color-field-widget-box';
    $element['#attached']['drupalSettings']['color_field']['color_field_widget_box']['settings'] = $settings;

    return $element;
  }

}
