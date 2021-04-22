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

import React from 'react';
import { act } from 'react-dom/test-utils';
import { render } from '@testing-library/react';
import '@testing-library/jest-dom';
import userEvent from '@testing-library/user-event';
import Accordion from '../Accordion';

const quicklinkClass = '.zg-accordion__quicklink';

const items = [
  { id: 'accordion-1', title: 'Accordion 1', body: '<p>This body contains html</p>' },
  { id: 'accordion-2', title: 'Accordion 2', body: '<p>This body contains html</p>' },
  { id: 'accordion-3', title: 'Accordion 3', body: '<p>This body contains html</p>' },
];

test('accordion without quicklinks', () => {
  const { container } = render(<Accordion items={items} />);
  act(() => {
    userEvent.click(container.querySelector(`#${items[0].id}`));
  });

  const copyButton = container.querySelector(quicklinkClass);
  expect(copyButton).toBeNull();
});

test('accordion with quicklinks', () => {
  const { container } = render(<Accordion items={items} quicklinks />);
  act(() => {
    userEvent.click(container.querySelector(`#${items[0].id}`));
  });

  const copyButton = container.querySelector(quicklinkClass);
  expect(copyButton).toBeTruthy();
});
