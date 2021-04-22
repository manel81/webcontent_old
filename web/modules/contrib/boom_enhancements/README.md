# Defining CKEDITOR styles in your theme

You can always check how `dp_zero_gravity` does this for an example.

1. Add the following key to your theme's `THEMENAME.info.yml` file:
    ```yaml
    custom_ckeditor_js: ''
    ```
1. Add a path to your `ckeditor.styles.js` file, e.g. if it's on the same level as the info file 
(the file name can be anything if the extension is `js` and the contents are right):
    ```yaml
    custom_ckeditor_js: 'ckeditor.js'
    ```
1. Add your CKEDITOR styles to the file, refer to the [official documentation](https://ckeditor.com/docs/ckeditor4/latest/guide/dev_howtos_styles.html) for more information:
    ```javascript
    CKEDITOR.stylesSet.add('dp_zero_gravity', [
        // Block-level styles.
        { name: 'Blue Title', element: 'h2', styles: { color: 'Blue' } },
        { name: 'Red Title',  element: 'h3', styles: { color: 'Red' } },
        
        // Inline styles.
        { name: 'CSS Style', element: 'span', attributes: { 'class': 'my_style' } },
        { name: 'Marker: Yellow', element: 'span', styles: { 'background-color': 'Yellow' } }
      ]
    );
    ```
   
**NOTE:**

* The  `CKEDITOR.stylesSet.add()` first parameter MUST be the machine name of your theme.
* If you don't define a `custom_ckeditor_js` in your theme then the parent theme's `custom_ckeditor_js` is being used (if it defines one)
* If you want to completely disable `custom_ckeditor_js` (even parent theme definitions), use it like this:
    ```javascript
    custom_ckeditor_js: false
    ```

