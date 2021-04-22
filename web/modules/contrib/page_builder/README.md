# Page Builder module

## Dependencies:
* paragraphs
* paragraphs_collapsible
* color_field
* svg_image
* link_class
* fieldblock
* select2
* block_field

## Install:
* Install dependencies if you don't have composer `merge-plugin` available:
    ``` shell
    composer require drupal/paragraphs drupal/paragraphs_collapsible \
    drupal/color_field drupal/svg_image drupal/link_class \
    drupal/fieldblock drupal/select2 npm-asset/select2 drupal/block_field \
    --no-interaction --prefer-dist -o --update-no-dev
    ```
* The `npm-asset/select2` dependency must be installed manually even if you do
  have composer `merge-plugin` available. Please refer to the README of the
  select2 module.
* Just enable the module and you can start creating landing pages right away.
* The module comes with some configuration options at 
  `/admin/structure/page-builder/settings`
    * You can set default row and column gaps for the grid system.
