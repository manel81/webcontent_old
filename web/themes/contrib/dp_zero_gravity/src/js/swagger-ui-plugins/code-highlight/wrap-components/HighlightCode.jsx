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

import React, { Component } from 'react';
import PropTypes from 'prop-types';
import saveAs from 'js-file-download';
import { CopyToClipboard } from 'react-copy-to-clipboard';

class CustomHighlightCodeComponent extends Component {
  state = {
    copied: false,
  };

  downloadText = () => {
    const { value, fileName } = this.props;
    saveAs(value, fileName);
  };

  copyText = () => {
    this.setState({ copied: true });
    setInterval(() => {
      return this.setState({ copied: false });
    }, 5000);
  };

  render() {
    const { value, downloadable, copiable, downloadIcon, copyIcon, getComponent } = this.props;
    let { className } = this.props;
    className = className || '';
    const Lowlight = getComponent('Lowlight');
    const { copied } = this.state;

    return (
      <div className={['highlighted-code', className].join(' ')}>
        <div className="highlighted-code__buttons">
          {downloadable ? (
            <button
              type="button"
              data-title="Download"
              className="highlighted-code__download"
              onClick={this.downloadText}
            >
              <span className="highlighted-code__download-text">
                <span className={downloadIcon} />
                Download
              </span>
            </button>
          ) : null}

          {copiable ? (
            <CopyToClipboard text={value} onCopy={this.copyText}>
              <button type="button" data-title="Copy" className="highlighted-code__copy">
                <span className="highlighted-code__copy-text">
                  <span className={copyIcon} />
                  Copy
                </span>
                {copied ? <span className="highlighted-code__copy-tooltip tooltip">Copied</span> : null}
              </button>
            </CopyToClipboard>
          ) : null}
        </div>
        <Lowlight value={value} />
      </div>
    );
  }
}

CustomHighlightCodeComponent.propTypes = {
  getComponent: PropTypes.func.isRequired,
  value: PropTypes.string.isRequired,
  className: PropTypes.string,
  fileName: PropTypes.string,
  downloadable: PropTypes.bool,
  copiable: PropTypes.bool,
  downloadIcon: PropTypes.string,
  copyIcon: PropTypes.string,
};

CustomHighlightCodeComponent.defaultProps = {
  className: '',
  fileName: 'response.txt',
  downloadable: false,
  copiable: false,
  downloadIcon: '',
  copyIcon: '',
};

export default CustomHighlightCodeComponent;
