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

/* eslint "react/forbid-prop-types": [1, { "forbid": ["any", "array"] }] */
import React, { PureComponent } from 'react';
import PropTypes from 'prop-types';
import ImPropTypes from 'react-immutable-proptypes';
import { sanitizeUrl } from '@braintree/sanitize-url';

class CustomInfoComponent extends PureComponent {
  render() {
    const {
      info,
      url,
      host,
      basePath,
      getComponent,
      externalDocs,
      showTitle,
      showDescription,
      postmanButtonEnabled,
    } = this.props;
    const version = info.get('version');
    const description = info.get('description');
    const title = info.get('title');
    const termsOfService = info.get('termsOfService');
    const contact = info.get('contact');
    const license = info.get('license');
    const postmanButtonCollectionId = info.get('x-postman-collection-id');
    const externalDocsUrl = externalDocs.get('url');
    const externalDocsDescription = externalDocs.get('description');
    const Markdown = getComponent('Markdown');
    const Link = getComponent('Link');
    const VersionStamp = getComponent('VersionStamp');
    const InfoUrl = getComponent('InfoUrl');
    const InfoBasePath = getComponent('InfoBasePath');
    const Contact = getComponent('Contact');
    const License = getComponent('License');
    const PostmanButton = getComponent('PostmanButton');

    return (
      <div className="info">
        <hgroup className="main">
          {showTitle && (
            <h2 className="title">
              {title}
              {version && <VersionStamp version={version} />}
            </h2>
          )}
          {host || basePath ? <InfoBasePath host={host} basePath={basePath} /> : null}
          {url && <InfoUrl getComponent={getComponent} url={url} />}
          {postmanButtonEnabled && postmanButtonCollectionId && (
            <PostmanButton collectionId={postmanButtonCollectionId} />
          )}
        </hgroup>
        {showDescription && (
          <div className="description">
            <Markdown source={description} />
          </div>
        )}
        {termsOfService && (
          <div className="info__tos">
            <Link className="has-icon" target="_blank" href={sanitizeUrl(termsOfService)}>
              Terms of service
            </Link>
          </div>
        )}
        {contact && contact.size && (
          <Contact
            getComponent={getComponent}
            name={contact.get('name')}
            url={contact.get('url')}
            email={contact.get('email')}
          />
        )}
        {license && license.size && (
          <License getComponent={getComponent} name={license.get('name')} url={license.get('url')} />
        )}
        {externalDocsUrl && (
          <Link className="info__extdocs has-icon" target="_blank" href={sanitizeUrl(externalDocsUrl)}>
            {externalDocsDescription || externalDocsUrl}
          </Link>
        )}
      </div>
    );
  }
}

CustomInfoComponent.propTypes = {
  info: PropTypes.object,
  url: PropTypes.string.isRequired,
  host: PropTypes.string,
  basePath: PropTypes.string,
  externalDocs: ImPropTypes.map,
  getComponent: PropTypes.func.isRequired,
  showTitle: PropTypes.bool,
  showDescription: PropTypes.bool,
  postmanButtonEnabled: PropTypes.bool,
};

CustomInfoComponent.defaultProps = {
  info: {},
  host: '',
  basePath: '',
  externalDocs: '',
  showTitle: true,
  showDescription: true,
  postmanButtonEnabled: false,
};

export default CustomInfoComponent;
