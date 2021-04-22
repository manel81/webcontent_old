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

use Drupal\Core\Url;
use Drupal\node\Entity\Node;

/**
 * Tests the API Tab block.
 *
 * @group dp_api_docs
 */
final class ApiDocsTabBlockTest extends ApiDocsTestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'dp_api_docs_test',
  ];

  /**
   * Test content editor user.
   *
   * @var \Drupal\user\UserInterface
   */
  protected $contentEditor;

  /**
   * Test authenticated user.
   *
   * @var \Drupal\user\UserInterface
   */
  protected $authenticatedUser;

  /**
   * Test API Basic Page node.
   *
   * @var \Drupal\node\Entity\Node
   */
  protected $apiBasicPageNodeByContentEditor1;

  /**
   * Test API Reference node.
   *
   * @var \Drupal\node\Entity\Node
   */
  protected $apiReferenceNode2;

  /**
   * Test API Description Page node.
   *
   * @var \Drupal\node\Entity\Node
   */
  protected $apiDescriptionNode2;

  /**
   * Test API Basic page node.
   *
   * @var \Drupal\node\Entity\Node
   */
  protected $unpublishedApiBasicPageNode2;

  /**
   * Test API Page Builder node.
   *
   * @var \Drupal\node\Entity\Node
   */
  protected $unpublishedApiPageBuilderNode2;

  /**
   * Test API Description Page node.
   *
   * @var \Drupal\node\Entity\Node
   */
  protected $unpublishedApiDescriptionNode3;

  /**
   * Test API Basic page node.
   *
   * @var \Drupal\node\Entity\Node
   */
  protected $apiBasicPageNodeByContentEditor3;

  /**
   * Test API Page Builder node.
   *
   * @var \Drupal\node\Entity\Node
   */
  protected $apiPageBuilderNode3;

  /**
   * Test block.
   *
   * @var \Drupal\block\Entity\Block
   */
  protected $apiTabBlock;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    $this->contentEditor = $this->drupalCreateUser([
      'bypass node access',
      'access draggableviews',
    ]);

    $this->authenticatedUser = $this->drupalCreateUser(['access content']);

    // API Basic Page 1. Only the author has access to this node.
    $this->apiBasicPageNodeByContentEditor1 = $this->drupalCreateNode([
      'uid' => $this->contentEditor->id(),
      'type' => 'api_basic_page',
      'status' => Node::PUBLISHED,
      'field_api_reference' => $this->apiReferenceNode1->id(),
    ]);

    // API Reference 2.
    $this->apiReferenceNode2 = $this->createApiReference();
    // API Description Page 2.
    $this->apiDescriptionNode2 = $this->createDescriptionPage((int) $this->apiReferenceNode2->id(), TRUE);
    // API Basic Page 2 (unpublished).
    $this->unpublishedApiBasicPageNode2 = $this->drupalCreateNode([
      'type' => 'api_basic_page',
      'status' => Node::NOT_PUBLISHED,
      'field_api_reference' => $this->apiReferenceNode2->id(),
    ]);

    // API Page Builder 2 (unpublished).
    $this->unpublishedApiPageBuilderNode2 = $this->drupalCreateNode([
      'type' => 'api_page_builder',
      'status' => Node::NOT_PUBLISHED,
      'field_api_reference' => $this->apiReferenceNode2->id(),
    ]);

    // API Description Page 3 (unpublished).
    $this->unpublishedApiDescriptionNode3 = $this->drupalCreateNode([
      'type' => 'api_description_page',
      'status' => Node::NOT_PUBLISHED,
      'field_api_reference' => $this->unpublishedApiReferenceNode3->id(),
    ]);

    // API Basic Page 3. The author and the user in the visibility field have
    // access to this node.
    $this->apiBasicPageNodeByContentEditor3 = $this->drupalCreateNode([
      'uid' => $this->contentEditor->id(),
      'type' => 'api_basic_page',
      'status' => Node::PUBLISHED,
      'field_api_reference' => $this->unpublishedApiReferenceNode3->id(),
      'field_visibility' => $this->authenticatedUser->id(),
    ]);
    // API Page Builder 3.
    $this->apiPageBuilderNode3 = $this->drupalCreateNode([
      'type' => 'api_page_builder',
      'status' => Node::PUBLISHED,
      'field_api_reference' => $this->unpublishedApiReferenceNode3->id(),
    ]);

    $this->apiTabBlock = $this->drupalPlaceBlock('api_tab_block', [
      'region' => 'content',
    ]);

    // Rebuild permissions because hook_node_grants() is implemented by the
    // dp_api_docs_test module.
    node_access_rebuild();
  }

  /**
   * Tests that the given title appears as tab.
   *
   * @param string $tab_title
   *   The title of the tab.
   */
  protected function assertTabExist(string $tab_title): void {
    // @todo replace this with an assertion with a more specific selector which
    // looks for the tab in the API Tab block and not on the whole page.
    $this->assertSession()->linkExistsExact($tab_title);
  }

  /**
   * Tests that the given title doesn't appear as tab.
   *
   * @param string $tab_title
   *   The title of the tab.
   */
  protected function assertTabNotExist(string $tab_title): void {
    // @todo replace this with an assertion with a more specific selector which
    // looks for the tab in the API Tab block and not on the whole page.
    $this->assertSession()->linkNotExists($tab_title);
  }

  /**
   * Tests that the given node is the active tab.
   *
   * @param string $active_tab_title
   *   The title of the node which is active.
   */
  protected function assertActiveTab(string $active_tab_title): void {
    $this->assertSession()->elementTextContains('css', '.block-api-tab-block .is-active', $active_tab_title);
  }

  /**
   * Tests the API Tab block and the API Pages tab.
   */
  public function testApiTabs(): void {
    $this->drupalLogin($this->authenticatedUser);

    // Tests whether the tabs appear properly on an API Reference node.
    $this->drupalGet($this->apiReferenceNode1->toUrl()->toString());
    $this->assertSession()->pageTextContains($this->apiReferenceNode1->label());
    $this->assertTabExist('Reference documentation');
    $this->assertTabExist('API Description');
    $this->assertTabNotExist($this->apiBasicPageNodeByContentEditor1->label());
    $this->assertTabExist($this->apiPageBuilderNode1->label());
    $this->assertActiveTab('Reference documentation');
    // Tests that the API Pages tab doesn't appear for an authenticated user.
    $this->assertSession()->linkNotExists('API Pages');

    // Tests whether the API Description tab on the API Reference 1 page
    // doesn't link to the API Description Page 2 which refers to the API
    // Reference 2, but it links to the API Description Page 1.
    $this->clickLink('API Description');
    $this->assertSession()->pageTextNotContains($this->apiDescriptionNode2->label());
    $this->assertSession()->pageTextContains($this->apiDescriptionNode1->label());
    // Tests whether the tabs appear properly on an API Description Page node.
    $this->assertTabExist('Reference documentation');
    $this->assertTabExist('API Description');
    $this->assertTabNotExist($this->apiBasicPageNodeByContentEditor1->label());
    $this->assertTabExist($this->apiPageBuilderNode1->label());
    $this->assertActiveTab('API Description');
    // Tests that the API Pages tab doesn't exist on another node type.
    $this->assertSession()->linkNotExists('API Pages');

    // Tests that the user doesn't have access to this page if they are not the
    // author of the node or they aren't in the visibility field.
    $this->drupalGet($this->apiBasicPageNodeByContentEditor1->toUrl()->toString());
    $this->assertSession()->pageTextContains('You are not authorized to access this page.');

    // Tests that the tabs appear properly on an API Page Builder node.
    $this->drupalGet($this->apiPageBuilderNode1->toUrl()->toString());
    $this->assertTabExist('Reference documentation');
    $this->assertTabExist('API Description');
    $this->assertTabNotExist($this->apiBasicPageNodeByContentEditor1->label());
    $this->assertTabExist($this->apiPageBuilderNode1->label());
    $this->assertActiveTab($this->apiPageBuilderNode1->label());

    // Tests that the caching of the nodes works properly: if the title of a
    // node changes then it also changes on the tab.
    $original_api_page_builder_title = $this->apiPageBuilderNode1->getTitle();
    $changed_api_page_builder_title = $this->randomMachineName();
    $this->apiPageBuilderNode1 = $this->apiPageBuilderNode1->setTitle($changed_api_page_builder_title);
    $this->apiPageBuilderNode1->save();
    $this->drupalGet($this->apiReferenceNode1->toUrl()->toString());
    $this->assertSession()->pageTextNotContains($original_api_page_builder_title);
    $this->assertSession()->pageTextContains($changed_api_page_builder_title);

    // Tests that the tabs appear properly when there are unpublished nodes that
    // refer to the API Reference.
    $this->drupalGet($this->apiReferenceNode2->toUrl());
    $this->assertTabExist('Reference documentation');
    $this->assertTabExist('API Description');
    $this->assertTabNotExist($this->unpublishedApiBasicPageNode2->label());
    $this->assertTabNotExist($this->unpublishedApiPageBuilderNode2->label());
    $this->assertActiveTab('Reference documentation');
    $this->drupalGet($this->apiDescriptionNode2->toUrl());
    $this->assertTabExist('Reference documentation');
    $this->assertTabExist('API Description');
    $this->assertTabNotExist($this->unpublishedApiBasicPageNode2->label());
    $this->assertTabNotExist($this->unpublishedApiPageBuilderNode2->label());
    $this->assertActiveTab('API Description');
    // Tests that the authenticated user gets an access denied page if they
    // don't have access to the nodes.
    $this->drupalGet($this->unpublishedApiBasicPageNode2->toUrl());
    $this->assertSession()->pageTextContains('You are not authorized to access this page.');
    $this->drupalGet($this->unpublishedApiPageBuilderNode2->toUrl());
    $this->assertSession()->pageTextContains('You are not authorized to access this page.');

    $this->drupalGet($this->apiBasicPageNodeByContentEditor3->toUrl());
    $this->assertTabNotExist('Reference documentation');
    $this->assertTabNotExist('API Description');
    $this->assertTabExist($this->apiBasicPageNodeByContentEditor3->label());
    $this->assertTabExist($this->apiPageBuilderNode3->label());
    $this->assertActiveTab($this->apiBasicPageNodeByContentEditor3->label());

    $this->drupalGet($this->apiPageBuilderNode3->toUrl());
    $this->assertTabNotExist('Reference documentation');
    $this->assertTabNotExist('API Description');
    $this->assertTabExist($this->apiBasicPageNodeByContentEditor3->label());
    $this->assertTabExist($this->apiPageBuilderNode3->label());
    $this->assertActiveTab($this->apiPageBuilderNode3->label());

    // Tests that the API Tab block doesn't appear on another CT.
    $this->drupalGet($this->pageNode->toUrl()->toString());
    $this->assertSession()->pageTextNotContains($this->apiTabBlock->label());

    // Tests that the API Tab block doesn't appear on an unknown CT which
    // machine name starts with api_.
    $this->drupalGet($this->apiTestPageNode->toUrl()->toString());
    $this->assertSession()->pageTextNotContains($this->apiTabBlock->label());

    $this->drupalGet($this->apiDescriptionNode2->toUrl()->toString());
    $this->assertContains('API Description Reference documentation', $this->getSession()->getPage()->getText());

    $this->drupalLogout();
    $this->drupalLogin($this->contentEditor);

    $this->drupalGet($this->apiReferenceNode2->toUrl());
    $this->assertSession()->pageTextContains($this->apiReferenceNode2->label());
    $this->assertTabExist('Reference documentation');
    $this->assertTabExist('API Description');
    $this->assertTabExist($this->unpublishedApiBasicPageNode2->label());
    $this->assertTabExist($this->unpublishedApiPageBuilderNode2->label());
    $this->assertActiveTab('Reference documentation');
    $this->assertSession()->linkExistsExact('API Pages');

    // Tests that the author user has access to this node.
    $this->drupalGet($this->unpublishedApiBasicPageNode2->toUrl());
    $this->assertTabExist('Reference documentation');
    $this->assertTabExist('API Description');
    $this->assertTabExist($this->unpublishedApiBasicPageNode2->label());
    $this->assertTabExist($this->unpublishedApiPageBuilderNode2->label());
    $this->assertActiveTab($this->unpublishedApiBasicPageNode2->label());
    $this->assertSession()->linkNotExists('API Pages');

    // Tests that the API Pages page lists only the current API Reference and
    // the related nodes.
    $this->drupalGet(Url::fromRoute('view.api_pages.api_tabs_sorting', ['node' => (int) $this->apiReferenceNode2->id()])->toString());
    $this->assertSession()->assertWaitOnAjaxRequest();
    $this->assertSession()->linkNotExists($this->apiReferenceNode1->label());
    $this->assertSession()->linkNotExists($this->apiDescriptionNode1->label());
    $this->assertSession()->linkNotExists($this->apiBasicPageNodeByContentEditor1->label());
    $this->assertSession()->linkNotExists($this->apiPageBuilderNode1->label());
    $this->assertSession()->linkExistsExact($this->apiReferenceNode2->label());
    $this->assertSession()->linkExistsExact($this->apiDescriptionNode2->label());
    $this->assertSession()->linkExistsExact($this->unpublishedApiBasicPageNode2->label());
    $this->assertSession()->linkExistsExact($this->unpublishedApiPageBuilderNode2->label());
    $this->assertSession()->linkNotExists($this->unpublishedApiReferenceNode3->label());
    $this->assertSession()->linkNotExists($this->unpublishedApiDescriptionNode3->label());
    $this->assertSession()->linkNotExists($this->apiBasicPageNodeByContentEditor3->label());
    $this->assertSession()->linkNotExists($this->apiPageBuilderNode3->label());

    // Drag API Description Page under API Reference.
    $field_1 = $this->assertSession()->elementExists('css', '[name="draggableviews[1][id]"]');
    $field_3 = $this->assertSession()->elementExists('css', '[name="draggableviews[3][id]"]');
    $dragged = $field_1->find('xpath', 'ancestor::tr[contains(@class, "draggable")]//a[@class="tabledrag-handle"]');
    $target = $field_3->find('xpath', 'ancestor::tr[contains(@class, "draggable")]');
    $dragged->dragTo($target);
    $this->assertSession()->assertWaitOnAjaxRequest();
    $this->submitForm([], 'Save order');

    $this->drupalLogout();

    // Tests that the order of the tabs changed.
    $this->drupalGet($this->apiDescriptionNode2->toUrl()->toString());
    $this->assertContains('Reference documentation API Description', $this->getSession()->getPage()->getText());

    // Tests that the tabs appear properly for an anonymous user.
    $this->drupalGet($this->apiReferenceNode1->toUrl());
    $this->assertTabExist('Reference documentation');
    $this->assertTabExist('API Description');
    $this->assertTabNotExist($this->apiBasicPageNodeByContentEditor1->label());
    $this->assertTabExist($this->apiPageBuilderNode1->label());
    $this->assertActiveTab('Reference documentation');
    $this->assertSession()->linkNotExists('API Pages');
  }

}
