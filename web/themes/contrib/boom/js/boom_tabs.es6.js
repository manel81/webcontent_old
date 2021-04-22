/**
 * @file
 * Make tab navigation like filter for FAQ pages according to the select list
 *     of terms.
 */

/**
 * Process Category option elements and make tab menu filter.
 *
 * @type {Drupal~behavior}
 *
 * @prop {Drupal~behaviorAttach} attach
 *   Attaches in_page_navigation behaviors.
 */

let VIEW_CLASS = null;
let FILTER_ID = null;

const getActiveValue = (selector) => {
  const select = document.querySelector(selector);
  return select.options[select.selectedIndex].value;
};

const buildTab = (value, text) => {
  const li = document.createElement('LI');
  const anchor = document.createElement('A');
  anchor.setAttribute('data-option-value', value);
  // anchor.setAttribute('href', `#${value}`);
  anchor.appendChild(document.createTextNode(text));
  if (value === getActiveValue(`${VIEW_CLASS} .form-select`)) {
    anchor.className = 'is-active';
    const span = document.createElement('span');
    span.className = 'visually-hidden';
    span.appendChild(document.createTextNode('(active tab)'));
    anchor.appendChild(span);
  }
  li.appendChild(anchor);

  return li;
};

const buildTabs = (data) => {
  return data.map((item) => {
    const { value, text } = item;
    return buildTab(value, text);
  });
};

const makeNavWrapper = (data) => {
  const text = document.createTextNode('Primary tabs');
  const title = document.createElement('H2');
  title.className = 'visually-hidden';
  title.appendChild(text);
  const ul = document.createElement('UL');
  ul.className = 'tabs';
  ul.classList.add('tabs--primary');
  const liList = buildTabs(data);
  liList.forEach((li) => {
    return ul.appendChild(li);
  });
  const nav = document.createElement('NAV');
  nav.className = 'tab-navigation';
  nav.appendChild(title);
  nav.appendChild(ul);
  return nav;
};

Drupal.behaviors.optionsToTabs = {
  // Temporary solution to avoid unused-vars error on settings:
  // eslint-disable-next-line no-unused-vars
  attach: (context, settings) => {
    VIEW_CLASS = `.view--${settings.tabsConfig.viewName}`;
    FILTER_ID = settings.tabsConfig.filterToHideId;
    const sources = Array.prototype.slice
      .call((context || document).querySelectorAll(`${VIEW_CLASS} select option`))
      .map((source) => {
        const { value, text } = source;
        return { value, text };
      });

    if (sources.length) {
      const handleClick = (e) => {
        e.preventDefault();
        (context || document).querySelector(`${VIEW_CLASS} .form-select`).value = e.target.getAttribute(
          'data-option-value',
        );

        (context || document).querySelector(`${FILTER_ID} .form-submit`).click();
      };

      (context || document).querySelector(FILTER_ID).insertAdjacentElement('beforebegin', makeNavWrapper(sources));

      const links = (context || document).querySelectorAll(`${VIEW_CLASS} .tabs--primary a`);
      for (let i = 0; i < links.length; i++) {
        links[i].addEventListener('click', handleClick);
      }
    }
  },
};
