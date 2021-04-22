<?php

declare(strict_types = 1);

namespace Drupal\Tests\dp_blog\Kernel;

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

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\KernelTests\KernelTestBase;

/**
 * Tests configuration overrides by the Devportal Blog module.
 *
 * @group dp_blog
 */
final class DpBlogConfigOverridesTest extends KernelTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'dp_blog',
  ];

  /**
   * {@inheritdoc}
   */
  public function register(ContainerBuilder $container) {
    $config_storage = $this->getMockBuilder('Drupal\Core\Config\StorageInterface')
      ->getMock();
    $config_storage
      ->method('readMultiple')
      ->willReturn(['field.field.paragraph.block.field_block' => ['settings' => ['foo' => 'bar']]]);

    $container->set('config.storage', $config_storage);
    parent::register($container);
  }

  /**
   * Tests config overrides by the Devportal Blog module.
   */
  public function testConfigOverrides(): void {
    $config = $this->container->get('config.factory')
      ->get('field.field.paragraph.block.field_block');
    $result = $config->get('settings');
    $this->assertArrayHasKey('foo', $result);
    self::assertEquals('bar', $result['foo']);
    $this->assertArrayHasKey('plugin_ids', $result);
    $this->assertArrayHasKey('views_block:blog_posts-recent_blog_posts', $result['plugin_ids']);
    self::assertEquals('views_block:blog_posts-recent_blog_posts', $result['plugin_ids']['views_block:blog_posts-recent_blog_posts']);
  }

}
