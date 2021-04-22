<?php

declare(strict_types = 1);

/**
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

namespace Drupal\allianz_error_pages\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\State\State;
use Drupal\Core\StringTranslation\TranslationInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Provides a setting UI for Allianz custom HTTP Error pages.
 */
class Settings extends ConfigFormBase {

  public const HTTP_ERROR_BACKGROUND_IMAGE = 'allianz_error_pages.http_error_background_image';
  public const MAINTENANCE_BACKGROUND_IMAGE = 'allianz_error_pages.maintenance_background_image';

  /**
   * The messenger service.
   *
   * @var \Drupal\Core\Messenger\Messenger
   */
  protected $messenger;

  /**
   * The state service.
   *
   * @var \Drupal\Core\State\State
   */
  protected $state;

  /**
   * Creates a new Settings instance.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The factory for configuration objects.
   * @param \Drupal\Core\StringTranslation\TranslationInterface $string_translation
   *   The translation manager.
   * @param \Drupal\Core\State\State $state
   *   State system.
   */
  public function __construct(ConfigFactoryInterface $config_factory, TranslationInterface $string_translation, State $state) {
    parent::__construct($config_factory);
    $this->stringTranslation = $string_translation;
    $this->state = $state;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container): Settings {
    return new static(
      $container->get('config.factory'),
      $container->get('string_translation'),
      $container->get('state')
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames(): array {
    return [
      'allianz_error_pages.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'allianz_error_pages_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, Request $request = NULL): array {
    $settings = $this->configFactory->get('allianz_error_pages.settings');

    $form['page_settings'] = [
      '#type' => 'vertical_tabs',
    ];

    $form['http_error_pages'] = [
      '#type' => 'details',
      '#title' => $this->t('HTTP Error pages (403/404)'),
      '#group' => 'page_settings',
    ];

    $form['http_error_pages']['403_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('403 Content'),
      '#format' => 'devportal_html',
      '#default_value' => $settings->get('403_content'),
      '#required' => TRUE,
    ];
    $form['http_error_pages']['403_show_home_button'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Show the default home button on the 403 page'),
      '#default_value' => $settings->get('403_show_home_button'),
    ];

    $form['http_error_pages']['404_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('404 Content'),
      '#format' => 'devportal_html',
      '#default_value' => $settings->get('404_content'),
      '#required' => TRUE,
    ];
    $form['http_error_pages']['404_show_home_button'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Show the default home button on the 404 page'),
      '#default_value' => $settings->get('404_show_home_button'),
    ];
    $form['http_error_pages']['http_error_background_image'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Background image'),
      '#upload_location' => 'public://uploads/error_pages/',
      '#default_value' => $this->state->get(self::HTTP_ERROR_BACKGROUND_IMAGE) ? [$this->state->get(self::HTTP_ERROR_BACKGROUND_IMAGE)] : [],
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg'],
        'file_validate_is_image' => [],
      ],
      '#theme' => 'image_widget',
      '#preview_image_style' => 'thumbnail',
    ];

    $form['maintenance_page'] = [
      '#type' => 'details',
      '#title' => $this->t('Maintenance page'),
      '#group' => 'page_settings',
    ];

    $form['maintenance_page']['maintenance_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Maintenance Content'),
      '#format' => 'devportal_html',
      '#default_value' => $settings->get('maintenance_content'),
      '#required' => TRUE,
    ];
    $form['maintenance_page']['maintenance_show_home_button'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Show the default home button on the maintenance page'),
      '#default_value' => $settings->get('maintenance_show_home_button'),
    ];
    $form['maintenance_page']['maintenance_background_image'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Background image'),
      '#upload_location' => 'public://uploads/error_pages/',
      '#default_value' => $this->state->get(self::MAINTENANCE_BACKGROUND_IMAGE) ? [$this->state->get(self::MAINTENANCE_BACKGROUND_IMAGE)] : [],
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg'],
        'file_validate_is_image' => [],
      ],
      '#theme' => 'image_widget',
      '#preview_image_style' => 'thumbnail',
    ];

    // This is a workaround for the managed_file AJAX upload's HTTP 500 error.
    $form_state->disableCache();

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    $settings = $this->configFactory->getEditable('allianz_error_pages.settings');

    $http_error_background_image_fid = $form_state->getValue('http_error_background_image');
    if (isset($http_error_background_image_fid[0])) {
      $this->state->set(self::HTTP_ERROR_BACKGROUND_IMAGE, $http_error_background_image_fid[0]);
    }

    $maintenance_background_image_fid = $form_state->getValue('maintenance_background_image');
    if (isset($maintenance_background_image_fid[0])) {
      $this->state->set(self::MAINTENANCE_BACKGROUND_IMAGE, $maintenance_background_image_fid[0]);
    }

    $settings->set('403_content', $form_state->getValue(['403_content', 'value']));
    $settings->set('403_show_home_button', $form_state->getValue('403_show_home_button'));
    $settings->set('404_content', $form_state->getValue(['404_content', 'value']));
    $settings->set('404_show_home_button', $form_state->getValue('404_show_home_button'));
    $settings->set('maintenance_content', $form_state->getValue(['maintenance_content', 'value']));
    $settings->set('maintenance_show_home_button', $form_state->getValue('maintenance_show_home_button'));
    $settings->save();

    parent::submitForm($form, $form_state);
  }

}
