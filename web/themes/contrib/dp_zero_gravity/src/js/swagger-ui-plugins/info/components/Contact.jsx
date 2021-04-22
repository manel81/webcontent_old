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

import React, { PureComponent } from 'react';
import PropTypes from 'prop-types';
import { sanitizeUrl } from '@braintree/sanitize-url';

class ContactComponent extends PureComponent {
  render() {
    const { getComponent, name, url, email } = this.props;
    const Link = getComponent('Link');

    return (
      <div className="info__contact">
        {url && (
          <Link className="has-icon info__website" href={sanitizeUrl(url)} target="_blank">
            {name} - Website
          </Link>
        )}
        {email && (
          <Link className="has-icon info__email" href={sanitizeUrl(`mailto:${email}`)}>
            {url ? `Send email to ${name}` : `Contact ${name}`}
          </Link>
        )}
      </div>
    );
  }
}

ContactComponent.propTypes = {
  name: PropTypes.string,
  url: PropTypes.string,
  email: PropTypes.string,
  getComponent: PropTypes.func.isRequired,
};

ContactComponent.defaultProps = {
  name: 'the developer',
  url: '',
  email: '',
};

export default ContactComponent;
