<?php

declare(strict_types = 1);

namespace Drupal\boom_header\Form;

/**
 * Copyright (C) 2019 PRONOVIX GROUP BVBA.
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

use Drupal\Component\Datetime\TimeInterface;
use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Entity\EntityRepositoryInterface;
use Drupal\Core\Entity\EntityTypeBundleInfoInterface;
use Drupal\Core\Executable\ExecutableManagerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\SubformState;
use Drupal\Core\Language\Language;
use Drupal\Core\Plugin\Context\ContextRepositoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Form controller for the boom_header entity edit forms.
 *
 * @ingroup content_entity_example
 */
class HeaderBackgroundForm extends ContentEntityForm {

  /**
   * The header background entity.
   *
   * @var \Drupal\boom_header\Entity\HeaderBackground
   */
  protected $entity;

  /**
   * The condition plugin manager.
   *
   * @var \Drupal\Core\Condition\ConditionManager
   */
  protected $conditionManager;

  /**
   * The context repository service.
   *
   * @var \Drupal\Core\Plugin\Context\ContextRepositoryInterface
   */
  protected $contextRepository;

  /**
   * Constructs a HeaderBackgroundForm object.
   *
   * @param \Drupal\Core\Entity\EntityRepositoryInterface $entity_repository
   *   The entity repository service.
   * @param \Drupal\Core\Entity\EntityTypeBundleInfoInterface $entity_type_bundle_info
   *   The entity type bundle service.
   * @param \Drupal\Component\Datetime\TimeInterface $time
   *   The time service.
   * @param \Drupal\Core\Executable\ExecutableManagerInterface $condition_manager
   *   The ConditionManager for building the visibility UI.
   * @param \Drupal\Core\Plugin\Context\ContextRepositoryInterface $context_repository
   *   The lazy context repository service.
   */
  public function __construct(EntityRepositoryInterface $entity_repository, EntityTypeBundleInfoInterface $entity_type_bundle_info, TimeInterface $time, ExecutableManagerInterface $condition_manager, ContextRepositoryInterface $context_repository) {
    parent::__construct($entity_repository, $entity_type_bundle_info, $time);
    $this->conditionManager = $condition_manager;
    $this->contextRepository = $context_repository;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity.repository'),
      $container->get('entity_type.bundle.info'),
      $container->get('datetime.time'),
      $container->get('plugin.manager.condition'),
      $container->get('context.repository')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    $entity = $this->entity;

    $form['langcode'] = [
      '#title' => $this->t('Language'),
      '#type' => 'language_select',
      '#default_value' => $entity->getUntranslated()->language()->getId(),
      '#languages' => Language::STATE_ALL,
    ];

    // Store the gathered contexts in the form state for other objects to use
    // during form building.
    $form_state->setTemporaryValue('gathered_contexts', $this->contextRepository->getAvailableContexts());
    $form['visibility'] = $this->buildVisibilityInterface([], $form_state);

    return $form;
  }

