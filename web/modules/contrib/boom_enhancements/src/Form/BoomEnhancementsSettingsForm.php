<?php

declare(strict_types = 1);

namespace Drupal\boom_enhancements\Form;

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

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\TranslationInterface;
use Drupal\boom_enhancements\BoomEnhancementsJsonManager;
use Drupal\boom_enhancements\BoomEnhancementsManager;
use Drupal\boom_enhancements\Exceptions\InvalidJsonException;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

/**
 * BoomEnhancements settings form.
 */
final class BoomEnhancementsSettingsForm extends ConfigFormBase {

  /**
   * The BoomEnhancementsJsonManager service.
   *
   * @var \Drupal\boom_enhancements\BoomEnhancementsJsonManager
   */
  private $boomEnhancementsJsonManager;

  /**
   * The node type storage.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  private $nodeTypeStorage;

  /**
   * BoomEnhancementsSettingsForm constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The factory for configuration objects.
   * @param \Drupal\boom_enhancements\BoomEnhancementsJsonManager $boom_enhancements_json_manager
   *   The BoomEnhancementsJson manager.
   * @param \Drupal\Core\Entity\EntityStorageInterface $node_type_storage
   *   The node type storage.
   * @param \Drupal\Core\StringTranslation\TranslationInterface $string_translation
   *   The translation manager.
   */
  public function __construct(ConfigFactoryInterface $config_factory, BoomEnhancementsJsonManager $boom_enhancements_json_manager, EntityStorageInterface $node_type_storage, TranslationInterface $string_translation) {
    parent::__construct($config_factory);
    $this->boomEnhancementsJsonManager = $boom_enhancements_json_manager;
    $this->nodeTypeStorage = $node_type_storage;
    $this->stringTranslation = $string_translation;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('boom_enhancements.json_manager'),
      $container->get('entity_type.manager')->getStorage('node_type'),
      $container->get('string_translation')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'boom_enhancements_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames(): array {
    return [
      'boom_enhancements.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $config = $this->config('boom_enhancements.settings');
    $options = [];

    $node_types = $this->nodeTypeStorage->loadMultiple();
    foreach ($node_types as $node_type) {
      $options[$node_type->id()] = $node_type->label();
    }

    $form['node_types'] = [
      '#type' => 'checkboxes',
      '#options' => $options,
      '#title' => $this->t('Page Title Exclude'),
      '#description' => $this->t("Opt in which content types shouldn't have a page title block. (E.g. because the page title is coming from a different source)"),
      '#default_value' => $config->get('node_types') ?? [],
    ];

    $form['colors_source'] = [
      '#type' => 'path',
      '#title' => $this->t('Color source path'),
      '#description' => $this->t("Specify the path for the folder where brandColors-lock.json can be found. Defaults to the default theme's folder when left empty."),
      '#default_value' => $config->get('colors_source') ?? '',
      '#element_validate' => ['::validateColorPath'],
    ];

    $form['icons_source'] = [
      '#type' => 'path',
      '#title' => $this->t('Icon source path'),
      '#description' => $this->t('Specify the path for the folder where selection.json and style.css can be found. Defaults to the feather icon pack in the Boom theme when left empty.'),
      '#default_value' => $config->get('icons_source') ?? '',
      '#element_validate' => ['::validateIconPath'],
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    $this->configFactory->getEditable('boom_enhancements.settings')
      ->set('colors_source', $form_state->getValue('colors_source'))
      ->set('icons_source', $form_state->getValue('icons_source'))
      ->set('node_types', array_filter($form_state->getValue('node_types')))
      ->save();

    parent::submitForm($form, $form_state);
  }

  /**
   * Validates colors_source form element.
   *
   * @param array $element
   *   The form element to process.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   * @param array $complete_form
   *   The complete form structure.
   */
  public function validateColorPath(array &$element, FormStateInterface $form_state, array &$complete_form): void {
    $path = $element['#value'];

    // Do nothing if the field is empty.
    if (empty($path)) {
      return;
    }

    // Validate the JSON file.
    try {
      $this->boomEnhancementsJsonManager->decode($path, BoomEnhancementsManager::BRAND_COLORS_JSON);
    }
    catch (FileNotFoundException $e) {
      $form_state->setError($element, $this->t('File: %file_path not found.', [
        '%file_path' => $e->getMessage(),
      ]));
    }
    catch (InvalidJsonException $e) {
      $form_state->setError($element, $this->t('An error occurred when parsing the JSON file.'));
    }
  }

  /**
   * Validates icons_source form element.
   *
   * @param array $element
   *   The form element to process.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   * @param array $complete_form
   *   The complete form structure.
   */
  public function validateIconPath(array &$element, FormStateInterface $form_state, array &$complete_form): void {
    $path = $element['#value'];

    // Do nothing if the field is empty.
    if (empty($path)) {
      return;
    }

    $css_file_path = $path . DIRECTORY_SEPARATOR . BoomEnhancementsManager::BRAND_ICONS_CSS;

    // Check if there's a CSS file at the given path.
    if (!file_exists($css_file_path)) {
      $form_state->setError($element, $this->t("CSS file: '%path' not found.", [
        '%path' => $css_file_path,
      ]));
      return;
    }

    // Validate the JSON file.
    try {
      $this->boomEnhancementsJsonManager->decode($path, BoomEnhancementsManager::BRAND_ICONS_JSON);
    }
    catch (FileNotFoundException $e) {
      $form_state->setError($element, $this->t('File: %file_path not found.', [
        '%file_path' => $e->getMessage(),
      ]));
    }
    catch (InvalidJsonException $e) {
      $form_state->setError($element, $this->t('An error occurred when parsing the JSON file.'));
    }
  }

}
