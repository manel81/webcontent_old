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

import React, { useEffect, useState, useRef } from 'react';
import PropTypes from 'prop-types';
import axios from 'axios';
import Accordion from '../Accordion/Accordion';
import Tabs from '../Tabs/Tabs';
import Loader from '../Loader/Loader';

const Faq = ({ config }) => {
  const appRoot = window.location.origin;
  const [data, setData] = useState(null);
  const [filters, setFilters] = useState([{ id: 'all', name: 'All', active: true }]);
  const [filter, setFilter] = useState('');
  const accordionRef = useRef(null);

  const handleTabsClick = (e) => {
    e.preventDefault();
    if (filter !== e.currentTarget.dataset.id && accordionRef.current) {
      accordionRef.current.closeAll();
    }
    return setFilter(e.currentTarget.dataset.id);
  };

  useEffect(() => {
    axios.get(`${appRoot}/jsonapi/node/faq_item?include=field_faq_tags&${filter}`).then((response) => {
      if (response.data.included) {
        setFilters([
          ...filters,
          ...response.data.included.map((item) => {
            return {
              id: item.id,
              name: item.attributes.name,
              active: false,
            };
          }),
        ]);
      }
      if (response.data.data) {
        setData(
          response.data.data.map((item) => {
            return {
              id: `${config.id}-${item.attributes.drupal_internal__nid}`,
              title: item.attributes.title,
              body: item.attributes.field_faq_answer.processed,
              // eslint-disable-next-line max-nested-callbacks
              tags: item.relationships.field_faq_tags.data.map((term) => {
                return term.id;
              }),
            };
          }),
        );
      }
    });
  }, []);

  return data ? (
    <>
      {filters.length > 1 && <Tabs items={filters} clickBehavior={handleTabsClick} />}
      {data && (
        <Accordion
          quicklinks={config.quicklinks}
          items={data.filter((el) => {
            if (filter === 'all') {
              return true;
            }
            if (filter) {
              return el.tags.includes(filter);
            }
            return true;
          })}
          ref={accordionRef}
        />
      )}
    </>
  ) : (
    <Loader />
  );
};

Faq.propTypes = {
  config: PropTypes.shape({
    id: PropTypes.string,
    quicklinks: PropTypes.bool,
  }).isRequired,
};

export default Faq;
