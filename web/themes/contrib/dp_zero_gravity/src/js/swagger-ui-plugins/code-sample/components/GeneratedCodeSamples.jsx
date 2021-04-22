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
import OpenAPISnippet from 'openapi-snippet';

class GeneratedCodeSamples extends PureComponent {
  getGeneratedCodeSamples = () => {
    const { specJson, path, method, targets } = this.props;
    const generatedCodeSamples = {};
    try {
      const result = OpenAPISnippet.getEndpointSnippets(specJson, path, method, targets, {});
      result.snippets.forEach((item) => {
        generatedCodeSamples[item.id] = {
          label: item.title.split('+')[0].trim().toUpperCase(),
          content: item.content,
        };
      });
    } catch (err) {
      // eslint-disable-next-line no-console
      console.error(err);
    }
    return generatedCodeSamples;
  };

  getManualCodeSamples = () => {
    const { codeSamplesExtension } = this.props;
    const manualCodeSamples = {};

    if (codeSamplesExtension) {
      codeSamplesExtension.forEach((item) => {
        if (item.get('lang') && item.get('source')) {
          const key = item.get('langKey') || item.get('lang');
          manualCodeSamples[key] = {
            label: item.get('lang'),
            content: item.get('source'),
          };
        }
      });
    }
    return manualCodeSamples;
  };

  render() {
    const { getComponent } = this.props;
    const CodeSamples = getComponent('CodeSamples');
    const codeBlockItems = Object.values({ ...this.getGeneratedCodeSamples(), ...this.getManualCodeSamples() });
    return codeBlockItems.length > 0 ? (
      <CodeSamples getComponent={getComponent} codeBlockItems={codeBlockItems} />
    ) : null;
  }
}

GeneratedCodeSamples.propTypes = {
  getComponent: PropTypes.func.isRequired,
  codeSamplesExtension: ImPropTypes.listOf(
    ImPropTypes.contains({
      lang: PropTypes.string.isRequired,
      source: PropTypes.string.isRequired,
    }),
  ),
  // eslint-disable-next-line react/forbid-prop-types
  specJson: PropTypes.object.isRequired,
  path: PropTypes.string.isRequired,
  method: PropTypes.string.isRequired,
  targets: PropTypes.objectOf(PropTypes.string).isRequired,
};

GeneratedCodeSamples.defaultProps = {
  codeSamplesExtension: null,
};

export default GeneratedCodeSamples;
