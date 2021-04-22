# DP Zero Gravity starterkit

## Usage

1. Copy the starterkit folder to `themes/custom/`
1. Change `THEMENAME.starterkit.yml` to `THEMENAME.info.yml`
1. Rename filenames's **THEMENAME** part to your theme's name
1. Replace everything in files containing **THEMENAME** to your theme's name
   (except in README file)
1. Replace **BASETHEMEFOLDER** to the parent theme's folder name.
1. Create a symlink to DP Zero Gravity's SCSS folder in the subtheme's `scss/01-vendor/` folder if it's broken or doesn't exist. In terminal navigate to your subtheme and use the following command:

   ```
   ln -s ../../../../contrib/dp_zero_gravity/src/scss scss/01-vendor/zero_gravity
   ```

   You can test if it's working by issuing the `ls scss/01-vendor/zero_gravity` command, you should see a list of files and folders.

1. If a `.unicompilerc.json` file doesn't exist at the Drupal root, create one, see the [monorepo's config file](https://code.pronovix.net/plugins/gitiles/dp-mono-product/+/refs/heads/master/.unicompilerc.json) for an example and [Unicompile's docs](https://www.npmjs.com/package/unicompile) for additional options
1. In terminal, navigate to the Drupal root and use the `dp-unicompile` Pronoscript command to build the theme

## Adding custom Swagger UI plugins

The Zero Gravity theme provides custom Swagger UI plugins, which can be further
extended. This section explains how custom Swagger UI plugins can be added to
sub-themes created from Zero Gravity starterkit. As an example we will override
the default `Lowlight` component which is originally created and registered by
Zero Gravity.

### Creating a new/overridden component

Create components that might have already been registered within Swagger UI,
such components should be added under `wrapComponents` key, or you can even
register new components in the plugin using the `components` key. See the docs
for more examples.
E.g. in `./src/js/swagger-ui-plugins/code-highlight/wrap-components/CustomLowlight.js` we can register a new language
for code highlighting.

```javascript
import java from 'highlight.js/lib/languages/java';
import React from 'react';

export default (props) => {
  const Original = props.original;
  Original.registerLanguage('java', java);
  return <Original {...props} />;
};
```

### Creating a plugin

Create a plugin inside your theme's `[zgsubtheme]/src/js/swagger-ui-plugins/[plugin-name]`
folder. See the `dp_zero_gravity/src/js/swagger-ui-plugins` folder for
examples. The plugins should be functions that return an object with keys that
Swagger UI specifies. See the [official guide](https://swagger.io/docs/open-source-tools/swagger-ui/customization/plugin-api/) for more examples.
The function should be added to `window.customSwaggerUiPlugins` so that it will
be automatically registered when Swagger UI renders.
_Note: you can use the `system` and `config` variables inside every plugin. The
`system` variable is provided by Swagger UI, and `config` contains the properties
of `drupalSettings.swaggerUiConfig` object. This means that you can easily
extend this from preprocess functions._

E.g. in `./src/js/swagger-ui-plugins/code-highlight/SwaggerUiOverridesPlugin.js`:

```javascript
import React from 'react';
import Lowlight from './wrap-components/CustomLowlight';

if (!(window.customSwaggerUiPlugins instanceof Object)) {
  window.customSwaggerUiPlugins = {};
}

/**
 * Defines custom plugin for Swagger UI.
 *
 * @return {Object}
 *   Object with data that will be passed to Swagger UI.
 */
window.customSwaggerUiPlugins.SwaggerUiOverridesPlugin = (system, config) {
  return {
    wrapComponents: {
      Lowlight: (Original) => props => <Lowlight { ...props } original={ Original } />
    },
  }
};
```

In this example the original `Lowlight` component is overridden by a custom one.

### Register the new plugin as a Drupal library

After running webpack on our code (see Zero Gravity's webpack config as an
example), we need to tell Drupal to load our plugin's JavaScript file and the
file that adds the plugin to the config array. For that we need to create a new
library in the theme and load the library for the field.
E.g.

```yaml
zg_subtheme_swagger_ui_highlight:
  js:
    dist/js/SwaggerUiOverridesPlugin.js: {}
```

```php
function zg_subtheme_preprocess_field(array &$variables): void {
  if (in_array($variables['element']['#formatter'], ['swagger_ui_file', 'swagger_ui_link'])) {
    $variables['#attached']['library'][] = 'zg_subtheme/zg_subtheme_swagger_ui_highlight';
  }
```
