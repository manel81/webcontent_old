/*
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

/* eslint-disable max-nested-callbacks */

/**
 * @file
 * Script extensions for the Swagger UI formatter.
 */

window.__assetPath = drupalSettings.assetPath;

// We need to recreate `Drupal.behaviors` object in order to run this behavior
// at the very beginning. The event handler needs to be attached before the
// trigger runs.
(($, Drupal) => {
  Drupal.behaviors.zeroGravitySwaggerUi = {
    attach: (context, drupalSettings) => {
      $(window).on('swaggerUIFormatterOptionsAlter', (event, options) => {
        if (Object.keys(window.customSwaggerUiPlugins).length === 0) {
          return;
        }

        Object.values(window.customSwaggerUiPlugins).forEach((plugin) => {
          if (typeof plugin === 'function') {
            options.plugins.push((system) => {
              return plugin(system, { ...drupalSettings.swaggerUiConfig });
            });
          }
        });
      });
    },
  };
})(jQuery, Drupal);
