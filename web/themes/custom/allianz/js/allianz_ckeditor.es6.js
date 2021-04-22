Drupal.behaviors.allianzCkeditor = {
  finishedClass: 'allianz-ckeditor--finished',
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
    CKEDITOR.stylesSet.add('allianz', [
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
      {
        name: 'Highlighted text',
        element: 'span',
        attributes: { class: 'text--highlighted' },
      },
    ]);
    CKEDITOR.on('instanceReady', (e) => {
      const { editor } = e;
      Drupal.behaviors.allianzCkeditor.updateListsCb(e);
      editor.on('change', Drupal.behaviors.allianzCkeditor.updateListsCb);
    });
    if (!document.body.classList.contains(this.finishedClass)) {
      document.body.classList.add(this.finishedClass);
    }
  },
};
