<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/page-builder-elements/page-builder-elements"
alt="Page Builder Elements" target="_self"><< Page Builder Elements</a> |
<a href="/admin/guides/non-api-related-content-management/documentation-page"
alt="Documentation page" target="_self">Documentation page >></a></strong></p>

---

# Basic page

</br>

<!-- IN THIS CHAPTER (BLUE) NOTIFICATION -->
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f4f8fa">
			<tr bgcolor="#f4f8fa">
			<td bgcolor="#5bc1de" style="width: 1px"></td>
			<td width="100%"><p><font color="#5bc1de"><strong>In this chapter</strong></font>
            </br><font color="#5bc1de">You learn about the <strong>Basic page</strong>
            content type: how to create, edit and delete it, and what are the most common fields of usage.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

### Table of contents

- [Introduction](#basic-intro)
- [Create static pages](#create-basic-pages)
- [Related topics](#related-topics)

</br>
## <a id="basic-intro"></a>Introduction
</br>

To create a new Basic page, go to _Content_ > _Add content_ > _Basic page_ in the administrative menu. Or go straight to
`/node/add/page`.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Edit form of a Basic page."
            src="@guide_path/assets/basic_page_ui.png" max-width="800">
            <div align="center"><em><font color="black">Edit form of a Basic page.</em></font></div></td>
		</tr>
	</tbody>
</table>

Complete the form fields where needed. See the table for fields and values below. **Required fields are marked with**
**a red ** `*` **on the UI.**

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
    <td>E.g. <em>About us</em>, <em>Our service</em>, <em>Terms and conditions</em></td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>Body</strong></td> <!-- BODY -->
    <td>The content of the particular Basic page page. </br>To format the text or add links, pictures, and other media
    items, use the <a href="/admin/guides/built-in-text-editor/built-in-text-editor" alt="WYSIWYG editor"
    target="_self">WYSIWYG editor</a></td>
    <td>[Copy of your content]</td>
  </tr>
  <tr>
    <td><strong>Text format</strong></td> <!-- TEXT FORMAT -->
    <td>We recommend you to use <strong>Devportal HTML</strong> format.</td>
    <td>Devportal HTML</td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>Revision log message</strong></td> <!-- REVISION LOG MESSAGE -->
    <td>Create a new version of an existing content and add information about your changes for other admins.</td>
    <td>[x] <em>Create new revision</em></br></br>
    [<em>Description of the change.</em>] e.g. “Fixed formatting issues.”</td>
  </tr>
  <tr>
    <td><strong>Menu settings</strong></td> <!-- MENU SETTINGS -->
    <td>You can place your Basic page into one of the menus as a menu item.</br> For further information, read the
    <a href="/admin/guides/menu-settings/menu-settings" alt="menu management" target="_self">menu management</a>
    section.</td>
    <td>[x] <em>Provide a menu link</em></br></br>
    <em>Menu link title</em>:</br>
    [The title you want to appear in the menu]</br></br>
    <em>Parent</em>:</br>
    &lt;Main navigation&gt;</br></br>
    <em>Weight</em>: 0</td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>URL alias</strong></td> <!-- URL ALIAS -->
    <td>The URL of the page.</br>It can be changed manually.</td>
    <td>E.g. <em>/about-us</em></br>Default: /node/[number of the node]</td>
  </tr>
  <tr>
    <td><strong>Authoring information</strong></td> <!-- AUTHORING INFORMATION -->
    <td>Automatically generated values. It's displayed on the admin UI. </br>Change the author and publishing date,
    if you are not creating your own page. </br>Leave blank to set it as an anonymous user.</td>
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
    <td><strong>Basic pages are automatically published after they are saved.</strong></br>To unpublish a basic page
    page, clear the <em>Published check box</em>. </br>Unpublished pages are available for content managers and
    administrators only in the Content menu, but aren’t displayed for the end users.</td>
    <td>[x] <em>Published</em></td>
  </tr>
</table>

</br>
## <a id="create-basic-pages"></a>Create static pages
</br>

Do you have a text-heavy content you need to publish legal documentation, like a _Privacy policy_, _About us_,
or _Terms and conditions_ page? When information is more important than visual appearance, consider using the
[Basic Page content type](/admin/guides/non-api-related-content-management/basic-page).

The capabilities of a Basic page start and end by the functionalities of the built-in WYSIWYG Editor. If you are
familiar with this (or any other) text editor (like Word or Google Docs), you can create and maintain Basic pages right
now. If you need any help, read our full step-by-step guide about the
[WYSIWYG Editor](/admin/guides/built-in-text-editor/built-in-text-editor) where
we show all the useful features of the editor by creating an exemplary Basic page.

</br>
## <a id="related-topics"></a>Related topics

- [Creating, editing, deleting content](/admin/guides/content-management/content-management)
- [Image management](/admin/guides/image-management/image-management)
- [Built-in editor](/admin/guides/built-in-text-editor/built-in-text-editor)

</br>

---
<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/page-builder-elements/page-builder-elements"
alt="Page Builder Elements" target="_self"><< Page Builder Elements</a> |
<a href="/admin/guides/non-api-related-content-management/documentation-page"
alt="Documentation page" target="_self">Documentation page >></a></strong></p>