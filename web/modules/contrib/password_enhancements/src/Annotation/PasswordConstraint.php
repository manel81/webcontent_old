<?php

declare(strict_types = 1);

namespace Drupal\password_enhancements\Annotation;

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

use Drupal\Component\Annotation\Plugin;

/**
 * Defines a password constraint annotation object.
 *
 * Plugin Namespace: Plugin\PasswordConstraint.
 *
 * For a working example, see
 * \Drupal\password_enhancements\Plugin\PasswordConstraint\MinimumCharacters
 *
 * @see hook_password_enhancements_constraint_info_alter()
 * @see \Drupal\password_enhancements\PasswordConstraintInterface
 * @see \Drupal\password_enhancements\Plugin\PasswordConstraint\PasswordConstraintBase
 * @see \Drupal\password_enhancements\PasswordConstraintPluginManager
 * @see plugin_api
 *
 * @Annotation
 */
class PasswordConstraint extends Plugin {

  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * A human-readable name for the constraint.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $name;

  /**
   * A brief description of the password constraint.
   *
   * This will be shown when adding or configuring this password constraint.
   *
   * @var \Drupal\Core\Annotation\Translation
   *   (optional)
   *
   * @ingroup plugin_translatable
   */
  public $description;

  /**
   * Defines whether the plugin can be used only once or multiple times.
   *
   * @var bool
   */
  public $unique;

  /**
   * Library reference that validates the plugin on the front-end.
   *
   * The referenced library has to be defined in the mymodule.libraries.yml
   * file.
   * If your plugin doesn't define a front-end validation for the plugin, then
   * set it to NULL.
   *
   * @var string|null
   */
  public $jsLibrary;

}
