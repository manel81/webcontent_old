<?php

declare(strict_types = 1);

namespace Drupal\Tests\dp_api_docs\FunctionalJavascript;

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

use Drupal\Tests\devportal_api_reference\FunctionalJavascript\ApiRefTestBase;
use Drupal\node\Entity\Node;
use Drupal\node\NodeInterface;

/**
 * Base class for dp_api_docs tests.
 */
abstract class ApiDocsTestBase extends ApiRefTestBase {

  /**
   * API Reference version.
   */
  protected const API_REFERENCE_VERSION = '0.1';

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'dp_api_docs',
  ];

  /**
   * Test API Reference node.
   *
   * @var \Drupal\node\Entity\Node
   */
  protected $apiReferenceNode1;

  /**
   * Test API Description Page node.
   *
   * @var \Drupal\node\Entity\Node
   */
  protected $apiDescriptionNode1;

  /**
   * Test API Page Builder node.
   *
   * @var \Drupal\node\Entity\Node
   */
  protected $apiPageBuilderNode1;

  /**
   * Test Page node.
   *
   * @var \Drupal\node\Entity\Node
   */
  protected $pageNode;

  /**
   * Test API Test Page node.
   *
   * @var \Drupal\node\Entity\Node
   */
  protected $apiTestPageNode;

  /**
   * Test API Reference node.
   *
   * @var \Drupal\node\Entity\Node
   */
  protected $unpublishedApiReferenceNode3;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    // API Reference node 1.
    $this->apiReferenceNode1 = $this->createApiReference();

    // API Description Page node 1.
    $this->apiDescriptionNode1 = $this->createDescriptionPage((int) $this->apiReferenceNode1->id(), TRUE);

    // API Page Builder 1.
    $this->apiPageBuilderNode1 = $this->drupalCreateNode([
      'type' => 'api_page_builder',
      'status' => Node::PUBLISHED,
      'field_api_reference' => $this->apiReferenceNode1->id(),
    ]);

    // Create a CT which machine name doesn't start with api_ and doesn't
    // have API Reference field.
    $this->drupalCreateContentType(['type' => 'page']);
    // Page.
    $this->pageNode = $this->drupalCreateNode([
      'type' => 'page',
      'status' => Node::PUBLISHED,
    ]);

    // Create a CT which machine name starts with api_.
    $this->drupalCreateContentType(['type' => 'api_test_page']);
    // API Test Page.
    $this->apiTestPageNode = $this->drupalCreateNode([
      'type' => 'api_test_page',
      'status' => Node::PUBLISHED,
    ]);

    // API Reference 3, unpublished.
    $this->unpublishedApiReferenceNode3 = $this->drupalCreateNode([
      'type' => 'api_reference',
      'status' => Node::NOT_PUBLISHED,
    ]);
  }

  /**
   * Creates an API Reference node.
   *
   * @return \Drupal\node\NodeInterface
   *   API Reference node.
   */
  protected function createApiReference(): NodeInterface {
    $title = $this->randomMachineName();
    return $this->drupalCreateNode([
      'type' => 'api_reference',
      'title' => $title,
      'status' => Node::PUBLISHED,
      'field_version' => self::API_REFERENCE_VERSION,
    ]);
  }

  /**
   * Creates an API Description Page node.
   *
   * @param int $api_ref_nid
   *   Referenced API Reference node id.
   * @param bool $should_succeed
   *   Whether it should succeed or not.
   *
   * @return \Drupal\node\NodeInterface|null
   *   API Description Page node.
   */
  protected function createDescriptionPage(int $api_ref_nid, bool $should_succeed): ?NodeInterface {
    $title = $this->randomMachineName();
    /** @var \Drupal\node\NodeInterface $api_ref */
    $api_ref = Node::load($api_ref_nid);

    $description_page = Node::create([
      'type' => 'api_description_page',
      'title' => $title,
      'status' => Node::PUBLISHED,
      'field_api_reference' => ['target_id' => $api_ref->id()],
    ]);

    $violations = $description_page->validate();
    if ($should_succeed) {
      $this->assertCount(0, $violations);
      $description_page->save();
      $this->drupalGet($description_page->toUrl()->toString());
      return $description_page;
    }
    else {
      $this->assertEquals("<em class=\"placeholder\">{$api_ref->label()}</em> is already referenced by a(n) <em class=\"placeholder\">API Description Page</em>.", $violations[0]->getMessage());
      return NULL;
    }
  }

}
