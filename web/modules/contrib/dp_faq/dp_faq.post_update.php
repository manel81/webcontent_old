<?php

/**
 * @file
 * Post update functions for the dp_faq module.
 */

declare(strict_types = 1);

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

use Drupal\views\Views;

/**
 * Remove Devportal FAQ pager. Add sort by title.
 */
function dp_faq_post_update_remove_pager_add_sort_by_title(): string {
  $view = Views::getView('devportal_faq');
  if (!$view) {
    return t('Devportal FAQ View not found!')->render();
  }

  // Remove the pager, clear its options, then set offset option to 0.
  $pager = $view->getDisplay()->getOption('pager');
  $pager['type'] = 'none';
  unset($pager['options']);
  $pager['options']['offset'] = 0;
  $view->getDisplay()->setOption('pager', $pager);

  // Sort by title.
  $sorts = $view->getDisplay()->getOption('sorts');
  $sorts['title'] = [
    'id' => 'title',
    'table' => 'node_field_data',
    'field' => 'title',
    'relationship' => 'none',
    'group_type' => 'group',
    'admin_label' => '',
    'order' => 'ASC',
    'exposed' => FALSE,
    'expose' => [
      'label' => '',
    ],
    'entity_type' => 'node',
    'entity_field' => 'title',
    'plugin_id' => 'standard',
  ];
  $view->getDisplay()->setOption('sorts', $sorts);

  // Save changes.
  $view->save();
  return t('Devportal FAQ View updated.')->render();
}
