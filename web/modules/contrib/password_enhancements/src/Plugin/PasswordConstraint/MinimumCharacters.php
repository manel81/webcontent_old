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
use Drupal\password_enhancements\Plugin\Exception\PasswordConstraintPluginValidationException;

/**
 * Minimum characters password constraint plugin.
 *
 * @PasswordConstraint(
 *   id = "minimum_characters",
 *   name = @Translation("Minimum characters"),
 *   description = @Translation("Checks if the password has at least a specified number of characters of any type."),
 *   unique = TRUE,
 *   jsLibrary = "password_enhancements/plugin.minimum_characters",
 * )
 */
class MinimumCharacters extends PasswordConstraintBase {

  /**
   * {@inheritdoc}
   */
  public function validate(string $value): void {
    $character_count = mb_strlen($value);
    if ($this->configuration['data']['minimum_characters'] > $character_count) {
      $count = $this->configuration['data']['minimum_characters'] - $character_count;
      $message = $count > 1 ? strtr($this->configuration['data']['descriptionPlural'], [
        '@minimum_characters' => $count,
      ]) : $this->configuration['data']['descriptionSingular'];
      throw new PasswordConstraintPluginValidationException($message);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getSummary(): array {
    $items = [
      $this->t('Minimum characters: %characters', ['%characters' => $this->configuration['data']['minimum_characters']]),
      $this->t('Description (singular): %description', ['%description' => $this->configuration['data']['descriptionSingular']]),
      $this->t('Description (plural): %description', ['%description' => $this->configuration['data']['descriptionPlural']]),
    ];
    $summary = [
      '#theme' => 'item_list',
      '#items' => $items,
    ];
    $summary += parent::getSummary();

    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state): array {
    $form = parent::buildConfigurationForm($form, $form_state);
    $form['minimum_characters'] = [
      '#type' => 'number',
      '#title' => $this->t('Minimum characters'),
      '#required' => TRUE,
      '#min' => 1,
      '#default_value' => !empty($this->configuration['data']['minimum_characters']) ? $this->configuration['data']['minimum_characters'] : 1,
    ];
    $form['descriptionSingular'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Description (singular)'),
      '#required' => TRUE,
      '#default_value' => $this->configuration['data']['descriptionSingular'] ?? $this->defaultDescriptionSingular(),
    ];
    $form['descriptionPlural'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Description (plural)'),
      '#required' => TRUE,
      '#default_value' => $this->configuration['data']['descriptionPlural'] ?? $this->defaultDescriptionPlural(),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state): void {
    parent::submitConfigurationForm($form, $form_state);
    $this->configuration['data']['minimum_characters'] = $form_state->getValue('minimum_characters');
    $this->configuration['data']['descriptionSingular'] = $form_state->getValue('descriptionSingular');
    $this->configuration['data']['descriptionPlural'] = $form_state->getValue('descriptionPlural');
  }

  /**
   * {@inheritdoc}
   */
  public function getInitialDescription(): string {
    $message = $this->configuration['data']['minimum_characters'] > 1
        ? $this->configuration['data']['descriptionPlural']
        : $this->configuration['data']['descriptionSingular'];
    return $message . parent::getInitialDescription();
  }

  /**
   * Returns the default description's singular form.
   *
   * @return string
   *   The default description's singular form.
   */
  public function defaultDescriptionSingular(): string {
    return 'Add at least one character.';
  }

  /**
   * Returns the default description's plural form.
   *
   * @return string
   *   The default description's plural form.
   */
  public function defaultDescriptionPlural(): string {
    return 'Add @minimum_characters more characters.';
  }

}
