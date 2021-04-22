/*
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

/**
 * @file
 * Create icons in the header of accordions.
 * These icons when clicked will update the url with the text content of the header.
 * On page load if the url has info about a selected view item that item will be opened and scrolled to.
 */

(($, Drupal) => {
  Drupal.behaviors.boomViewItemQuicklink = {
    attach: (context, settings) => {
      let iconClass = 'feather-copy';
      if (settings.quicklinkConfig) {
        ({ iconClass } = settings.quicklinkConfig);
      }
      const $containers = $('.accordion-quicklinks-on');
      const linkClass = 'ui-accordion-quicklink';

      $containers.once('addedActivatedEventListener').on('accordionbeforeactivate', (e, ui) => {
        if (ui.newHeader.length > 0) {
          const $header = $(ui.newHeader);
          const $headerText = $header.find('.ui-accordion-header-text');
          const $icon = $('<span>').addClass(iconClass);
          const fadeOutHandler = function cb() {
            $(this).remove();
          };
          const copyLinkHandler = function cb(event) {
            event.stopPropagation();
            const $body = $('body');
            const $temp = $('<input>');
            const copyPath = `${window.location.origin}${window.location.pathname}${window.location.search}#${$(
              this.parentElement,
            ).attr('id')}`;
            $body.append($temp);
            $temp.val(copyPath).select();
            document.execCommand('copy');
            $temp.remove();
            const $responseMessage = $(
              `<div role="alert" class="tooltip">${Drupal.t('Link copied to clipboard.')}</div>`,
            )
              .css({
                position: 'fixed',
                bottom: '10%',
                left: '50%',
                transform: 'translateX(-50%)',
              })
              .fadeOut(3000, fadeOutHandler);
            window.history.replaceState(null, null, copyPath);
            $body.append($responseMessage);
          };
          const $link = $('<a role="button">')
            .append($icon)
            .addClass(`${linkClass}`)
            .attr('data-tooltip', Drupal.t('Copy link'))
            .on('click', copyLinkHandler);
          $link.insertAfter($headerText);
        }

        if (ui.oldHeader.length > 0) {
          ui.oldHeader.find(`.${linkClass}`).remove();
        }
      });

      const openItemByUrlHash = () => {
        if (window.location.href.indexOf('#') === -1) {
          return false;
        }
        const id = window.location.href.split('#')[1];
        const item = $(`#${id}`);

        if (item === null) {
          return;
        }

        const $target = $(item.closest($containers));
        const index = $target.find('.ui-accordion-header').index(item);

        if (index === -1) {
          return;
        }

        $('html, body').animate({ scrollTop: item.offset().top - $('#navigation').height() });
        $target.accordion('option', 'active', index);
      };

      openItemByUrlHash();
    },
  };
})(jQuery, Drupal);
