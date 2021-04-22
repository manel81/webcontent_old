<?php

declare(strict_types = 1);

/**
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

namespace Drupal\in_page_navigation;

/**
 * In page navigation configuration.
 *
 * @internal
 *
 * @group domain
 */
final class InPageNavigationConfiguration {

  /**
   * The DOM selector(s) to be used.
   *
   * @var string
   */
  private $domSelector;

  /**
   * The scroll offset.
   *
   * @var int
   */
  private $scrollOffset;

  /**
   * Constructs a new object.
   *
   * @param string $dom_selector
   *   The DOM selector.
   * @param int $scroll_offset
   *   The scroll offset.
   */
  public function __construct(string $dom_selector, int $scroll_offset) {
    $this->domSelector = $dom_selector;
    $this->scrollOffset = $scroll_offset;
  }

  /**
   * The DOM selector.
   *
   * @return string
   *   The DOM selector.
   */
  public function domSelector(): string {
    return $this->domSelector;
  }

  /**
   * The scroll offset.
   *
   * @return int
   *   The scroll offset.
   */
  public function scrollOffset(): int {
    return $this->scrollOffset;
  }

}
