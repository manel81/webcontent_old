<?php

declare(strict_types = 1);

namespace Drupal\password_enhancements\Routing;

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

use Drupal\Core\ParamConverter\ParamConverterInterface;
use Drupal\password_enhancements\PasswordConstraintPluginManager;
use Symfony\Component\Routing\Route;

/**
 * Converts parameters for upcasting password constraint names to full arrays.
 *
 * @internal
 */
final class PasswordConstraintTypeParamConverter implements ParamConverterInterface {

  /**
   * The constraint plugin manager.
   *
   * @var \Drupal\password_enhancements\PasswordConstraintPluginManager
   */
  private $constraintPluginManager;

  /**
   * Constructs a new PasswordConstraintTypeParamConverter.
   *
   * @param \Drupal\password_enhancements\PasswordConstraintPluginManager $constraint_plugin_manager
   *   The constraint plugin manager.
   */
  public function __construct(PasswordConstraintPluginManager $constraint_plugin_manager) {
    $this->constraintPluginManager = $constraint_plugin_manager;
  }

  /**
   * {@inheritdoc}
   */
  public function convert($value, $definition, $name, array $defaults): array {
    return $this->constraintPluginManager->getDefinition($value, FALSE);
  }

  /**
   * {@inheritdoc}
   */
  public function applies($definition, $name, Route $route): bool {
    return (!empty($definition['type']) && $definition['type'] === 'password_constraint_type');
  }

}
