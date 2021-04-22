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

namespace Drupal\allianz_contact\Plugin\Block;

use Drupal\Component\Utility\UrlHelper;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Messenger\Messenger;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\StringTranslation\TranslationInterface;
use Drupal\boom_enhancements\BoomEnhancementsManager;
use Drupal\boom_enhancements\Exceptions\InvalidArgumentException;
use Drupal\guides\Exception\FileNotFoundException;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class for Allianz Contact - contact block.
 *
 * @Block(
 *   id = "allianz_contact_contact_block",
 *   admin_label = @Translation("Contact block"),
 *   category = @Translation("Allianz")
 * )
 */
class ContactBlock extends BlockBase implements ContainerFactoryPluginInterface {
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
   * Creates a new ContactBlock instance.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\boom_enhancements\BoomEnhancementsManager $boom_enhancements_manager
   *   The BoomEnhancementsManager service.
   * @param \Drupal\Core\Messenger\Messenger $messenger
   *   The Messenger service.
   * @param \Drupal\Core\StringTranslation\TranslationInterface $string_translation
   *   The translation manager.
   * @param \Psr\Log\LoggerInterface $logger
   *   The logger service.
   */
  public function __construct(array $configuration, string $plugin_id, $plugin_definition, BoomEnhancementsManager $boom_enhancements_manager, Messenger $messenger, TranslationInterface $string_translation, LoggerInterface $logger) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->boomEnhancementsManager = $boom_enhancements_manager;
    $this->messenger = $messenger;
    $this->stringTranslation = $string_translation;
    $this->logger = $logger;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('boom_enhancements.manager'),
      $container->get('messenger'),
      $container->get('string_translation'),
      $container->get('logger.channel.allianz_contact_info_block')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'title' => 'Open API Team',
      'address_icon' => 'feather-map-pin',
      'address_text' => '82 Rue Henry Farman 92130 Issy-les-moulineaux',
      'phone_icon' => 'feather-phone',
      'phone_text' => '+33 1 00 00 00 00',
      'email_icon' => 'feather-mail',
      'email_text' => 'allianz.openapi.support@allianz.com',
      'facebook' => '',
      'twitter' => '',
      'linked_in' => '',
      'github' => '',
      'icon_color' => '#ffffff',
      'icon_background_color' => '#38326c',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {

    $brand_colors = [];
    try {
      $brand_colors = $this->boomEnhancementsManager->getBrandColors();

      $brand_colors = array_values($brand_colors);
    }
    catch (InvalidArgumentException $e) {
      $this->logger->warning('The colors source directory is invalid. Please review the Devportal Theme Enhancements Settings', [
        'link' => $this->boomEnhancementsManager->getSettingsLink()->toString(),
      ]);
      $this->messenger->addError($this->t('The colors source directory is invalid. Please contact the site administrator.'));
    }

    $brand_icons = [];
    try {
      $icons = $this->boomEnhancementsManager->getBrandIcons();

      foreach ($icons['icons'] as $icon) {
        $icon_name = $icon['properties']['name'];
        $icon_class = $icons['preferences']['fontPref']['prefix'] . $icon_name;
        $brand_icons[$icon_class] = $icon_name;
      }
    }
    catch (InvalidArgumentException $e) {
      $this->logger->error('The icons source directory is invalid. Please review the Devportal Theme Enhancements Settings.', [
        'link' => $this->boomEnhancementsManager->getSettingsLink()->toString(),
      ]);
      $this->messenger->addError($this->t('The icons source directory is invalid. Please contact the site administrator.'));
    }
    catch (FileNotFoundException $e) {
      $this->logger->error('File: %file_path not found. Please review the Devportal Theme Enhancements Settings.', [
        'link' => $this->boomEnhancementsManager->getSettingsLink()->toString(),
        '%file_path' => $e->getMessage(),
      ]);
      $this->messenger->addError($this->t('The icons source directory is invalid. Please contact the site administrator.'));
    }

    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $this->configuration['title'],
      '#required' => TRUE,
    ];

