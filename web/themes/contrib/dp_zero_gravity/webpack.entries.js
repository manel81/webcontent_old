const swaggerUiPluginsDir = './src/js/swagger-ui-plugins';
const customSwaggerUiPlugins = {
  SwaggerUiCodeHighlightPlugin: `${swaggerUiPluginsDir}/code-highlight/SwaggerUiCodeHighlightPlugin.jsx`,
  SwaggerUiInfoPlugin: `${swaggerUiPluginsDir}/info/SwaggerUiInfoPlugin.jsx`,
  SwaggerUiCodeSamplesPlugin: `${swaggerUiPluginsDir}/code-sample/SwaggerUiCodeSamplesPlugin.jsx`,
};

const blocks = {
  faq: `./src/js/blocks/DpFaqBlock.jsx`,
};

module.exports = {
  entry: {
    style: './src/scss/style.scss',
    'font-faces': './src/scss/font-faces.scss',
    'shift-homepage-content': './src/scss/shift-homepage-content.scss',
    polyfills: './src/js/polyfills.js',
    zero_gravity_active_links: './src/js/zero_gravity_active_links.js',
    zero_gravity_cards: './src/js/zero_gravity_cards.js',
    zero_gravity_ckeditor: './src/js/zero_gravity_ckeditor.js',
    zero_gravity_swagger_ui: './src/js/zero_gravity_swagger_ui.js',
    zero_gravity_views_accordion_quicklink: './src/js/zero_gravity_views_accordion_quicklink.js',
    vendor: ['react', 'react-dom', 'prop-types'],
    ...customSwaggerUiPlugins,
    ...blocks,
  },
};
