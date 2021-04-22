<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/administrative-menu/administrative-menu"
alt="Administrative menu" target="_self"><< Administrative menu</a> |
<a href="/admin/guides/what-content-type-should-i-use/what-content-type-should-i-use"
alt="What content type should I use" target="_self">What content type should I use >></a></strong></p>

---

# Menu settings

</br>

### Prerequisite knowledge

- [Administrative menu](/admin/guides/administrative-menu/administrative-menu)

</br>

### Table of Contents

- [Main navigation](#main-navigation)
    - [Creating menu item](#create-main-item)
    - [Reordering menu items](#reorder-main)
    - [Hiding/disabling menu items](#hide-main-items)
    - [Editing menu items](#edit-main)
    - [Deleting menu items](#delete-main)
- [Footer menu](#footer-menu)
    - [Creating menu item](#create-footer-item)
    - [Reordering menu items](#reorder-footer)
    - [Hiding/disabling menu items](#hide-footer-items)
    - [Editing menu items](#edit-footer)
    - [Deleting menu items](#delete-footer)
- [Related topics](#related-topics)
- [FAQ](#faq)

<!-- IN THIS CHAPTER (BLUE) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f4f8fa">
			<tr bgcolor="#f4f8fa">
			<td bgcolor="#5bc1de" style="width: 1px"></td>
			<td width="100%"><p><font color="#5bc1de"><strong>In this chapter</strong></font>
            </br><font color="#5bc1de">You learn how to adjust the different menu elements of the portal, like
            the Main navigation and the Footer menu.</font></p>
			</td>
		</tr>
	</tbody>
</table>

</br>
## <a id="main-navigation"></a>Main navigation
</br>

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font></br><font color="#f0ad4e">Main
            navigation menu is one of the most important navigation tools of the portal. Main navigation is always
			visible for the users, so it has to list the main services of the site in a well-structured way (e.g.,
			<em>Home</em>, <em>API Catalog</em>, <em>Blog</em>, <em>FAQ</em>).</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Header section of the home page with highlighted Main
            navigation menu." src="@guide_path/assets/6593_main_navigation.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Header section of the home page with highlighted Main navigation
            menu.</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

### <a id="create-main-item"></a>Creating menu item

Assume that a landing page for a brand new feature called _Demo_ has been created and this page must be available for
the users from the Main navigation.

To **create** a new Main navigation item, follow the steps below:

1. In the administrative menu, go to _Structure_ > _Menus_ > _Main navigation_> _Add link_. Or go straight to
`/admin/structure/menu/manage/main/add`

2. <font color="red"><font color="red">(required)</font></font> Add a _Menu link title_. This title appears in the Main
navigation as a selectable item. (e.g., Demo)

3. <font color="red">(required)</font> Fill the _Link_ text box to define the location this menu link points to. Start
typing the title of a piece of content to select it.

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font></br><font color="#f0ad4e">You can also
            enter an internal path like /node/add, or an external URL like http://www.example.com.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

4. Leave the _Enabled_ check box marked to display the new item on the Main navigation menu after the
configuration.

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
            </br><font color="#f0ad4e">If you clear the Enabled check box, the created menu item isn't become visible for
			the users. You can change this option later.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

5. Write a short _Description_ that appears when hovering over the menu link.

6. (optional, **not recommended**) Mark the _Show as expanded_ check box if this menu link has children and you want this
menu to always appear expanded.

7. Be sure the _Parent Link_ is set to _Main navigation_.

8. (optional, **not recommended**) Define the _Weight_ of your menu item by modifying the default value. (default: 0).

9. Click _Save_ to apply your changes. You get a notification. Navigate back to your home page.

<!-- MILESTONE -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f1f9f1">
			<td bgcolor="#5cb85c" style="width: 1px"></td>
			<td width="100%"><p><font color="#5cb85c"><strong>Milestone</strong></font>
            </br><font color="#5cb85c">If you didn’t change the default weight, your new menu item appears as the
            last item on the Main navigation menu.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font></br><font color="#f0ad4e">If you can’t
            see the change, <a href="/admin/guides/faq/faq#faq-cache">try flushing caches</a>.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Add item to main menu"
            src="@guide_path/assets/6593_main_navigation_add.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font></br><font color="#f0ad4e">
            The text from the Description field appears as a flag when hovering over the menu link.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Main navigation new item"
            src="@guide_path/assets/6593_main_navigation_newitem.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

### <a id="reorder-main"></a>Reordering menu items

In the previous chapter, you have created a new menu item (e.g., _Demo_). If you didn’t change the default weight during
the process of creation, _Demo_ is the last item on the Main navigation and must look something like this:

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Reorder main menu"
            src="@guide_path/assets/6593_main_navigation_reorder.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

Let’s suppose that the new _Demo_ feature is more important than the _Blog_ or _FAQ page_, and a statistical survey
also revealed that more users click on the _Pet APIs_ option than the _API Catalog_, so these two items
must be rearranged, too.

To **reorder** Main navigation menu items, follow the steps below:

1. Click the [pencil icon](/admin/guides/administrative-menu#quick-edit-icons) next to the Main navigation and select
the _Edit menu_ option.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Main navigation edit icon"
            src="@guide_path/assets/6593_main_navigation_edit_icon.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
			</br><font color="#f0ad4e">Or in the administrative menu, go to <em>Structure</em> > <em>Menus</em> >
			<em>Main navigation</em>.</br>Or go straight to /admin/structure/menu/manage/main/.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

2. You can find the current items of the Main navigation in the table in the following order: the item on the top of the
table is the first element on the left in the Main navigation (e.g., _Guidelines_).

3. Click the small cross arrow on the left side of the items and reorder the elements by dragging and dropping them
to their new place.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Drag the menu items to their new place"
            src="@guide_path/assets/6593_main_navigation_reorder_dragndrop.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Drag the menu items to their new place.
			</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

4. After the modification, a small asterisk (`*`) appears on the right side of each moved item and a notification points
out that you have unsaved changes.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="New reorder main menu"
            src="@guide_path/assets/6593_main_navigation_reorder_new.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

5. Click _Save_ to apply your changes. You get a notification. Navigate back to your home page.

<!-- MILESTONE -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f1f9f1">
			<td bgcolor="#5cb85c" style="width: 1px"></td>
			<td width="100%"><p><font color="#5cb85c"><strong>Milestone</strong></font>
            </br><font color="#5cb85c">The menu items appear by the new order in the Main navigation.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

<!-- IMAGE -->
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Main navigation new order"
            src="@guide_path/assets/6593_main_navigation_new_order.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
			</br><font color="#f0ad4e">If you can’t see the changes,
			<a href="/admin/guides/faq/faq#faq-cache">try flushing caches</a>.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

### <a id="hide-main-items"></a>Hiding/disabling menu items

Let's take the layout of the Main navigation as an example from the result of the previous subchapter.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Main navigation new order"
            src="@guide_path/assets/6593_main_navigation_new_order.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

Imagine you received a notification about the FAQ page is being updated and must be inaccessible for the end users
during maintenance, which means, you have to remove this item from the Main navigation menu without deleting it.

To **hide (disable)** Main navigation menu items, follow the steps below:

1. Click the [pencil icon](/admin/guides/administrative-menu#quick-edit-icons) next to the Main navigation and select
the _Edit menu_ option.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Main navigation disable ui"
            src="@guide_path/assets/6593_main_navigation_disable_ui.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
			</br><font color="#f0ad4e">Or in the
            administrative menu, go to <em>Structure</em> > <em>Menus</em> > <em>Main navigation</em>.
			</br>Or go straight to /admin/structure/menu/manage/main/.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

2. Find the item you want to hide (e.g., FAQ) from the Main navigation in the table.

3. Clear the _Enabled_ check box on the right side of the item’s row.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Main navigation disable edit"
            src="@guide_path/assets/6593_main_navigation_disable_edit.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

4. Click _Save_ to apply your changes. You get a notification. Navigate back to your home page.

<!-- MILESTONE -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f1f9f1">
			<td bgcolor="#5cb85c" style="width: 1px"></td>
			<td width="100%"><p><font color="#5cb85c"><strong>Milestone</strong></font>
            </br><font color="#5cb85c">FAQ is now hidden from the Main navigation.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Main navigation disable result"
            src="@guide_path/assets/6593_main_navigation_disable_result.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
			</br><font color="#f0ad4e">If you can’t see the changes,
			<a href="/admin/guides/faq/faq#faq-cache">try flushing caches</a>.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

### <a id="edit-main"></a>Editing menu items

Let's take the layout of the Main navigation as an example from the result of the previous subchapter.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Main navigation disable result"
            src="@guide_path/assets/6593_main_navigation_disable_result.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

Assume that a new landing page has been created (e.g., New Demo) that must replace the old one on the site
(e.g., _Demo_). This new page must be accessible from the Main navigation menu too, but the company want to keep the
original name of the link for the benefit of the registered users. You have to modify the URL and the Description of
the menu item to make it more suitable for the new content without changing the Title.

To **edit** Main navigation menu items, follow the steps below:

1. Click the [pencil icon](/admin/guides/administrative-menu#quick-edit-icons) next to the Main navigation and select
the _Edit menu_ option.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Main navigation edit ui"
            src="@guide_path/assets/6593_main_navigation_edit_ui.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
			</br><font color="#f0ad4e">Or in the administrative menu, go to <em>Structure</em> > <em>Menus</em> >
			<em>Main navigation</em>.</br>Or go straight to /admin/structure/menu/manage/main/.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

2. Find the title of the Main navigation menu item you need to edit (e.g., Demo).

3. Click _Edit_ at the end of the row.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Main navigation edit"
            src="@guide_path/assets/6593_main_navigation_edit_edit.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

4. Edit the copy or its settings on the appearing page. (e.g., _Link_, _Description_)

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
			</br><font color="#f0ad4e">The Menu link title is remained the same as before.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Main navigation edit modify"
            src="@guide_path/assets/6593_main_navigation_edit_modify.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

5. Click _Save_ to apply your changes.

<!-- MILESTONE -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f1f9f1">
			<td bgcolor="#5cb85c" style="width: 1px"></td>
			<td width="100%"><p><font color="#5cb85c"><strong>Milestone</strong></font>
            </br><font color="#5cb85c">The settings of the menu item are updated.
			</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Main navigation edit result"
            src="@guide_path/assets/6593_main_navigation_edit_result.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
			</br><font color="#f0ad4e">If you can’t see the changes,
			<a href="/admin/guides/faq/faq#faq-cache">try flushing caches</a>.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

### <a id="delete-main"></a>Deleting menu items

Let's take the layout of the Main navigation menu as an example from the result of the previous subchapter.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Main navigation edit result"
            src="@guide_path/assets/6593_main_navigation_edit_result.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

Let’s suppose that after the release of the _Pet 2 APIs_ the former _Pet APIs_ became outdated and has to be removed
from the Main navigation.

To **delete** the Main navigation items, follow the steps below:

1. Click the [pencil icon](/admin/guides/administrative-menu#quick-edit-icons) next to the Main navigation and select
the _Edit menu_ option.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Main navigation edit ui"
            src="@guide_path/assets/6593_main_navigation_edit_ui.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
			</br><font color="#f0ad4e">Or in the administrative menu, go to <em>Structure</em> > <em>Menus</em> >
			<em>Main navigation</em>.</br>Or go straight to /admin/structure/menu/manage/main/.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

2. Find the title of the Main navigation menu item you need to delete (e.g., _Pet APIs_).

3. Select the _Delete_ operation from the drop-down menu at the end of the row.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Main navigation delete edit"
            src="@guide_path/assets/6593_main_navigation_delete_edit.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

4. You get a confirmation message. Click _Delete_ to remove the Menu item for sure, or
_Cancel_ to leave the page without changes.

<!-- MILESTONE -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f1f9f1">
			<td bgcolor="#5cb85c" style="width: 1px"></td>
			<td width="100%"><p><font color="#5cb85c"><strong>Milestone</strong></font>
            </br><font color="#5cb85c">The Main navigation menu has been updated.
			</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Main navigation delete result"
            src="@guide_path/assets/6593_main_navigation_delete_result.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
			</br><font color="#f0ad4e">If you can’t see the changes,
			<a href="/admin/guides/faq/faq#faq-cache">try flushing caches</a>.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
			</br><font color="#f0ad4e">If you
            <a href="#hide-main-items"><strong>disable a menu item</strong></a> you can <strong>hide it</strong>
			from the Main navigation <strong>without deleting it</strong>. <strong>The page</strong> that is connected
			to the deleted item <strong>stays on the site</strong>. <strong>If you delete a node, its link in the Main
			navigation is deleted too.
            </strong></font></p></td>
		</tr>
	</tbody>
</table>

</br>
## <a id="footer-menu"></a>Footer menu
</br>

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
			</br><font color="#f0ad4e">The role of the Footer menu is to help users find legal or other information
			(e.g., <em>Contact</em>, <em>Terms of Use</em>, <em>Privacy Policy</em>) on the bottom of every page of the
			developer portal without the need to scroll back up to the Main navigation.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Footer default ui"
            src="@guide_path/assets/6593_footer_default_ui.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

### <a id="create-footer-item"></a>Creating menu item

Imagine that you have read an argument from a user on the forum of your company how useful would it be if the visitors
could reach the FAQ from more places, not just from the Main navigation menu. As a site administrator, you can help
fulfill this need.

To **create** a new Footer menu item, follow the steps below:

1. In the administrative menu, go to _Structure_ > _Menus_ > _Footer_> _Add link_. Or go straight to
`/admin/structure/menu/manage/footer/add`.

2. <font color="red">(required)</font> Add a _Menu link title_. This title appears in the Footer menu as a selectable
item (e.g., _FAQ_).

3. <font color="red">(required)</font> Fill the _Link_ text box to define the location this menu link points to. Start
typing the title of a piece of content to select it.

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
			</br><font color="#f0ad4e">You can also enter an internal path like /node/add or an external URL like
			http://www.example.com.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

4. Leave the _Enabled_ check box marked to make the new item visible on the Footer menu after the configuration.

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
			</br><font color="#f0ad4e">If you clear the Enabled check box, the created menu item isn't become visible
			for the users. You can change this option later.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

5. Write a short _Description_ that is shown when hovering over the menu link with the cursor.

6. (Optional, **Not recommended**) Mark the _Show as expanded_ check box if this menu link has children and you want
this menu to always appear expanded.

7. Be sure the _Parent Link_ is set to _Footer_.

8. (Optional, **Not recommended**) Define the _Weight_ of your menu item by modifying the default value. (default: 0)

9. Click _Save_ to apply your changes. You get a notification. Navigate back to your home page.

<!-- MILESTONE -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f1f9f1">
			<td bgcolor="#5cb85c" style="width: 1px"></td>
			<td width="100%"><p><font color="#5cb85c"><strong>Milestone</strong></font>
            </br><font color="#5cb85c">The new item is among the others in the Footer menu.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Footer create edit"
            src="@guide_path/assets/6593_footer_create_edit.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Footer modified ui"
            src="@guide_path/assets/6593_footer_modified_ui.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
			</br><font color="#f0ad4e">If you can’t see the change,
			<a href="/admin/guides/faq/faq#faq-cache">try flushing caches</a>.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

### <a id="reorder-footer"></a>Reordering menu items

Let's take the layout of the Footer menu as an example from the result of the previous subchapter.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Footer reorder ui"
            src="@guide_path/assets/6593_footer_reorder_ui.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

Assume that the feedback regarding the new Footer menu layout is so positive you decided to put the FAQ item to the
first place by rearranging it with the Contact item.

To **reorder** the Footer menu items, follow the steps below:

1. In the administrative menu, go to _Structure_ > _Menus_ > _Footer_. Or go straight to
`/admin/structure/menu/manage/footer/`.

2. You can find the current items of the Footer menu in the table in the following order: the item on the top of the
table is the first element on the left in the Footer menu (e.g., _Contact_).

3. Click the small cross arrow on the left side of the items and reorder the elements by dragging and dropping them
to their new place.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Drag the footer menu items to their new place."
            src="@guide_path/assets/6593_footer_reorder_edit.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Drag the menu items to their new place.
			</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

4. After the modification, a small asterisk appears on the right side of each moved item and a notification points out
that you have unsaved changes.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Footer reorder unsaved"
            src="@guide_path/assets/6593_footer_reorder_edit_unsaved.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

5. Click _Save_ to apply your changes. You get a notification. Navigate back to your home page.

<!-- MILESTONE -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f1f9f1">
			<td bgcolor="#5cb85c" style="width: 1px"></td>
			<td width="100%"><p><font color="#5cb85c"><strong>Milestone</strong></font>
            </br><font color="#5cb85c">The menu items appear by the new order on the Footer menu.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Footer reorder result"
            src="@guide_path/assets/6593_footer_reorder_result.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
			</br><font color="#f0ad4e">If you can’t see the changes,
			<a href="/admin/guides/faq/faq#faq-cache">try flushing caches</a>.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

### <a id="hide-footer-items"></a>Hiding/disabling menu items

Let's take the layout of the Footer menu as an example from the result of the previous subchapter.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Footer reorder result"
            src="@guide_path/assets/6593_footer_reorder_result.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

Imagine that from the heatmap of the portal created by an eye-tracking software, you discovered that most of the
visitors never access the Contact page by using the Footer menu. You must remove it from the menu without deleting the
item.

To **hide (disable)** the Footer menu items, follow the steps below:

1. In the administrative menu, go to _Structure_ > _Menus_ > _Footer_. Or go straight to
`/admin/structure/menu/manage/footer/`.

2. Find the item you want to hide (e.g., Privacy Policy) from the Footer menu in the table.

3. Clear the _Enabled_ box on the right side of the item’s row.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Footer hide edit"
            src="@guide_path/assets/6593_footer_hide_edit.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

4. Click _Save_ to apply your changes. You get a notification. Navigate back to your home page.

<!-- MILESTONE -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f1f9f1">
			<td bgcolor="#5cb85c" style="width: 1px"></td>
			<td width="100%"><p><font color="#5cb85c"><strong>Milestone</strong></font>
            </br><font color="#5cb85c">Contact is now hidden from the Footer menu.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Footer hide result"
            src="@guide_path/assets/6593_footer_hide_result.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
			</br><font color="#f0ad4e">If you can’t see the changes,
			<a href="/admin/guides/faq/faq#faq-cache">try flushing caches</a>.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

### <a id="edit-footer"></a>Editing menu items

Let's take the layout of the Footer menu as an example from the result of the previous subchapter.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Footer hide result"
            src="@guide_path/assets/6593_footer_hide_result.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

Let’s suppose that because of the change of your company’s legal environment the current Privacy Policy is not valid
anymore but that page must be kept. A new Policy page has been created and you have to update the Footer menu by
changing the URL of the item.

To **edit** the Footer menu items, follow the steps below:

1. In the administrative menu, go to _Structure_ > _Menus_ > _Footer_. Or go straight to
`/admin/structure/menu/manage/footer/`.

2. Find the title of the Footer menu item you need to edit (e.g., Privacy Policy).

3. Click _Edit_ at the end of the row.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Footer edit again"
            src="@guide_path/assets/6593_footer_edit_edit.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

4. Edit the copy or its settings on the appearing page. (e.g., _Link_)

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font></br><font color="#f0ad4e">
			The Menu link title is remains the same as before.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Footer edit modify"
            src="@guide_path/assets/6593_footer_edit_modify.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

5. Click _Save_ to apply your changes. You get a notification. Navigate back to your home page.

<!-- MILESTONE -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f1f9f1">
			<td bgcolor="#5cb85c" style="width: 1px"></td>
			<td width="100%"><p><font color="#5cb85c"><strong>Milestone</strong></font>
            </br><font color="#5cb85c">The settings of the menu item are updated.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

### <a id="delete-footer"></a>Deleting menu items

Let's take this layout of the Footer menu as an example:

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Footer delete ui"
            src="@guide_path/assets/6593_footer_delete_ui.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

Imagine that a new page (e.g., _Demo_) has been connected to the Footer menu for a brief testing period, but it turned
out, this new page is more important, so it has to be in the Main navigation menu instead. You have to delete the Demo
item from the Footer menu.

To **delete** the Footer menu items, follow the steps below:

1. In the administrative menu, go to _Structure_ > _Menus_ > _Footer_. Or go straight to
`/admin/structure/menu/manage/footer/`.

2. Find the title of the Footer menu item you need to delete (e.g., _Demo_).

3. Select the _Delete_ operation from the drop-down menu at the end of the row.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Footer delete edit"
            src="@guide_path/assets/6593_footer_delete_edit.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

4. You get a confirmation message. Click _Delete_ to remove the menu item for sure, or
_Cancel_ to leave the page without changes. Navigate back to your home page.

<!-- MILESTONE -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f1f9f1">
			<td bgcolor="#5cb85c" style="width: 1px"></td>
			<td width="100%"><p><font color="#5cb85c"><strong>Milestone</strong></font>
            </br><font color="#5cb85c">The items of the Footer menu has been updated.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Footer hide result 2"
            src="@guide_path/assets/6593_footer_hide_result.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
			</br><font color="#f0ad4e">If you can’t see the changes,
			<a href="/admin/guides/faq/faq#faq-cache">try flushing caches</a>.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
			</br><font color="#f0ad4e">If you <a href="#hide-footer-items"><strong>disable a menu item</strong></a> you
			can <strong>hide it</strong> from the Main navigation <strong>without deleting it</strong>.
			<strong>The page</strong> that is connected to the deleted item <strong>remains on
            the site</strong>. <strong>If you delete a node, its link in the Main navigation is deleted too.
            </strong></font></p></td>
		</tr>
	</tbody>
</table>
</br>

</br>
## <a id="related-topics"></a>Related Topics

- [Quick edit icons](/admin/guides/administrative-menu#quick-edit-icons)

</br>
## <a id="faq"></a>FAQ

- [Flushing all caches](/admin/guides/faq/faq#faq-cache)
- [Why can’t I delete my API Catalog, FAQ, Blog pages?](/admin/guides/faq/faq#faq-delete-catalog-faq-blog)
- [Why can’t I modify the URLs of my API Catalog, FAQ, Blog pages?](/admin/guides/faq/faq#faq-urls-catalog-faq-blog)

</br>

---

<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/administrative-menu/administrative-menu"
alt="Administrative menu" target="_self"><< Administrative menu</a> |
<a href="/admin/guides/what-content-type-should-i-use/what-content-type-should-i-use"
alt="What content type should I use" target="_self">What content type should I use >></a></strong></p>