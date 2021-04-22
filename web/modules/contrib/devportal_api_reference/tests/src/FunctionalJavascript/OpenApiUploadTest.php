<?php

declare(strict_types = 1);

namespace Drupal\Tests\devportal_api_reference\FunctionalJavascript;

/**
 * Validates OpenAPI file uploads.
 *
 * @group devportal
 * @group api_reference
 */
class OpenApiUploadTest extends ApiRefTestBase {

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'stark';

  /**
   * Provides a list of files to upload.
   *
   * @return array
   *   File list.
   */
  public function uploadProvider(): array {
    return [
      '3.0.0' => ['petstore-openapi.yaml'],
      '3.0.1' => ['petstore-openapi-3.0.1.yaml'],
      '3.0.2' => ['petstore-openapi-3.0.2.yaml'],
    ];
  }

  /**
   * A simple file upload.
   *
   * @param string $filename
   *   File to upload.
   *
   * @dataProvider uploadProvider
   */
  public function testPetstoreUpload(string $filename): void {
    $this->drupalLogin($this->rootUser);

    $this->drupalGet('node/add/api_reference');
    $this->createScreenshot(__FUNCTION__);

    $this->uploadFile($filename);

    $this->clickAddApiCategory();
    $this->submitForm([], 'Save');
    $this->createScreenshot(__FUNCTION__ . '_after_submit');
    $this->assertSession()->pageTextContains('Swagger Petstore');

    /** @var \Drupal\node\NodeInterface $node */
    $node = $this
      ->container
      ->get('entity_type.manager')
      ->getStorage('node')
      ->load(1);
    $version = $node->get('field_version')->getValue()[0]['value'];
    self::assertEquals('1.0.0', $version);
  }

  /**
   * Tests the propose mode.
   */
  public function testPropose(): void {
    $this->drupalLogin($this->rootUser);
    $session = $this->getSession();

    $this->drupalGet('node/add/api_reference');
    $this->createScreenshot(__FUNCTION__);

    $name = $this->randomMachineName();
    $version = '0.1';

    $page = $session->getPage();
    $this->selectManualMode();
    $page->fillField(self::TITLE_NAME, $name);
    $page->fillField(self::VERSION_NAME, $version);
    $this->createScreenshot(__FUNCTION__ . '_before_save');
    $this->clickAddApiCategory();
    $this->clickSubmit();
    $this->createScreenshot(__FUNCTION__ . '_after_save');

    $this->assertSession()->pageTextContains($name);

    $this->clickLink('Edit');

    $new_name = $this->randomMachineName();
    $new_version = '0.2';
    $this->selectManualMode();
    $page = $session->getPage();
    $page->fillField(self::TITLE_NAME, $new_name);
    $page->fillField(self::VERSION_NAME, $new_version);
    $this->clickAddApiCategory();
    $this->clickSubmit();

    $this->assertSession()->pageTextContains($new_name);
    $this->assertSession()->pageTextContains($new_version);
    $this->assertSession()->pageTextNotContains($name);
    $this->assertSession()->pageTextNotContains($version);

    $this->clickLink('Edit');
    $this->selectManualMode();
    $this->selectUploadMode();
    $this->uploadFile('petstore-openapi.yaml');
    $this->createScreenshot(__FUNCTION__ . '_before_upload');
    $this->clickAddApiCategory();
    $this->clickSubmit();

    $this->createScreenshot(__FUNCTION__ . '_after_upload');
    $this->assertSession()->pageTextContains('Swagger Petstore');
  }

  /**
   * Tests revision handling.
   */
  public function testRevisions(): void {
    $this->drupalLogin($this->rootUser);

    $this->drupalGet('node/add/api_reference');

    $this->uploadFile('petstore-openapi.yaml');
    $this->clickAddApiCategory();
    $this->clickSubmit();

    $this->assertSession()->pageTextContains('Swagger Petstore');
    $this->assertSession()->pageTextContains('1.0.0');

    $this->clickLink('Edit');

    $this->uploadFile('petstore-openapi2.yaml');
    $this->clickAddApiCategory();
    $this->clickSubmit();

    $this->assertSession()->pageTextContains('Swagger Petstore');
    $this->assertSession()->pageTextContains('1.0.1');

    $this->clickLink('Edit');
    $this->clickAddApiCategory();
    $this->assertSession()->waitForButton('Save');
    $this->createScreenshot(__FUNCTION__ . '_edit_page');
    $this->assertSession()->pageTextContains('petstore-openapi.yaml (1.0.0)');
    $this->assertSession()->pageTextContains('petstore-openapi2.yaml (1.0.1)');

    $this->clickLink('Revisions');
    $this->assertSession()->waitForLink('Revert');
    $this->clickLink('Revert');
    $this->assertSession()->waitForLink('Cancel');
    $this->getSession()->getPage()->findButton('Revert')->click();
    $this->assertSession()->waitForLink('View');

    $this->drupalGet('node/1');

    $this->assertSession()->pageTextContains('1.0.0');

    $this->drupalGet('node/1/revisions/2/delete');
    $this->getSession()->getPage()->findButton('Delete')->click();
    $this->assertSession()->waitForLink('Revert');
    $this->createScreenshot(__FUNCTION__ . '_after_revision_delete');

    $this->drupalGet('node/1/edit');

    $this->assertSession()->pageTextContains('petstore-openapi.yaml (1.0.0)');
    $this->assertSession()->pageTextNotContains('petstore-openapi2.yaml (1.0.1)');
  }

  /**
   * Tests the 'allow_version_duplication' setting.
   */
  public function testVersionDuplication(): void {
    $this->drupalLogin($this->rootUser);
    $this
      ->config('devportal_api_reference.settings')
      ->set('allow_version_duplication', TRUE)
      ->save();

    $this->drupalGet('node/add/api_reference');
    $this->uploadFile('petstore-openapi.yaml');
    $this->clickAddApiCategory();
    $this->clickSubmit();

    $this->assertSession()->pageTextContains('Swagger Petstore');
    $this->assertSession()->pageTextContains('1.0.0');

    $this->clickLink('Edit');

    $this->uploadFile('petstore-openapi-duplicate.yaml');
    $this->clickAddApiCategory();
    $this->clickSubmit();

    $this->assertSession()->pageTextContains('Swagger Petstore');
    $this->assertSession()->pageTextContains('1.0.0');
    $this->assertSession()->pageTextContains('petstore-openapi-duplicate.yaml');
  }

  /**
   * Tests the default mode hidden setting.
   */
  public function testDefaultModeSetting(): void {
    $this->drupalLogin($this->rootUser);
    $this
      ->config('devportal_api_reference.settings')
      ->set('manual_mode_default', TRUE)
      ->save();

    $this->drupalGet('node/add/api_reference');
    $this->assertSession()->pageTextContains('Title');
    $this->assertSession()->pageTextNotContains('Source file');

    $this
      ->config('devportal_api_reference.settings')
      ->set('manual_mode_default', FALSE)
      ->save();

    $this->drupalGet('node/add/api_reference');
    $this->assertSession()->pageTextNotContains('Title');
    $this->assertSession()->pageTextContains('Source file');
  }

}
