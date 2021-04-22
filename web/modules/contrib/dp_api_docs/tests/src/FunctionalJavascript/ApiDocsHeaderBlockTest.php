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

use Drupal\node\Entity\Node;
use Drupal\taxonomy\Entity\Term;

/**
 * Tests the API header block.
 *
 * @group dp_api_docs
 */
final class ApiDocsHeaderBlockTest extends ApiDocsTestBase {

  /**
   * Test API Basic Page node.
   *
   * @var \Drupal\node\Entity\Node
   */
  protected $apiBasicPageNode1;

  /**
   * Test API category.
   *
   * @var \Drupal\taxonomy\TermInterface
   */
  protected $category1;

  /**
   * Test API category.
   *
   * @var \Drupal\taxonomy\TermInterface
   */
  protected $category2;

  /**
   * Test API category.
   *
   * @var \Drupal\taxonomy\TermInterface
   */
  protected $category3;

  /**
   * Test API category.
   *
   * @var \Drupal\taxonomy\TermInterface
   */
  protected $category4;

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
  protected $apiDescriptionNode3;

  /**
   * Test API Reference node.
   *
   * @var \Drupal\node\Entity\Node
   */
  protected $apiReferenceNode4;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    $this->drupalPlaceBlock('api_header_block', [
      'region' => 'content',
    ]);

    // API Basic Page 1.
    $this->apiBasicPageNode1 = $this->drupalCreateNode([
      'type' => 'api_basic_page',
      'status' => Node::PUBLISHED,
      'field_api_reference' => $this->apiReferenceNode1->id(),
    ]);

    $this->category1 = Term::create([
      'vid' => 'api_categories',
      'name' => $this->randomMachineName(),
    ]);
    $this->category1->save();

    $this->category2 = Term::create([
      'vid' => 'api_categories',
      'name' => $this->randomMachineName(),
    ]);
    $this->category2->save();

    $this->category3 = Term::create([
      'vid' => 'api_categories',
      'name' => $this->randomMachineName(),
    ]);
    $this->category3->save();

    $this->category4 = Term::create([
      'vid' => 'api_categories',
      'name' => $this->randomMachineName(),
      'status' => Node::NOT_PUBLISHED,
    ]);
    $this->category4->save();

    // API Reference 2.
    $this->apiReferenceNode2 = $this->drupalCreateNode([
      'type' => 'api_reference',
      'field_api_category' => [
        $this->category1->id(),
        $this->category2->id(),
        $this->category4->id(),
      ],
      'status' => Node::PUBLISHED,
    ]);

    // API Reference 4.
    $this->apiReferenceNode4 = $this->drupalCreateNode([
      'type' => 'api_reference',
      'field_api_category' => [$this->category2->id(), $this->category3->id()],
      'status' => Node::PUBLISHED,
    ]);

