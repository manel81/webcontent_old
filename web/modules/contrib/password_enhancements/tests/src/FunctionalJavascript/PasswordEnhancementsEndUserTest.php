<?php

declare(strict_types = 1);

namespace Drupal\Tests\password_enhancements\FunctionalJavascript;

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

use Drupal\Core\Test\AssertMailTrait;
use Drupal\Core\Url;
use Drupal\FunctionalJavascriptTests\WebDriverTestBase;

/**
 * Tests user registration forms with constraints.
 *
 * @group password_enhancements
 */
class PasswordEnhancementsEndUserTest extends WebDriverTestBase {

  use AssertMailTrait {
    getMails as drupalGetMails;
  }

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'password_enhancements',
    'password_enhancements_editor_role_test',
    'password_enhancements_display_constraints_test',
  ];

  /**
   * The user with the editor role.
   *
   * @var \Drupal\user\Entity\User|false|null
   */
  protected $editorUser = NULL;

  /**
   * The user with the authenticated role.
   *
   * @var \Drupal\user\Entity\User
   */
  protected $authUser;

  /**
   * Adds a new constraint to a role.
   *
   * @param string $role
   *   The role ID.
   * @param string $constraint
   *   The constraint ID.
   * @param array $data
   *   The constraint data.
   */
  protected function addConstraintToRole(string $role, string $constraint, array $data): void {
    $current_user = $this->loggedInUser;
    if ($current_user->id() !== $this->rootUser->id()) {
      $this->drupalLogin($this->rootUser);
    }
    $this->drupalPostForm(Url::fromRoute('entity.user_role.edit_form', ['user_role' => $role]), [
      'password_enhancements_apply_policy' => 1,
      'password_enhancements[minimumRequiredConstraints]' => 1,
      'password_enhancements_new_constraint' => $constraint,
    ], 'Save');

    // @covers \Drupal\password_enhancements\Form\PasswordConstraintAddForm
    $constraint_definition = $this->container->get('plugin.manager.password_enhancements.constraint')->getDefinition($constraint);
    $this->assertSession()->responseContains('Add ' . $constraint_definition['name'] . ' constraint');
    $this->drupalPostForm(NULL, $data, 'Add constraint');
    if ($current_user->id() !== $this->rootUser->id()) {
      $this->drupalLogin($current_user);
    }
  }

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();

    // Set up the authenticated role as needed. (The editor role comes from the
    // test module's config.)
    $this->drupalLogin($this->rootUser);
    $this->addConstraintToRole('authenticated', 'minimum_characters', [
      'required' => 1,
      'minimum_characters' => 8,
      'descriptionSingular' => 'Add at least one character. A',
      'descriptionPlural' => 'Add @minimum_characters more characters. B',
    ]);
    $this->addConstraintToRole('authenticated', 'lower_case', [
      'required' => 1,
      'minimum_characters' => 2,
      'descriptionSingular' => 'Add at least one lower-cased letter. C',
      'descriptionPlural' => 'Add @minimum_characters more lower-cased letters. D',
    ]);
    $this->addConstraintToRole('authenticated', 'upper_case', [
      'required' => 1,
      'minimum_characters' => 2,
      'descriptionSingular' => 'Add at least one upper-cased letter. E',
      'descriptionPlural' => 'Add @minimum_characters more upper-cased letters. F',
    ]);
    $this->addConstraintToRole('authenticated', 'number', [
      'required' => 1,
      'minimum_characters' => 2,
      'descriptionSingular' => 'Add at least one number. G',
      'descriptionPlural' => 'Add @minimum_characters more numbers. H',
    ]);
    $this->addConstraintToRole('authenticated', 'special_character', [
      'required' => 1,
      'minimum_characters' => 2,
      'descriptionSingular' => 'Add at least one special character. I',
      'descriptionPlural' => 'Add @minimum_characters more special characters. J',
      'use_custom_special_characters' => 1,
      'special_characters' => '!"',
    ]);
    $this->addConstraintToRole('authenticated', 'special_character', [
      'required' => 1,
      'minimum_characters' => 2,
      'descriptionSingular' => 'Add at least one special character. K',
      'descriptionPlural' => 'Add @minimum_characters more special characters. L',
      'use_custom_special_characters' => 1,
      'special_characters' => '#&',
    ]);

    $this->drupalPostForm(Url::fromRoute('entity.user.admin_form'), [
      // Enable setting the password at during registration.
      'user_email_verification' => 0,
      // Disable core's password strength indicator.
      'user_password_strength' => 0,
    ], 'Save configuration');

    $this->editorUser = $this->createUser([], $this->randomMachineName(), FALSE, ['roles' => ['editor']]);
    $this->authUser = $this->createUser();
    $this->drupalGet(Url::fromRoute('entity.user.edit_form', ['user' => $this->editorUser->id()]));
    $this->assertSession()->checkboxChecked('edit-roles-editor');
    $this->drupalLogout();
  }

  /**
   * Tests user-facing behavior.
   */
  public function testAll(): void {
    $this->checkRegisterPage();
    $this->checkRegisterPageWithoutPasswordField();
    $this->checkEditorPasswordChange();
    $this->checkUserEditFormWithoutPasswordField();
  }

  /**
   * Tests user registration page (ie. constraints for the authenticated role).
   */
  public function checkRegisterPage(): void {
    \Drupal::state()->set('password_enhancements_test.display_password_field', TRUE);
    $this->drupalGet(Url::fromRoute('user.register'));

    // Check initial messages.
    $session = $this->assertSession();
    $session->responseContains('Add <span data-setting="minimum_characters">8</span> more characters. B (required)');
    $session->responseContains('Add <span data-setting="minimum_characters">2</span> more lower-cased letters. D (required)');
    $session->responseContains('Add <span data-setting="minimum_characters">2</span> more upper-cased letters. F (required)');
    $session->responseContains('Add <span data-setting="minimum_characters">2</span> more numbers. H (required)');
    $session->responseContains('Add <span data-setting="minimum_characters">2</span> more special characters. J (required)');
    $session->responseContains('Add <span data-setting="minimum_characters">2</span> more special characters. L (required)');

    // Check client-side validations with constraints partially satisfied.
    $page = $this->getSession()->getPage();
    $page->fillField('pass[pass1]', 'aA1!#==');
    $session->responseContains('Add at least one character. A (required)');
    $session->responseContains('Add at least one lower-cased letter. C (required)');
    $session->responseContains('Add at least one upper-cased letter. E (required)');
    $session->responseContains('Add at least one number. G (required)');
    $session->responseContains('Add at least one special character. I (required)');
    $session->responseContains('Add at least one special character. K (required)');

    // Check server-side validations with constraints partially satisfied.
    $page->fillField('pass[pass2]', 'aA1!#==');
    $page->fillField('mail', $this->randomMachineName() . '@example.com');
    $page->fillField('name', $this->randomMachineName());
    $this->click('#edit-submit');
    $session->elementTextContains('css', '.password-error-message', "The given password doesn't meet some requirements:");
    $session->elementTextContains('css', 'ul.password-error-messages', 'Add at least one character. A');
    $session->elementTextContains('css', 'ul.password-error-messages', 'Add at least one lower-cased letter. C');
    $session->elementTextContains('css', 'ul.password-error-messages', 'Add at least one upper-cased letter. E');
    $session->elementTextContains('css', 'ul.password-error-messages', 'Add at least one number. G');
    $session->elementTextContains('css', 'ul.password-error-messages', 'Add at least one special character. I');
    $session->elementTextContains('css', 'ul.password-error-messages', 'Add at least one special character. K');
    $session->responseContains('Add <span data-setting="minimum_characters">8</span> more characters. B (required)');
    $session->responseContains('Add <span data-setting="minimum_characters">2</span> more lower-cased letters. D (required)');
    $session->responseContains('Add <span data-setting="minimum_characters">2</span> more upper-cased letters. F (required)');
    $session->responseContains('Add <span data-setting="minimum_characters">2</span> more numbers. H (required)');
    $session->responseContains('Add <span data-setting="minimum_characters">2</span> more special characters. J (required)');
    $session->responseContains('Add <span data-setting="minimum_characters">2</span> more special characters. L (required)');

    // Check client-side validation with all constraints satisfied.
    $page->fillField('pass[pass1]', 'aaAA11!!##');
    $session->elementAttributeContains('css', '#password-enhancements-policy-constraints [data-constraint="minimum_characters"]', 'data-validation-passed', 'yes');
    $session->elementAttributeContains('css', '#password-enhancements-policy-constraints [data-constraint="lower_case"]', 'data-validation-passed', 'yes');
    $session->elementAttributeContains('css', '#password-enhancements-policy-constraints [data-constraint="upper_case"]', 'data-validation-passed', 'yes');
    // CSS doesn't have contains(), and there's no better way targeting this
    // element without the constraint's UUID.
    $session->elementAttributeContains('xpath', '//*[@id="password-enhancements-policy-constraints"]//*[@data-constraint="special_character"][contains(text(),"Add at least one special character. I (required)")]', 'data-validation-passed', 'yes');
    $session->elementAttributeContains('xpath', '//*[@id="password-enhancements-policy-constraints"]//*[@data-constraint="special_character"][contains(text(),"Add at least one special character. K (required)")]', 'data-validation-passed', 'yes');

    // Check server-side validation with all constraints satisfied.
    $page->fillField('pass[pass2]', 'aaAA11!!##');
    $this->click('#edit-submit');
    $session->elementTextContains('css', '.messages--status', 'Registration successful.');
    $this->drupalLogout();
  }

  /**
   * Test constraints without password field on user registration page.
   */
  public function checkRegisterPageWithoutPasswordField(): void {
    \Drupal::state()->set('password_enhancements_test.display_password_field', FALSE);
    $this->drupalGet(Url::fromRoute('user.register'));

    $session = $this->assertSession();
    $session->responseNotContains('<div id="password-policy-constraint-ajax-wrapper">');
  }

  /**
   * Tests the constraintswithout password field on user edit form.
   */
  public function checkUserEditFormWithoutPasswordField(): void {
    \Drupal::state()->set('password_enhancements_test.display_password_field', FALSE);
    $this->drupalLogin($this->authUser);
    $this->drupalGet(Url::fromRoute('entity.user.edit_form', ['user' => $this->authUser->id()]));
    $session = $this->assertSession();
    $session->responseNotContains('<div id="password-policy-constraint-ajax-wrapper">');
    $this->drupalLogout();
  }

  /**
   * Tests editor password change (ie. constraints for the editor role).
   */
  public function checkEditorPasswordChange(): void {
    \Drupal::state()->set('password_enhancements_test.display_password_field', TRUE);
    $this->drupalLogin($this->editorUser);
    $this->drupalGet(Url::fromRoute('entity.user.edit_form', ['user' => $this->editorUser->id()]));

    // Check (not-so-)initial messages with the overridden constraints.
    $page = $this->getSession()->getPage();
    $page->fillField('pass[pass1]', '=');
    $session = $this->assertSession();
    $session->responseContains('Add <span data-setting="minimum_characters">8</span> more characters. N (required)');
    $session->responseContains('Add <span data-setting="minimum_characters">3</span> more lower-cased letters. P (required)');
    $session->responseContains('Add <span data-setting="minimum_characters">3</span> more upper-cased letters. R');
    $session->responseContains('Add <span data-setting="minimum_characters">3</span> more numbers. T (required)');
    $session->responseContains('Add <span data-setting="minimum_characters">3</span> more special characters. V (required)');
    $session->responseContains('Add <span data-setting="minimum_characters">3</span> more special characters. X (required)');

    // Check overridden client-side validations with constraints partially
    // satisfied.
    $page->fillField('pass[pass1]', 'aaAA11((<<');
    $session->elementAttributeContains('css', '#password-enhancements-policy-constraints [data-constraint="minimum_characters"]', 'data-validation-passed', 'yes');
    $session->responseContains('Add at least one lower-cased letter. O (required)');
    $session->elementContains('css', '#password-enhancements-policy-constraints [data-constraint="upper_case"]', 'Add at least one upper-cased letter. Q<em class="optional">&nbsp;(optional)</em>');
    $session->responseContains('Add at least one number. S (required)');
    $session->responseContains('Add at least one special character. U (required)');
    $session->responseContains('Add at least one special character. W (required)');

    // Check server-side validations with constraints partially satisfied.
    $page->fillField('current_pass', $this->editorUser->passRaw);
    $page->fillField('pass[pass2]', 'aaAA11((<<');
    $this->click('#edit-submit');
    $session->elementTextContains('css', '.password-error-message', "The given password doesn't meet some requirements:");
    $session->elementTextContains('css', 'ul.password-error-messages', 'Add at least one lower-cased letter. O');
    $session->elementTextContains('css', 'ul.password-error-messages', 'Add at least one number. S');
    $session->elementTextContains('css', 'ul.password-error-messages', 'Add at least one special character. U');
    $session->elementTextContains('css', 'ul.password-error-messages', 'Add at least one special character. W');
    // These are hidden (because their parent fieldset is hidden), but anyway.
    $session->responseContains('Add <span data-setting="minimum_characters">9</span> more characters. N (required)');
    $session->responseContains('Add <span data-setting="minimum_characters">3</span> more lower-cased letters. P (required)');
    $session->responseContains('Add <span data-setting="minimum_characters">3</span> more upper-cased letters. R');
    $session->responseContains('Add <span data-setting="minimum_characters">3</span> more numbers. T (required)');
    $session->responseContains('Add <span data-setting="minimum_characters">3</span> more special characters. V (required)');
    $session->responseContains('Add <span data-setting="minimum_characters">3</span> more special characters. X (required)');

    // Check client-side validation with all constraints satisfied.
    $page->fillField('pass[pass1]', 'aaaAAA111(((<<<');
    $session->elementAttributeContains('css', '#password-enhancements-policy-constraints [data-constraint="minimum_characters"]', 'data-validation-passed', 'yes');
    $session->elementAttributeContains('css', '#password-enhancements-policy-constraints [data-constraint="lower_case"]', 'data-validation-passed', 'yes');
    $session->elementAttributeContains('css', '#password-enhancements-policy-constraints [data-constraint="upper_case"]', 'data-validation-passed', 'yes');
    // CSS doesn't have contains(), and there's no better way targeting this
    // element without the constraint's UUID.
    $session->elementAttributeContains('xpath', '//*[@id="password-enhancements-policy-constraints"]//*[@data-constraint="special_character"][contains(text(),"Add at least one special character. U (required)")]', 'data-validation-passed', 'yes');
    $session->elementAttributeContains('xpath', '//*[@id="password-enhancements-policy-constraints"]//*[@data-constraint="special_character"][contains(text(),"Add at least one special character. W (required)")]', 'data-validation-passed', 'yes');

    // Check server-side validation with all constraints satisfied.
    $page->fillField('current_pass', $this->editorUser->passRaw);
    $page->fillField('pass[pass2]', 'aaaAAA111(((<<<');
    $this->click('#edit-submit');
    $session->elementTextContains('css', '.messages--status', 'The changes have been saved.');
    $this->editorUser->passRaw = 'aaaAAA111(((<<<';

    // Check password change enforcements.
    $this->drupalLogin($this->editorUser);

    // @see \Drupal\password_enhancements\Access\AccessControlHandler::hasPasswordChangeAccess()
    // Check if a user without any further restrictions is allowed to change the
    // password.
    $password_change_url = Url::fromRoute('password_enhancements.password_change')->toString();
    $front_url = Url::fromRoute('entity.user.canonical', ['user' => $this->editorUser->id()])->toString();
    $this->drupalGet($password_change_url);
    $this->assertSession()->pageTextContains('Access denied');

    /** @var \Drupal\user\UserStorageInterface $user_storage */
    $user_storage = $this->container->get('entity_type.manager')->getStorage('user');

    // Check if a user with a required password change is allowed to change the
    // password.
    $user = $user_storage->load($this->editorUser->id());
    $user->set('password_enhancements_password_change_required', TRUE);
    $user->save();
    $this->drupalGet($password_change_url);
    $this->assertSession()->pageTextNotContains('Access denied');
    $session->elementExists('css', '#edit-current-pass');

    // @see \Drupal\password_enhancements\EventSubscriber\InitSubscriber::passwordChangeNotification()
    // Check if the user is warned about and/or forced changing the password.
    // If the user has changed the password recently, the messages shouldn't be
    // visible, and no redirection should happen.
    $user->set('password_enhancements_password_change_required', FALSE);
    $user->set('password_enhancements_password_changed_date', \Drupal::time()->getRequestTime());
    $user->save();
    $this->drupalGet($front_url);
    $this->assertUrl($front_url);
    // This string is coming from the test module's user.role.editor.yml.
    $this->assertSession()->pageTextNotContains('before it expires to prevent any potential data loss');

    // If the user has changed the password but not recently enough, the warning
    // warning message should not be visible, but no redirection should happen.
    // This magic constant is 5 seconds higher than the expireWarnSeconds set in
    // the test module's user.role.editor.yml.
    $user->set('password_enhancements_password_changed_date', \Drupal::time()->getRequestTime() - 86405);
    $user->save();
    $this->drupalGet($front_url);
    $this->assertUrl($front_url);
    // This string is coming from the test module's user.role.editor.yml.
    $session->elementTextContains('css', '.messages--warning', 'before it expires to prevent any potential data loss');

    // If the user hasn't changed the password recently enough, the warning
    // message shouldn't be visible, but a redirection should happen to the
    // password change page/form.
    // This magic constant is 5 seconds higher than the expireSeconds set in the
    // test module's user.role.editor.yml.
    $user->set('password_enhancements_password_changed_date', \Drupal::time()->getRequestTime() - 172805);
    $user->save();
    $this->drupalGet($front_url);
    $this->assertUrl($password_change_url);
    // This string is coming from the test module's user.role.editor.yml.
    $this->assertSession()->pageTextNotContains('before it expires to prevent any potential data loss');
    $session->elementTextContains('css', '.messages--error', 'Your password has expired and must be changed before continuing.');
    $session->elementExists('css', '#edit-current-pass');

    // Check if the user has to provide the old password when the password is
    // required to be changed. This is triggered only during login, so we need
    // to relogin.
    // @see \Drupal\password_enhancements\Form\PasswordChangeForm::buildForm()
    // @see password_enhancements_user_login()
    $this->drupalLogout();
    $this->drupalLogin($this->editorUser);
    $this->assertUrl($password_change_url);
    // This string is coming from the test module's user.role.editor.yml.
    $this->assertSession()->pageTextNotContains('before it expires to prevent any potential data loss');
    $session->elementTextContains('css', '.messages--error', 'Your password has expired and must be changed before continuing.');
    $session->elementNotExists('css', '#edit-current-pass');

    // Check if the user has to provide the old password when a reset password
    // URL is being used.
    $this->drupalLogout();
    $user->set('password_enhancements_password_changed_date', \Drupal::time()->getRequestTime() - 172805);
    $user->save();

    // Forge a password reset URL.
    // @see \Drupal\Tests\user\Functional\UserPasswordResetTest::testUserPasswordReset()
    $this->drupalGet(Url::fromRoute('user.pass'));
    $edit = ['name' => $this->editorUser->getAccountName()];
    $this->drupalPostForm(NULL, $edit, 'Submit');
    // Assume the most recent email.
    $_emails = $this->drupalGetMails();
    $email = end($_emails);
    $urls = [];
    preg_match('#.+user/reset/.+#', $email['body'], $urls);
    $reset_url = $urls[0];
    $this->drupalGet($reset_url . '/login');

    $this->assertUrl($password_change_url);
    // This string is coming from the test module's user.role.editor.yml.
    $this->assertSession()->pageTextNotContains('before it expires to prevent any potential data loss');
    $session->elementTextContains('css', '.messages--error', 'You need to change your password before continuing.');
    $session->elementNotExists('css', '#edit-current-pass');
    $this->drupalLogout();
  }

}
