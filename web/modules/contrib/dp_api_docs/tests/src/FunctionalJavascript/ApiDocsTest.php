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
use Drupal\node\Entity\NodeType;
use Drupal\node\NodeInterface;

/**
 * The ApiDocs test class.
 *
 * @group dp_api_docs
 */
final class ApiDocsTest extends ApiDocsTestBase {

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'stark';

  private const FIELD_API_REFERENCE_NAME = 'field_api_reference[0][target_id]';

  /**
   * {@inheritdoc}
   *
   * Unfortunately this is needed, since config schema is missing in many
   * contrib modules, mostly in the dependencies of page builder.
   * Patching these modules is quite hopeless, so this is the workaround.
   *
   * @todo Patch these modules.
   *
   * As the sniff name is a bit long, the line length check must also be
   * disabled.
   *
   * phpcs:disable Drupal.Files.LineLength.TooLong
   * phpcs:disable DrupalPractice.Objects.StrictSchemaDisabled.StrictConfigSchema
   */
  protected $strictConfigSchema = FALSE;
  // phpcs:enable

  /**
   * The node storage.
   *
   * @var \Drupal\node\NodeStorageInterface
   */
  private $nodeStorage;

  /**
   * Test user.
   *
   * @var \Drupal\user\UserInterface
   */
  private $contentEditor;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    $this->nodeStorage = $this->container->get('entity_type.manager')->getStorage('node');
    // The user has to have the 'administer nodes' permission, because they
    // can see the Published checkbox with this permission only and an API
    // Reference content is unpublished by default.
    $this->contentEditor = $this->drupalCreateUser([
      'administer nodes',
      'access draggableviews',
      'bypass node access',
    ]);
  }

  /**
   * Tests the one-to-one mapping enforcement between api refs and desc pages.
   */
  public function testOneToOne(): void {
    // API Reference 1.
    $apiReferenceNode1 = $this->createApiReference();
    // API Reference 2.
    $apiReferenceNode2 = $this->createApiReference();
    // API Reference 3.
    $apiReferenceNode3 = $this->createApiReference();
    // API Description Page 1.
    $apiDescriptionNode = $this->createDescriptionPage((int) $apiReferenceNode1->id(), TRUE);

    // API Description Page 2.
    $this->createDescriptionPage((int) $apiReferenceNode2->id(), TRUE);
    $this->createDescriptionPage((int) $apiReferenceNode1->id(), FALSE);

    $this->editDescriptionPage((int) $apiDescriptionNode->id(), (int) $apiReferenceNode3->id(), TRUE);
    $this->editDescriptionPage((int) $apiDescriptionNode->id(), (int) $apiReferenceNode2->id(), FALSE);
  }

  /**
   * Edits a description page node.
   *
   * @param int $description_page_int
   *   Description page node id.
   * @param int $api_ref_nid
   *   Referenced api reference node id.
   * @param bool $should_succeed
   *   Whether it should fail or not.
   */
  private function editDescriptionPage(int $description_page_int, int $api_ref_nid, bool $should_succeed): void {
    $this->drupalLogin($this->contentEditor);
    $this->drupalGet("node/{$description_page_int}/edit");

    /** @var \Drupal\node\Entity\Node $api_ref */
    $api_ref = Node::load($api_ref_nid);
    $page = $this->getSession()->getPage();
    $page->fillField(self::FIELD_API_REFERENCE_NAME, "{$api_ref->label()} ({$api_ref->id()})");
    $this->createScreenshot(__FUNCTION__ . '_before_save');
    $this->clickSubmit();
    $this->createScreenshot(__FUNCTION__ . '_after_save');

    $message = "{$api_ref->label()} is already referenced by a(n)";
    if ($should_succeed) {
      $this->assertSession()->pageTextNotContains($message);
    }
    else {
      $this->assertSession()->pageTextContains($message);
    }
    $this->drupalLogout();
  }

  /**
   * Creates an API Docs node on the UI.
   *
   * @param string $bundle
   *   The bundle of the node.
   * @param string $title
   *   The title of the node.
   * @param \Drupal\node\NodeInterface $api_reference
   *   The API Reference node which the API Docs node refers to.
   */
  private function createApiDocsNodeOnUi(string $bundle, string $title, NodeInterface $api_reference): void {
    $node_type = NodeType::load($bundle)->label();
    $this->drupalLogin($this->contentEditor);
    $this->drupalGet(Url::fromRoute('node.add', ['node_type' => $bundle])->toString());
    $page = $this->getSession()->getPage();
    $page->fillField(self::TITLE_NAME, $title);
    $page->fillField(self::FIELD_API_REFERENCE_NAME, "{$api_reference->label()} ({$api_reference->id()})");
    $this->createScreenshot(__FUNCTION__ . '_before_save');
    $this->clickSubmit();
    $this->createScreenshot(__FUNCTION__ . '_after_save');
    $this->assertSession()->pageTextContains("{$node_type} {$title} has been created.");
    $this->drupalLogout();
  }

  /**
   * Edits the title of an API Docs node on the UI.
   *
   * @param \Drupal\node\NodeInterface $node
   *   The node to edit.
   */
  private function editApiDocsNodeOnUi(NodeInterface $node): void {
    $title = $this->randomMachineName();
    $node_type = NodeType::load($node->bundle())->label();
    $this->drupalLogin($this->contentEditor);
    $this->drupalGet("node/{$node->id()}/edit");
    $page = $this->getSession()->getPage();
    $page->fillField(self::TITLE_NAME, $title);
    $this->createScreenshot(__FUNCTION__ . '_before_save');
    $this->clickSubmit();
    $this->createScreenshot(__FUNCTION__ . '_after_save');
    $this->assertSession()->pageTextContains("{$node_type} {$title} has been updated.");
    $this->drupalLogout();
  }

  /**
   * Tests the API Docs nodes creation on the UI.
   *
   * Creates and edits an API Reference, an API Description Page, an API Basic
   * page and an API Page Builder node on the user interface.
   */
  public function testNodeCreationOnUi(): void {
    // Create an API Reference node.
    $api_reference_title = $this->randomMachineName();
    $this->drupalLogin($this->contentEditor);
    $this->drupalGet(Url::fromRoute('node.add', ['node_type' => 'api_reference'])->toString());
    $this->selectManualMode();
    $page = $this->getSession()->getPage();
    $page->fillField(self::TITLE_NAME, $api_reference_title);
    $page->fillField(self::VERSION_NAME, self::API_REFERENCE_VERSION);
    $page->fillField('status[value]', Node::PUBLISHED);
    $this->createScreenshot(__FUNCTION__ . '_before_save');
    $this->clickSubmit();
    $this->createScreenshot(__FUNCTION__ . '_after_save');
    $this->assertSession()->pageTextContains("API Reference {$api_reference_title} has been created.");
    $this->drupalLogout();

    $api_reference_array = $this->nodeStorage->loadByProperties(['title' => $api_reference_title]);
    $apiReferenceNode1 = reset($api_reference_array);

    // Create an API Description Page.
    $api_description_page_title = 'API Description Page test title';
    $this->createApiDocsNodeOnUi('api_description_page', $api_description_page_title, $apiReferenceNode1);
    // Create an API Basic page.
    $api_basic_page_title = 'API Basic page test title';
    $this->createApiDocsNodeOnUi('api_basic_page', $api_basic_page_title, $apiReferenceNode1);
    // Create an API Page Builder.
    $api_page_builder_title = 'API Page Builder test title';
    $this->createApiDocsNodeOnUi('api_page_builder', $api_page_builder_title, $apiReferenceNode1);

    // Edit the API Reference node.
    $api_reference_title = $this->randomMachineName();
    $this->drupalLogin($this->contentEditor);
    $this->drupalGet("node/{$apiReferenceNode1->id()}/edit");
    $this->selectManualMode();
    $page = $this->getSession()->getPage();
    $page->fillField(self::TITLE_NAME, $api_reference_title);
    $this->createScreenshot(__FUNCTION__ . '_before_save');
    $this->clickSubmit();
    $this->createScreenshot(__FUNCTION__ . '_after_save');
    $this->assertSession()->pageTextContains("API Reference {$api_reference_title} has been updated.");
    $this->drupalLogout();

    // Edit the API Description Page.
    $this->editApiDocsNodeOnUi($this->drupalGetNodeByTitle($api_description_page_title));
    // Edit the API Basic page.
    $this->editApiDocsNodeOnUi($this->drupalGetNodeByTitle($api_basic_page_title));
    // Edit the API Page Builder.
    $this->editApiDocsNodeOnUi($this->drupalGetNodeByTitle($api_page_builder_title));
  }

  /**
   * Tests API Reference deletion.
   *
   * Tests that the nodes that refer to an API Reference are also deleted when
   * the API Reference is deleted.
   */
  public function testApiReferenceDeletion(): void {
    $apiReferenceNode1 = $this->createApiReference();
    $apiDescriptionNode = $this->createDescriptionPage((int) $apiReferenceNode1->id(), TRUE);
    $apiBasicPage = $this->drupalCreateNode([
      'type' => 'api_basic_page',
      'field_api_reference' => $apiReferenceNode1->id(),
    ]);
    $apiPageBuilder = $this->drupalCreateNode([
      'type' => 'api_page_builder',
      'field_api_reference' => $apiReferenceNode1->id(),
    ]);

    // Checks that the content exists.
    $this->assertTrue($this->nodeStorage->load($apiReferenceNode1->id()));
    $this->assertTrue($this->nodeStorage->load($apiDescriptionNode->id()));
    $this->assertTrue($this->nodeStorage->load($apiBasicPage->id()));
    $this->assertTrue($this->nodeStorage->load($apiPageBuilder->id()));

    $apiReferenceNode1->delete();

    // Checks that the nodes that refer to the deleted API Reference are also
    // deleted after deleting the API Reference.
    $this->assertFalse($this->nodeStorage->load($apiReferenceNode1->id()));
    $this->assertFalse($this->nodeStorage->load($apiDescriptionNode->id()));
    $this->assertFalse($this->nodeStorage->load($apiBasicPage->id()));
    $this->assertFalse($this->nodeStorage->load($apiPageBuilder->id()));
  }

}
