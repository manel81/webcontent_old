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

import React, { useState, useEffect } from 'react';
import PropTypes from 'prop-types';
import CopyToClipboard from 'react-copy-to-clipboard';
import classList from '../../utility/classList';
import t from '../../utility/translate';

const CopyButton = ({ copyText }) => {
  const [showMessage, setShowMessage] = useState(false);

  useEffect(() => {
    let timer;
    if (showMessage) {
      timer = setTimeout(() => {
        setShowMessage(false);
      }, 2000);
    }

    return () => {
      clearTimeout(timer);
    };
  }, [showMessage]);

  const handleCopy = () => {
    setShowMessage(true);
  };

  const handleClick = (e) => {
    e.preventDefault();
    e.stopPropagation();
  };

  return (
    <>
      <CopyToClipboard onCopy={handleCopy} text={copyText}>
        <button onClick={handleClick} className="zg-accordion__quicklink" type="button" data-tooltip={t('Copy link')}>
          {t('Copy to clipboard')}
          <span className="zg-icon--copy" />
        </button>
      </CopyToClipboard>
      {showMessage && (
        <div
          className={classList(
            'zg-tooltip',
            'zg-tooltip--copy',
            !showMessage && 'zg-hidden',
            showMessage && 'zg-fadeout',
          )}
        >
          {t('Link copied to clipboard.')}
        </div>
      )}
    </>
  );
};

CopyButton.propTypes = {
  copyText: PropTypes.string,
};

export default CopyButton;
