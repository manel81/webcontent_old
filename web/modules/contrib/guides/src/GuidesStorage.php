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

use Drupal\Core\Cache\CacheBackendInterface;
use Drupal\Core\Link;
use Drupal\Core\Site\Settings;
use Drupal\guides\Exception\FileNotFoundException;

/**
 * Defines GuidesStorage for Guides files, links and directories.
 */
final class GuidesStorage implements GuidesStorageInterface {

  /**
   * The settings of the site.
   *
   * @var \Drupal\Core\Site\Settings
   */
  private $settings;

  /**
   * The cache backend service.
   *
   * @var \Drupal\Core\Cache\CacheBackendInterface
   */
  private $cacheBackend;

  /**
   * GuidesStorage constructor.
   *
   * @param \Drupal\Core\Site\Settings $settings
   *   The settings of the site.
   * @param \Drupal\Core\Cache\CacheBackendInterface $cache_backend
   *   The cache backend.
   */
  public function __construct(Settings $settings, CacheBackendInterface $cache_backend) {
    $this->settings = $settings;
    $this->cacheBackend = $cache_backend;
  }

  /**
   * Prepare a URL friendly string.
   *
   * @param string $parameter
   *   The string to transform.
   *
   * @return string
   *   The transformed string.
   */
  private function prepareParameter(string $parameter): string {
    return strtolower(str_replace('_', '-', preg_replace('/^(\d*_)/', '', $parameter)));
  }

  /**
   * Prepare a human readable title.
   *
   * @param string $title
   *   The string to transform.
   *
   * @return string
   *   The transformed string.
   */
  private function prepareHumanReadableTitle(string $title): string {
    return str_replace('_', ' ', preg_replace('/^(\d*_)/', '', $title));
  }

  /**
   * {@inheritdoc}
   */
  private function getDirectory(): string {
    return DRUPAL_ROOT . ($this->settings->get('guides_dir') ?? '/guides');
  }

  /**
   * {@inheritdoc}
   */
  public function getFilePaths(): array {
    $directory = $this->getDirectory();
    $cid = 'guides_files:' . $directory;
    $data_cached = $this->cacheBackend->get($cid);

    if ($data_cached) {
      $guides = $data_cached->data;
    }
    else {
      $guides = [];

      if (file_exists($directory)) {
        $iterator = new \RecursiveDirectoryIterator($directory, \FilesystemIterator::CURRENT_AS_FILEINFO | \FilesystemIterator::SKIP_DOTS);
        $filter = new \RecursiveCallbackFilterIterator($iterator, static function (\SplFileInfo $current, string $key, \RecursiveIterator $iterator): bool {
          if ($iterator->hasChildren()) {
            return TRUE;
          }
          $path = $current->getPathname();
          if (is_file($path)) {
            return $current->getExtension() === 'md';
          }

          return FALSE;
        });

        $files = new \RecursiveIteratorIterator($filter);
        foreach ($files as $md) {
          if ($files->getDepth() === 1) {
            $path = $md->getPathname();
            if (isset($guides[$md->getPath()])) {
              $guides[$md->getPath()]['files'][] = $md->getBasename('.md');
            }
            else {
              $guides[$md->getPath()] = [
                'dir' => basename(dirname($path)),
                'files' => [$md->getBasename('.md')],
              ];
            }
          }
        }
      }

      ksort($guides);
      $this->cacheBackend->set($cid, $guides);
    }

    return $guides;
  }

  /**
   * {@inheritdoc}
   */
  public function getFilePath(string $dir_parameter, string $file_parameter): string {
    $file_path = NULL;

    foreach ($this->getFilePaths() as $path => $parameters) {
      if ($this->prepareParameter($parameters['dir']) === $dir_parameter) {
        foreach ($parameters['files'] as $file) {
          if ($this->prepareParameter($file) === $file_parameter) {
            $file_path = $path . DIRECTORY_SEPARATOR . $file . '.md';
            break 2;
          }
        }
      }
    }

    if ($file_path !== NULL && file_exists($file_path)) {
      return $file_path;
    }

    // If the file does not exist, then the cache contains invalid data, so it
    // has to be rebuilt.
    $this->cacheBackend->deleteAll();
    throw new FileNotFoundException($file_path);
  }

  /**
   * {@inheritdoc}
   */
  public function getFileContent(string $path): string {
    return str_replace('@guide_path', substr(dirname($path), strlen(DRUPAL_ROOT)), file_get_contents($path));
  }

  /**
   * {@inheritdoc}
   */
  public function getLinks(): array {
    $guides_files = $this->getFilePaths();
    $guides = [];

    foreach ($guides_files as $path => $parameters) {
      $guide_list = [
        '#theme' => 'item_list',
        '#title' => $this->prepareHumanReadableTitle($parameters['dir']),
        '#list_type' => 'ol',
        '#items' => [],
      ];

      sort($parameters['files']);
      foreach ($parameters['files'] as $file) {
        $guide_list['#items'][] = Link::createFromRoute($this->prepareHumanReadableTitle($file), 'guides.guide', [
          'dir' => $this->prepareParameter($parameters['dir']),
          'file' => $this->prepareParameter($file),
        ])->toRenderable();
      }
      $guides[] = $guide_list;
    }

    return $guides;
  }

}
