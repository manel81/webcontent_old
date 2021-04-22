<?php

declare(strict_types = 1);

namespace Drupal\dp_trigger\Form;

/**
 * Devportal Pro module for Drupal.
 *
 * Copyright (C) 2018 PRONOVIX GROUP BVBA.
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

use Drupal\Core\Cache\Cache;
use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\Url;

/**
 * Token delete form.
 */
class TokenDeleteForm extends ConfirmFormBase {

  /**
   * {@inheritdoc}
   */
  public function getQuestion(): TranslatableMarkup {
    return $this->t('Are you sure that you want to delete this token?');
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl(): Url {
    /** @var \Drupal\dp_trigger\ResolverManager $resolver */
    $resolver = \Drupal::service('plugin.manager.dp_trigger_resolver');
    $entity = $resolver->findEntity($this->getRouteMatch());

    return $entity ? Url::fromRoute("entity.{$entity->getEntityTypeId()}.tokens.list", [
      $entity->getEntityTypeId() => $entity->id(),
    ]) : NULL;
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'dp_trigger_token_delete_form';
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    /** @var \Drupal\dp_trigger\ResolverManager $resolver */
    $resolver = \Drupal::service('plugin.manager.dp_trigger_resolver');
    $entity = $resolver->findEntity($this->getRouteMatch());
    $token = $this->getRouteMatch()->getParameter('token');

    \Drupal::database()->delete('dp_trigger_token')
      ->condition('token', $token)
      ->execute();

    if (!$entity) {
      return;
    }

    Cache::invalidateTags(["trigger:token:{$entity->getEntityTypeId()}:{$entity->id()}"]);

    $form_state->setRedirectUrl(Url::fromRoute("entity.{$entity->getEntityTypeId()}.tokens.list", [
      $entity->getEntityTypeId() => $entity->id(),
    ]));
  }

}
