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
 * @file A utiltiy function to substitute Drupal's translate function.
 */

/* eslint-disable import/no-mutable-exports */

/**
 * A substitute for Drupal's translate - t() - function.
 *
 * @param {string} string The string to be returned.
 * @return {string} The given string.
 */
let t = (string) => {
  return string;
};

if (typeof Drupal !== 'undefined' && typeof Drupal.t !== 'undefined') {
  t = Drupal.t;
}

export default t;
