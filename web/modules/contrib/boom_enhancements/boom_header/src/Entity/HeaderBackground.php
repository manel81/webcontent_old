<?php

declare(strict_types = 1);

namespace Drupal\boom_header\Entity;

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

use Drupal\Core\Condition\ConditionInterface;
use Drupal\Core\Condition\ConditionPluginCollection;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Executable\ExecutableManagerInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\boom_header\HeaderBackgroundInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Header Background entity.
 *
 * @ContentEntityType(
 *   id = "boom_header",
 *   label = @Translation("Header Background"),
 *   handlers = {
 *     "access" = "Drupal\boom_header\HeaderBackgroundAccessControlHandler",
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\boom_header\Entity\Controller\HeaderBackgroundListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "form" = {
 *       "add" = "Drupal\boom_header\Form\HeaderBackgroundForm",
 *       "edit" = "Drupal\boom_header\Form\HeaderBackgroundForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *   },
 *   base_table = "header",
 *   admin_permission = "administer header background entity",
 *   fieldable = TRUE,
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "canonical" = "/boom_header/{boom_header}",
 *     "edit-form" = "/boom_header/{boom_header}/edit",
 *     "delete-form" = "/boom_header/{boom_header}/delete",
 *     "collection" = "/boom_header/list"
 *   },
 *   field_ui_base_route = "boom_header.header_settings",
 * )
 */
class HeaderBackground extends ContentEntityBase implements HeaderBackgroundInterface {

  // Implements methods defined by EntityChangedInterface.
  use EntityChangedTrait;

  /**
   * The visibility collection.
   *
   * @var \Drupal\Core\Condition\ConditionPluginCollection
   */
  protected $visibilityCollection;

  /**
   * The condition plugin manager.
   *
   * @var \Drupal\Core\Executable\ExecutableManagerInterface
   */
  protected $conditionPluginManager;

  /**
   * {@inheritdoc}
   */
  public function getVisibility(): array {
    return $this->getVisibilityConditions()->getConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  public function setVisibilityConfig(string $instance_id, array $configuration): HeaderBackgroundInterface {
    $conditions = $this->getVisibilityConditions();
    if (!$conditions->has($instance_id)) {
      $configuration['id'] = $instance_id;
      $conditions->addInstanceId($instance_id, $configuration);
    }
    else {
      $conditions->setInstanceConfiguration($instance_id, $configuration);
    }
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getVisibilityConditions() {
    if (!isset($this->visibilityCollection)) {
      /** @var \Drupal\Core\Field\MapFieldItemList $field_visibility */
      $field_visibility = $this->get('visibility');
      $field_visibility = $field_visibility->isEmpty() ? [] : $field_visibility->first()->getValue();
      $this->visibilityCollection = new ConditionPluginCollection($this->conditionPluginManager(), $field_visibility);
    }
    return $this->visibilityCollection;
  }

  /**
   * {@inheritdoc}
   */
  public function getVisibilityCondition(string $instance_id): ConditionInterface {
    return $this->getVisibilityConditions()->get($instance_id);
  }

  /**
   * Gets the condition plugin manager.
   *
   * @return \Drupal\Core\Executable\ExecutableManagerInterface
   *   The condition plugin manager.
   */
  protected function conditionPluginManager(): ExecutableManagerInterface {
    if (!isset($this->conditionPluginManager)) {
      $this->conditionPluginManager = \Drupal::service('plugin.manager.condition');
    }
    return $this->conditionPluginManager;
  }

  /**
   * {@inheritdoc}
   *
   * When a new entity instance is added, set the user_id entity reference to
   * the current user as the creator of the instance.
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += [
      'user_id' => \Drupal::currentUser()->id(),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime(): int {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('user_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   *
   * Define the field properties here.
   *
   * Field name, type and size determine the table structure.
   *
   * In addition, we can define how the field and its content can be manipulated
   * in the GUI. The behaviour of the widgets used can be determined here.
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    /** @var \Drupal\Core\Field\BaseFieldDefinition[] $fields */
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['admin_label'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Admin label'))
      ->setDescription(t('Administrative label for the background image.'))
      ->setRequired(TRUE)
      ->setSettings([
        'default_value' => '',
        'max_length' => 255,
        'text_processing' => 0,
      ])
      ->setDisplayOptions('view', [
        'label' => 'inline',
        'type' => 'string',
        'weight' => -9,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -9,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['hbg_image'] = BaseFieldDefinition::create('image')
      ->setLabel(t('Background Image'))
      ->setDescription(t('The Background image for the given visibility rules.'))
      ->setRequired(TRUE)
      ->setSettings([
        'file_directory' => 'header-images',
        'alt_field_required' => FALSE,
        'file_extensions' => 'png jpg jpeg',
      ])
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'default',
        'weight' => -8,
      ])
      ->setDisplayOptions('form', [
        'label' => 'hidden',
        'type' => 'image_focal_point',
        'weight' => -8,
        'settings' => [
          'preview_image_style' => 'medium',
          'preview_link' => FALSE,
        ],
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    $fields['visibility'] = BaseFieldDefinition::create('map')
      ->setLabel(t('Visibility'))
      ->setDescription(t('The visibility settings for the entity.'));

    $fields['weight'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Weight'))
      ->setDescription(t('The weight of the entity.'))
      ->setRequired(TRUE)
      ->setDefaultValue(0)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'hidden',
      ])
      ->setDisplayOptions('form', [
        'label' => 'inline',
        'type' => 'number',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function preSave(EntityStorageInterface $storage) {
    // This is needed to only store those parts of the condition settings that
    // need to be stored (eg. don't store basic_page => 0 when this content type
    // is unchecked on the form).
    $this->set('visibility', $this->getVisibility());
    parent::preSave($storage);
  }

  /**
   * Utility function to sort an array of header backgrounds by their weight.
   *
   * @param \Drupal\boom_header\HeaderBackgroundInterface[] $header_backgrounds
   *   The array to be sorted.
   */
  public static function sort(array &$header_backgrounds): void {
    uasort($header_backgrounds, static function (HeaderBackgroundInterface $a, HeaderBackgroundInterface $b) {
      return $a->get('weight')->value <=> $b->get('weight')->value;
    });
  }

}
