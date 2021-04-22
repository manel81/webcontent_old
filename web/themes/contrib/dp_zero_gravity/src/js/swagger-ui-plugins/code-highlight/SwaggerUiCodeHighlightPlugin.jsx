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

/* eslint "react/jsx-props-no-spreading": [0] */

import React from 'react';
import HighlightCode from './wrap-components/HighlightCode';
import Lowlight from './components/Lowlight';

// eslint-disable-next-line camelcase,no-global-assign,no-undef
__webpack_public_path__ = window.__assetPath;

if (!(window.customSwaggerUiPlugins instanceof Object)) {
  window.customSwaggerUiPlugins = {};
}

/**
 * Defines custom plugin for code highlighting.
 *
 * @param {object} system
 *   Global data coming from Swagger UI library.
 * @param {object} config
 *   The config object that is coming from drupalSettings.swaggerUiConfig.
 *
 * @return {Object}
 *   Object with data that will be passed to Swagger UI.
 */
window.customSwaggerUiPlugins.SwaggerUiCodeHighlightPlugin = (system, config) => {
  return {
    afterLoad() {
      // At this point in time, your actions have been bound into the system
      // so you can do things with them.
      window.swaggerUiCodeHighlightPluginLoaded = true;
    },
    components: {
      Lowlight: (props) => {
        return <Lowlight {...props} {...config.lowlight} />;
      },
    },
    wrapComponents: {
      highlightCode: () => {
        return (props) => {
          return <HighlightCode {...props} {...config.highlight} getComponent={system.getComponent} />;
        };
      },
    },
  };
};
