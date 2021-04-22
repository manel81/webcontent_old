<?php

declare(strict_types = 1);

namespace Drupal\password_enhancements\Form;

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
use Drupal\password_enhancements\PasswordConstraintInterface;
use Drupal\user\RoleInterface;

/**
 * Provides an add form for password constraints.
 *
 * @internal
 */
final class PasswordConstraintAddForm extends PasswordConstraintFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'password_constraint_add_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, RoleInterface $user_role = NULL, $password_constraint = NULL): array {
    $form = parent::buildForm($form, $form_state, $user_role, $password_constraint);

    $form['#title'] = $this->t('Add %name constraint', ['%name' => $this->constraint->name()]);
    $form['actions']['submit']['#value'] = $this->t('Add constraint');

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  protected function preparePasswordConstraint($password_constraint_type): PasswordConstraintInterface {
    return $this->constraintPluginManager->createInstance($password_constraint_type['id']);
  }

}
