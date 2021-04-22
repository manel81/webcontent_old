<?php

declare(strict_types = 1);

namespace Drupal\Tests\dp_password\Functional;

use Drupal\Core\Url;
use Drupal\Tests\BrowserTestBase;

/**
 * The PasswordTest test class.
 *
 * @group devportal
 * @group dp_password
 */
final class PasswordTest extends BrowserTestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'dp_password',
    'block',
  ];

  /**
   * Test user.
   *
   * @var \Drupal\user\UserInterface
   */
  private $user;

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();

    $this->user = $this->createUser(['access content']);

    $this->drupalLogin($this->user);
  }

  /**
   * Verifies password validation rules.
   */
  public function testValidation(): void {
    $passwords = [
      'a' => FALSE,
      'asdfgH7*' => TRUE,
      'AAA1234$' => TRUE,
    ];

    $current_pw = $this->user->pass_raw;

    /** @var string $password */
    /** @var bool $success */
    foreach ($passwords as $password => $success) {
      $this->drupalPostForm(Url::fromRoute('entity.user.edit_form', [
        'user' => $this->user->id(),
      ])->toString(), [
        'current_pass' => $current_pw,
        'pass[pass1]' => $password,
        'pass[pass2]' => $password,
      ], 'Save');

      $this->assertAlertMessage(!$success);

      if (!$success) {
        continue;
      }

      $current_pw = $password;
    }
  }

  /**
   * Asserts that alert messages are displayed or not.
   *
   * @param bool $shouldExists
   *   Whether the alert message should exists or not.
   */
  private function assertAlertMessage(bool $shouldExists): void {
    $this->assertCount((int) $shouldExists, $this->getSession()->getPage()->findAll('css', 'div[role="alert"]'));
  }

}
