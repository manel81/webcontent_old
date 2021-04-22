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

use Drupal\Component\Utility\Random;
use Drupal\Core\Cache\Cache;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\dp_trigger\ResolverManager;
use Drupal\user\UserStorageInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Token form.
 */
class TokenForm extends FormBase {

  /**
   * The DP Trigger resolver manager service.
   *
   * @var \Drupal\dp_trigger\ResolverManager
   */
  protected $dpTriggerResolverManager;

  /**
   * The user storage.
   *
   * @var \Drupal\user\UserStorageInterface
   */
  protected $userStorage;

  /**
   * TokenForm constructor.
   *
   * @param \Drupal\dp_trigger\ResolverManager $dp_trigger_resolver_manager
   *   The DP Trigger resolver manager service.
   * @param \Drupal\user\UserStorageInterface $user_storage
   *   The user storage.
   */
  public function __construct(ResolverManager $dp_trigger_resolver_manager, UserStorageInterface $user_storage) {
    $this->dpTriggerResolverManager = $dp_trigger_resolver_manager;
    $this->userStorage = $user_storage;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('plugin.manager.dp_trigger_resolver'),
      $container->get('entity_type.manager')->getStorage('user')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'dp_trigger_token_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#required' => TRUE,
    ];

    $currentUser = $this->currentUser()->id();
    $user = $this->userStorage->load($currentUser);

    $form['account'] = [
      '#type' => 'value',
      '#value' => $user->uuid(),
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    /** @var \Drupal\Core\Entity\EntityInterface $entity */
    $entity = $this->dpTriggerResolverManager->findEntity($this->getRouteMatch());
    static::save(
      $form_state->getValue('title'),
      $entity->getEntityTypeId(),
      $entity->uuid(),
      $form_state->getValue('account')
    );

    Cache::invalidateTags(["trigger:token:{$entity->getEntityTypeId()}:{$entity->id()}"]);

    $form_state->setRedirectUrl(Url::fromRoute("entity.{$entity->getEntityTypeId()}.tokens.list", [
      $entity->getEntityTypeId() => $entity->id(),
    ]));
  }

  /**
   * Saves a token to the database.
   *
   * @param string $title
   *   Token title.
   * @param string $entity_type
   *   Token entity type.
   * @param string|int $entity_id
   *   Token entity id.
   * @param string|int $account
   *   Account id.
   *
   * @todo refactor this to a service
   *
   * @return string
   *   Generated token.
   */
  public static function save(string $title, string $entity_type, $entity_id, $account): string {
    $token = (new Random())->name(64);
    \Drupal::database()->insert('dp_trigger_token')
      ->fields([
        'title' => $title,
        'entity_type' => $entity_type,
        'entity_uuid' => $entity_id,
        'account' => $account,
        'token' => $token,
      ])
      ->execute();

    return $token;
  }

}
