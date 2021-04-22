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

/* eslint "react/forbid-prop-types": [1, { "forbid": ["any"] }] */

import React from 'react';
import PropTypes from 'prop-types';
import ImPropTypes from 'react-immutable-proptypes';

const CustomParametersComponent = ({
  onTryoutClick,
  onCancelClick,
  parameters,
  allowTryItOut,
  tryItOutEnabled,
  specPath,
  fn,
  getComponent,
  getConfigs,
  specSelectors,
  specActions,
  pathMethod,
  oas3Actions,
  oas3Selectors,
  operation,
  onChangeKey,
  original: Original,
  manualCodeSamplesEnabled,
  generatedCodeSamplesEnabled,
}) => {
  const specJson = specSelectors.specJson();
  const ManualCodeSamples = getComponent('ManualCodeSamples');
  const GeneratedCodeSamples = getComponent('GeneratedCodeSamples');
  const path = specPath.get(1);
  const method = specPath.get(2);
  const codeSamplesExtension = specJson.get('paths').get(path).get(method).get('x-code-samples');
  return (
    <div>
      <Original
        parameters={parameters}
        specPath={specPath}
        operation={operation}
        onChangeKey={onChangeKey}
        onTryoutClick={onTryoutClick}
        onCancelClick={onCancelClick}
        tryItOutEnabled={tryItOutEnabled}
        allowTryItOut={allowTryItOut}
        fn={fn}
        getComponent={getComponent}
        specActions={specActions}
        specSelectors={specSelectors}
        pathMethod={pathMethod}
        getConfigs={getConfigs}
        oas3Actions={oas3Actions}
        oas3Selectors={oas3Selectors}
      />
      {!tryItOutEnabled && generatedCodeSamplesEnabled ? (
        <GeneratedCodeSamples
          getComponent={getComponent}
          codeSamplesExtension={manualCodeSamplesEnabled && codeSamplesExtension ? codeSamplesExtension : null}
          specJson={specSelectors.specJson().toJS()}
          path={path}
          method={method}
        />
      ) : (
        !tryItOutEnabled &&
        manualCodeSamplesEnabled &&
        codeSamplesExtension && (
          <ManualCodeSamples getComponent={getComponent} codeSamplesExtension={codeSamplesExtension} />
        )
      )}
    </div>
  );
};

CustomParametersComponent.propTypes = {
  parameters: ImPropTypes.list.isRequired,
  operation: PropTypes.object.isRequired,
  specActions: PropTypes.object.isRequired,
  getComponent: PropTypes.func.isRequired,
  specSelectors: PropTypes.object.isRequired,
  oas3Actions: PropTypes.object.isRequired,
  oas3Selectors: PropTypes.object.isRequired,
  fn: PropTypes.object.isRequired,
  tryItOutEnabled: PropTypes.bool,
  allowTryItOut: PropTypes.bool,
  onTryoutClick: PropTypes.func,
  onCancelClick: PropTypes.func,
  onChangeKey: PropTypes.array,
  pathMethod: PropTypes.array.isRequired,
  getConfigs: PropTypes.func.isRequired,
  specPath: ImPropTypes.list,
  original: PropTypes.func.isRequired,
  manualCodeSamplesEnabled: PropTypes.bool,
  generatedCodeSamplesEnabled: PropTypes.bool,
};

CustomParametersComponent.defaultProps = {
  onTryoutClick: Function.prototype,
  onCancelClick: Function.prototype,
  tryItOutEnabled: false,
  allowTryItOut: true,
  onChangeKey: [],
  specPath: [],
  manualCodeSamplesEnabled: false,
  generatedCodeSamplesEnabled: false,
};

export default CustomParametersComponent;
