<?php

declare(strict_types = 1);

namespace Drupal\dp_trigger_group\Plugin\TriggerResolver;

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

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Plugin\PluginBase;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\dp_trigger\ResolverInterface;
use Drupal\node\NodeInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Group trigger resolver plugin.
 *
 * @Plugin(
 *   id = "group",
 * )
 */
class Group extends PluginBase implements ResolverInterface, ContainerFactoryPluginInterface {

  /**
   * Entity type manager service.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Query factory service.
   *
   * @var \Drupal\Core\Entity\Query\QueryFactory
   */
  protected $entityQuery;

  /**
   * Current user service.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, EntityTypeManagerInterface $entityTypeManager = NULL, $entityQuery = NULL, AccountProxyInterface $currentUser = NULL) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->entityTypeManager = $entityTypeManager ?: \Drupal::service('entity_type.manager');
    // @todo Query factory is deprecated and it is removed from Drupal 9.0.0.
    $this->entityQuery = $entityQuery ?: \Drupal::service('entity.query');
    $this->currentUser = $currentUser ?: \Drupal::service('current_user');
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    /** @var \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager */
    $entity_type_manager = $container->get('entity_type.manager');

    /** @var \Drupal\Core\Session\AccountProxyInterface $current_user */
    $current_user = $container->get('current_user');

    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $entity_type_manager,
      NULL,
      $current_user
    );
  }

  /**
   * {@inheritdoc}
   */
  public function resolve(EntityInterface $entity, ?\stdClass $document): ?NodeInterface {
    /** @var \Drupal\group\Entity\GroupInterface $entity */

    $project_id = $_SERVER['HTTP_X_PROJECT_ID'] ?? $document->{'x-project-id'} ?? NULL;
    if (!$project_id) {
      throw new UnprocessableEntityHttpException('Missing x-project-id attribute or header');
    }

    /** @var \Drupal\node\NodeStorageInterface $node_storage */
    $node_storage = $this->entityTypeManager->getStorage('node');
    /** @var \Drupal\group\Entity\Storage\GroupContentStorageInterface $group_content_storage */
    $group_content_storage = $this->entityTypeManager->getStorage('group_content');

    /** @var \Drupal\node\NodeInterface[] $api_refs */
    $api_refs = $node_storage
      ->loadByProperties(['field_project_id' => $project_id]);

    if ($api_refs) {
      /** @var \Drupal\node\NodeInterface $api_ref */
      $api_ref = reset($api_refs);

      $correct_group = (bool) $group_content_storage->getQuery()
        ->condition('gid', $entity->id())
        ->condition('entity_id', $api_ref->id())
        ->count()
        ->execute();

      if (!$correct_group) {
        throw new UnprocessableEntityHttpException('Attribute x-project-id belongs to a different group');
      }
    }
    elseif ($document) {
      // @todo these references shouldn't be hardcoded
      $api_ref = $node_storage->create([
        'title' => $document->info->title,
        'field_description' => !empty($document->info->description) ? [
          'value' => $document->info->description,
          'format' => 'github_flavored_markdown',
        ] : '',
        'field_version' => $document->info->version,
        'field_project_id' => $project_id,
        'type' => 'api_reference',
        'uid' => $this->currentUser->id(),
      ]);

      $node_storage->save($api_ref);

      $group_type = $entity->getGroupType()->id();
      /** @var \Drupal\group\Entity\GroupContentTypeInterface[] $group_content_types */
      $group_content_types = $this
        ->entityTypeManager
        ->getStorage('group_content_type')
        ->loadByProperties([
          'group_type' => $group_type,
          'content_plugin' => 'group_api_ref:api_reference',
        ]);

      if (!$group_content_types) {
        throw new HttpException(500, 'Token related group type not found');
      }

      /** @var \Drupal\group\Entity\GroupContentTypeInterface $group_content_type */
      $group_content_type = reset($group_content_types);

      $group_content = $group_content_storage->create([
        'gid' => $entity->id(),
        'entity_id' => $api_ref,
        'label' => $api_ref->label(),
        'uid' => $this->currentUser->id(),
        'type' => $group_content_type->id(),
      ]);

      $group_content_storage->save($group_content);
    }
    else {
      $api_ref = NULL;
    }

    return $api_ref;
  }

}
