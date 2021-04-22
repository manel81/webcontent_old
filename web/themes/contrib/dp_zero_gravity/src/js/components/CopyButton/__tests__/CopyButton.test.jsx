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
import CopyButton from '../CopyButton';

const copyTooltipClass = '.zg-tooltip--copy';
const quicklinkClass = '.zg-accordion__quicklink';
const copyMessageTimer = 2000;
window.prompt = jest.fn();

jest.mock('copy-to-clipboard', () => {
  return jest.fn();
});

beforeEach(() => {
  jest.useFakeTimers();
});

test('copy message', () => {
  const { container } = render(<CopyButton copyText="Text copied to clipboard." />);
  const copyButton = container.querySelector(quicklinkClass);
  let copyTooltip = container.querySelector(copyTooltipClass);
  expect(copyTooltip).toBeNull();

  act(() => {
    userEvent.click(copyButton);
  });
  expect(setTimeout).toHaveBeenCalled();
  expect(setTimeout).toHaveBeenLastCalledWith(expect.any(Function), copyMessageTimer);

  copyTooltip = container.querySelector(copyTooltipClass);
  expect(copyTooltip).toBeTruthy();
  act(() => {
    jest.advanceTimersByTime(copyMessageTimer);
  });
  copyTooltip = container.querySelector(copyTooltipClass);
  expect(copyTooltip).toBeNull();
});

// Running all pending timers and switching to real timers using Jest
afterEach(() => {
  jest.runOnlyPendingTimers();
  jest.useRealTimers();
});
