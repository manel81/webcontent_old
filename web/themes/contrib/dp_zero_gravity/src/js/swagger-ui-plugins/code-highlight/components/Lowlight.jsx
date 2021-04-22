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

import Lowlight from 'react-lowlight';
import 'highlight.js/styles/github.css';
import React, { PureComponent } from 'react';
import PropTypes from 'prop-types';

class LowlightComponent extends PureComponent {
  state = {
    finishedRegistering: false,
  };

  constructor(props) {
    super(props);
    this.processedLangs = {};
    props.langs.forEach((lang) => {
      this.processedLangs[lang] = false;
    });
  }

  componentDidMount() {
    const { langs } = this.props;
    langs.forEach((lang) => {
      import(/* webpackChunkName: "lowLang-[request]" */ `highlight.js/lib/languages/${lang}`)
        .then(({ default: langImport }) => {
          Lowlight.registerLanguage(lang, langImport);
          this.processedLangs[lang] = true;
          if (!Object.values(this.processedLangs).includes(false)) {
            this.setState({ finishedRegistering: true });
          }
        })
        .catch((e) => {
          this.processedLangs[lang] = true;
          // eslint-disable-next-line no-console
          console.error(e);
        });
    });
  }

  render() {
    const { value } = this.props;
    const { finishedRegistering } = this.state;
    return finishedRegistering ? <Lowlight value={value} /> : <pre>{value}</pre>;
  }
}

LowlightComponent.propTypes = {
  langs: PropTypes.arrayOf(PropTypes.string).isRequired,
  value: PropTypes.string.isRequired,
};

export default LowlightComponent;
