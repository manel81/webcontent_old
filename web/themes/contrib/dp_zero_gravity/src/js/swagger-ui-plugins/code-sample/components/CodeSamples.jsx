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

class CodeSamples extends PureComponent {
  state = {
    activeTab: 0,
  };

  constructor(props) {
    super(props);
    this.id = new Date().getTime();
  }

  handleChange = (event) => {
    this.setState({ activeTab: event.target.value });
  };

  render() {
    const { getComponent, codeBlockItems } = this.props;
    const { activeTab } = this.state;
    const HighlightCode = getComponent('highlightCode');

    return (
      codeBlockItems.length > 0 && (
        <div className="code-samples">
          <label htmlFor={`id-${this.id}`} className="code-samples__title text--lead">
            Code samples
            <select id={`id-${this.id}`} className="code-samples__select" onChange={this.handleChange}>
              {codeBlockItems.map((item, index) => {
                return (
                  <option key={`key-${item.label}`} value={index}>
                    {item.label}
                  </option>
                );
              })}
            </select>
          </label>
          <HighlightCode className="code-samples__content" downloadable value={codeBlockItems[activeTab].content} />
        </div>
      )
    );
  }
}

CodeSamples.propTypes = {
  getComponent: PropTypes.func.isRequired,
  codeBlockItems: PropTypes.arrayOf(
    PropTypes.shape({
      label: PropTypes.string.isRequired,
      content: PropTypes.string.isRequired,
    }),
  ).isRequired,
};

export default CodeSamples;
