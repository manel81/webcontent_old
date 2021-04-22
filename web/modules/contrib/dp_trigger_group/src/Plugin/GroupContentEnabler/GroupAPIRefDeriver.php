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

use Drupal\Component\Plugin\Derivative\DeriverBase;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\node\Entity\NodeType;

/**
 * Derives group plugins for api references.
 */
class GroupAPIRefDeriver extends DeriverBase {

  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  public function getDerivativeDefinitions($base_plugin_definition): array {
    foreach (NodeType::loadMultiple() as $name => $type) {
      /** @var \Drupal\node\Entity\NodeType $type */
      $label = $type->label();

      $this->derivatives[$name] = [
        'entity_bundle' => $name,
        'label' => $this->t('Group API Reference (%type)', [
          '%type' => $label,
        ]),
        'description' => $this->t('Adds %type API Reference to groups both publicly and privately.', [
          '%type' => $label,
        ]),
      ] + $base_plugin_definition;
    }

    return $this->derivatives;
  }

}
