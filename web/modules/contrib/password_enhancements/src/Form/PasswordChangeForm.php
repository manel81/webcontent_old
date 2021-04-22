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

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\Password\PasswordInterface;
use Drupal\Core\Session\SessionManagerInterface;
use Drupal\user\UserInterface;
use Drupal\user\UserStorageInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Password change form.
 */
final class PasswordChangeForm extends FormBase {

  /**
   * Password service.
   *
   * @var \Drupal\Core\Password\PasswordInterface
   */
  private $password;

  /**
   * Session manager.
   *
   * @var \Drupal\Core\Session\SessionManagerInterface
   */
  private $sessionManager;

  /**
   * User storage.
   *
   * @var \Drupal\user\UserStorageInterface
   */
  private $userStorage;

  /**
   * Constructs the password change form.
   *
   * @param \Drupal\user\UserStorageInterface $user_storage
   *   User storage.
   * @param \Drupal\Core\Messenger\MessengerInterface $messenger
   *   Messenger.
   * @param \Drupal\Core\Password\PasswordInterface $password
   *   Password service.
   * @param \Symfony\Component\HttpFoundation\RequestStack $request_stack
   *   Request stack.
   * @param \Drupal\Core\Session\SessionManagerInterface $session_manager
   *   Session manager.
   */
  public function __construct(UserStorageInterface $user_storage, MessengerInterface $messenger, PasswordInterface $password, RequestStack $request_stack, SessionManagerInterface $session_manager) {
    $this->messenger = $messenger;
    $this->password = $password;
    $this->requestStack = $request_stack;
    $this->sessionManager = $session_manager;
    $this->userStorage = $user_storage;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container): self {
    return new static(
      $container->get('entity_type.manager')->getStorage('user'),
      $container->get('messenger'),
      $container->get('password'),
      $container->get('request_stack'),
      $container->get('session_manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'password_enhancements_change_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    // Get user roles.
    $current_user = $this->currentUser();
    $roles = $current_user->getRoles();
    $form_state->setValue('roles', $roles);
    $form_state->setUserInput(['roles' => $roles]);

    $user_pass_reset = FALSE;
    $token = $this->getRequest()->get('pass-reset-token');
    if (!$form_state->get('user_pass_reset') && $token) {
      $session_key = 'pass_reset_' . $current_user->id();
      $user_pass_reset = isset($_SESSION[$session_key]) && hash_equals($_SESSION[$session_key], $token);
      $form_state->set('user_pass_reset', $user_pass_reset);
    }
    elseif (!empty($this->sessionManager->getBag('attributes')->getBag()->get('password_enhancements_login_password_change_required'))) {
      $user_pass_reset = TRUE;
      $form_state->set('user_pass_reset', $user_pass_reset);
    }

    $form['account'] = [
      '#type' => 'container',
      'roles' => [
        '#type' => 'hidden',
        '#value' => $roles,
      ],
      'current_pass' => [
        '#type' => 'password',
        '#title' => $this->t('Current password'),
        '#required' => TRUE,
        '#attributes' => ['autocomplete' => 'off'],
        '#access' => !$user_pass_reset,
      ],
      'pass' => [
        '#type' => 'password_confirm',
        '#size' => 25,
        '#required' => TRUE,
      ],
    ];

    $form['actions'] = [
      '#type' => 'container',
      'save' => [
        '#type' => 'submit',
        '#value' => $this->t('Change'),
      ],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state): void {
    parent::validateForm($form, $form_state);

    $user = $this->loadCurrentUser();
    if (!$form_state->get('user_pass_reset') && !$this->password->check($form_state->getValue('current_pass'), $user->getPassword())) {
      $form_state->setError($form['account']['current_pass'], $this->t('Incorrect password.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    // Remove lock and clean-up session variables.
    $attributes_bag = $this->sessionManager->getBag('attributes')->getBag();
    $attributes_bag->remove('password_enhancements_login_password_change_required');
    $attributes_bag->remove('password_enhancements_pass_reset_token');

    // Update user fields.
    $user = $this->loadCurrentUser();
    $user->set('password_enhancements_password_change_required', FALSE)
      ->setPassword($form_state->getValue('pass'))
      ->save();

    $this->messenger()->addStatus($this->t('Your password has been successfully changed.'));
    $form_state->setRedirect('user.page');
  }

  /**
   * Loads the full user object for the current user.
   *
   * @return \Drupal\user\UserInterface
   *   The fully loaded user object.
   */
  protected function loadCurrentUser(): UserInterface {
    return $this->userStorage->load($this->currentUser()->id());
  }

}
