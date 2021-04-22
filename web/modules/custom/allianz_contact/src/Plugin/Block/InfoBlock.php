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
 * Class for Allianz Contact - info block.
 *
 * @Block(
 *   id = "allianz_contact_info_block",
 *   admin_label = @Translation("Info block"),
 *   category = @Translation("Allianz"),
 * )
 */
class InfoBlock extends BlockBase implements ContainerFactoryPluginInterface {

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
   * Creates a new ContactInfoBlock instance.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin ID for the plugin instance.
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
      'icon' => 'feather-compass',
      'icon_color' => '#ffffff',
      'icon_background_color' => '#38326c',
      'title' => 'Have a question?',
      'content' => 'Send us a message and we will go back faster than a super Hero !',
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

    $form['icon'] = [
      '#type' => 'select2',
      '#title' => $this->t('Icon'),
      '#options' => $brand_icons,
      '#default_value' => $this->configuration['icon'],
      '#required' => TRUE,
      '#select2' => [
        'width' => 'element',
      ],
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
      '#title' => $this->t('Icon background color'),
      '#color_options' => $brand_colors,
      '#default_value' => [
        'color' => $this->configuration['icon_background_color'],
      ],
      '#required' => TRUE,
    ];
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $this->configuration['title'],
      '#required' => TRUE,
    ];
    $form['content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Content'),
      '#format' => 'devportal_html',
      '#default_value' => $this->configuration['content'],
      '#required' => TRUE,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['icon'] = $form_state->getValue('icon');
    $this->configuration['icon_color'] =
      $form_state->getValue(['icon_color', 'settings', 'color']);
    $this->configuration['icon_background_color'] =
      $form_state->getValue(['icon_background_color', 'settings', 'color']);
    $this->configuration['title'] = $form_state->getValue('title');
    $this->configuration['content'] = $form_state->getValue(['content', 'value']);
  }

  /**
   * {@inheritdoc}
   */
  public function build(): array {
    return [
      '#theme' => 'info_block',
      '#icon' => $this->configuration['icon'],
      '#icon_color' => $this->configuration['icon_color'],
      '#icon_background_color' => $this->configuration['icon_background_color'],
      '#title' => $this->configuration['title'],
      '#content' => $this->configuration['content'],
      '#attached' => [
        'library' => [
          'allianz_contact/allianz_contact_info_block',
        ],
      ],
    ];
  }

}
