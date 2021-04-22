<?php

declare(strict_types = 1);

namespace Drupal\Tests\dp_trigger_field\Functional;

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
use Drupal\Tests\BrowserTestBase;
use Drupal\Tests\dp_trigger\Functional\TriggerTestTrait;
use Drupal\Tests\field_ui\Traits\FieldUiTestTrait;
use Drupal\dp_trigger\Form\TokenForm;
use Drupal\node\Entity\Node;
use Drupal\user\Entity\User;
use Symfony\Component\HttpFoundation\Response;

/**
 * Main test class for dp_trigger_field.
 */
class TriggerFieldTest extends BrowserTestBase {

  use FieldUiTestTrait;
  use TriggerTestTrait;

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'user',
    'dp_trigger_api_ref',
    'dp_trigger_field',
    'field_ui',
    'node',
    'text',
    'block',
  ];

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();
    $this->drupalLogin($this->rootUser);
    $this->drupalPlaceBlock('system_breadcrumb_block');
    $this->drupalPlaceBlock('page_title_block');
    $this->fieldUIAddNewField(Url::fromRoute('entity.node_type.edit_form', [
      'node_type' => 'api_reference',
    ])->toString(), 'text', 'Text', 'text_long');
    \Drupal::configFactory()
      ->getEditable('dp_trigger_field.settings')
      ->set('whitelist', ['field_text'])
      ->save();
  }

  /**
   * Basic test for updating a text field.
   */
  public function testContentUpdate(): void {
    $node = Node::create([
      'type' => 'api_reference',
      'title' => $this->randomString(),
    ]);
    $node->save();
    /** @var \Drupal\user\UserInterface $user */
    $user = User::load($this->rootUser->id());

    $token = TokenForm::save('test token', 'node', $node->uuid(), $user->uuid());

    $text = trim($this->getRandomGenerator()->paragraphs(1));

    $this->assertRequestUrl(Response::HTTP_ACCEPTED, Url::fromRoute('dp_trigger.tokens.trigger.field', [
      'entity' => $token,
      'field_name' => 'field_text',
    ]), $text);

    $this->drupalGet($node->toUrl()->toString());
    $this->assertSession()->pageTextContains($text);
  }

}