    $form['address_icon'] = [
      '#type' => 'select2',
      '#title' => $this->t('Address icon'),
      '#options' => $brand_icons,
      '#default_value' => $this->configuration['address_icon'],
      '#required' => TRUE,
      '#select2' => [
        'width' => 'element',
      ],
    ];
    $form['address_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Address'),
      '#default_value' => $this->configuration['address_text'],
      '#required' => TRUE,
    ];

    $form['phone_icon'] = [
      '#type' => 'select2',
      '#title' => $this->t('Phone icon'),
      '#options' => $brand_icons,
      '#default_value' => $this->configuration['phone_icon'],
      '#required' => TRUE,
      '#select2' => [
        'width' => 'element',
      ],
    ];
    $form['phone_text'] = [
      '#type' => 'tel',
      '#title' => $this->t('Phone'),
      '#default_value' => $this->configuration['phone_text'],
      '#required' => TRUE,
    ];

    $form['email_icon'] = [
      '#type' => 'select2',
      '#title' => $this->t('Email icon'),
      '#options' => $brand_icons,
      '#default_value' => $this->configuration['email_icon'],
      '#required' => TRUE,
      '#select2' => [
        'width' => 'element',
      ],
    ];
    $form['email_text'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#default_value' => $this->configuration['email_text'],
      '#required' => TRUE,
    ];

    $form['facebook'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Facebook'),
      '#default_value' => $this->configuration['facebook'],
    ];
    $form['twitter'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Twitter'),
      '#default_value' => $this->configuration['twitter'],
    ];
    $form['linked_in'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Linked In'),
      '#default_value' => $this->configuration['linked_in'],
    ];
    $form['github'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Github'),
      '#default_value' => $this->configuration['github'],
    ];

    $form['icon_color'] = [
      '#type' => 'color_field_element_box',
      '#title' => $this->t('Icon color'),
      '#color_options' => $brand_colors,
      '#default_value' => [
        'color' => $this->configuration['icon_color'],
      ],
      '#required' => TRUE,
    ];
    $form['icon_background_color'] = [
      '#type' => 'color_field_element_box',
      '#title' => $this->t('Icons background color'),
      '#color_options' => $brand_colors,
      '#default_value' => [
        'color' => $this->configuration['icon_background_color'],
      ],
      '#required' => TRUE,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockValidate($form, FormStateInterface $form_state) {
    parent::blockValidate($form, $form_state);
    $values = $form_state->getValues();

    if ($values['facebook'] !== '' && !UrlHelper::isValid($values['facebook'], TRUE)) {
      $form_state->setErrorByName('facebook', $this->t('The Facebook URL must be a valid!'));
    }

    if ($values['twitter'] !== '' && !UrlHelper::isValid($values['twitter'], TRUE)) {
      $form_state->setErrorByName('twitter', $this->t('The Twitter URL must be a valid!'));
    }

    if ($values['linked_in'] !== '' && !UrlHelper::isValid($values['linked_in'], TRUE)) {
      $form_state->setErrorByName('linked_in', $this->t('The Linked In URL must be a valid!'));
    }

    if ($values['github'] !== '' && !UrlHelper::isValid($values['github'], TRUE)) {
      $form_state->setErrorByName('github', $this->t('The Github URL must be a valid!'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['title'] = $form_state->getValue('title');
    $this->configuration['address_icon'] = $form_state->getValue('address_icon');
    $this->configuration['address_text'] = $form_state->getValue('address_text');
    $this->configuration['phone_icon'] = $form_state->getValue('phone_icon');
    $this->configuration['phone_text'] = $form_state->getValue('phone_text');
    $this->configuration['email_icon'] = $form_state->getValue('email_icon');
    $this->configuration['email_text'] = $form_state->getValue('email_text');
    $this->configuration['facebook'] = $form_state->getValue('facebook');
    $this->configuration['twitter'] = $form_state->getValue('twitter');
    $this->configuration['linked_in'] = $form_state->getValue('linked_in');
    $this->configuration['github'] = $form_state->getValue('github');
    $this->configuration['icon_color'] =
      $form_state->getValue(['icon_color', 'settings', 'color']);
    $this->configuration['icon_background_color'] =
      $form_state->getValue(['icon_background_color', 'settings', 'color']);
  }

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    return [
      '#theme' => 'contact_block',
      '#title' => $this->configuration['title'],
      '#address_icon' => $this->configuration['address_icon'],
      '#address_text' => $this->configuration['address_text'],
      '#phone_icon' => $this->configuration['phone_icon'],
      '#phone_text' => $this->configuration['phone_text'],
      '#email_icon' => $this->configuration['email_icon'],
      '#email_text' => $this->configuration['email_text'],
      '#facebook' => $this->configuration['facebook'],
      '#twitter' => $this->configuration['twitter'],
      '#linked_in' => $this->configuration['linked_in'],
      '#github' => $this->configuration['github'],
      '#icon_color' => $this->configuration['icon_color'],
      '#icon_background_color' => $this->configuration['icon_background_color'],
      '#attached' => [
        'library' => [
          'allianz_contact/allianz_contact_contact_block',
        ],
      ],
    ];
  }

}
