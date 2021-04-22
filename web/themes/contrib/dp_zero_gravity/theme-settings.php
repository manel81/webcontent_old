<?php

/**
 * @file
 * Theme setting callbacks for DP Zero Gravity theme.
 */

declare(strict_types = 1);

use Drupal\Component\Serialization\Json;
use Drupal\Component\Utility\Color;
use Drupal\Core\Form\FormStateInterface;

define('DP_ZERO_GRAVITY_COLOR_TYPE_BRAND', 'brandColors');
define('DP_ZERO_GRAVITY_COLOR_TYPE_COMPONENTS', 'colorComponents');

/**
 * Implements hook_form_FORM_ID_alter() for system_theme_settings().
 */
function dp_zero_gravity_form_system_theme_settings_alter(array &$form, FormStateInterface &$form_state, string $form_id = NULL): void {
  // Work-around for a core bug affecting admin themes. See issue #943212.
  if (isset($form_id)) {
    return;
  }

  /** @var \Drupal\Core\Extension\ModuleHandler $module_handler */
  $module_handler = \Drupal::service('module_handler');

  if ($module_handler->moduleExists('dp_blog')) {
    $form['blog_post'] = [
      '#type' => 'details',
      '#title' => t('Blog post header image'),
      '#open' => TRUE,
    ];
    $form['blog_post']['blog_post_header'] = [
      '#type' => 'checkbox',
      '#title' => t('If you enable this option when you are on a Blog post page the teaser picture image will appear in the header.'),
      '#default_value' => theme_get_setting('blog_post_header'),
    ];
  }

  $form['navigation'] = [
    '#type' => 'details',
    '#title' => t('Navigation'),
    '#open' => TRUE,
  ];
  $form['navigation']['navigation_position'] = [
    '#type' => 'checkbox',
    '#title' => t('Navigation inside the header'),
    '#description' => t('If you opt this in, the header background image will be behind the navigation. If this is opted out, the header background image will be below the navigation.'),
    '#default_value' => theme_get_setting('navigation_position'),
  ];

  $form['extras'] = [
    '#type' => 'details',
    '#title' => t('Extra settings'),
    '#open' => TRUE,
  ];

  $form['extras']['shift_homepage_content'] = [
    '#type' => 'checkbox',
    '#title' => t('Shift homepage content into header'),
    '#description' => t('Opting this settings will shift the homepage content into the header by approximately 100px (7rem). Advised to use only when the content below the page are three cards.'),
    '#default_value' => theme_get_setting('shift_homepage_content'),
  ];
  $form['extras']['faq_accordion_quicklinks'] = [
    '#type' => 'checkbox',
    '#title' => t('Add copyable quicklinks to FAQ accordion elements'),
    '#description' => t('A link icon will appear next to FAQ accordion elements. Navigating to a link provided by this icon will open and scroll to the accordion item.'),
    '#default_value' => theme_get_setting('faq_accordion_quicklinks'),
  ];

  $form['cards'] = [
    '#type' => 'details',
    '#title' => t('Cards'),
    '#open' => TRUE,
  ];

  $form['cards']['cards_interactive'] = [
    '#type' => 'checkbox',
    '#title' => t('Make cards interactive (some behaviour when containing links)'),
    '#description' => t('Make cards interactive when they contain links. The default behaviour in the case of Zero Gravity is that the cards grow vertically.'),
    '#default_value' => theme_get_setting('cards_interactive'),
  ];

  if ($module_handler->moduleExists('swagger_ui_formatter')) {
    $form['swagger_ui'] = [
      '#type' => 'vertical_tabs',
      '#title' => 'Swagger UI settings',
    ];

    $form['highlight'] = [
      '#type' => 'details',
      '#title' => t('Code highlighting'),
      '#group' => 'swagger_ui',
    ];

    $form['highlight']['swagger_ui_highlight_enable'] = [
      '#type' => 'checkbox',
      '#title' => t('Enable code highlighting'),
      '#default_value' => theme_get_setting('swagger_ui_highlight_enable'),
      '#attributes' => [
        'data-name' => 'highlight',
      ],
    ];

    $form['highlight']['swagger_ui_highlight_langs'] = [
      '#type' => 'textfield',
      '#multiple' => TRUE,
      '#title' => t('Supported languages:'),
      '#required' => TRUE,
      '#description' => t('Comma separated list of languages (e.g. <code>javascript, shell</code>), see <a href="@url" target="_blank">@url</a>.', ['@url' => ' https://github.com/highlightjs/highlight.js/tree/master/src/languages']),
      '#default_value' => theme_get_setting('swagger_ui_highlight_langs') ?? 'javascript, shell',
      '#placeholder' => 'javascript, shell',
      '#states' => [
        'visible' => [
          ':input[data-name="highlight"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $form['highlight']['swagger_ui_highlight_download'] = [
      '#type' => 'checkbox',
      '#title' => t('Enable "Download" button for highlighted code'),
      '#default_value' => theme_get_setting('swagger_ui_highlight_download'),
      '#states' => [
        'visible' => [
          ':input[data-name="highlight"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $form['highlight']['swagger_ui_highlight_copy'] = [
      '#type' => 'checkbox',
      '#title' => t('Enable "Copy" button for highlighted code'),
      '#default_value' => theme_get_setting('swagger_ui_highlight_copy'),
      '#states' => [
        'visible' => [
          ':input[data-name="highlight"]' => ['checked' => TRUE],
        ],
      ],
    ];

    $form['info'] = [
      '#type' => 'details',
      '#title' => t('Info section'),
      '#group' => 'swagger_ui',
    ];

    $form['info']['swagger_ui_info_show_title'] = [
      '#type' => 'checkbox',
      '#title' => t('Show title and version'),
      '#default_value' => theme_get_setting('swagger_ui_info_show_title'),
    ];

    $form['info']['swagger_ui_info_show_description'] = [
      '#type' => 'checkbox',
      '#title' => t('Show description'),
      '#default_value' => theme_get_setting('swagger_ui_info_show_description'),
    ];

    $form['info']['swagger_ui_info_download'] = [
      '#type' => 'checkbox',
      '#title' => t('Alter specification URL to "Download" button'),
      '#default_value' => theme_get_setting('swagger_ui_info_download'),
    ];

    $form['info']['swagger_ui_info_postman'] = [
      '#type' => 'checkbox',
      '#title' => t('Enable "Run in Postman" button'),
      '#description' => t('Display "Run in Postman" button if the "info" object in the specification has an "x-postman-collection-id" property.'),
      '#default_value' => theme_get_setting('swagger_ui_info_postman'),
    ];

    $form['code_sample'] = [
      '#type' => 'details',
      '#title' => t('Code samples'),
      '#group' => 'swagger_ui',
    ];

    $form['code_sample']['swagger_ui_code_samples_manual'] = [
      '#type' => 'checkbox',
      '#title' => t('Enable manual code samples'),
      '#default_value' => theme_get_setting('swagger_ui_code_samples_manual'),
      '#description' => t('Show code samples section when an operation has an "x-code-samples" attribute (format: sequence of mappings with "lang" and "source" keys).'),
    ];

    $form['code_sample']['swagger_ui_code_samples_generate'] = [
      '#type' => 'checkbox',
      '#title' => t('Enable generated code samples'),
      '#default_value' => theme_get_setting('swagger_ui_code_samples_generate'),
      '#description' => t('Show code samples generated based on specification.'),
      '#attributes' => [
        'data-name' => 'code-generate',
      ],
    ];

    $targets = [
      'c_libcurl',
      'csharp_restsharp',
      'go_native',
      'java_okhttp',
      'java_unirest',
      'javascript_jquery',
      'javascript_xhr',
      'node_native',
      'node_request',
      'node_unirest',
      'objc_nsurlsession',
      'ocaml_cohttp',
      'php_curl',
      'php_http1',
      'php_http2',
      'python_python3',
      'python_requests',
      'ruby_native',
      'shell_curl',
      'shell_httpie',
      'shell_wget',
      'swift_nsurlsession',
    ];

    $form['code_sample']['swagger_ui_code_samples_generate_langs'] = [
      '#type' => 'select',
      '#multiple' => TRUE,
      '#title' => t('Generate code samples for the following target types:'),
      '#default_value' => theme_get_setting('swagger_ui_code_samples_generate_langs'),
      '#options' => array_combine($targets, $targets),
      '#states' => [
        'visible' => [
          ':input[data-name="code-generate"]' => ['checked' => TRUE],
        ],
      ],
    ];
  }

  // @todo Create a custom service and add this function to it.
  $color_groups = _dp_zero_gravity_get_colors(DP_ZERO_GRAVITY_COLOR_TYPE_COMPONENTS);
  if (empty($color_groups)) {
    return;
  }

  // @todo Create a custom service and add this function to it.
  $color_options = _dp_zero_gravity_get_colors();

  $form['color_tabs'] = [
    '#type' => 'vertical_tabs',
    '#title' => t('Theme colors'),
  ];
  $form['theme_colors'] = [
    '#type' => 'container',
    '#tree' => TRUE,
  ];

  foreach ($color_groups as $group_name => $group_info) {
    $form['theme_colors'][$group_name] = [
      '#type' => 'details',
      '#title' => $group_info['displayName'],
      '#group' => 'color_tabs',
    ];
    foreach ($group_info['colors'] as $color_name => $color_info) {
      $full_color_loaded = theme_get_setting("color_overrides.{$color_name}");
      if ($full_color_loaded) {
        $color_pattern = '/#([\da-f]{3}){1,2}|rgba\((\d{1,3}%?,\s?){3}(1|0|0?\.\d+)\)|rgb\(\d{1,3}%?(,\s?\d{1,3}%?){2}\)/';
        preg_match_all($color_pattern, $full_color_loaded, $matches);
        $colors_loaded = $matches[0];
      }
      else {
        $colors_loaded = $color_info['value'];
      }
      $form['theme_colors'][$group_name][$color_name] = [
        '#type' => 'fieldset',
        '#title' => $color_info['displayName'],
      ];
      foreach ($colors_loaded as $color_loaded) {
        // @todo Create a custom service and add this function to it.
        $form['theme_colors'][$group_name][$color_name][] = _dp_zero_gravity_get_color_box_render_array($color_loaded, '', $color_options, TRUE);
      }
    }
  }

  $form['#submit'][] = '_dp_zero_gravity_theme_settings_submit';
}

/**
 * Form submission handler for Zero Gravity theme's settings page.
 *
 * @param array $form
 *   The complete form structure.
 * @param \Drupal\Core\Form\FormStateInterface $form_state
 *   The current state of the form.
 */
function _dp_zero_gravity_theme_settings_submit(array $form, FormStateInterface $form_state): void {
  $config_key = $form_state->getValue('config_key');
  $config = \Drupal::service('config.factory')->getEditable($config_key);
  $color_overrides = [];

  $form_values = $form_state->getValue('theme_colors');
  foreach ($form_values as $group_name => $group_colors) {
    foreach ($group_colors as $color_name => $color_values) {
      $values = [];
      // @todo Create a custom service and add this function to it.
      $original_colors = _dp_zero_gravity_get_colors(DP_ZERO_GRAVITY_COLOR_TYPE_COMPONENTS);
      foreach ($color_values as $key => $color_settings) {
        $values[$key] = $color_values[$key]['settings']['color'];
        if (!isset($color_values[$key]['settings']['opacity'])) {
          continue;
        }

        $opacity = $color_values[$key]['settings']['opacity'];
        $values[$key] = str_replace('rgb', 'rgba', $values[$key]);
        $values[$key] = str_replace(')', ",{$opacity})", $values[$key]);
      }
      $merged_value = implode(',', $values);
      $merged_value = str_replace(' ', '', $merged_value);
      $original_value = implode(',', $original_colors[$group_name]['colors'][$color_name]['value']);
      $original_value = str_replace(' ', '', $original_value);
      if ($merged_value === $original_value) {
        continue;
      }

      $color_overrides[$color_name] = $merged_value;
    }
  }

  $form_state->unsetValue('theme_colors');
  $config->set('color_overrides', $color_overrides)->save();
}

/**
 * Create render array for color box form element.
 *
 * @param string $color
 *   The color of the box.
 *   Supported formats: hex, rgb and rgba.
 * @param string $title
 *   The title of the form element.
 * @param array $color_options
 *   The allowed colors for the form element.
 * @param bool $required
 *   (optional) If TRUE, the form element will be required.
 *
 * @return array|null
 *   The color box render array.
 *
 * @todo Create a custom service and add this function to it.
 */
function _dp_zero_gravity_get_color_box_render_array(string $color, string $title, array $color_options, bool $required = FALSE): ?array {
  $rgba_pattern = '/rgba\((\d{1,3}%?,\s?){3}(1|0|0?\.\d+)\)/';
  $default_color = $color;
  $default_opacity = NULL;

  if (preg_match_all($rgba_pattern, $color, $matches)) {
    $color_components = preg_split('~[^\d.]+~', $color, -1, PREG_SPLIT_NO_EMPTY);
    $default_color = "rgb({$color_components[0]},{$color_components[1]},{$color_components[2]})";
    $default_opacity = $color_components[3];
  }

  $element = [
    '#type' => 'color_field_element_box',
    '#title' => $title,
    '#color_options' => $color_options,
    '#required' => $required,
    '#default_value' => [
      'color' => $default_color,
    ],
  ];
  if ($default_opacity !== NULL) {
    $element['#default_value']['opacity'] = $default_opacity;
  }

  return $element;
}

/**
 * Returns the colors of the given type by reading the relevant JSON source.
 *
 * @param string $type
 *   The type of the color list which is used in the JSON file name. Only
 *   hexa, rgb or rgba color formats are supported.
 *   Currently supported types are the following constants:
 *   - DP_ZERO_GRAVITY_COLOR_TYPE_BRAND
 *   - DP_ZERO_GRAVITY_COLOR_TYPE_COMPONENTS.
 *
 * @return array
 *   List of color groups loaded from the JSON file or empty array if file
 *   doesn't exist. Color values are either in rgb or rgba format.
 *   Format of an array element:
 *   group_name
 *     color_name
 *       display_name
 *       colors_bundles
 *         color_bundle
 *           display_name
 *           color_values
 *             color_value
 *             color_value
 *             ...
 *
 * @todo Create a custom service and add this function to it.
 */
function _dp_zero_gravity_get_colors(string $type = DP_ZERO_GRAVITY_COLOR_TYPE_BRAND): array {
  $theme_handler = \Drupal::service('theme_handler');
  $default_theme = $theme_handler->getDefault();
  $theme_path = $theme_handler->getTheme($default_theme)->getPath();
  $file = "{$theme_path}/{$type}-lock.json";
  if (!file_exists($file)) {
    return [];
  }
  $colors = file_get_contents($file);
  if (!$colors) {
    return [];
  }
  $file_array = Json::decode($colors);

  if ($type === DP_ZERO_GRAVITY_COLOR_TYPE_BRAND) {
    foreach ($file_array as &$color) {
      $color = str_replace(' ', '', $color);
    }
  }
  elseif ($type === DP_ZERO_GRAVITY_COLOR_TYPE_COMPONENTS) {
    foreach ($file_array as &$group) {
      foreach ($group['colors'] as $color_name => $color_info) {
        $value = $color_info['value'];
        $color_pattern = '/#([\da-f]{3}){1,2}|rgba\((\d{1,3}%?,\s?){3}(1|0|0?\.\d+)\)|rgb\(\d{1,3}%?(,\s?\d{1,3}%?){2}\)/';
        preg_match_all($color_pattern, $value, $matches);
        $colors_array = [];

        foreach ($matches[0] as $match) {
          $match = str_replace(' ', '', $match);
          if (Color::validateHex($match)) {
            $match = Color::hexToRgb($match);
            $match = "rgb({$match['red']},{$match['green']},{$match['blue']})";
          }
          $colors_array[] = $match;
        }

        $group['colors'][$color_name]['value'] = $colors_array;
      }
    }
  }

  return $file_array;
}
