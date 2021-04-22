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

use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\ParamConverter\ParamConverterInterface;
use Drupal\password_enhancements\PasswordConstraintInterface;
use Drupal\password_enhancements\PasswordConstraintPluginManager;
use Drupal\password_enhancements\PasswordPolicy;
use Symfony\Component\Routing\Route;

/**
 * Converts parameters for upcasting password constraint IDs to full objects.
 */
final class PasswordConstraintParamConverter implements ParamConverterInterface {

  /**
   * The role storage service.
   *
   * @var \Drupal\user\RoleStorageInterface
   */
  private $roleStorage;

  /**
   * The constraint plugin manager.
   *
   * @var \Drupal\password_enhancements\PasswordConstraintPluginManager
   */
  private $constraintPluginManager;

  /**
   * Constructs a new PasswordConstraintParamConverter.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   * @param \Drupal\password_enhancements\PasswordConstraintPluginManager $constraint_plugin_manager
   *   The constraint plugin manager.
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager, PasswordConstraintPluginManager $constraint_plugin_manager) {
    $this->roleStorage = $entity_type_manager->getStorage('user_role');
    $this->constraintPluginManager = $constraint_plugin_manager;
  }

  /**
   * {@inheritdoc}
   */
  public function convert($value, $definition, $name, array $defaults): ?PasswordConstraintInterface {
    // Bail out early (with "Page not found") if:
    // ...the password constraint ID or the user role (ID) is missing.
    if (empty($value) || empty($defaults['user_role'])) {
      return NULL;
    }
    // ...the role could not be loaded (does not exist).
    /** @var \Drupal\user\RoleInterface $role */
    $role = $this->roleStorage->load($defaults['user_role']);
    if (!$role) {
      return NULL;
    }
    // ...the role has no password policy.
    $policy = PasswordPolicy::createFromRole($this->constraintPluginManager, $role);
    if (!$policy) {
      return NULL;
    }
    // ...the policy does not have the given constraint (ID).
    $constraints = $policy->getConstraints();
    if (!$constraints->has($value)) {
      return NULL;
    }
    // Do the actual conversion.
    return $constraints->get($value);
  }

  /**
   * {@inheritdoc}
   */
  public function applies($definition, $name, Route $route): bool {
    return (!empty($definition['type']) && $definition['type'] === 'password_constraint');
  }

}
