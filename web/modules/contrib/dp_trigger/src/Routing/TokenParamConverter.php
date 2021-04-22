<?php

declare(strict_types = 1);

namespace Drupal\dp_trigger\Routing;

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

use Drupal\Core\Database\Connection;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\ParamConverter\ParamConverterInterface;
use Symfony\Component\Routing\Route;

/**
 * Url parameter converters for tokens.
 */
class TokenParamConverter implements ParamConverterInterface {

  /**
   * Database connection service.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $connection;

  /**
   * Entity type manager service.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * {@inheritdoc}
   */
  public function __construct(Connection $connection, EntityTypeManagerInterface $entityTypeManager) {
    $this->connection = $connection;
    $this->entityTypeManager = $entityTypeManager;
  }

  /**
   * {@inheritdoc}
   */
  public function convert($value, $definition, $name, array $defaults): ?EntityInterface {
    $data = $this->connection->query('
        SELECT * 
        FROM {dp_trigger_token} 
        WHERE token = :token
    ', ['token' => $value])->fetch(\PDO::FETCH_ASSOC);
    if (!$data) {
      return NULL;
    }

    $referenced_entities = $this->entityTypeManager
      ->getStorage($data['entity_type'])
      ->loadByProperties([
        'uuid' => $data['entity_uuid'],
      ]);
    if (count($referenced_entities) !== 1) {
      return NULL;
    }

    return reset($referenced_entities);
  }

  /**
   * {@inheritdoc}
   */
  public function applies($definition, $name, Route $route): bool {
    return ($definition['type'] ?? NULL) === 'dp-trigger-token';
  }

}
