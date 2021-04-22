<?php

declare(strict_types = 1);

namespace Drupal\guides;

/**
 * Copyright (C) 2019 PRONOVIX GROUP BVBA.
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
 * Defines an interface for guides storage classes.
 */
interface GuidesStorageInterface {

  /**
   * Gets the path of the guides files which are in the guides subdirectories.
   *
   * The returned list of files may contain paths of files that does not
   * actually exist in the filesystem.
   *
   * @return array
   *   The array of the paths of the guides files.
   */
  public function getFilePaths(): array;

  /**
   * Get the real file system path based off url parameters.
   *
   * @param string $dir_parameter
   *   The 'dir' parameter in the url.
   * @param string $file_parameter
   *   The 'file' parameter in the url.
   *
   * @return string
   *   The path for the file in the file system.
   */
  public function getFilePath(string $dir_parameter, string $file_parameter): string;

  /**
   * Gets the content of the given file.
   *
   * Parses a markdown file or throws an exception if the file doesn't exist or
   * can't be parsed.
   *
   * @param string $path
   *   The relative path of the guides file without extension.
   *
   * @return string
   *   The content of the file or an exception.
   *
   * @throws \Drupal\guides\Exception\FileNotFoundException
   *   Thrown if the file with the given name and subdirectory is not found.
   */
  public function getFileContent(string $path): string;

  /**
   * Gets the links of the guides files.
   *
   * @return array
   *   The array of the links of the files.
   */
  public function getLinks(): array;

}
