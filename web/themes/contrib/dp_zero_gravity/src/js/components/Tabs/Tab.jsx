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
import PropTypes from 'prop-types';
import classList from '../../utility/classList';

const Tab = ({
  activeClass = 'zg-active',
  tabType = 'primary',
  active = false,
  id = null,
  name = null,
  handleClick = null,
}) => {
  return (
    <li className={classList(`zg-tabs--${tabType}__item`, tabType === 'secondary' && active && activeClass)}>
      <button
        type="button"
        data-id={id}
        onClick={handleClick}
        className={classList(`zg-tabs--${tabType}__link`, tabType === 'primary' && active && activeClass)}
      >
        {name}
      </button>
    </li>
  );
};

Tab.propTypes = {
  active: PropTypes.bool,
  id: PropTypes.string,
  name: PropTypes.string,
  handleClick: PropTypes.func,
  activeClass: PropTypes.string,
  tabType: PropTypes.oneOf(['primary', 'secondary']),
};

export default Tab;
