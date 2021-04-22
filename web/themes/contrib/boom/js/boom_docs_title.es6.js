(function sif(Drupal, $) {
  Drupal.behaviors.global = {
    attach: () => {
      const activeLink = $('aside nav').find('.in-active-trail');

      if (activeLink.length > 0) {
        const $siteContent = $('#site-content');
        const content = $siteContent.find('article.full');
        const pageTitle = $siteContent.find('.block--page-title-block');
        const pageTitleH1 = pageTitle.find('h1');
        const menuTitle = activeLink.parents('nav').children('h2');

        if (content.length === 0) {
          pageTitleH1.addClass('visually-hidden');
        } else {
          pageTitleH1.once('movePageTitle').removeClass('h1--page-title').prependTo(content);
        }

        pageTitle.parent().once('moveMenuTitle').prepend(`<h2 class="h1 h1--page-title">${menuTitle.text()}</h2>`);
      }
    },
  };
})(Drupal, jQuery);
