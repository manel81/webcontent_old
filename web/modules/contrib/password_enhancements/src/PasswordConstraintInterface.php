<?php

declare(strict_types = 1);

namespace Drupal\password_enhancements;

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

use Drupal\Component\Plugin\ConfigurableInterface;
use Drupal\Component\Plugin\DependentPluginInterface;
use Drupal\Component\Plugin\PluginInspectionInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines the interface for password constraints.
 */
interface PasswordConstraintInterface extends PluginInspectionInterface, ConfigurableInterface, DependentPluginInterface {

  /**
   * Validates a password string against the constraint.
   *
   * @param string $value
   *   The value that needs to be validated.
   *
   * @throws \Drupal\password_enhancements\Plugin\Exception\PasswordConstraintPluginValidationException
   *   The exception will be thrown if the validation fails.
   */
  public function validate(string $value): void;

  /**
   * Returns a render array summarizing the config of the password constraint.
   *
   * @return array
   *   A render array.
   */
  public function getSummary(): array;

  /**
   * Returns the password constraint name.
   *
   * @return string
   *   The password constraint name.
   */
  public function name(): string;

  /**
   * Returns the unique ID representing the password constraint.
   *
   * @return string
   *   The password constraint ID.
   */
  public function getUuid(): string;

  /**
   * Returns whether the constraint is required or not.
   *
   * @return bool
   *   TRUE if the constraint is required, FALSE otherwise.
   */
  public function isRequired(): bool;

  /**
   * Builds the configuration form for the password constraint.
   *
   * @param array $form
   *   The form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   *
   * @return array
   *   The built form.
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state): array;

  /**
   * Validates the configuration form for the password constraint.
   *
   * @param array $form
   *   The form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  public function validateConfigurationForm(array &$form, FormStateInterface $form_state): void;

  /**
   * Handles the password constraint configuration form submission.
   *
   * @param array $form
   *   The form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state): void;

  /**
   * Returns the initial description for the constraint.
   *
   * @return string
   *   The initial description for the constraint.
   */
  public function getInitialDescription(): string;

}
