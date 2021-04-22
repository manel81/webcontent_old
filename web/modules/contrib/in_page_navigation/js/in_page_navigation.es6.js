/**
 * @file
 * Inpage navigation function for devportals.
 */
(($, Drupal, drupalSettings) => {
  /**
   * Process node h2 elements and make in-page menu.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches in_page_navigation behaviors.
   */
  Drupal.behaviors.in_page_navigation = {
    // Temporary solution to avoid unused-vars error on settings:
    // eslint-disable-next-line no-unused-vars
    attach: (context, settings) => {
      const BLOCK = 'typeBlock';
      const MENU = 'typeMenu';
      const topOffset = drupalSettings.ip_navigation.top_offset || 0;
      const isSwagger = $('[id^="swagger-ui-field_source"]', context).length > 0;
      const getSelector = () => {
        return drupalSettings.ip_navigation.dom_element;
      };
      const globalListOfIDs = [];
      const menuStructure = [];
      let activeItem;
      const cutOutHTML = (str) => {
        const tempDivElement = document.createElement('div');
        tempDivElement.innerHTML = str;
        return tempDivElement.textContent || tempDivElement.innerText || '';
      };
      const makeSafeForCSS = (name) => {
        return cutOutHTML(name).replace(/[^a-z0-9]/g, (s) => {
          const c = s.charCodeAt(0);
          if (c === 32) return '-';
          if (c >= 65 && c <= 90) return `${s.toLowerCase()}`;
          const subString = `000${c.toString(16)}`;
          return `__${subString.slice(-4)}`;
        });
      };
      const uniqueID = (input, counter = 0) => {
        if ($.inArray(makeSafeForCSS(input), globalListOfIDs) === -1) {
          const currentID = makeSafeForCSS(input);
          globalListOfIDs.push(currentID);
          return currentID;
        }
        if (counter > 0) {
          input = input.slice(0, -1 * counter.toString().length);
        }
        counter += 1;
        return uniqueID(input + counter, counter);
      };
      const replaceHtmlEntities = (str) => {
        return str.replace(/[&<>]/g, (tag) => {
          const tagsToReplace = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
          };
          return tagsToReplace[tag] || tag;
        });
      };
      const buildMenu = (structure) => {
        let result = '<ul class="ip-navigation">';
        structure.forEach((structureItem, index) => {
          const title = replaceHtmlEntities(structureItem.title);
          result += `<li class="ip-navigation-item ip-navigation-item-${index}"><a data-ipTarget="${structureItem.safeTitle}" href="#${structureItem.safeTitle}" class="${structureItem.nodeNameClass} noZensmooth">${title}</a></li>`;
        });
        result += '</ul>';
        return result;
      };
      const between = (x, minMaxArr) => {
        return x >= minMaxArr[0] && x <= minMaxArr[1];
      };
      const minMax = (x, y) => {
        return x < y ? [x, y] : [y, x];
      };
      const setActiveItem = (heading) => {
        if (heading !== activeItem) {
          activeItem = heading;
          $('ul.ip-navigation a', context).removeClass('is-active');
          const ahref = heading.safeTitle;
          $(`a[data-ipTarget="${ahref}"]`, context).addClass('is-active');
        }
      };
      const setActiveipNAv = (headingList, currentOffset) => {
        $.each(headingList, (index, heading) => {
          if (heading !== _.last(headingList)) {
            if (between(currentOffset, minMax(heading.offset.top, headingList[index + 1].offset.top))) {
              setActiveItem(heading);
            }
          }
          // It isn't the first nor the last item.
          else if (between(currentOffset, minMax(heading.offset.top, $(document).height()))) {
            setActiveItem(heading);
          }
        });
      };
      const scrollToHeading = (heading) => {
        const sectionActivated = new Event('sectionActivated');
        $('html, body').animate(
          {
            scrollTop: $(`[data-ipcontent="${heading}"]`).offset().top + topOffset,
          },
          500,
          () => {
            const elem = $(`[data-ipcontent="${heading}"]`, context);
            const elemID = elem.attr('id');
            elem.attr('id', `${elemID}-temporary`);
            window.location.hash = elemID;
            elem.attr('id', elemID);
            sectionActivated.detail = heading;
            document.dispatchEvent(sectionActivated);
          },
        );
      };
      const getMenuContext = () => {
        const result = [];
        if ($('nav.block--in-page-navigation', context).length) {
          $.each($('nav.block--in-page-navigation', context), (index, element) => {
            result.push({
              element,
              type: BLOCK,
            });
          });
        }
        if ($('.attach_ip_navigation', context).length) {
          $.each($('.attach_ip_navigation', context), (index, element) => {
            result.push({
              element,
              type: MENU,
            });
          });
        }
        return result;
      };
      const swaggerUILoaded = new CustomEvent('swaggerUILoaded', {
        detail: 'The swaggerUI on the page is loaded.',
      });
      const app = () => {
        if ($(getSelector(), context).length > 1) {
          $('.region--content', context).addClass('has-ip-navigation');
          $(getSelector(), context).each((index, heading) => {
            const title = cutOutHTML($(heading).html());
            const safeTitle = $(heading, context).attr('id') ? $(heading).attr('id') : uniqueID(title);
            $(heading).attr('data-ipContent', safeTitle).attr('id', safeTitle);
            const offset = $(heading).offset();
            const nodeNameClass = `element-type--${heading.nodeName.toLowerCase()}`;
            menuStructure.push({
              index,
              title,
              safeTitle,
              offset,
              nodeNameClass,
            });
          });
          _.each(getMenuContext(), (entryPoint) => {
            switch (entryPoint.type) {
              case BLOCK:
                $('nav.block--in-page-navigation', context).append(buildMenu(menuStructure));
                window.dispatchEvent(swaggerUILoaded);
                $('nav.block--in-page-navigation li.ip-navigation-item a', context).click((e) => {
                  e.preventDefault();
                  const theTarget = e.target.nodeName === 'A' ? e.target : e.currentTarget;
                  scrollToHeading(theTarget.dataset.iptarget);
                });
                break;
              default:
                $('.attach_ip_navigation a.is-active', context).after(buildMenu(menuStructure));
                window.dispatchEvent(swaggerUILoaded);
                $('.attach_ip_navigation .ip-navigation-item a', context).click((e) => {
                  e.preventDefault();
                  const theTarget = e.target.nodeName === 'A' ? e.target : e.currentTarget;
                  scrollToHeading(theTarget.dataset.iptarget);
                });
                break;
            }
          });
          setActiveipNAv(menuStructure, $(document).scrollTop());
          $(window)
            .once('in_page_navigation')
            .scroll(() => {
              setActiveipNAv(menuStructure, $(document).scrollTop());
            });
        } else {
          $('nav.block--in-page-navigation', context).hide();
        }
      };
      if (isSwagger && context === document) {
        $(window).bind('swaggerUIFormatterOptionsAlter', (event, options) => {
          // Save existing onComplete function if any.
          let existingOnComplete = null;
          if (options.hasOwnProperty('onComplete')) {
            existingOnComplete = options.onComplete;
          }
          options.onComplete = () => {
            // Call previously defined onComplete function if any.
            if (typeof existingOnComplete === 'function') {
              existingOnComplete();
            }
            app();
          };
        });
      } else {
        app();
      }
    },
  };
})(jQuery, Drupal, drupalSettings);
