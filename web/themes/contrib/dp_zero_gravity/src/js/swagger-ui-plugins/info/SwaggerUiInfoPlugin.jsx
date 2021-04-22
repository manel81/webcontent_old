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
import PostmanButton from './components/PostmanButton';
import Info from './wrap-components/Info';
import InfoUrl from './wrap-components/InfoUrl';
import Contact from './components/Contact';
import License from './components/License';

if (!(window.customSwaggerUiPlugins instanceof Object)) {
  window.customSwaggerUiPlugins = {};
}

/**
 * Defines custom plugin for modified Info section.
 *
 * @param {object} system
 *   Global data coming from Swagger UI library.
 * @param {object} config
 *   The config object that is coming from drupalSettings.swaggerUiConfig.
 *
 * @return {Object}
 *   Object with data that will be passed to Swagger UI.
 */
window.customSwaggerUiPlugins.SwaggerUiInfoPlugin = (system, config) => {
  return {
    afterLoad() {
      // At this point in time, your actions have been bound into the system
      // so you can do things with them.
      window.swaggerUiInfoPluginLoaded = true;
    },
    components: {
      PostmanButton: (props) => {
        return <PostmanButton {...props} {...config.postmanButton} />;
      },
      Contact,
      License,
    },
    wrapComponents: {
      info: () => {
        return (props) => {
          return <Info {...props} {...config.info} />;
        };
      },
      InfoUrl: (Original) => {
        return (props) => {
          return <InfoUrl {...props} {...config.infoUrl} original={Original} />;
        };
      },
    },
  };
};
