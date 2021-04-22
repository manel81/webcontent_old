/**
 * @file
 * Javascript functions related to the Page builder's icon field.
 */
(function ($, Drupal) {

  'use strict';

  Drupal.behaviors.pageBuilder = {
    attach: function (context, settings) {
      Drupal.pageBuilder.addSelect2Icon(context, settings);
    }
  };

  Drupal.pageBuilder = {
    addSelect2Icon: function (context, settings) {
      $('.field--name-field-icon .select2-widget', context).on('select2-init', function (e) {
        var config = $(e.target).data('select2-config');

        config.escapeMarkup = function(m) {
          return m;
        };

        config.templateSelection = formatState;
        config.templateResult = formatState;

        $(e.target).data('select2-config', config);
      });

      function formatState (state) {
        if (!state.id) {
          return state.text;
        }

        return $(
          '<span class="select2-selection__icon ' + state.element.value + '"></span><span>' + state.text + '</span>'
        );
      }
    }
  };
})(jQuery, Drupal);
