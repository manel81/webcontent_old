<?php

declare(strict_types = 1);

namespace Drupal\dp_trigger_group\Plugin\GroupContentEnabler;

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

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\group\Entity\GroupInterface;
use Drupal\group\Plugin\GroupContentEnablerBase;
use Drupal\node\Entity\NodeType;

/**
 * Enables group content for api references.
 *
 * @GroupContentEnabler(
 *   id = "group_api_ref",
 *   label = @Translation("Group API Reference"),
 *   description = @Translation("Adds API references to groups both publicly and privately."),
 *   entity_type_id = "node",
 *   entity_access = TRUE,
 *   reference_label = @Translation("Name"),
 *   reference_description = @Translation("The name of the API reference to add to the group"),
 *   deriver = "Drupal\dp_trigger_group\Plugin\GroupContentEnabler\GroupAPIRefDeriver",
 * )
 */
class GroupAPIRef extends GroupContentEnablerBase {

  /**
   * Loads the NodeType associated with this plugin instance.
   *
   * @return \Drupal\node\Entity\NodeType
   *   The node type instance.
   */
  protected function getApiRefType(): NodeType {
    return NodeType::load($this->getEntityBundle());
  }

  /**
   * {@inheritdoc}
   */
  public function getGroupOperations(GroupInterface $group): array {
    $account = \Drupal::currentUser();
    $plugin_id = $this->getPluginId();
    $type = $this->getEntityBundle();
    $operations = [];

    if ($group->hasPermission("create {$plugin_id} entity", $account)) {
      $operations["dp_trigger_group-create-{$type}"] = [
        'title' => $this->t('Create @type', [
          '@type' => $this->getApiRefType()->label(),
        ]),
        'url' => new Url('entity.group_content.create_form', [
          'group' => $group->id(),
          'plugin_id' => $plugin_id,
        ]),
        'weight' => 30,
      ];
    }

    return $operations;
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration(): array {
    $config = parent::defaultConfiguration();
    $config['entity_cardinality'] = 1;
    return $config;
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state): array {
    $form = parent::buildConfigurationForm($form, $form_state);
    $form['entity_cardinality']['#disabled'] = TRUE;
    $form['entity_cardinality']['#access'] = FALSE;
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function calculateDependencies(): array {
    $dependencies = parent::calculateDependencies();
    $dependencies['config'][] = "node.type.{$this->getEntityBundle()}";
    return $dependencies;
  }

}
