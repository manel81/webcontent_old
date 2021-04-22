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

/**
 * @file
 * Set the is-active class on <a>
 * menu elements that trigger redirect in Drupal - they don't work
 * with core/misc/ąctive-link.js
 */

/**
 * Set 'is-active' class on a menu account link manually if needed
 *
 * @type {Drupal~behavior}
 *
 * @property {Drupal~behaviorAttach} attach
 * Attaches in_page_navigation behaviors.
 */

Drupal.behaviors.zgActiveLinks = {
  attach: () => {
    const navigation = document.getElementById('navigation');
    if (navigation.querySelectorAll('a.is-active').length > 0) {
      return;
    }

    let linkToActivate = null;
    const currentPath = window.location.pathname;
    const urlsToCheck = [
      {
        regex: /^\/user\/\d+\/apps$/g,
        href: '/user/apps',
      },
      {
        regex: /^\/user\/\d+$/g,
        href: '/user',
      },
    ];
    navigation.querySelectorAll('.menu li > a').forEach((link) => {
      const href = link.getAttribute('href');
      urlsToCheck.push({
        regex: new RegExp(`^${href}.*$`, 'g'),
        href,
      });
    });
    for (let i = 0; i < urlsToCheck.length; i++) {
      if (urlsToCheck[i].regex.test(currentPath)) {
        linkToActivate = urlsToCheck[i].href;
        break;
      }
    }
    if (linkToActivate) {
      navigation.querySelector(`a[href="${linkToActivate}"]`).classList.add('is-active');
    }
  },
};
