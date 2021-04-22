/**
 * @file
 * Autosubmit selected option on the select form.
 */

(() => {
  Drupal.behaviors.autosubmit = {
    attach: () => {
      const versionSwitcher = document.getElementById('api-reference-version-form');
      versionSwitcher.addEventListener('change', () => {
        versionSwitcher.submit();
      });
    },
  };
})();
