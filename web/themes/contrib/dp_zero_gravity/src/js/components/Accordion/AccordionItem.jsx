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

import React, { useState, useRef, useEffect } from 'react';
import PropTypes from 'prop-types';
import CopyButton from '../CopyButton/CopyButton';
import Markup from '../Markup/Markup';
import classList from '../../utility/classList';

const AccordionItem = ({
  title,
  body,
  id,
  handleClick,
  className = 'zg-accordion__item',
  quicklinks = false,
  active = false,
}) => {
  const [copyText, setCopyText] = useState(null);
  const ref = useRef(null);

  useEffect(() => {
    setCopyText(ref.current.href);
  }, []);
  return (
    <div className={classList(className, active && 'zg-accordion--active')}>
      <a ref={ref} className="zg-accordion__header" href={`#${id}`} id={id} onClick={handleClick}>
        <span>{title}</span>
        {quicklinks && active && <CopyButton copyText={copyText} />}
        <span className="zg-accordion__toggle" />
      </a>
      {active ? <Markup className="zg-accordion__body" html={body} /> : null}
    </div>
  );
};

AccordionItem.propTypes = {
  quicklinks: PropTypes.bool,
  active: PropTypes.bool,
  className: PropTypes.string,
  title: PropTypes.string.isRequired,
  body: PropTypes.node.isRequired,
  id: PropTypes.string.isRequired,
  handleClick: PropTypes.func,
};

export default AccordionItem;