    $this->apiDescriptionNode3 = $this->drupalCreateNode([
      'type' => 'api_description_page',
      'status' => Node::PUBLISHED,
      'field_api_reference' => $this->unpublishedApiReferenceNode3->id(),
    ]);
  }

  /**
   * Assertion for the API Header block.
   *
   * Tests that the API Header block and the API categories appear properly.
   */
  private function assertApiHeaderBlockAppears(): void {
    // Tests whether the API Header block appears on an API Reference page.
    $this->drupalGet($this->apiReferenceNode1->toUrl()->toString());
    $this->assertSession()->elementTextContains('css', '.block-api-header-block', $this->apiReferenceNode1->label());
    // Tests that the content of the version field appears on the header block
    // if the field is filled in.
    $this->assertSession()->elementExists('css', '.block-api-header-block .version');
    $this->assertSession()->elementTextContains('css', '.block-api-header-block .version', self::API_REFERENCE_VERSION);
    // Tests that the API Header block doesn't contain the tags class if the
    // API category field is not filled in.
    $this->assertSession()->elementNotExists('css', '.block-api-header-block .field__items');

    // Tests whether the API Header block appears on an API Description page.
    $this->drupalGet($this->apiDescriptionNode1->toUrl()->toString());
    $this->assertSession()->pageTextContains($this->apiReferenceNode1->label());
    // Tests that the content of the version field appears on the header block
    // if the field of the referenced entity is filled in.
    $this->assertSession()->elementExists('css', '.block-api-header-block .version');
    $this->assertSession()->elementTextContains('css', '.block-api-header-block .version', self::API_REFERENCE_VERSION);
    // Tests that the API Header block doesn't contain the tags class if the
    // API category field of the referenced entity is not filled in.
    $this->assertSession()->elementNotExists('css', '.block-api-header-block .field__items');

    // Tests whether the API Header block appears on an API Basic Page.
    $this->drupalGet($this->apiBasicPageNode1->toUrl()->toString());
    $this->assertSession()->pageTextContains($this->apiReferenceNode1->label());
    // Tests that the content of the version field appears on the header block
    // if the field is filled in.
    $this->assertSession()->elementExists('css', '.block-api-header-block .version');
    $this->assertSession()->elementTextContains('css', '.block-api-header-block .version', self::API_REFERENCE_VERSION);
    // Tests that the API Header block doesn't contain the tags class if the
    // API category field of the referenced entity is not filled in.
    $this->assertSession()->elementNotExists('css', '.block-api-header-block .field__items');

    // Tests whether the API Header block appears on an API Page Builder page.
    $this->drupalGet($this->apiPageBuilderNode1->toUrl()->toString());
    $this->assertSession()->pageTextContains($this->apiReferenceNode1->label());
    // Tests that the content of the version field appears on the header block
    // if the field is filled in.
    $this->assertSession()->elementExists('css', '.block-api-header-block .version');
    $this->assertSession()->elementTextContains('css', '.block-api-header-block .version', self::API_REFERENCE_VERSION);
    // Tests that the API Header block doesn't contain the tags class if the
    // API category field of the referenced entity is not filled in.
    $this->assertSession()->elementNotExists('css', '.block-api-header-block .field__items');

    // Tests that the API Header block doesn't appear if the user doesn't have
    // access to the referenced API Reference.
    $this->drupalGet($this->apiDescriptionNode3->toUrl()->toString());
    $this->assertSession()->elementNotExists('css', '.block-api-header-block');
    $this->assertSession()->pageTextNotContains($this->unpublishedApiReferenceNode3->label());

    // Tests whether the API Header block doesn't appear on another CT.
    $this->drupalGet($this->pageNode->toUrl()->toString());
    $this->assertSession()->elementNotExists('css', '.block-api-header-block');

    // Tests whether the API Header block doesn't appear on a CT which machine
    // name starts with api_ and which has no API Reference field.
    $this->drupalGet($this->apiTestPageNode->toUrl()->toString());
    $this->assertSession()->elementNotExists('css', '.block-api-header-block');

    // Tests that the version class appears in the HTML but it is empty if
    // field_version is not filled in.
    $this->drupalGet($this->apiReferenceNode2->toUrl()->toString());
    $this->assertSession()->pageTextContains($this->apiReferenceNode2->label());
    $this->assertEmpty($this->assertSession()->elementExists('css', '.block-api-header-block .version')->getText());
    // Tests that the API Header block contains the proper categories if the
    // API category field is filled in.
    $this->assertSession()->elementExists('css', '.block-api-header-block .field__items');
    $this->assertSession()->elementTextContains('css', '.block-api-header-block .field__items', $this->category1->label());
    $this->assertSession()->elementTextContains('css', '.block-api-header-block .field__items', $this->category2->label());
    $this->assertSession()->elementTextNotContains('css', '.block-api-header-block .field__items', $this->category3->label());
    $this->assertSession()->elementTextNotContains('css', '.block-api-header-block .field__items', $this->category4->label());

    $changed_category_label = $this->randomMachineName();
    $this->category1->setName($changed_category_label);
    $this->category1->save();

    // Tests that the caching of the taxonomy terms works properly: if a term's
    // name change then it changes on the API Header block too.
    $this->drupalGet($this->apiReferenceNode2->toUrl()->toString());
    $this->assertSession()->elementTextContains('css', '.block-api-header-block .field__items', $changed_category_label);

    // Tests the API category filtering functionality on the API Catalog.
    $this->drupalGet('api-catalog');
    $this->assertSession()->linkExistsExact($this->apiReferenceNode1->label());
    $this->assertSession()->linkExistsExact($this->apiReferenceNode2->label());
    $this->assertSession()->linkExistsExact($this->apiReferenceNode4->label());
    $this->assertSession()->pageTextNotContains($this->apiDescriptionNode1->label());
    $this->assertSession()->pageTextNotContains($this->apiBasicPageNode1->label());
    $this->assertSession()->pageTextNotContains($this->apiPageBuilderNode1->label());
    $page = $this->getSession()->getPage();
    $page->selectFieldOption('field_api_category_target_id', $this->category1->label());
    $page->pressButton('Apply');
    $this->assertSession()->assertWaitOnAjaxRequest();
    $this->assertSession()->pageTextNotContains($this->apiReferenceNode1->label());
    $this->assertSession()->linkExistsExact($this->apiReferenceNode2->label());
    $this->assertSession()->pageTextNotContains($this->apiReferenceNode4->label());

    $page->selectFieldOption('field_api_category_target_id', $this->category2->label());
    $page->pressButton('Apply');
    $this->assertSession()->assertWaitOnAjaxRequest();
    $this->assertSession()->pageTextNotContains($this->apiReferenceNode1->label());
    $this->assertSession()->linkExistsExact($this->apiReferenceNode2->label());
    $this->assertSession()->linkExistsExact($this->apiReferenceNode4->label());

    $page->selectFieldOption('field_api_category_target_id', $this->category3->label());
    $page->pressButton('Apply');
    $this->assertSession()->assertWaitOnAjaxRequest();
    $this->assertSession()->pageTextNotContains($this->apiReferenceNode1->label());
    $this->assertSession()->pageTextNotContains($this->apiReferenceNode2->label());
    $this->assertSession()->linkExistsExact($this->apiReferenceNode4->label());
  }

  /**
   * Tests the API Header block and the API category field.
   */
  public function testApiHeaderBlock(): void {
    // Test the block with anonymous user.
    $this->assertApiHeaderBlockAppears();

    // Test the block with authenticated user.
    $this->drupalLogin($this->drupalCreateUser());
    $this->assertApiHeaderBlockAppears();

    // Test that a user who has access to unpublished taxonomy terms sees
    // the unpublished category on the API Header block.
    $this->drupalLogin($this->drupalCreateUser(['administer taxonomy']));
    $this->drupalGet($this->apiReferenceNode2->toUrl()->toString());
    $this->assertSession()->elementTextContains('css', '.block-api-header-block .field__items', $this->category1->label());
    $this->assertSession()->elementTextContains('css', '.block-api-header-block .field__items', $this->category2->label());
    $this->assertSession()->elementTextContains('css', '.block-api-header-block .field__items', $this->category4->label());
  }

}