  /**
   * Helper function for building the visibility UI form.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array
   *   The form array with the visibility UI added in.
   */
  protected function buildVisibilityInterface(array $form, FormStateInterface $form_state): array {
    $form['#tree'] = TRUE;
    $form['visibility_tabs'] = [
      '#type' => 'vertical_tabs',
      '#title' => $this->t('Visibility'),
      '#parents' => ['visibility_tabs'],
    ];
    // @todo Allow list of conditions to be configured in
    //   https://www.drupal.org/node/2284687.
    $visibility = $this->entity->getVisibility();
    $definitions = $this->conditionManager->getFilteredDefinitions('boom_header', $form_state->getTemporaryValue('gathered_contexts'), ['boom_header' => $this->entity]);
    foreach ($definitions as $condition_id => $definition) {
      // Don't display the current theme condition.
      if ($condition_id == 'current_theme') {
        continue;
      }
      // @todo Add multilingual support.
      // phpcs:disable Drupal.Files.LineLength.TooLong
      // phpcs:disable Drupal.Commenting.InlineComment.SpacingBefore
      // // Don't display the language condition until we have multiple languages.
      // if ($condition_id == 'language' && !$this->language->isMultilingual()) {
      //   continue;
      // }
      // phpcs:enable
      /** @var \Drupal\Core\Condition\ConditionInterface $condition */
      $condition = $this->conditionManager->createInstance($condition_id, $visibility[$condition_id] ?? []);
      $form_state->set(['conditions', $condition_id], $condition);
      $condition_form = $condition->buildConfigurationForm([], $form_state);
      $condition_form['#type'] = 'details';
      $condition_form['#title'] = $condition->getPluginDefinition()['label'];
      $condition_form['#group'] = 'visibility_tabs';
      // Condition ID also needs to be stored.
      $condition_form['id'] = [
        '#type' => 'value',
        '#value' => $condition_id,
      ];
      $form[$condition_id] = $condition_form;
    }

    if (isset($form['node_type'])) {
      $form['node_type']['#title'] = $this->t('Content types');
      $form['node_type']['bundles']['#title'] = $this->t('Content types');
      $form['node_type']['negate']['#type'] = 'value';
      $form['node_type']['negate']['#title_display'] = 'invisible';
      $form['node_type']['negate']['#value'] = $form['node_type']['negate']['#default_value'];
    }
    if (isset($form['user_role'])) {
      $form['user_role']['#title'] = $this->t('Roles');
      unset($form['user_role']['roles']['#description']);
      $form['user_role']['negate']['#type'] = 'value';
      $form['user_role']['negate']['#value'] = $form['user_role']['negate']['#default_value'];
    }
    if (isset($form['request_path'])) {
      $form['request_path']['#title'] = $this->t('Pages');
      $form['request_path']['negate']['#type'] = 'radios';
      $form['request_path']['negate']['#default_value'] = (int) $form['request_path']['negate']['#default_value'];
      $form['request_path']['negate']['#title_display'] = 'invisible';
      $form['request_path']['negate']['#options'] = [
        $this->t('Show for the listed pages'),
        $this->t('Hide for the listed pages'),
      ];
    }
    if (isset($form['language'])) {
      $form['language']['negate']['#type'] = 'value';
      $form['language']['negate']['#value'] = $form['language']['negate']['#default_value'];
    }
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
    $this->validateVisibility($form, $form_state);
  }

  /**
   * Helper function to independently validate the visibility UI.
   *
   * @param array $form
   *   A nested array form elements comprising the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  protected function validateVisibility(array $form, FormStateInterface $form_state): void {
    // Validate visibility condition settings.
    foreach ($form_state->getValue('visibility') as $condition_id => $values) {
      // All condition plugins use 'negate' as a Boolean in their schema.
      // However, certain form elements may return it as 0/1. Cast here to
      // ensure the data is in the expected type.
      if (array_key_exists('negate', $values)) {
        $form_state->setValue(['visibility', $condition_id, 'negate'],
          (bool) $values['negate']
        );
      }

      // Allow the condition to validate the form.
      $condition = $form_state->get(['conditions', $condition_id]);
      $condition->validateConfigurationForm($form['visibility'][$condition_id], SubformState::createForSubform($form['visibility'][$condition_id], $form, $form_state));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    $this->submitVisibility($form, $form_state);
    $this->messenger()->addStatus($this->t('The header background has been saved.'));
  }

  /**
   * Helper function to independently submit the visibility UI.
   *
   * @param array $form
   *   A nested array form elements comprising the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  protected function submitVisibility(array $form, FormStateInterface $form_state): void {
    foreach ($form_state->getValue('visibility') as $condition_id => $values) {
      // Allow the condition to submit the form.
      $condition = $form_state->get(['conditions', $condition_id]);
      $subform = SubformState::createForSubform($form['visibility'][$condition_id], $form, $form_state);
      $condition->submitConfigurationForm($form['visibility'][$condition_id], $subform);

      $condition_configuration = $condition->getConfiguration();
      // Update the visibility conditions on the header background.
      $this->entity->getVisibilityConditions()->addInstanceId($condition_id, $condition_configuration);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    try {
      $status = parent::save($form, $form_state);

      $entity = $this->entity;
      if ($status == SAVED_UPDATED) {
        /** @var \Drupal\Core\Field\BaseFieldDefinition[] $fields */
        $this->messenger()->addMessage($this->t('The header background %feed has been updated.', ['%feed' => $entity->get('admin_label')->value]));
      }
      else {
        $this->messenger()->addMessage($this->t('The header background %feed has been added.', ['%feed' => $entity->get('admin_label')->value]));
      }
    }
    catch (\Exception $exception) {
      $this->messenger()->addMessage($this->t('An error occurred during save. Try again later.'));
    }

    $form_state->setRedirectUrl($this->entity->toUrl('collection'));
    return $status;
  }

}
