/**
 * @file global.js
 *
 * Global scripts.
 */

(($, Drupal) => {
  Drupal.behaviors.global = {
    attach(context, settings) {
      Drupal.global.dismissMessage();
      Drupal.global.stickyNavigation(context, settings);
      Drupal.global.setTables(context, settings);
      Drupal.global.mobileMenu(context, settings);
    },
  };

  Drupal.global = {
    dismissMessage() {
      const $dismiss = $('.messages').find('.dismiss');
      $dismiss.on('click', function cb() {
        $(this).parent().remove();
      });
    },
    stickyNavigation(context, settings) {
      const $navbar = $('#navigation');
      const $window = $(window);
      const $body = $('body');
      const $bodyPaddingTop = parseInt($body.css('padding-top'), 10);

      if (settings.sticky_navigation) {
        $window.on('scroll', () => {
          if ($window.scrollTop() > 0) {
            $navbar.addClass('sticky');
            $navbar.css('top', $bodyPaddingTop);
          } else if ($window.scrollTop() <= 0) {
            $navbar.removeClass('sticky');
          }
        });
      }
    },
    setTables() {
      const $table = $('table');

      if (!$table.parent().hasClass('table-wrapper')) {
        const $responsiveTable = $('<div>', {
          class: 'table-wrapper',
        });
        $table.wrap($responsiveTable).addClass('table table-hover table-striped');
      }
    },
    mobileMenu(context, settings) {
      const $navToggle = $('.navigation__toggle--nav', context);
      const $navs = $('.navigation nav', context);

      if (settings.nav_search_block) {
        const $searchToggle = $('.navigation__toggle--search', context);
        const $search = $(`.navigation ${settings.nav_search_block}`, context);
        $searchToggle.click(function cb() {
          $navToggle.removeClass('active');
          $navs.removeClass('open');
          $(this).toggleClass('active');
          $search.toggleClass('open');
        });

        $navToggle.click(function cb() {
          $searchToggle.removeClass('active');
          $search.removeClass('open');
          $(this).toggleClass('active');
          $navs.toggleClass('open');
        });
      } else {
        $navToggle.click(function cb() {
          $(this).toggleClass('active');
          $navs.toggleClass('open');
        });
      }
    },
  };
})(jQuery, Drupal);
