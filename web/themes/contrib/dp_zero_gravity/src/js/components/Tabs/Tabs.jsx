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

import React, { useState } from 'react';
import PropTypes from 'prop-types';
import Tab from './Tab';

const Tabs = ({ items, tabType = 'primary', clickBehavior = null }) => {
  const [activeIndex, setActiveIndex] = useState(0);

  const handleClick = (i, e) => {
    e.preventDefault();
    setActiveIndex(i);
  };

  return (
    <nav>
      <ul className={`zg-tabs zg-tabs--${tabType}`}>
        {items.map(({ id, name }, i) => {
          return (
            <Tab
              tabType={tabType}
              key={id}
              handleClick={(e) => {
                handleClick(i, e);
                if (typeof clickBehavior !== 'undefined') {
                  clickBehavior(e);
                }
              }}
              id={id}
              name={name}
              active={activeIndex === i}
            />
          );
        })}
      </ul>
    </nav>
  );
};

Tabs.propTypes = {
  clickBehavior: PropTypes.func,
  tabType: PropTypes.oneOf(['primary', 'secondary']),
  items: PropTypes.arrayOf(
    PropTypes.shape({
      name: PropTypes.string,
      id: PropTypes.string,
      active: PropTypes.bool,
    }),
  ).isRequired,
};

export default Tabs;
