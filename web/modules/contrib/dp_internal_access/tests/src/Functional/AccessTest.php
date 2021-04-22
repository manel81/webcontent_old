<?php

declare(strict_types = 1);

namespace Drupal\Tests\dp_internal_access\Functional;

use Drupal\Tests\BrowserTestBase;
use Drupal\Tests\field_ui\Traits\FieldUiTestTrait;
use Drupal\Tests\node\Traits\ContentTypeCreationTrait;
use Drupal\testtools\AccountList;
use Drupal\testtools\PermissionMatrix;
use Drupal\testtools\PermissionMatrixInterface;
use Drupal\testtools\PermissionTestTrait;

/**
 * The AccessTest test class.
 *
 * @group devportal
 * @group dp_internal_access
 */
final class AccessTest extends BrowserTestBase {

  use PermissionTestTrait;
  use FieldUiTestTrait;
  use ContentTypeCreationTrait;

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'dp_internal_access',
    'block',
    'field_ui',
  ];

  /**
   * Test content type.
   *
   * @var \Drupal\node\NodeTypeInterface
   */
  private $contentType;

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();

    $this->drupalPlaceBlock('local_tasks_block');
    $this->drupalPlaceBlock('system_breadcrumb_block');

    node_access_rebuild();

    $this->drupalLogin($this->rootUser);

    $this->contentType = $this->createContentType();
    $this->fieldUIAddExistingField($this->contentType->toUrl()->toString(), 'field_internal');

    /** @var \Drupal\Core\Entity\EntityFieldManagerInterface $field_manager */
    $field_manager = \Drupal::service('entity_field.manager');
    $field_manager->clearCachedFieldDefinitions();
  }

  /**
   * {@inheritdoc}
   */
  protected function getPermissionMatrix(): PermissionMatrixInterface {
    $user_access_content = $this->createUser(['access content'], 'access_content');
    $user_access_internal_content = $this->createUser(
      ['access content', 'access internal content'],
      'access_internal_content'
    );
    $user_access_unpublished = $this->createUser(['view own unpublished content'], 'unpublished');

    $account_list = new AccountList();
    $account_list->addRoot($this->rootUser);
    $account_list->addAnonymous();
    $account_list->addMultiple($user_access_content, $user_access_internal_content);

    $node_public = $this->createNode([
      'type' => $this->contentType->id(),
      'uid' => $this->rootUser->id(),
      'status' => 1,
      'field_internal' => [['value' => 0]],
      'title' => 'public',
    ]);

    $node_unpublised = $this->createNode([
      'type' => $this->contentType->id(),
      'uid' => $this->rootUser->id(),
      'status' => 0,
      'field_internal' => [['value' => 0]],
      'title' => 'unpublished',
    ]);

    $node_internal = $this->createNode([
      'type' => $this->contentType->id(),
      'uid' => $this->rootUser->id(),
      'status' => 1,
      'field_internal' => [['value' => 1]],
      'title' => 'internal',
    ]);

    $node_internal_unpublished = $this->createNode([
      'type' => $this->contentType->id(),
      'uid' => $user_access_unpublished->id(),
      'status' => 0,
      'field_internal' => [['value' => 1]],
      'title' => 'internal unpublished',
    ]);

    return (new PermissionMatrix($account_list))
      ->assertForbiddenFor($this->assertEntityAccess($node_public, 'view'))
      ->assertAllowedFor($this->assertEntityAccess($node_unpublised, 'view'), 'root')
      ->assertAllowedFor($this->assertEntityAccess($node_internal, 'view'), 'root', $user_access_internal_content->getAccountName())
      ->assertAllowedFor($this->assertEntityAccess($node_internal_unpublished, 'view'), 'root', $user_access_unpublished->getAccountName())
      ->assertAllowedFor($this->assertEntityFieldAccess($node_internal, 'field_internal', 'view', 'edit', 'delete'), 'root', $user_access_internal_content->getAccountName());
  }

}
