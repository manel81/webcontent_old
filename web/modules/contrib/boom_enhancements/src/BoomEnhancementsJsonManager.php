<?php

declare(strict_types = 1);

namespace Drupal\boom_enhancements;

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

use Drupal\boom_enhancements\Exceptions\InvalidJsonException;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

/**
 * Class BoomEnhancementsJsonManager.
 */
final class BoomEnhancementsJsonManager {

  /**
   * JsonDecode object.
   *
   * @var \Symfony\Component\Serializer\Encoder\JsonDecode
   */
  private $jsonDecode;

  /**
   * The BoomEnhancementsJsonManager constructor.
   */
  public function __construct() {
    $this->jsonDecode = new JsonDecode();
  }

  /**
   * Decode the contents of a valid JSON file.
   *
   * @param string $path
   *   The path to the file.
   * @param string $file_name
   *   The name of the file. This parameter remains here if in a later
   *   implementation different filenames could be used as well.
   *
   * @return array
   *   The validated contents of the file.
   *
   * @throws \Drupal\guides\Exception\FileNotFoundException
   *   Thrown when no JSON file is found.
   * @throws \Drupal\boom_enhancements\Exceptions\InvalidJsonException
   *   Thrown when the parsed JSON file is invalid.
   */
  public function decode(string $path, string $file_name): array {
    $file_path = $path . DIRECTORY_SEPARATOR . $file_name;

    // If no files are found, throw an exception.
    if (!file_exists($file_path)) {
      throw new FileNotFoundException($file_path);
    }

    try {
      $json = $this->jsonDecode->decode(file_get_contents($file_path), 'json', [
        'json_decode_associative' => TRUE,
      ]);
    }
    catch (NotEncodableValueException $e) {
      throw new InvalidJsonException('There was an issue parsing the JSON file: ' . $e->getMessage(), $e->getCode(), $e);
    }

    return $json;
  }

}
