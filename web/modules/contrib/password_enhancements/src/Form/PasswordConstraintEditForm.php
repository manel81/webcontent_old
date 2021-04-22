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
 * Provides an edit form for password constraints.
 *
 * @internal
 */
final class PasswordConstraintEditForm extends PasswordConstraintFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'password_constraint_edit_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, RoleInterface $user_role = NULL, $password_constraint = NULL): array {
    $form = parent::buildForm($form, $form_state, $user_role, $password_constraint);

    $form['#title'] = $this->t('Edit %label constraint', ['%label' => $this->constraint->name()]);
    $form['actions']['submit']['#value'] = $this->t('Update constraint');

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  protected function preparePasswordConstraint($password_constraint): PasswordConstraintInterface {
    // Received is the old, to-be-updated password constraint (loaded during URL
    // parameter conversion), but need to return the object that is _associated_
    // with the policy (because the constraint is not saved by itself, but it
    // gets saved along with the policy).
    return $this->policy->getConstraint($password_constraint->getUuid());
  }

}
