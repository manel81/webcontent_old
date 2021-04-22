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
 * @file Utility function to build a className string from a list of strings or conditional strings.
 */

/**
 * Returns a concatenated string of classes.
 *
 * @param {...string|boolean|null} classes Strings or conditional strings.
 * @example
 * classList(['class1', $condition && 'class2']);
 * // returns 'class1 class2' or 'class1'
 * @return {string} The concatenated classes string.
 */
function classList(...classes) {
  return classes
    .filter((item) => {
      return !!item;
    })
    .join(' ');
}

export default classList;
