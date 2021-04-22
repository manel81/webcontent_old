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

/* eslint-disable react/require-default-props */
import React, { useEffect, useState, useImperativeHandle, forwardRef } from 'react';
import PropTypes from 'prop-types';
import AccordionItem from './AccordionItem';
import scrollTo from '../../utility/scrollTo';

const Accordion = forwardRef(({ items, quicklinks = false, className = 'zg-accordion' }, ref) => {
  const [activeId, setActiveId] = useState(null);

  const handleClick = (e) => {
    e.preventDefault();
    const currentId = e.currentTarget.id;
    if (activeId === currentId) {
      setActiveId(null);
    } else {
      setActiveId(currentId);
    }
  };

  useImperativeHandle(ref, () => {
    return {
      closeAll: () => {
        setActiveId(null);
      },
    };
  });

  useEffect(() => {
    const hash = window.location.hash.substr(1);
    if (activeId === null && hash) {
      setActiveId(hash);
    }
    if (hash) {
      const el = document.getElementById(hash);
      if (el) {
        scrollTo(el);
      }
    }
  }, []);

  return (
    <div className={className}>
      {items.map(({ id, title, body }) => {
        return (
          <AccordionItem
            quicklinks={quicklinks}
            active={activeId === id}
            key={id}
            id={id}
            title={title}
            body={body}
            handleClick={handleClick}
          />
        );
      })}
    </div>
  );
});

Accordion.propTypes = {
  items: PropTypes.arrayOf(
    PropTypes.shape({
      id: PropTypes.string,
      title: PropTypes.string,
      body: PropTypes.node,
    }),
  ).isRequired,
  quicklinks: PropTypes.bool,
  className: PropTypes.string,
};

export default Accordion;
