<?php

declare(strict_types = 1);

/**
 * Copyright (C) 2020 PRONOVIX GROUP BVBA.
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

namespace Drupal\Tests\page_builder\FunctionalJavascript;

use Drupal\Core\StreamWrapper\PublicStream;
use Drupal\FunctionalJavascriptTests\WebDriverTestBase;
use Drupal\Tests\TestFileCreationTrait;

/**
 * Class for testing the Page Builder content type.
 *
 * @group page_builder
 */
final class PageBuilderTest extends WebDriverTestBase {

  use TestFileCreationTrait;

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'page_builder',
    'views_ui',
  ];

  /**
   * User with the 'create page_builder content' permission.
   *
   * @var \Drupal\user\UserInterface
   */
  private $adminUser;

  /**
   * File system service.
   *
   * @var \Drupal\Core\File\FileSystemInterface
   */
  private $fileSystem;

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    // Create admin user.
    $this->adminUser = $this->drupalCreateUser([
      'create page_builder content',
      'edit own page_builder content',
      'access content overview',
    ]);

    $this->fileSystem = $this->container->get('file_system');
    $module_path = drupal_get_path('module', 'page_builder');
    $this->fileSystem->copy(DRUPAL_ROOT . '/' . $module_path . '/tests/fixtures/files/drupal-black.jpg', PublicStream::basePath());
    $this->fileSystem->copy(DRUPAL_ROOT . '/' . $module_path . '/tests/fixtures/files/drupal-logo.png', PublicStream::basePath());
    $this->fileSystem->copy(DRUPAL_ROOT . '/' . $module_path . '/tests/fixtures/files/character-drubot.gif', PublicStream::basePath());
  }

  /**
   * Tests the page builder elements.
   */
  public function testPageBuilderElements(): void {
    $assert_session = $this->assertSession();
    $this->drupalLogin($this->adminUser);

    $this->drupalGet('node/add/page_builder');
    $page = $this->getSession()->getPage();
    $page->fillField('Title', 'Test page builder');
    $page->pressButton('Add Grid');
    $assert_session->assertWaitOnAjaxRequest();
    // Fill in the Administrative title which will only visible
    // on the edit form.
    $page->fillField('field_page_builder_elements[0][subform][field_administrative_title][0][value]', 'Scale armour belies');
    // Fill in the Grid title which will be visible on the view page.
    $page->fillField('field_page_builder_elements[0][subform][field_grid_title][0][value]', 'Step forward');
    // Add a Grid button.
    $page->fillField('field_page_builder_elements[0][subform][field_grid_button][0][uri]', '/node/add');
    $page->fillField('field_page_builder_elements[0][subform][field_grid_button][0][title]', 'And meet a new sunrise');
    // Select Grid layout.
    $page->selectFieldOption('field_page_builder_elements[0][subform][field_grid_layout]', 'two-columns');

    $this->drupalPostForm(NULL, [], 'Add Block');
    $assert_session->assertWaitOnAjaxRequest();
    $page->selectFieldOption('Block', 'Recent content');
    $assert_session->assertWaitOnAjaxRequest();

    $this->drupalPostForm(NULL, [], 'Add Card');
    $assert_session->assertWaitOnAjaxRequest();
    // Fill in the Administrative title.
    $page->fillField('field_page_builder_elements[0][subform][field_grid_elements][1][subform][field_administrative_title][0][value]', 'Virgin innocence');
    // Upload a jpg image.
    $jpg_path = $this->fileSystem->realpath('public://drupal-black.jpg');
    $page->attachFileToField('files[field_page_builder_elements_0_subform_field_grid_elements_1_subform_field_image_0]', $jpg_path);
    $assert_session->assertWaitOnAjaxRequest();
    $page->fillField('field_page_builder_elements[0][subform][field_grid_elements][1][subform][field_image][0][alt]', 'A coward is shivering inside');
    // Fill in the description field.
    $page->fillField('field_page_builder_elements[0][subform][field_grid_elements][1][subform][field_description][0][value]', "Today I'll, I'll be a friend of mine");
    // Add Target.
    $page->fillField('field_page_builder_elements[0][subform][field_grid_elements][1][subform][field_target][0][uri]', '/admin/content');
    $page->fillField('field_page_builder_elements[0][subform][field_grid_elements][1][subform][field_target][0][title]', 'Who swallows');

    $this->drupalPostForm(NULL, [], 'Add Text');
    $assert_session->assertWaitOnAjaxRequest();
    // Fill in the administrative title.
    $page->fillField('field_page_builder_elements[0][subform][field_grid_elements][2][subform][field_administrative_title][0][value]', 'One being brings life');
    // Fill in the text field.
    $page->fillField('field_page_builder_elements[0][subform][field_grid_elements][2][subform][field_text][0][value]', 'Suffering with smile');

    $this->drupalPostForm(NULL, [], 'Add Image');
    $assert_session->assertWaitOnAjaxRequest();
    // Fill in the Administrative title.
    $page->fillField('field_page_builder_elements[0][subform][field_grid_elements][3][subform][field_administrative_title][0][value]', 'Another runs for death');
    // Upload a png image.
    $png_path = $this->fileSystem->realpath('public://drupal-logo.png');
    $page->attachFileToField('files[field_page_builder_elements_0_subform_field_grid_elements_3_subform_field_image_0]', $png_path);
    $assert_session->assertWaitOnAjaxRequest();
    $page->fillField('field_page_builder_elements[0][subform][field_grid_elements][3][subform][field_image][0][alt]', 'I drew a different reality');

    $this->drupalPostForm(NULL, [], 'Add Benefit');
    $assert_session->assertWaitOnAjaxRequest();
    // Fill in the Administrative title.
    $page->fillField('field_page_builder_elements[0][subform][field_grid_elements][4][subform][field_administrative_title][0][value]', 'Pisces swimming through the river');
    // Fill in the Text field.
    $page->fillField('field_page_builder_elements[0][subform][field_grid_elements][4][subform][field_text][0][value]', 'With unconditional loyalty');

    $this->drupalPostForm(NULL, [], 'Add Promo image');
    $assert_session->assertWaitOnAjaxRequest();
    // Fill in the Administrative title.
    $page->fillField('field_page_builder_elements[0][subform][field_grid_elements][5][subform][field_administrative_title][0][value]', 'All their life against the stream');
    $gif_path = $this->fileSystem->realpath('public://character-drubot.gif');
    $page->attachFileToField('files[field_page_builder_elements_0_subform_field_grid_elements_5_subform_field_image_0]', $gif_path);
    $assert_session->assertWaitOnAjaxRequest();
    $page->fillField('field_page_builder_elements[0][subform][field_grid_elements][5][subform][field_image][0][alt]', "Ego hardly can be piqued cause I'm selfless");

    $this->drupalPostForm(NULL, [], 'Add Message');
    $assert_session->assertWaitOnAjaxRequest();
    // Fill in the Text field.
    $page->fillField('field_page_builder_elements[0][subform][field_grid_elements][6][subform][field_text][0][value]', 'No promises I ever give');

    $this->drupalPostForm(NULL, [], 'Add CTA');
    $assert_session->assertWaitOnAjaxRequest();
    // Fill in the Administrative title.
    $page->fillField('field_page_builder_elements[1][subform][field_administrative_title][0][value]', 'Searching for a hook to catch on');
    // Fill in the Text field.
    $page->fillField('field_page_builder_elements[1][subform][field_text][0][value]', "Don't rely on me and I won't deceive");

    $page->pressButton('Save');

    $this->drupalGet('node/1');
    // Test if the page contains the Grid title.
    $assert_session->pageTextContains('Step forward');
    // Test if the page contains the Grid button.
    $assert_session->linkExists('And meet a new sunrise');
    // Test if the Recent content block is on the page and contains
    // the newly created content.
    $assert_session->pageTextContains('Recent content');
    $assert_session->linkExists('Test page builder');
    // Test the Card element.
    $assert_session->elementAttributeContains('css', '.paragraph--type--card img', 'alt', 'A coward is shivering inside');
    $assert_session->pageTextContains("Today I'll, I'll be a friend of mine");
    $assert_session->linkExists('Who swallows');
    // Test the Text element.
    $assert_session->pageTextContains('Suffering with smile');
    // Test the Image element.
    $assert_session->elementAttributeContains('css', '.paragraph--type--image img', 'alt', 'I drew a different reality');
    // Test the Benefit element.
    $assert_session->pageTextContains('With unconditional loyalty');
    // Test the Promo Image element.
    $assert_session->elementAttributeContains('css', '.paragraph--type--promo-image img', 'alt', "Ego hardly can be piqued cause I'm selfless");
    // Test the Message field.
    $assert_session->pageTextContains('No promises I ever give');
    // Test the CTA field.
    $assert_session->pageTextContains("Don't rely on me and I won't deceive");

    $this->drupalGet('node/1/edit');
    // Test if the page contains the Administrative title of the Grid
    // and the CTA.
    $assert_session->pageTextContains('Scale armour belies');
    $assert_session->pageTextContains('Searching for a hook to catch on');
    // Expand the Grid elements and test if the page contains the
    // Administrative title of the sub-elements.
    $page->findById('edit-field-page-builder-elements-0-top-paragraph-type-title')->press();
    $assert_session->assertWaitOnAjaxRequest();
    $assert_session->pageTextContains('Virgin innocence');
    $assert_session->pageTextContains('One being brings life');
    $assert_session->pageTextContains('Another runs for death');
    $assert_session->pageTextContains('Pisces swimming through the river');
    $assert_session->pageTextContains('All their life against the stream');
  }

}
