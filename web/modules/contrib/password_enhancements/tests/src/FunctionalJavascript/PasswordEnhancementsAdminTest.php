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

use Drupal\Core\Url;
use Drupal\FunctionalJavascriptTests\WebDriverTestBase;

/**
 * Tests the admin UI for the Password Enhancements module.
 *
 * @group password_enhancements
 */
class PasswordEnhancementsAdminTest extends WebDriverTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'password_enhancements',
    'user',
  ];

  /**
   * The admin user for tests.
   *
   * @var \Drupal\user\UserInterface
   */
  protected $adminUser;

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();

    $this->adminUser = $this->drupalCreateUser([
      // This is needed for the role edit forms.
      'administer permissions',
      'administer user password enhancements settings',
    ]);
  }

  /**
   * Tests the administrative UI.
   */
  public function testAll(): void {
    $this->drupalLogin($this->adminUser);

    $this->checkAnonymousCantHaveAnyPolicy();
    $this->checkNonAnonymousCanBeSavedWithoutPolicy();
    $this->checkRolePolicyIsSavedCorrectly();
    $this->checkRoleConstraintsUi();
    $this->checkConstraintPlugins();
  }

  /**
   * Test that anonymous user role can't have any policy.
   */
  public function checkAnonymousCantHaveAnyPolicy(): void {
    $path = Url::fromRoute('entity.user_role.edit_form', [
      'user_role' => 'anonymous',
    ])->toString();
    // Make sure that the user has access to the edit role page.
    $this->assertUserHasAccessToPath($path);
    // The password policy management related checkbox shouldn't exist.
    $this->assertNoField('edit-password-enhancements-apply-policy');
  }

  /**
   * Test that a non-anonymous user role can be saved without a policy.
   */
  public function checkNonAnonymousCanBeSavedWithoutPolicy(): void {
    // Make sure that the user has access to the add role page.
    $path = Url::fromRoute('user.role_add')->toString();
    $this->assertUserHasAccessToPath($path);

    $session = $this->getSession();
    $page = $session->getPage();

    // Fill out the Role name field.
    $role_name = $this->randomMachineName();
    $page->fillField('edit-label', $role_name);
    $session->wait(2500, "jQuery('.machine-name-value').text() === '{$role_name}'");

    // Uncheck the password policy related checkbox and try to save the form.
    $this->assertField('edit-password-enhancements-apply-policy');
    $page->uncheckField('edit-password-enhancements-apply-policy');
    $this->drupalPostForm(NULL, [], 'Save', [], 'user-role-form');
    $this->assertSession()->pageTextContains("Role $role_name has been added.");
  }

  /**
   * Test that a role's policy is saved correctly.
   */
  public function checkRolePolicyIsSavedCorrectly(): void {
    $path = Url::fromRoute('user.role_add')->toString();
    $role_name = strtolower($this->randomMachineName());

    $session = $this->getSession();
    $page = $session->getPage();

    $this->drupalGet($path);
    // Fill out the Role name field.
    $page->fillField('edit-label', $role_name);
    // For some reason, this check is case-insensitive; therefore having an
    // uppercase letter in the role name might cause problems when trying to
    // load it later. To circumvent this, strtolower() is applied to the
    // random-generated machine name above, before using it anywhere.
    $session->wait(2500, "jQuery('.machine-name-value').text() === '{$role_name}'");

    // Check the password policy related checkboxes and #states.
    $this->assertJsCondition("jQuery('#edit-password-enhancements').is(':hidden')");
    $this->assertJsCondition("jQuery('#edit-password-enhancements-minimumrequiredconstraints').is(':hidden')");
    $this->assertJsCondition("jQuery('#edit-password-enhancements-expire-password').is(':hidden')");
    $this->assertJsCondition("jQuery('#edit-password-enhancements-new-constraint').is(':hidden')");
    $this->assertJsCondition("jQuery('#edit-password-enhancements-expire-days').is(':hidden')");
    $this->assertJsCondition("jQuery('#edit-password-enhancements-expire-warn-before-days').is(':hidden')");
    $this->assertJsCondition("jQuery('#edit-password-enhancements-expiry-warning-message').is(':hidden')");

    // Check if minimumRequiredConstraints > 0 is enforced (on server-side).
    $page->checkField('edit-password-enhancements-apply-policy');
    $page->fillField('edit-password-enhancements-minimumrequiredconstraints', 0);
    // Change this attribute so the form can be submitted with minimum required
    // constraints set to 0.
    $session->executeScript("jQuery('#edit-password-enhancements-minimumrequiredconstraints').attr('min',0)");
    $this->click('#edit-submit');

    $this->assertSession()->elementTextContains('css', '.messages--error', 'Minimum required constraints must be higher than or equal to 1.');

    // Continue checking the password policy related checkboxes and #states.
    $page->fillField('edit-password-enhancements-minimumrequiredconstraints', 1);
    $page->checkField('edit-password-enhancements-apply-policy');
    $this->assertJsCondition("jQuery('#edit-password-enhancements').is(':visible')");
    $this->assertJsCondition("jQuery('#edit-password-enhancements-minimumrequiredconstraints').is(':visible')");
    $this->assertJsCondition("jQuery('#edit-password-enhancements-expire-password').is(':visible')");
    $this->assertJsCondition("jQuery('#edit-password-enhancements-new-constraint').is(':visible')");

    // Continue checking #states.
    $this->assertJsCondition("jQuery('#edit-password-enhancements-expire-days').is(':hidden')");
    $this->assertJsCondition("jQuery('#edit-password-enhancements-expire-warn-before-days').is(':hidden')");
    $this->assertJsCondition("jQuery('#edit-password-enhancements-expiry-warning-message').is(':hidden')");
    $page->checkField('edit-password-enhancements-expire-password');
    $this->assertJsCondition("jQuery('#edit-password-enhancements-expire-days').is(':visible')");
    $this->assertJsCondition("jQuery('#edit-password-enhancements-expire-warn-before-days').is(':visible')");
    $this->assertJsCondition("jQuery('#edit-password-enhancements-expiry-warning-message').is(':hidden')");
    $this->assertJsCondition("!jQuery('#edit-password-enhancements-expiry-warning-message').prop('required')");
    $page->fillField('edit-password-enhancements-expire-warn-before-days', 1);
    $this->assertJsCondition("jQuery('#edit-password-enhancements-expiry-warning-message').is(':visible')");
    $this->assertJsCondition("jQuery('#edit-password-enhancements-expiry-warning-message').prop('required')");

    // Check server-side validation.
    $this->drupalPostForm(NULL, [], 'Save');
    $this->assertSession()->elementTextContains('css', '.messages--error', 'Expiring passwords must live for at least one day.');
    $page->fillField('edit-password-enhancements-expire-days', 1);
    $page->fillField('edit-password-enhancements-expire-warn-before-days', 2);
    $this->drupalPostForm(NULL, [], 'Save');
    $this->assertSession()->elementTextContains('css', '.messages--error', 'Cannot warn about password expiry before it is set.');

    // Check if expireWarnDays > 0 is enforced (on server-side).
    $page->fillField('edit-password-enhancements-expire-warn-before-days', -1);
    // Change this attribute so the form can be submitted with expireWarnDays
    // set to -1.
    $session->executeScript("jQuery('#edit-password-enhancements-expire-warn-before-days').attr('min',-1)");
    $this->drupalPostForm(NULL, [], 'Save');
    $this->assertSession()->elementTextContains('css', '.messages--error', 'Show warning must be higher than or equal to 0.');

    // Check if expiryWarningMessage is required (on server-side) when
    // expireWarnDays > 0.
    $page->fillField('edit-password-enhancements-expire-warn-before-days', 1);
    // Make this non-required so the form can be submitted with an empty
    // expireWarnMessage.
    $this->getSession()->executeScript("jQuery('#edit-password-enhancements-expiry-warning-message').removeAttr('required')");
    $page->fillField('edit-password-enhancements-expiry-warning-message', '');
    $this->drupalPostForm(NULL, [], 'Save');
    $this->assertSession()->elementTextContains('css', '.messages--error', 'Expiry warning message cannot be empty for expiring passwords.');

    // Finally, submit a properly populated form.
    $page->fillField('edit-password-enhancements-expiry-warning-message', 'Your password will expire on @date_time, please <a href="@url">change your password</a> before it expires to prevent any potential data loss.');
    $this->drupalPostForm(NULL, [], 'Save');
    $this->assertSession()->pageTextContains("Role $role_name has been added.");

    // Make sure that role's policy is saved properly.
    /** @var \Drupal\user\RoleStorage $role_storage */
    $role_storage = $this->container->get('entity_type.manager')->getStorage('user_role');
    /** @var \Drupal\user\Entity\Role $role */
    $role = $role_storage->load($role_name);
    $settings = $role->getThirdPartySettings('password_enhancements');
    $settings_expected = [
      'minimumRequiredConstraints' => 1,
      'expireSeconds' => 86400,
      'expireWarnSeconds' => 86400,
      'expiryWarningMessage' => 'Your password will expire on @date_time, please <a href="@url">change your password</a> before it expires to prevent any potential data loss.',
    ];
    $this->assertSame($settings_expected, $settings);
  }

  /**
   * Test role constraints UI.
   */
  public function checkRoleConstraintsUi(): void {
    $path = Url::fromRoute('user.role_add')->toString();
    $role_name = strtolower($this->randomMachineName());

    $session = $this->getSession();
    $page = $session->getPage();

    $this->drupalGet($path);
    // Fill out the Role name field.
    $page->fillField('edit-label', $role_name);
    // For some reason, this check is case-insensitive; therefore having an
    // uppercase letter in the role name might cause problems when trying to
    // load it later. To circumvent this, strtolower() is applied to the
    // random-generated machine name above, before using it anywhere.
    $session->wait(2500, "jQuery('.machine-name-value').text() === '{$role_name}'");

    // Check the password policy related checkboxes and #states.
    $this->assertJsCondition("jQuery('#edit-password-enhancements-new-constraint').is(':hidden')");
    $page->checkField('edit-password-enhancements-apply-policy');
    $this->assertJsCondition("jQuery('#edit-password-enhancements-new-constraint').is(':visible')");
    $page->selectFieldOption('edit-password-enhancements-new-constraint', 'lower_case');
    // Make sure the table displays no constraints for this role yet.
    $this->assertSession()->elementTextContains('css', '#edit-password-enhancements', 'There are no constraints in this policy yet. Add one by selecting an option below.');
    $this->drupalPostForm(NULL, [], 'Save');
    $page->hasContent('Add Lower-case constraint');
    $this->drupalPostForm(NULL, [], 'Add constraint');

    // Make sure the table is now displaying the constraint with all its
    // (default) settings.
    $this->assertSession()->elementTextNotContains('css', '#edit-password-enhancements', 'There are no constraints in this policy yet. Add one by selecting an option below.');
    $this->assertSession()->elementsCount('css', '#password-enhancements-policy-constraints > tbody > tr', 1);
    $this->assertSession()->elementTextContains('css', '#password-enhancements-policy-constraints > tbody td:nth-child(1n)', 'Lower-case');
    $this->assertSession()->elementTextContains('css', '#password-enhancements-policy-constraints > tbody td:nth-child(2n)', 'No');
    $this->assertSession()->elementTextContains('css', '#password-enhancements-policy-constraints > tbody td:nth-child(3n)', 'Minimum characters: 1');
    $this->assertSession()->elementTextContains('css', '#password-enhancements-policy-constraints > tbody td:nth-child(3n)', 'Description (singular): Add at least one lower-cased letter.');
    $this->assertSession()->elementTextContains('css', '#password-enhancements-policy-constraints > tbody td:nth-child(3n)', 'Description (plural): Add @minimum_characters more lower-cased letters.');

    // Make sure unique constraint can be added only once.
    $this->assertSession()->elementNotExists('css', '#edit-password-enhancements-new-constraint > option[value="lower_case"]');
    $this->drupalGet(Url::fromRoute('password_enhancements.constraint_add_form', [
      'user_role' => $role_name,
      'password_constraint' => 'lower_case',
    ]));
    $this->assertSession()->pageTextContains('Access denied');

    // Make sure an already-existing constraint can be edited.
    $this->drupalGet(Url::fromRoute('entity.user_role.edit_form', ['user_role' => $role_name]));
    $this->click('#password-enhancements-policy-constraints .edit a');
    $page->checkField('edit-required');
    $page->fillField('edit-minimum-characters', 2);
    $page->fillField('edit-descriptionsingular', 'Add at least one lower-cased letter. AAA');
    $page->fillField('edit-descriptionplural', 'Add @minimum_characters more lower-cased letters. BBB');
    $this->drupalPostForm(NULL, [], 'Update constraint');
    $this->assertSession()->elementsCount('css', '#password-enhancements-policy-constraints > tbody > tr', 1);
    $this->assertSession()->elementTextContains('css', '#password-enhancements-policy-constraints > tbody td:nth-child(1n)', 'Lower-case');
    $this->assertSession()->elementTextContains('css', '#password-enhancements-policy-constraints > tbody td:nth-child(2n)', 'Yes');
    $this->assertSession()->elementTextContains('css', '#password-enhancements-policy-constraints > tbody td:nth-child(3n)', 'Minimum characters: 2');
    $this->assertSession()->elementTextContains('css', '#password-enhancements-policy-constraints > tbody td:nth-child(3n)', 'Description (singular): Add at least one lower-cased letter. AAA');
    $this->assertSession()->elementTextContains('css', '#password-enhancements-policy-constraints > tbody td:nth-child(3n)', 'Description (plural): Add @minimum_characters more lower-cased letters. BBB');

    // Make sure an already-existing constraint can be deleted.
    // It's impossible to use $this->click() in this case as the Delete action
    // is the second one in a dropbutton, so it's not visible.
    $session->executeScript("jQuery('#password-enhancements-policy-constraints div.dropbutton-wrapper.dropbutton-multiple').addClass('open')");
    $this->click('#password-enhancements-policy-constraints .delete a');
    $this->drupalPostForm(NULL, [], 'Delete');
    $this->assertSession()->elementTextContains('css', '#edit-password-enhancements', 'There are no constraints in this policy yet. Add one by selecting an option below.');

    // Make sure non-unique constraint can be added more than once.
    $page->selectFieldOption('edit-password-enhancements-new-constraint', 'special_character');
    $this->drupalPostForm(NULL, [], 'Save');
    $page->hasContent('Add Special character constraint');
    $this->drupalPostForm(NULL, [], 'Add constraint');
    $this->assertSession()->elementsCount('css', '#password-enhancements-policy-constraints > tbody > tr', 1);
    $this->assertSession()->elementTextContains('css', '#password-enhancements-policy-constraints > tbody td:nth-child(1n)', 'Special character');
    $page->selectFieldOption('edit-password-enhancements-new-constraint', 'special_character');
    $this->drupalPostForm(NULL, [], 'Save');
    $page->hasContent('Add Special character constraint');
    $this->drupalPostForm(NULL, [], 'Add constraint');
    $this->assertSession()->elementsCount('css', '#password-enhancements-policy-constraints > tbody > tr', 2);
    $this->assertSession()->elementTextContains('css', '#password-enhancements-policy-constraints > tbody tr:nth-child(1n) td:nth-child(1n)', 'Special character');
    $this->assertSession()->elementTextContains('css', '#password-enhancements-policy-constraints > tbody tr:nth-child(2n) td:nth-child(1n)', 'Special character');
  }

  /**
   * Tests constraint plugins' functionality not tested elsewhere.
   */
  public function checkConstraintPlugins(): void {
    $path = Url::fromRoute('user.role_add')->toString();
    $role_name = strtolower($this->randomMachineName());

    $session = $this->getSession();
    $page = $session->getPage();

    $this->drupalGet($path);
    // Fill out the Role name field.
    $page->fillField('edit-label', $role_name);
    // For some reason, this check is case-insensitive; therefore having an
    // uppercase letter in the role name might cause problems when trying to
    // load it later. To circumvent this, strtolower() is applied to the
    // random-generated machine name above, before using it anywhere.
    $session->wait(2500, "jQuery('.machine-name-value').text() === '{$role_name}'");

    // Check the #states for the special_characters plugin's config form.
    $page->checkField('edit-password-enhancements-apply-policy');
    $page->selectFieldOption('edit-password-enhancements-new-constraint', 'special_character');
    $this->drupalPostForm(NULL, [], 'Save');
    $this->assertJsCondition("jQuery('#edit-special-characters').is(':hidden')");
    $page->checkField('edit-use-custom-special-characters');
    $this->assertJsCondition("jQuery('#edit-special-characters').is(':visible')");

    // Check special_characters plugin's config form validation, submission and
    // summary.
    $page->fillField('edit-special-characters', ' !"#$%&\'()*+,-./:;<=>?@[\]^_`{|}~a');
    $this->drupalPostForm(NULL, [], 'Add constraint');
    $this->assertSession()->elementTextContains('css', '.messages--error', 'Alphanumeric characters are not allowed.');
    $page->fillField('edit-special-characters', '!"#$%&');
    $this->drupalPostForm(NULL, [], 'Add constraint');
    $this->assertSession()->elementsCount('css', '#password-enhancements-policy-constraints > tbody > tr', 1);
    $this->assertSession()->elementTextContains('css', '#password-enhancements-policy-constraints > tbody td:nth-child(1n)', 'Special character');
    $this->assertSession()->elementTextContains('css', '#password-enhancements-policy-constraints > tbody td:nth-child(2n)', 'No');
    $this->assertSession()->elementTextContains('css', '#password-enhancements-policy-constraints > tbody td:nth-child(3n)', 'Minimum characters: 1');
    $this->assertSession()->elementTextContains('css', '#password-enhancements-policy-constraints > tbody td:nth-child(3n)', 'Description (singular): Add at least one special character.');
    $this->assertSession()->elementTextContains('css', '#password-enhancements-policy-constraints > tbody td:nth-child(3n)', 'Description (plural): Add @minimum_characters more special characters.');
    $this->assertSession()->elementTextContains('css', '#password-enhancements-policy-constraints > tbody td:nth-child(3n)', 'Define special characters: Yes');
    $this->assertSession()->elementTextContains('css', '#password-enhancements-policy-constraints > tbody td:nth-child(3n)', 'Special characters: !"#$%&');
    $this->click('#password-enhancements-policy-constraints .edit a');
    $page->uncheckField('edit-use-custom-special-characters');
    $this->drupalPostForm(NULL, [], 'Update constraint');
    $this->assertSession()->elementsCount('css', '#password-enhancements-policy-constraints > tbody > tr', 1);
    $this->assertSession()->elementTextContains('css', '#password-enhancements-policy-constraints > tbody td:nth-child(1n)', 'Special character');
    $this->assertSession()->elementTextContains('css', '#password-enhancements-policy-constraints > tbody td:nth-child(2n)', 'No');
    $this->assertSession()->elementTextContains('css', '#password-enhancements-policy-constraints > tbody td:nth-child(3n)', 'Minimum characters: 1');
    $this->assertSession()->elementTextContains('css', '#password-enhancements-policy-constraints > tbody td:nth-child(3n)', 'Description (singular): Add at least one special character.');
    $this->assertSession()->elementTextContains('css', '#password-enhancements-policy-constraints > tbody td:nth-child(3n)', 'Description (plural): Add @minimum_characters more special characters.');
    $this->assertSession()->elementTextContains('css', '#password-enhancements-policy-constraints > tbody td:nth-child(3n)', 'Define special characters: No');
    $this->assertSession()->elementTextNotContains('css', '#password-enhancements-policy-constraints > tbody td:nth-child(3n)', 'Special characters: !"#$%&');
  }

  /**
   * Asserts that the logged in user has access to a given path.
   *
   * @param string $path
   *   The page path.
   *
   * @throws \Behat\Mink\Exception\ResponseTextException
   */
  protected function assertUserHasAccessToPath(string $path): void {
    $this->drupalGet($path);
    // Make sure that the user has access to the page (status code
    // check is not available in functional JavaScript tests).
    // @todo There might be a more elegant solution to check this.
    $this->assertSession()->pageTextNotContains('Access denied');
  }

}
