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

import React from 'react';
import sanitizeHtml from 'sanitize-html';
import PropTypes from 'prop-types';

const defaultOptions = {
  allowedTags: [
    'a',
    'em',
    'strong',
    'cite',
    'blockquote',
    'code',
    'ul',
    'ol',
    'li',
    'dl',
    'dt',
    'dd',
    'h1',
    'h2',
    'h3',
    'h4',
    'h5',
    'h6',
    'p',
    'div',
    'br',
    'span',
    'img',
    'hr',
    'table',
    'caption',
    'tbody',
    'thead',
    'tfoot',
    'th',
    'td',
    'tr',
    'u',
    's',
  ],
  allowedAttributes: {
    '*': ['class', 'id'],
    a: ['href', 'hreflang', 'target'],
    blockquote: ['cite'],
    ul: ['class', 'type'],
    ol: ['class', 'type', 'start'],
    img: ['src', 'alt', 'height', 'width', 'data-entity-type', 'data-entity-uuid', 'data-align', 'data-caption'],
  },
};

const markup = (dirty, options) => {
  return {
    __html: sanitizeHtml(dirty, { ...defaultOptions, ...options }),
  };
};

const Markup = ({ html = null, options, className }) => {
  // eslint-disable-next-line react/no-danger
  return <div className={className} dangerouslySetInnerHTML={markup(html, options)} />;
};

Markup.propTypes = {
  html: PropTypes.node,
  options: PropTypes.shape({
    allowedTags: PropTypes.arrayOf(PropTypes.string),
    disallowedTagsMode: PropTypes.string,
    allowedAttributes: PropTypes.objectOf(PropTypes.objectOf(PropTypes.arrayOf(PropTypes.string))),
    allowedClasses: PropTypes.objectOf(PropTypes.objectOf(PropTypes.arrayOf(PropTypes.string))),
    allowedStyles: PropTypes.objectOf(PropTypes.objectOf(PropTypes.arrayOf(PropTypes.instanceOf(RegExp)))),
    selfClosing: PropTypes.arrayOf(PropTypes.string),
    allowedSchemes: PropTypes.arrayOf(PropTypes.string),
    allowedSchemesByTag: PropTypes.objectOf(PropTypes.objectOf(PropTypes.arrayOf(PropTypes.string))),
    allowedSchemesAppliedToAttributes: PropTypes.arrayOf(PropTypes.string),
    allowedIframeHostnames: PropTypes.arrayOf(PropTypes.string),
    allowedIframeDomains: PropTypes.arrayOf(PropTypes.string),
    allowProtocolRelative: PropTypes.bool,
    enforceHtmlBoundary: PropTypes.bool,
  }),
  className: PropTypes.string,
};

export default Markup;
