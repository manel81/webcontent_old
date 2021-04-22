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
import ImPropTypes from 'react-immutable-proptypes';

class ManualCodeSamples extends PureComponent {
  render() {
    const { getComponent, codeSamplesExtension } = this.props;
    const CodeSamples = getComponent('CodeSamples');
    const codeBlockItems = [];

    codeSamplesExtension.forEach((item) => {
      if (item.get('lang') && item.get('source')) {
        codeBlockItems.push({
          label: item.get('lang'),
          content: item.get('source'),
        });
      }
    });

    return <CodeSamples getComponent={getComponent} codeBlockItems={codeBlockItems} />;
  }
}

ManualCodeSamples.propTypes = {
  getComponent: PropTypes.func.isRequired,
  codeSamplesExtension: ImPropTypes.listOf(
    ImPropTypes.contains({
      lang: PropTypes.string.isRequired,
      source: PropTypes.string.isRequired,
    }),
  ).isRequired,
};

export default ManualCodeSamples;
