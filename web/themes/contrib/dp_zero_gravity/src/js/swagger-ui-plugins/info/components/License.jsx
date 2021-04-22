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

class LicenseComponent extends PureComponent {
  render() {
    const { name, url, getComponent } = this.props;
    const Link = getComponent('Link');

    return (
      <div className="info__license">
        {url ? (
          <Link className="has-icon" target="_blank" href={sanitizeUrl(url)}>
            {name}
          </Link>
        ) : (
          <span>{name}</span>
        )}
      </div>
    );
  }
}

LicenseComponent.propTypes = {
  name: PropTypes.string.isRequired,
  url: PropTypes.string,
  getComponent: PropTypes.func.isRequired,
};

LicenseComponent.defaultProps = {
  url: '',
};

export default LicenseComponent;
