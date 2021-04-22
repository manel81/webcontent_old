# D8 In-page navigation module
The D8 In-page navigation module gathers h2 level headings from #content body
field, then renders an in-page navigation from the headings to the specified
entry points. The rendered In-page navigation doesn't contain any theming at
all, it provides the functionality of the navigation bar only.
It works only with h2 level headings and you can't change the depth of the
headings (yet). The in-page menu isn't visible with 1 or less menu items.

## Installing the In-page navigation module
Simply enable the module:
1. In the administrative menu, go to _Extend_.
2. Search for "In-page navigation" or find the module in the module list.
3. Select the checkbox next to the module's name to enable it.
### Configuration

## Set up the DOM selector
After enabling the module, you may have to set up the selector where the
navigation collects the headings from. You can do that under
/admin/appearance/settings/{theme}.

## Using the the module as the part of the menu block configuration
After enabling the module, it will show up as an option at any menu block (_Use
In-page navigation_ checkbox) at the bottom of the page. If this checkbox is
checked, the in-page navigation will be rendered as a submenu of the active menu
item of this menu.

## Using the module as an In-page navigation block
After enabling it, you can use a new block type in the In-page navigation
category. The active in-page navigation will be rendered as the content of this
block.
