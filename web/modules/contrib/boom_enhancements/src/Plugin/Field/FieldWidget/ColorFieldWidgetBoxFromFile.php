<?php

declare(strict_types = 1);

namespace Drupal\boom_enhancements\Plugin\Field\FieldWidget;

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

use Drupal\Component\Utility\Color;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Messenger\Messenger;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\StringTranslation\TranslationInterface;
use Drupal\boom_enhancements\BoomEnhancementsManager;
use Drupal\boom_enhancements\Exceptions\InvalidArgumentException;
use Drupal\boom_enhancements\Exceptions\InvalidJsonException;
use Drupal\color_field\Plugin\Field\FieldWidget\ColorFieldWidgetBase;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

/**
 * Plugin implementation of the color_field box widget.
 *
 * @FieldWidget(
 *   id = "color_field_widget_box_from_file",
 *   label = @Translation("Color boxes from file"),
 *   field_types = {
 *     "color_field_type"
 *   }
 * )
 */
final class ColorFieldWidgetBoxFromFile extends ColorFieldWidgetBase implements ContainerFactoryPluginInterface {

  /**
   * The BoomEnhancementsManager service.
   *
   * @var \Drupal\boom_enhancements\BoomEnhancementsManager
   */
  private $boomEnhancementsManager;

  /**
   * The messenger service.
   *
   * @var \Drupal\Core\Messenger\Messenger
   */
  protected $messenger;

  /**
   * The logger service.
   *
   * @var \Psr\Log\LoggerInterface
   */
  protected $logger;

  /**
   * A translatable markup.
   *
   * @var \Drupal\Core\StringTranslation\TranslatableMarkup
   */
  private $contactAdminTranslatable;

  /**
   * Creates a new ColorFieldWidgetBoxFromFile instance.
   *
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Field\FieldDefinitionInterface $field_definition
   *   The definition of the field to which the widget is associated.
   * @param array $settings
   *   The widget settings.
   * @param array $third_party_settings
   *   Any third party settings.
   * @param \Drupal\boom_enhancements\BoomEnhancementsManager $boom_enhancements_manager
   *   The BoomEnhancementsManager service.
   * @param \Drupal\Core\Messenger\Messenger $messenger
   *   The Messenger service.
   * @param \Drupal\Core\StringTranslation\TranslationInterface $string_translation
   *   The translation manager.
   * @param \Psr\Log\LoggerInterface $logger
   *   The logger service.
   */
  public function __construct(string $plugin_id, $plugin_definition, FieldDefinitionInterface $field_definition, array $settings, array $third_party_settings, BoomEnhancementsManager $boom_enhancements_manager, Messenger $messenger, TranslationInterface $string_translation, LoggerInterface $logger) {
    parent::__construct($plugin_id, $plugin_definition, $field_definition, $settings, $third_party_settings);
    $this->boomEnhancementsManager = $boom_enhancements_manager;
    $this->messenger = $messenger;
    $this->stringTranslation = $string_translation;
    $this->logger = $logger;
    $this->contactAdminTranslatable = $this->t('Please contact the site administrator.');
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $plugin_id,
      $plugin_definition,
      $configuration['field_definition'],
      $configuration['settings'],
      $configuration['third_party_settings'],
      $container->get('boom_enhancements.manager'),
      $container->get('messenger'),
      $container->get('string_translation'),
      $container->get('logger.channel.boom_enhancements')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function settingsSummary(): array {
    $summary = [];

    // Try to get the color definitions but return with an empty array if an
    // exception is caught.
    try {
      $color_definition = $this->boomEnhancementsManager->getBrandColors();
    }
    catch (InvalidArgumentException $e) {
      $this->logger->error('The colors source directory is invalid. Please review the Devportal Theme Enhancements Settings.', [
        'link' => $this->boomEnhancementsManager->getSettingsLink()->toString(),
      ]);
      $this->messenger->addError($this->t('The colors source directory is invalid.') . ' ' . $this->contactAdminTranslatable);
      return $summary;
    }
    catch (FileNotFoundException $e) {
      $this->logger->error('File: %file_path not found. Please review the Devportal Theme Enhancements Settings.', [
        'link' => $this->boomEnhancementsManager->getSettingsLink()->toString(),
        '%file_path' => $e->getMessage(),
      ]);
      $this->messenger->addError($this->t('Brand colors JSON file not found.') . ' ' . $this->contactAdminTranslatable);
      return $summary;
    }
    catch (InvalidJsonException $e) {
      $this->logger->error('An error occurred when parsing the JSON file. Please review the Devportal Theme Enhancements Settings.', [
        'link' => $this->boomEnhancementsManager->getSettingsLink()->toString(),
      ]);
      $this->messenger->addError($this->t('An error occurred when parsing the JSON file.') . ' ' . $this->contactAdminTranslatable);
      return $summary;
    }

    if (empty($color_definition)) {
      return $summary;
    }

    $summary[] = $this->t('Colors found in source:');

    foreach ($color_definition as $color) {
      $summary[] = $color;
    }

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state): array {
    $element = parent::formElement($items, $delta, $element, $form, $form_state);
    $element['#attached']['library'][] = 'color_field/color-field-widget-box';
    $element['#attached']['drupalSettings']['color_field']['color_field_widget_box']['settings'] = [
      $element['#uid'] => [
        'required' => $this->fieldDefinition->isRequired(),
      ],
    ];

    // As form_state errors could only be set in a validation callback
    // messenger service is used to remind users if the widget doesn't work as
    // it should.
    try {
      $color_definition = $this->boomEnhancementsManager->getBrandColors();
    }
    catch (InvalidArgumentException $e) {
      $this->logger->error('The colors source directory is invalid. Please review the Devportal Theme Enhancements Settings.', [
        'link' => $this->boomEnhancementsManager->getSettingsLink()->toString(),
      ]);
      $this->messenger->addError($this->t('The colors source directory is invalid.') . ' ' . $this->contactAdminTranslatable);
    }
    catch (FileNotFoundException $e) {
      $this->logger->error('File: %file_path not found. Please review the Devportal Theme Enhancements Settings.', [
        'link' => $this->boomEnhancementsManager->getSettingsLink()->toString(),
        '%file_path' => $e->getMessage(),
      ]);
      $this->messenger->addError($this->t('Brand colors JSON file not found.') . ' ' . $this->contactAdminTranslatable);
    }
    catch (InvalidJsonException $e) {
      $this->logger->error('An error occurred when parsing the JSON file. Please review the Devportal Theme Enhancements Settings', [
        'link' => $this->boomEnhancementsManager->getSettingsLink()->toString(),
      ]);
      $this->messenger->addError($this->t('An error occurred when parsing the JSON file.') . ' ' . $this->contactAdminTranslatable);
    }

    if (!empty($color_definition)) {
      foreach ($color_definition as $color) {
        $color = Color::validateHex($color) ? $color : Color::rgbToHex($color);

        switch ($items->first()->getDataDefinition()->getSettings()['format']) {
          case '#HEXHEX':
          case 'HEXHEX':
            $color = strtoupper($color);
            break;

          case '#hexhex':
          case 'hexhex':
            $color = strtolower($color);
            break;
        }

        $element['#attached']['drupalSettings']['color_field']['color_field_widget_box']['settings'][$element['#uid']]['palette'][] = $color;
      }
    }

    $element['color']['#suffix'] = "<div class='color-field-widget-box-form' id='{$element['#uid']}'></div>";

    return $element;
  }

}
