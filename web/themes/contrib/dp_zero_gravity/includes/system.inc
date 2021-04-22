<?php

/**
 * @file
 * Theme and preprocess functions for system related components.
 *
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

declare(strict_types = 1);

define('DP_ZERO_GRAVITY_MESSAGE_INFO_ICON', 'info');
define('DP_ZERO_GRAVITY_MESSAGE_SUCCESS_ICON', 'check');
define('DP_ZERO_GRAVITY_MESSAGE_WARNING_ICON', 'bell');
define('DP_ZERO_GRAVITY_MESSAGE_ERROR_ICON', 'alert-circle');

/**
 * Implements hook_preprocess_HOOK().
 */
function dp_zero_gravity_preprocess_status_messages(array &$variables): void {
  $message_list = $variables['message_list'];
  if (isset($message_list)) {
    foreach ($message_list as $type => $message) {
      switch ($type) {
        case 'status':
        case 'success':
          $variables['message_icon'][$type] = DP_ZERO_GRAVITY_MESSAGE_SUCCESS_ICON;
          break;

        case 'error':
          $variables['message_icon'][$type] = DP_ZERO_GRAVITY_MESSAGE_ERROR_ICON;
          break;

        case 'warning':
          $variables['message_icon'][$type] = DP_ZERO_GRAVITY_MESSAGE_WARNING_ICON;
          break;

        case 'info':
          $variables['message_icon'][$type] = DP_ZERO_GRAVITY_MESSAGE_INFO_ICON;
          break;
      }
    }
  }

  // Add headings if they haven't been added when calling the render element.
  if (!empty($variables['status_headings'])) {
    return;
  }

  $variables['status_headings'] = [
    'status' => t('Status message'),
    'error' => t('Error message'),
    'warning' => t('Warning message'),
    'info' => t('Info message'),
  ];
}
