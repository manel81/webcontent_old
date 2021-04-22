<?php

declare(strict_types = 1);

namespace Drupal\boom_header\Entity\Controller;

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

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Form\FormInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\boom_header\Entity\HeaderBackground;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a list controller for boom_header entity.
 */
class HeaderBackgroundListBuilder extends EntityListBuilder implements FormInterface {

  /**
   * The form builder.
   *
   * @var \Drupal\Core\Form\FormBuilderInterface
   */
  protected $formBuilder;

  /**
   * The header background entities being listed.
   *
   * @var \Drupal\boom_header\HeaderBackgroundInterface[]
   */
  protected $entities;

  /**
   * {@inheritdoc}
   */
  protected $limit = FALSE;

  /**
   * {@inheritdoc}
   */
  public static function createInstance(ContainerInterface $container, EntityTypeInterface $entity_type) {
    return new static(
      $entity_type,
      $container->get('entity_type.manager')->getStorage($entity_type->id()),
      $container->get('form_builder')
    );
  }

  /**
   * Constructs a new EntityListBuilder object.
   *
   * @param \Drupal\Core\Entity\EntityTypeInterface $entity_type
   *   The entity type definition.
   * @param \Drupal\Core\Entity\EntityStorageInterface $storage
   *   The entity storage class.
   * @param \Drupal\Core\Form\FormBuilderInterface $form_builder
   *   The form builder.
   */
  public function __construct(EntityTypeInterface $entity_type, EntityStorageInterface $storage, FormBuilderInterface $form_builder) {
    parent::__construct($entity_type, $storage);
    $this->formBuilder = $form_builder;
  }

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header = [
      'admin_label' => $this->t('Admin label'),
      'visibility' => $this->t('Visibility'),
      'weight' => $this->t('Weight'),
    ];
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /** @var \Drupal\boom_header\Entity\HeaderBackground $entity */
    $visibility_rules = $entity->getVisibilityConditions();
    $summary = [];
    foreach ($visibility_rules as $visibility_rule) {
      $summary[] = $visibility_rule->summary();
    }

    $row = [];
    // Override default values to markup elements.
    $row['#attributes']['class'][] = 'draggable';
    $row['#weight'] = $entity->get('weight')->value;

    // Add other columns.
    $row['admin_label'] = $entity->get('admin_label')->value;
    $row['visibility'] = [
      'data' => [
        '#theme' => 'item_list',
        '#items' => $summary,
      ],
    ];

    // Add weight column.
    $row['weight'] = [
      '#type' => 'weight',
      '#title' => $this->t('Weight for @title', [
        '@title' => $entity->get('admin_label')->value,
      ]),
      '#title_display' => 'invisible',
      '#default_value' => $entity->get('weight')->value,
      '#attributes' => [
        'class' => [
          'header-background-weight',
        ],
      ],
    ];
    return $row + parent::buildRow($entity);
  }

  /**
   * {@inheritdoc}
   */
  public function render() {
    return $this->formBuilder->getForm($this);
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'boom_header_list';
  }

  /**
   * Builds the header background list form.
   *
   * @param array $form
   *   The form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   *
   * @return array
   *   The built form.
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $form['header_backgrounds'] = [
      '#type' => 'table',
      '#header' => $this->buildHeader(),
      '#empty' => $this->t('There is no @label yet.', [
        '@label' => $this->entityType->getLabel(),
      ]),
      '#tabledrag' => [
        [
          'action' => 'order',
          'relationship' => 'sibling',
          'group' => 'header-background-weight',
        ],
      ],
    ];
    $this->entities = $this->load();
    // Sort the header backgrounds (if only this could be done on the DB level).
    HeaderBackground::sort($this->entities);

    $delta = 10;
    // Change the delta of the weight field if have more than 20 entities.
    $count = count($this->entities);
    if ($count > 20) {
      $delta = ceil($count / 2);
    }
    foreach ($this->entities as $entity) {
      $row = $this->buildRow($entity);
      if (isset($row['admin_label'])) {
        $row['admin_label'] = [
          '#markup' => $row['admin_label'],
        ];
      }
      if (isset($row['weight'])) {
        $row['weight']['#delta'] = $delta;
      }
      $form['header_backgrounds'][$entity->id()] = $row;
    }
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // No need for any validation.
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $changed = FALSE;
    foreach ($form_state->getValue('header_backgrounds') as $id => $value) {
      if (isset($this->entities[$id]) && $this->entities[$id]->get('weight')->value != $value['weight']) {
        // Save entity only when its weight was changed.
        $this->entities[$id]->set('weight', $value['weight']);
        $this->entities[$id]->save();
        $changed = TRUE;
      }
    }
    if (!$changed) {
      return;
    }

    $this->messenger()->addStatus($this->t('The configuration options have been saved.'));
  }

}
