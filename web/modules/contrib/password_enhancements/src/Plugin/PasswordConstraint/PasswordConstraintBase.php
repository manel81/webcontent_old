<?php

declare(strict_types = 1);

namespace Drupal\password_enhancements\Plugin\PasswordConstraint;

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

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Plugin\PluginBase;
use Drupal\Core\StringTranslation\TranslationInterface;
use Drupal\password_enhancements\PasswordConstraintInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a base class for password constraints.
 *
 * @see \Drupal\password_enhancements\Annotation\PasswordConstraint
 * @see \Drupal\password_enhancements\PasswordConstraintInterface
 * @see \Drupal\password_enhancements\PasswordConstraintPluginManager
 * @see plugin_api
 */
abstract class PasswordConstraintBase extends PluginBase implements PasswordConstraintInterface, ContainerFactoryPluginInterface {

  /**
   * The password constraint ID.
   *
   * @var string
   */
  protected $uuid;

  /**
   * PasswordConstraintBase constructor.
   *
   * @param array $configuration
   *   The configuration array.
   * @param string $plugin_id
   *   The plugin ID.
   * @param mixed $plugin_definition
   *   The plugin definition.
   * @param \Drupal\Core\StringTranslation\TranslationInterface $translation
   *   The string translation service.
   */
  public function __construct(array $configuration, string $plugin_id, $plugin_definition, TranslationInterface $translation) {
    $this->uuid = $configuration['uuid'] ?? '';
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->stringTranslation = $translation;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('string_translation')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getSummary(): array {
    return [
      '#markup' => '',
      '#constraint' => [
        'id' => $this->pluginDefinition['id'],
        'label' => $this->name(),
        'description' => $this->pluginDefinition['description'],
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function name(): string {
    return $this->pluginDefinition['name']->render();
  }

  /**
   * {@inheritdoc}
   */
  public function getUuid(): string {
    return $this->uuid;
  }

  /**
   * {@inheritdoc}
   */
  public function getConfiguration(): array {
    return [
      'uuid' => $this->getUuid(),
      'id' => $this->getPluginId(),
      'data' => $this->configuration['data'],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function setConfiguration(array $configuration): self {
    $this->configuration = $configuration + $this->defaultConfiguration();
    $this->uuid = $configuration['uuid'];
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isRequired(): bool {
    return $this->configuration['data']['required'] ?? FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration(): array {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function calculateDependencies(): array {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state): array {
    $form['required'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Required'),
      '#default_value' => !empty($this->configuration['data']['required']),
      // This form element should always be the first one.
      '#weight' => -10,
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateConfigurationForm(array &$form, FormStateInterface $form_state): void {
    // As the base provides a single checkbox only, there's nothing to validate
    // here.
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state): void {
    $this->configuration['data']['required'] = $form_state->getValue('required');
  }

  /**
   * {@inheritdoc}
   */
  public function getInitialDescription(): string {
    return $this->isRequired() ? ' ' . $this->t('(required)') : '';
  }

}
