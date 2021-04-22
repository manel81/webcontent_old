<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/api-documentation/api-page-builder"
alt="API Page Builder" target="_self"><< API Page Builder</a> |
<a href="/admin/guides/api-documentation/api-catalog"
alt="API Catalog" target="_self">API Catalog >></a></strong></p>

---

# API Basic page

</br>

### Table of Contents

- [Introduction](#api-basic-intro)
- [Create static pages](#create-api-basic-pages)
- [Enhance with side-bar navigation](#add-side-bar)
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
            </br><font color="#5bc1de">You learn about the
            <a href="/admin/guides/what-content-type-should-i-use/what-content-type-should-i-use#api-basic-page">
            <strong>API Basic page</strong> content type. While this
            section only shows you the basics and you do not need to have any prerequisite knowledge to follow the
            steps, consider reading the chapters about the
            <a href="/admin/guides/what-content-type-should-i-use/what-content-type-should-i-use#api-reference">API
            Reference</a>,
            <a href="/admin/guides/what-content-type-should-i-use/what-content-type-should-i-use#api-description">
            API Description</a>, and
            <a href="/admin/guides/what-content-type-should-i-use/what-content-type-should-i-use#api-page-builder">
            API Page Builder</a> content types to get a full
            picture of how the API Documentation works on the developer portal.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- WARNING (RED) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fdf7f7">
			<td bgcolor="#d9534f" style="width: 1px"></td>
			<td width="100%"><p><font color="#d9534f"><strong>Caution</strong></font>
            </br><font color="#d9534f">You can't create an API Basic page without an already uploaded API Reference.
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
			<td bgcolor="#f3f4f4" align="center"><img alt="An API Basic page with sidebar navigation"
            src="@guide_path/assets/api_basic_fullscreen.png" max-width="800" align="center">
            <div align="center"><em><font color="black">An API Basic page with sidebar navigation.</em></font></div>
            </td>
		</tr>
	</tbody>
</table>

</br>
## <a id="api-basic-intro"></a>Introduction
</br>

To create a new API Basic page, go to _Content_ > _Add content_ > _API Basic page_ in the administrative menu. Or go
straight to `/node/add/api_basic_page`.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Edit form of an API Basic page"
            src="@guide_path/assets/6966_api_basic_page_ui.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Edit form of an API Basic page.</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

Complete the form fields where needed. See the table for fields and values below. Required fields are marked with a red
(`*`) on the UI.

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
    <td>E.g., <em>Release notes</em></td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>API reference</strong> <font color="red">(required)</font></td> <!-- API REFERENCE -->
    <td>The name of an already uploaded API reference file.</br>The new API Basic page is associated with it and become
    accessible as a tab on the API’s page.</td>
    <td>E.g., <em>Swagger Petstore demo</em></td>
  </tr>
  <tr>
    <td><strong>Body</strong></td> <!-- BODY -->
    <td>The content of the particular API Basic page.</br>To format the text or add links, pictures, and other media
    items, use the <a href="/admin/guides/built-in-text-editor/built-in-text-editor">WYSIWYG editor</a>.</td>
    <td>[copy of your content]</td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>Text format</strong></td> <!-- TEXT FORMAT -->
    <td>We recommend you to use <strong>developer portal HTML</strong> format.
    </td>
    <td><em>developer portal HTML</em></td>
  </tr>
  <tr>
    <td><strong>Revision log message</strong></td> <!-- REVISION LOG -->
    <td>Create a new version of an existing content and add information about your changes for other admins.</td>
    <td>[x] <em>Create new revision</em></br></br>
    [<em>Description of the change.</em>] e.g., “Fixed formatting issues.”</td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>Menu settings</strong></td> <!-- MENU SETTINGS -->
    <td>No need to change anything here.</td>
    <td>-</td>
  </tr>
  <tr>
    <td><strong>URL alias</strong></td> <!-- URL ALIAS -->
    <td>The URL of the page.</br>The path is automatically generated from the Title when the page is saved.</br>You can
    enhance the API Basic page with sidebar navigation.
</td>
    <td>Default:</br><font color="red"><strong>/api-catalog/</strong></font>updated-petstore-release-notes</br>
    For sidebar
    navigation:</br><font color="red"><strong>/api-docs/[reference-node-name]/</strong></font>release-notes</td></tr>
  <tr bgcolor="#efefef">
    <td><strong>Authoring information</strong></td> <!-- AUTHORING INFORMATION -->
    <td>Automatically generated values. Displayed on the admin UI.</br>Change the author and publishing date,
    if you are not creating your own page. </br>Leave blank to set it as an anonymous user.</td>
    <td><em>Authored by</em>:</br>
    [the user you're logged in with] e.g., Admin</br></br>
    <em>Authored on</em>:</br>
    [the date of saving] e.g., 2019-09-09 14:00:00</td>
  </tr>
  <tr>
    <td><strong>Promotion options</strong></td> <!-- PROMOTION OPTIONS -->
    <td>No need to change anything here.</td>
    <td>-</td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>Published</strong></td> <!-- PUBLISHED -->
    <td><strong><font color="red">API Basic pages are automatically published after they are saved.</font></strong></br>
    To
    unpublish the page, clear the <em>Published check box</em>.</br>Unpublished pages are available for content managers
    and
    administrators only in the Content menu, but aren’t displayed for the end users.</td>
    <td>[x] <em>Published</em></td>
  </tr>
</table>
</br>

Click _Save_ to create the new content item.

</br>
## <a id="create-api-basic-pages"></a>Create static pages
</br>

Do you have a text-heavy content **related to API documentation** you need to publish, like _Get Started_,
_Overview_, or _Release notes_? When information is more important than visual appearance, consider using the
[API Basic Page](/admin/guides/what-content-type-should-i-use/what-content-type-should-i-use#api-basic-page) content
type. Make sure you uploaded an
[API Reference](/admin/guides/what-content-type-should-i-use/what-content-type-should-i-use#api-reference) file: you
have to connect the API Basic page to the corresponding swagger (YAML, YML, or JSON) file.

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font></br><font color="#f0ad4e">If you
      don’t
            need to connect your content to API documentation, consider using the
            <a href="/admin/guides/what-content-type-should-i-use/what-content-type-should-i-use#basic-page">Basic page
            content type instead.</td></tr>
	</tbody>
</table>
</br>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="An API Basic with a swagger"
            src="@guide_path/assets/6996_api_basic_add.png" max-width="800" align="center">
            <div align="center"><em><font color="black">The filled-in edit form of an API Basic page called Release
            notes
            with a selected API Reference file (Swagger Petstore Demo). This page is part of the API's
            documentation and enhanced with a side-bar navigation when displayed.</em></font></div></td>
		</tr>
	</tbody>
</table>

The capabilities of an API Basic page start and end by the functionalities of the built-in text editor.
If you are familiar with this (or any other) text editor (like Word or Google Doc), you can create and maintain API
Basic pages right now. If you need any help, read our full step-by-step guide about the
[WYSIWYG Editor](/admin/guides/built-in-text-editor/built-in-text-editor) where we show all the useful features
of the editor through creating an exemplary Basic page (which behave the same as API Basic page).

</br>
## <a id="add-side-bar"></a>Enhance with side-bar navigation
</br>

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font></br><font color="#f0ad4e">Every
            API-related page is part of the API Catalog. So the default URL alias is start with /api-catalog/ plus the
            Title of the API Basic page. For example: /api-catalog/release-notes (if the Title is "Release notes"). You
            need to change the default URL alias of the created API Basic page to enhance it with side-bar navigation.
            </td></tr>
	</tbody>
</table>
</br>

1. Go to the [edit form](/admin/guides/content-management/content-management#edit-ct) of the selected API Basic page.

2. Look for the _URL alias_ menu item. If it's unfolded, click its name to make the URL settings visible.

3. _Generate automatic URL alias_ check box is marked by default. Clear it to make the _URL alias_ filed editable.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Default state of the URL alias settings"
            src="@guide_path/assets/6966_url_alias_default.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Default state of the URL alias settings.</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

4. Provide a new alias for the page. It must start with /api-docs/, then the URL alias of the corresponding API
Reference page, like "pet2" and the name of the API Basic page. (For example: `/api-docs/pet2/release-notes`).

<!-- WARNING (RED) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fdf7f7">
			<td bgcolor="#d9534f" style="width: 1px"></td>
			<td width="100%"><p><font color="#d9534f"><strong>Caution</strong></font>
            </br><font color="#d9534f">Make sure you change every instance of the link of the page with the new URL
            alias. Otherwise, users can't reach this page and get a broken link error message.
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
			<td bgcolor="#f3f4f4" align="center"><img alt="new URL alias settings"
            src="@guide_path/assets/6966_url_alias_new.png" max-width="800" align="center">
            <div align="center"><em><font color="black">New URL alias settings.</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

5. Click _Save_ to apply your changes.

<!--MILESTONE -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f1f9f1">
			<td bgcolor="#5cb85c" style="width: 1px"></td>
			<td width="100%"><p><font color="#5cb85c"><strong>Milestone</strong></font>
            </br><font color="#5cb85c">The API Basic page has been updated. All text in Heading 2 format is now
            available as a clickable menu item from the appearing side-bar navigation.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="An API Basic page with sidebar navigation"
            src="@guide_path/assets/api_basic_fullscreen.png" max-width="800" align="center">
            <div align="center"><em><font color="black">An API Basic page with sidebar navigation.</em></font></div>
            </td>
		</tr>
	</tbody>
</table>

</br>
## <a id="related-topics"></a>Related topics

- [Content management](/admin/guides/content-management/content-management)
- [API Reference page content type](/admin/guides/what-content-type-should-i-use/what-content-type-should-i-use#api-reference)
- [WYSIWYG editor](/admin/guides/built-in-text-editor/built-in-text-editor)
- [Basic page content type](/admin/guides/what-content-type-should-i-use/what-content-type-should-i-use#basic-page)
- [API Catalog](/admin/guides/api-documentation/api-catalog)
- [API pages](/admin/guides/api-documentation/api-pages)
- [API Tab Sorting](/admin/guides/api-documentation/api-tabs-sorting)
- [Categories and tags](/admin/guides/categories-and-tags/categories-and-tags)

</br>
## <a id="faq"></a>FAQ

- [Can I reorder the pages of the documentation overview page](/admin/guides/faq/faq#faq-reorder-pages-doc-overview)
- [What is on the API cards?](/admin/guides/faq/faq#faq-api-card-what)
- [What is the right link format?](/admin/guides/faq/faq#faq-correct-link)

</br>

---

<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/api-documentation/api-page-builder"
alt="API Page Builder" target="_self"><< API Page Builder</a> |
<a href="/admin/guides/api-documentation/api-catalog"
alt="API Catalog" target="_self">API Catalog >></a></strong></p>
