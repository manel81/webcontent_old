# Guides

## Installation

1. Install https://packagist.org/packages/erusev/parsedown
2. Follow the instructions below on how to add guides
3. Enable the guides module, navigate to `/admin/guides` and see the uploaded documentations.

## Adding guides
1. Create a web-accessible folder and provide its relative path in `settings.php` or alike:
   ``` php
   $settings['guides_dir'] = '/guides';
   ```
   If you skip this step, it defaults to `/guides`.
2. Create a folder where you use underscores instead of spaces and optionally add a number prefix for ordering, e.g. `01_User_guide`, this will be a group title appearing on `/admin/guides`
3. Create markdown files inside the guide folder with underscores instead of spaces and an optional number prefix for ordering, e.g. `01_First_Chapter.md`, this will be the url for this guide grouped by the folder name, e.g.: `admin/guides/user-guide/first-chapter`
4. You can add images and asstes by creating an `Assets` folder inside the guide's folder, then use the `@guide_path` token for defining their location, where `@guide_path` is the folder of the guide, e.g. `![Landing page editing](@guide_path/Assets/2_editing.jpg)`

### Notes
* Only folders containing a single markdown file will work.
* Make sure the file extension `.md` is lowercase.
