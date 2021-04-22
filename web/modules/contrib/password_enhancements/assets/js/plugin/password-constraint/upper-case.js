/**
 * @file
 * Password constraint upper-case validator plugin.
 */

(function ($) {

  Drupal.behaviors.passwordEnhancementsUpperCasePlugin = {
    attach: function (context, settings) {
      if (context.nodeName === '#document' || context.id === 'password-policy-constraint-ajax-wrapper') {
        // Register our plugin.
        var $field = $('.constraint[data-constraint="upper_case"]');
        window.dispatchEvent(new CustomEvent('passwordEnhancementsPluginLoad', {
          detail: {
            type: 'upper_case',
            id: $field.attr('id'),
            plugin: new UpperCasePlugin($field)
          }
        }));
      }
    }
  };

  /**
   * Constructs the upper-case constraint plugin.
   */
  function UpperCasePlugin(field) {
    PasswordEnhancementsMinimumCharacters.call(this, field);
  }

  // Inherit methods.
  UpperCasePlugin.prototype = Object.create(PasswordEnhancementsMinimumCharacters.prototype);

  /**
   * Overrides parent validate method.
   */
  UpperCasePlugin.prototype.validate = function (value, settings) {
    // Get all upper-cased characters.
    var matches = value.match(/([A-Z])/g);
    var characters = '';
    if (matches !== null) {
      characters = matches.join('');
    }

    return PasswordEnhancementsMinimumCharacters.prototype.validate.call(this, characters, settings);
  };

})(jQuery);
