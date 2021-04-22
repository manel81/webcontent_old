/**
 * @file
 * Javascript functions related to Page Builder.
 */
(function ($, Drupal) {

  'use strict';

  Drupal.behaviors.pageBuilder = {
    attach: function (context, settings) {
      Drupal.pageBuilder.columnFormDisplay(context, settings);
    }
  };

  Drupal.pageBuilder = {
    columnFormDisplay: function (context, settings) {
      $('.paragraphs-subform', context).each(function () {
        var $this = $(this);
        var $columnInput = $this.find('.field--name-field-grid-columns').find('input');
        var $columnRatioRows = $this.find('.field--name-field-grid-column-ratios').find('table tbody tr');

        // Initial state.
        if ($columnRatioRows.length > 0) {
          var counter = parseInt($columnInput.val());

          $columnRatioRows.each(function (index) {
            if (index < counter) {
              $(this).show();
            }
            else if (index === counter) {
              $(this).hide();
              counter++;
            }
          });
        }

        $columnInput.on('change', {
          columnInput: $columnInput,
          columnRatioRows: $columnRatioRows
        }, hideColumns);

      });
      /**
       * Callback function for input change.
       *
       * @param event
       *  Event data.
       */
      function hideColumns(event) {
        var columnInput = event.data.columnInput;
        var columnRatioRows = event.data.columnRatioRows;

        if (columnRatioRows.length > 0) {
          var counter = parseInt(columnInput.val());

          columnRatioRows.each(function (index) {
            if (index < counter) {
              $(this).show();
            }
            else if (index === counter) {
              $(this).hide();
              counter++;
            }
          });
        }
      }
    }
  };
})(jQuery, Drupal);
