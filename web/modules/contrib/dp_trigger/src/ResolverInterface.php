<?php

declare(strict_types = 1);

namespace Drupal\dp_trigger;

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
use Drupal\node\NodeInterface;

/**
 * Interface for resolving trigger nodes.
 */
interface ResolverInterface {

  /**
   * Resolves the node to be updated.
   *
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   Triggering entity.
   * @param object|null $document
   *   API doc document.
   *
   * @return \Drupal\node\NodeInterface|null
   *   Found node or null.
   */
  public function resolve(EntityInterface $entity, ?\stdClass $document): ?NodeInterface;

}
