<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/non-api-related-content-management/basic-page"
alt="Basic page" target="_self"><< Basic page</a> |
<a href="/admin/guides/non-api-related-content-management/blog-post"
alt="Blog post" target="_self">Blog post >></a></strong></p>

---

# Documentation page

</br>

### Table of Contents

- [Introduction](#documentation-intro)
- [Creating Documentation pages from scratch](#create-documentation-page)
    - [Getting started pages](#create-getting-started)
    - [Adding Documentation pages to the Overview page](#add-getting-started)
    - [Adding the Documentation Overview page to the Main navigation](#add-documentation-link)
    - [Creating more Documentation pages](#create-more-documentation)
    - [Reordering Documentation pages in the sidebar navigation](#reorder-documentation-items)
- [Related topics](#related-topics)
- [FAQ](#faq)

</br>

<!-- IN THIS CHAPTER (BLUE) NOTIFICATION -->
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f4f8fa">
			<tr bgcolor="#f4f8fa">
			<td bgcolor="#5bc1de" style="width: 1px"></td>
			<td width="100%"><p><font color="#5bc1de"><strong>In this chapter</strong></font>
            </br><font color="#5bc1de">You learn how to create, edit or delete
            <a href="/admin/guides/what-content-type-should-i-use/what-content-type-should-i-use#documentation-page"
            alt="Documentation pages" target="_self">Documentation pages</a>.</font></p>
			</td>
		</tr>
	</tbody>
</table>

</br>
## <a id="documentation-intro"></a>Introduction
</br>

To create a new Documentation content item, go to _Content_ > _Add content_ > Documentation page_, in the administrative
menu. Or go straight to `/node/add/documentation_page`.

<!-- SCREENSHOT FROM THE UI-->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="API Tab Sorting page with the available API pages."
            src="@guide_path/assets/documentation_page_ui.png" max-width="800">
            <div align="center"><em><font color="black">Edit form of a Documentation page.</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

Complete the form fields where needed. See the table for fields and values below.
**Required fields are marked with a red **`*`** on the UI.**

<!-- REFERENCE TABLE -->
</br>
<table border="0" cellpadding="5" cellspacing="5" style="width: 100%">
  <tr> <!-- HEADER -->
    <th><center><strong>Field name</font></strong><center></th>
    <th><center><strong>Description</font></strong><center></th>
    <th><center><strong>Example/default value(s)</font></strong><center></th>
  </tr>
  <tr>
    <td><strong>Title</strong> <font color="red">(required)</font></td> <!-- TITLE -->
    <td>The title of the content item that is visible for end users.</td>
    <td>E.g. <em>Getting started</em>, <em>Overview</em>, <em>Concepts</em></td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>Body</strong></td> <!-- BODY -->
    <td>The content of the particular Documentation page. <strong>Heading 2 titles</strong> are rendered as clickable
    items in the sidebar navigation. </br>To format the text or add links, pictures, and other media items, use the
    <a href="/admin/guides/built-in-text-editor/built-in-text-editor" alt="WYSIWYG editor" target="_self">WYSIWYG editor
    </a>.</td>
    <td>[copy of your content]</td>
  </tr>
  <tr>
    <td><strong>Text format</strong></td> <!-- TEXT FORMAT -->
    <td>We recommend you to use <strong>Devportal HTML</strong> format.</td>
    <td><em>Devportal HTML</em></td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>Revision log message</strong></td> <!-- REVISION LOG MESSAGE -->
    <td>Create a new version of an existing content and add information about your changes for other admins.</td>
    <td>[x] <em>Create new revision</em></br></br>
    [<em>Description of the change.</em>] e.g. “Fixed formatting issues.”</td>
  </tr>
  <tr>
    <td><strong>Menu settings</strong></td> <!-- MENU SETTINGS -->
    <td>Add the new page to the Documentation menu. Displayed in the sidebar navigation.</td>
    <td>[x] <em>Provide a menu link</em></br></br>
    <em>Menu link title</em>:</br>
    [The title you want to appear in the <strong>sidebar navigation</strong>] e.g <em>Getting started</em></br>
    </br>
    <em>Parent</em>:</br>
    &lt;Main navigation&gt;</br></br>
    <em>Weight</em>: 0</td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>URL alias</strong></td> <!-- URL ALIAS -->
    <td>The URL of the page. </br>The path is automatically generated from the Title.</td>
    <td>[x] <em>Generate automatic URL</em> E.g. <em>/<strong>docs</strong>/getting-started</em></td>
  </tr>
  <tr>
    <td><strong>Authoring information</strong></td> <!-- AUTHORING INFORMATION -->
    <td>Automatically generated values. Displayed on the admin UI. </br>Change the author and publishing date, if
    you are not creating your own page. </br>Leave blank to set it as an anonymous user.</td>
    <td><em>Authored by</em>:</br>
    [the user you're logged in with] e.g., Admin</br></br>
    <em>Authored on</em>:</br>
    [the date of saving] e.g., 2019-09-09 14:00:00</td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>Promotion options</strong></td> <!-- PROMOTION OPTIONS -->
    <td>No need to change anything here.</td>
    <td>-</td>
  </tr>
  <tr>
    <td><strong>Published</strong></td> <!-- PUBLISHED -->
    <td>Documentation pages are automatically published after they are saved. </br>To unpublish the page, clear the
    <em>Published check box</em>. </br>Unpublished pages are available for content managers and administrators only in the
    Content menu, but aren’t displayed for the end users.</td>
    <td>[x] <em>Published</em></td>
  </tr>
</table>
</br>

Click _Save_ to create the content item.

</br>
## <a id="create-documentation-page"></a>Creating Documentation pages
</br>

<!-- IN THIS CHAPTER (BLUE) NOTIFICATION -->
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f4f8fa">
			<tr bgcolor="#f4f8fa">
			<td bgcolor="#5bc1de" style="width: 1px"></td>
			<td width="100%"><p><font color="#5bc1de"><strong>In this chapter</strong></font>
            </br><font color="#5bc1de">We show you how to compile a complex documentation “book” for the
            imaginary Serenity Project API program. This chapter doesn’t provide detailed explanation
            about the building units. You do not need to have any prerequisite knowledge to follow the steps, but
            consider reading the chapters about the <a href="/admin/guides/what-content-type-should-i-use/what-content-type-should-i-use#documentation-page"
            alt="Documentation page" target="_self">Documentation page</a> content type and the <a href="/admin/guides/menu-settings/menu-settings#main-navigation"
            alt="Main navigation" target="_self">Main navigation</a> to get the full picture how the presented features
            work on the developer portal.</font></p>
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
			<td width="100%"><p><font color="#f0ad4e"><strong>Terminology</strong></font>
            </br><font color="#f0ad4e"></br>
            <strong>Documentation page (content type)</strong>: referring to the content type used to create new
            content.</br>
            <strong>documentation page</strong>: referring to the page created with the content type (or by using the
            title of the created page e.g., Getting started).</br>
            <strong>Documentation Overview Page</strong>: referring to the complex Documentation "book".</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="The to-be-done documentation page layout."
            src="@guide_path/assets/6681_documentation_page_result.png" max-width="800">
            <div align="center"><em><font color="black">A snippet of the layout of the documentation page of the
            Serenity Project API program you are going to create.</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

Let’s assume that as the content editor of the Serenity Project you have to write a full-scale documentation for the
project. To set up the Documentation Overview Page, you need to take five major steps.

1. Create your first example documentation page, [Getting started](#create-getting-started).

2. Add a URL that is required to [attach this page to the Documentation Overview Page](#add-getting-started).
   The Documentation Overview Page is populated with the content of the Getting Started page.

3. (optional) [Add the Documentation Page to the Main navigation](#add-documentation-link).

4. [Create three more documentation pages](#create-more-documentation) and attach them to the Documentation Overview
   Page, e.g.:

    - Overview,
    - Concepts,
    - Tutorials.

5. [Reorder the elements](#reorder-documentation-items).

</br>
## <a id="create-getting-started"></a>‘Getting Started’ page
</br>

You have to follow the same steps when creating all four pages and linking them to the Documentation Overview Page and
to the sidebar navigation. In the following, we show you the necessary steps in details, while later, in the
[Creating more documentation pages](#create-more-documentation) section, you can find a brief overview of the most
important settings.

Let’s start with the Getting started page, where users can learn the basics about the project’s APIs,
authentication, and configuration.

1. In the administrative menu, go to _Content_ > _Add content_ > Documentation page_.
   Or go straight to `/node/add/documentation_page`.

2. (required) Add a _Title_ to the page (e.g., _Getting started_).

3. Type or copy-paste the content of the particular page. **Heading 2 titles** are rendered as clickable items in the
   sidebar navigation (e.g., _Registration_, _Find the best API_, _API Key Request_).

4. To format the text or add links, pictures, and other media items use the
[WYSIWYG editor](/admin/guides/built-in-text-editor/built-in-text-editor).

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Filling the Title and the Body field."
            src="@guide_path/assets/6681_getting_started_content.png" max-width="800">
            <div align="center"><em><font color="black">The title and the content of the Getting Started page.</em>
            </font></div></td>
		</tr>
	</tbody>
</table>
</br>

5. Click _Save_ to create the new content item. Clear the _Published_ check box if you don't want to publish it now.

In the next subchapter, we show you how to link this page to the Documentation Overview Page. Take a look at the
_Authoring information_ and _URL alias_ drop-down menu on the panel on the right side of the screenshot above.

</br>
## <a id="add-getting-started"></a>Adding to the Overview Page
</br>

The Documentation Overview Page can be the main knowledge-hub of your portal. To enrich it
with information, you have to attach every documentation pages you have created to it in the following way:

1. Expand the _Menu settings_ and the _URL alias_ menu.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Menu settings and URL alias fields."
            src="@guide_path/assets/6681_provide_menu_link.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

2. Mark the _Provide a menu link_ check box in **_Menu settings_**.

3. You can add a _Menu link title_ that is shown in the sidebar navigation menu. We recommend using the title of
   the documentation page (e.g., _Getting started_), but this is not a requirement.

4. (optional) Write a short _Description_ to this item, which is shown when hovering the cursor over the menu link.

5. Now you have to add the page to the Documentation Overview Page as a menu item. Select _<Documentation>_ from the
   _Parent item_ drop-down menu.

6. You can also change the **_URL alias_** of the page, but it must start with **/docs/** to keep it attached
   to the Documentation Overview Page. We recommend marking the _Generate automatic URL alias_ check box.


<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
            </br><font color="#f0ad4e">If you don’t have Documentation Overview Page on your portal, type the URL alias
            manually <strong>/docs/title-of-the-page</strong>. After saving your progress, you have to update the Main
            navigation to make the “Documentation” menu item (and the Documentation Overview Page) visible for
            end-users. The Documentation Overview Page is populated with the content of the attached
            (e.g., <em>Getting started</em>) pages.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Menu settings."
            src="@guide_path/assets/6573_menu_settings.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

Click _Save_ to apply your changes. Now your Getting started page is done, but it's not be visible on the portal yet.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="The Getting Started page is attached to the
            Documentation Overview Page."
            src="@guide_path/assets/6681_getting_started_done.png" max-width="800">
            <div align="center"><em><font color="black">The Getting Started page is attached to the Documentation
            Overview Page, you can see the Heading 2s as items in the sidebar navigation menu (top-left).</em></font>
            </div></td>
		</tr>
	</tbody>
</table>

</br>
## <a id="add-documentation-link"></a>Adding to the Main navigation
</br>

Take a look at the screenshot above. The Getting Started page is attached to a page called Documentation by
default. This is what we call Documentation Overview Page in this chapter. The sidebar navigation is populated with the
Titles and the Heading 2s of the attached documentation pages and on the body of the page you can see the content of the
uploaded documentation pages.

<!-- WARNING (RED) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fdf7f7">
			<td bgcolor="#d9534f" style="width: 1px"></td>
			<td width="100%"><p><font color="#d9534f"><strong>Caution</strong></font>
            </br><font color="#d9534f">If the Documentation Overview Page is not visible in the Main navigation,
            end users cannot reach the documentation.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

To **create** a new Main navigation menu item, follow the steps below:

1. In the administrative menu, go to _Structure_ > _Menus_ > _Main navigation_> _Add link_. Or go straight
   to `/admin/structure/menu/manage/main/add`.

2. (required) Add a _Menu link title_. This title appears in the Main navigation menu as a selectable item
   (e.g., _Documentation_).

3. (required) Fill the _Link_ text box to define the location this menu link points to (e.g. /docs/getting-started).

4. (optional) Write a short _Description_ that is shown when hovering over the menu link with the cursor.

5. Be sure the _Parent Link_ is set to _Main navigation_.

6. Click _Save_ to apply your changes. You get a notification. Navigate back to the home page. If you didn’t
   change the default weight, your new menu item appears as the last item on the Main navigation. You can
   [reorder the menu items](#reorder-documentation-items), too.

</br>
## <a id="create-more-documentation"></a>Creating more pages
</br>

After you have created the Getting started page, you are now familiar with the documentation page creating process.
If you still need
further explanation, scroll back to the [Creating the Getting Started page](#create-getting-started) chapter and
follow the description.

For the imaginary Serenity Project API program, you have to create a Concept page, where user can get to be familiar with
the main concepts of the portal. On the Tutorials page, user can get to know the full power of the Serenity Project APIs
by learning to use them on an advanced level. Write an Overview page where you can introduce the chapters and goals of
the project’s documentation.

1. Create a Documentation page (content type).

2. (required) Add a _Title_ (e.g., _Overview_, _Concepts_, _Tutorials_).

3. Type or copy-paste the content of the particular page and formatting it with the
   [WYSIWYG Editor](/admin/guides/built-in-text-editor/built-in-text-editor).

4. Mark the _Provide a menu link_ check box.

5. Be sure the _Documentation_ item is selected in the _Parent item_ drop-down menu.

6. Mark the _Generate automatic URL alias_ check box or type the URL alias manually in this form:
   `/docs/title-of-the-page`.

7. Save your progress.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Settings of the Overview page."
            src="@guide_path/assets/6681_overview_page.png" max-width="800">
            <div align="center"><em><font color="black">The example content and the Menu settings and URL alias of the
            Overview page.</em></font></div></td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="New documentation page added to the
            Documentation Overview page."
            src="@guide_path/assets/6681_overview_page_result.png" max-width="800">
            <div align="center"><em><font color="black">The Overview page in the Documentation Overview Page.</em>
            </font></div></td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="New documentation page added to the
            Documentation Overview page."
            src="@guide_path/assets/6681_concepts_result.png" max-width="800">
            <div align="center"><em><font color="black">The Concepts page in the Documentation Overview Page.</em>
            </font></div></td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="New documentation page added to the
            Documentation Overview page."
            src="@guide_path/assets/6681_tutorials_result.png" max-width="800">
            <div align="center"><em><font color="black">The Tutorials page in the Documentation Overview page.</em>
            </font></div></td>
		</tr>
	</tbody>
</table>

</br>
## <a id="reorder-documentation-items"></a>Reordering items
</br>

As you can see in the screenshot above, the created documentation pages are listed in a (seemingly) random order
in the sidebar navigation. Let’s reorder the chapters in this manner: Overview, Concepts, Getting Started, Tutorials.

1. Go to _Structure_ > _Menus_ > _Documentation_. Here you can see all documentation pages in the documentation
   menu.

2. To reorder the pages, drag the menu items to their new places.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Reordering pages by dragging."
            src="@guide_path/assets/6681_reorder.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

3. Click _Save_ to apply your changes.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Reordered documentation pages."
            src="@guide_path/assets/6681_final_result.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

You have created the necessary documentation pages to share every important detail with end users about the features and
usage of the APIs. They can now start working and succeed with your APIs.

</br>
## <a id="related-topics"></a>Related topics

- [Menu settings](/admin/guides/menu-settings/menu-settings)
- [Built-in text editor](/admin/guides/built-in-text-editor/built-in-text-editor)
- [Image management](/admin/guides/image-management/image-management)

</br>
## <a id="faq"></a>FAQ

- [Can I add new pages to existing Documentation Overview page?](/admin/guides/faq/faq#faq-page-to-doc-overview)
- [Can I reorder the pages of my Documentation Overview page?](/admin/guides/faq/faq#faq-reorder-pages-doc-overview)
- [What’s the difference between Documentation pages and API documentation?](/admin/guides/faq/faq#faq-diff-docu-apidoc)

</br>

---
<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/non-api-related-content-management/basic-page"
alt="Basic page" target="_self"><< Basic page</a> |
<a href="/admin/guides/non-api-related-content-management/blog-post"
alt="Blog post" target="_self">Blog post >></a></strong></p>
