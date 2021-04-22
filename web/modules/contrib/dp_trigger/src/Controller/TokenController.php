<?php

declare(strict_types = 1);

namespace Drupal\dp_trigger\Controller;

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

use Drupal\Component\Utility\Html;
use Drupal\Core\Cache\Cache;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Url;
use Drupal\dp_trigger\ResolverManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Token controller class.
 */
class TokenController extends ControllerBase {

  /**
   * Database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $database;

  /**
   * Resolver manager.
   *
   * @var \Drupal\dp_trigger\ResolverManager
   */
  protected $resolverManager;

  /**
   * TokenController constructor.
   *
   * @param \Drupal\Core\Database\Connection $connection
   *   Database connection.
   * @param \Drupal\dp_trigger\ResolverManager $resolverManager
   *   Resolver manager.
   */
  public function __construct(Connection $connection, ResolverManager $resolverManager) {
    $this->database = $connection;
    $this->resolverManager = $resolverManager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    /** @var \Drupal\Core\Database\Connection $database */
    $database = $container->get('database');

    /** @var \Drupal\dp_trigger\ResolverManager $resolverManager */
    $resolverManager = $container->get('plugin.manager.dp_trigger_resolver');

    return new static(
      $database,
      $resolverManager
    );
  }

  /**
   * Page handler for 'entity.$entity.tokens.list'.
   *
   * @param \Drupal\Core\Routing\RouteMatchInterface $route_match
   *   Route match object.
   *
   * @return array
   *   Token list.
   */
  public function listTokens(RouteMatchInterface $route_match): array {
    $entity = $this->resolverManager->findEntity($route_match);
    $entity_type = $entity->getEntityTypeId();
    $results = $this->database->query('
        SELECT title, account, token 
        FROM {dp_trigger_token} 
        WHERE entity_type = :entity_type AND entity_uuid = :entity_uuid
        ORDER BY title', [
          ':entity_type' => $entity_type,
          ':entity_uuid' => $entity->uuid(),
        ])->fetchAll(\PDO::FETCH_ASSOC);

    $page = [];
    $page['tokens'] = [
      '#type' => 'table',
      '#header' => [
        $this->t('Title'),
        $this->t('Account'),
        $this->t('Link'),
        $this->t('Operations'),
      ],
    ];

    foreach ($results as $result) {
      /** @var \Drupal\user\Entity\User[] $accounts */
      $accounts = $this->entityTypeManager()->getStorage('user')->loadByProperties([
        'uuid' => $result['account'],
      ]);
      /** @var \Drupal\user\Entity\User $account */
      $account = reset($accounts);
      $link = Url::fromRoute('dp_trigger.tokens.trigger', [
        'entity' => $result['token'],
      ], [
        'absolute' => TRUE,
      ]);

      if ($account) {
        $token_account = [
          '#type' => 'link',
          '#title' => $account->getAccountName(),
          '#url' => $account->toUrl(),
        ];
      }
      else {
        $token_account = [
          '#markup' => $this->t('Anonymous (not verified)'),
        ];
      }

      $page['tokens'][] = [
        'title' => [
          '#markup' => Html::escape($result['title']),
        ],
        'account' => $token_account,
        'link' => [
          '#type' => 'link',
          '#title' => $link->toString(),
          '#url' => $link,
        ],
        'delete' => [
          '#type' => 'link',
          '#title' => $this->t('Revoke'),
          '#url' => Url::fromRoute("entity.{$entity_type}.tokens.delete", [
            $entity_type => $entity->id(),
            'token' => $result['token'],
          ]),
        ],
      ];
    }

    $page['#cache'] = [
      'contexts' => Cache::mergeContexts(['route'], $entity->getCacheContexts()),
      'tags' => Cache::mergeTags(["trigger:token:{$entity->getEntityTypeId()}:{$entity->id()}"], $entity->getCacheTagsToInvalidate()),
    ];

    return $page;
  }

}
