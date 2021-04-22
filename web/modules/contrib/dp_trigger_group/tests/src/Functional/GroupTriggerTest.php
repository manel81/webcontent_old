<?php

declare(strict_types = 1);

namespace Drupal\Tests\dp_trigger_group\Functional;

/**
 * Devportal Pro module for Drupal.
 *
 * Copyright (C) 2018 PRONOVIX GROUP BVBA.
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

use Drupal\Core\Url;
use Drupal\Tests\dp_trigger\Functional\TriggerTestTrait;
use Drupal\Tests\group\Functional\GroupBrowserTestBase;
use Drupal\dp_trigger\Form\TokenForm;
use Drupal\group\Entity\Group;
use Symfony\Component\HttpFoundation\Response;

/**
 * Browser test for group trigger.
 *
 * @group devportal
 * @group dp_trigger
 */
class GroupTriggerTest extends GroupBrowserTestBase {

  use TriggerTestTrait;

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'user',
    'group_test_config',
    'dp_trigger_group',
  ];

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();

    /** @var \Drupal\group\Entity\GroupType $default_group_type */
    $default_group_type = $this->entityTypeManager
      ->getStorage('group_type')
      ->load('default');
    /** @var \Drupal\group\Entity\Storage\GroupContentTypeStorageInterface $storage */
    $storage = $this->entityTypeManager->getStorage('group_content_type');
    $storage
      ->createFromPlugin($default_group_type, 'group_api_ref:api_reference')
      ->save();

    $this->refreshVariables();
    \Drupal::service('router.builder')->rebuildIfNeeded();
  }

  /**
   * Tests if token can be created by the API.
   */
  public function testToken(): void {
    $group = $this->createGroup();

    $this->assertEquals('group', $group->getEntityTypeId());
    $this->assertNotEmpty($group->uuid());

    $token = $this->createToken($group);

    $this->assertNotEmpty($token, 'Token is created');

    $swagger10 = file_get_contents(__DIR__ . '/swagger10.yaml');
    $swagger11 = file_get_contents(__DIR__ . '/swagger11.yaml');

    $this->assertNotEmpty($swagger10);
    $this->assertNotEmpty($swagger11);

    $this->assertRequest(Response::HTTP_ACCEPTED, $token, $swagger10);
    $this->assertRequest(Response::HTTP_CONFLICT, $token, $swagger10);
    $this->assertRequest(Response::HTTP_ACCEPTED, $token, $swagger11);

    $count = $this->entityTypeManager->getStorage('node')->getQuery()
      ->accessCheck(FALSE)
      ->condition('type', 'api_reference')
      ->count()
      ->execute();
    $this->assertEquals(1, $count, 'Only one reference exists.');
  }

  /**
   * Tests if X-Project-ID is handled correctly.
   */
  public function testProjectId(): void {
    $group = $this->createGroup();
    $token = $this->createToken($group);
    $swagger = file_get_contents(__DIR__ . '/swagger_no_project_id.yml');

    $this->assertRequest(Response::HTTP_UNPROCESSABLE_ENTITY, $token, $swagger);
    $this->assertRequest(Response::HTTP_ACCEPTED, $token, $swagger, [
      'X-Project-ID' => 'petstore',
    ]);
  }

  /**
   * Tests published status is retained.
   */
  public function testStatus(): void {
    $group = $this->createGroup();
    $token = $this->createToken($group);
    $swagger10 = file_get_contents(__DIR__ . '/swagger10.yaml');
    $swagger11 = file_get_contents(__DIR__ . '/swagger11.yaml');
    $storage = $this->container->get('entity_type.manager')->getStorage('node');

    $this->assertRequest(Response::HTTP_ACCEPTED, $token, $swagger10);
    /** @var \Drupal\node\Entity\Node $node */
    $node = $storage->load(1);
    $this->assertFalse($node->isPublished());

    $this
      ->config('dp_trigger.settings')
      ->set('status', TRUE)
      ->save();
    $storage->resetCache();

    $this->assertRequest(Response::HTTP_ACCEPTED, $token, $swagger11);
    $node = $storage->load(1);
    $this->assertTrue($node->isPublished());
  }

  /**
   * Tests the token UI.
   */
  public function testTokenUserInterface(): void {
    $this->drupalLogin($this->rootUser);
    $group = $this->createGroup();

    $title = $this->getRandomGenerator()->name();

    $this->drupalPostForm(Url::fromRoute('entity.group.tokens.add', [
      'group' => $group->id(),
    ]), [
      'title' => $title,
    ], 'Save');

    $this->drupalGet(Url::fromRoute('entity.group.tokens.list', [
      'group' => $group->id(),
    ]));

    $this->assertSession()->pageTextContains($title);

    $this->clickLink('Revoke');
    $this->submitForm([], 'Confirm');

    $this->drupalGet(Url::fromRoute('entity.group.tokens.list', [
      'group' => $group->id(),
    ]));

    $this->assertSession()->pageTextNotContains($title);
  }

  /**
   * Creates a token for a group.
   *
   * @param \Drupal\group\Entity\Group $group
   *   Target group.
   *
   * @return string
   *   Generated token.
   */
  protected function createToken(Group $group): string {
    return TokenForm::save(
      'test token',
      $group->getEntityTypeId(),
      $group->uuid(),
      $this->groupCreator->uuid()
    );
  }

}
