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
 * @file Custom CKEDITOR styles and additional behavior.
 */

Drupal.behaviors.zeroGravityCkeditor = {
  finishedClass: 'zero-gravity-ckeditor--finished',
  updateListsCb: (e) => {
    const { editor } = e;
    const lists = editor.document.$.querySelectorAll('ul, ol');
    if (lists.length > 0) {
      lists.forEach((element) => {
        if (!element.classList.contains('list')) {
          editor.fire('lockSnapshot');
          element.classList.add('list');
          editor.fire('unlockSnapshot');
        }
      });
    }
  },
  attach: function attach() {
    if (document.body.classList.contains(this.finishedClass)) {
      return;
    }
    CKEDITOR.stylesSet.add('dp_zero_gravity', [
      {
        name: 'Heading 1 - Hero variant',
        element: 'h1',
        attributes: { class: 'h1--hero' },
      },
      {
        name: 'Heading 1 - Page title',
        element: 'h1',
        attributes: { class: 'h1--page-title' },
      },
      {
        name: 'Primary button',
        element: 'a',
        attributes: { class: 'button button--primary' },
      },
      {
        name: 'Primary Inverted button',
        element: 'a',
        attributes: { class: 'button button--primary--inverted' },
      },
      {
        name: 'Secondary button',
        element: 'a',
        attributes: { class: 'button button--secondary' },
      },
      {
        name: 'Secondary Inverted button',
        element: 'a',
        attributes: { class: 'button button--secondary--inverted' },
      },
      {
        name: 'Card link',
        element: 'a',
        attributes: { class: 'card__link' },
      },
      {
        name: 'Card link with arrow',
        element: 'a',
        attributes: { class: 'card__link card__link--arrow' },
      },
      {
        name: 'Version pill',
        element: 'span',
        attributes: { class: 'version' },
      },
      {
        name: 'Tag pill',
        element: 'span',
        attributes: { class: 'tag' },
      },
      { name: 'Inline quote', element: 'span', attributes: { class: 'text--quote' } },
      { name: 'Light text', element: 'span', attributes: { class: 'text--light' } },
      { name: 'Dark text', element: 'span', attributes: { class: 'text--dark' } },
      { name: 'Lead text', element: 'span', attributes: { class: 'text--lead' } },
      { name: 'Small text', element: 'span', attributes: { class: 'text--small' } },
      { name: 'Code - Inline', element: 'span', attributes: { class: 'code' } },
      { name: 'Code - Block - Light', element: 'span', attributes: { class: 'code code--block' } },
      { name: 'Code - Block - Dark', element: 'span', attributes: { class: 'code code--block code--dark' } },
      { name: 'Light list - Bulleted', element: 'ul', attributes: { class: 'list--light' } },
      { name: 'Light list - Numbered', element: 'ol', attributes: { class: 'list--light' } },
      {
        name: 'Step by step list',
        element: 'ol',
        attributes: { class: 'list--step-by-step' },
      },
      {
        name: 'Step by step list - Light',
        element: 'ol',
        attributes: { class: 'list--light list--step-by-step' },
      },
    ]);
    CKEDITOR.on('instanceReady', (e) => {
      const { editor } = e;
      Drupal.behaviors.zeroGravityCkeditor.updateListsCb(e);
      editor.on('change', Drupal.behaviors.zeroGravityCkeditor.updateListsCb);
    });
    if (!document.body.classList.contains(this.finishedClass)) {
      document.body.classList.add(this.finishedClass);
    }
  },
};
