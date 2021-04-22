<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/allianz-content-types/api-product-description"
alt="API Product Description" target="_self"><< API Product Description</a> |
<a href="/admin/guides/allianz-content-types/products-listing-page"
alt="Products listing page" target="_self">Products listing page >></a></strong></p>

---
# Content Type: API Product release note
</br>

### Table of contents

- [Introduction](#allianz-api-product-release-notes-intro)
- [Creating API Product release note pages](#allianz-create-api-product-release-note)
- [Related Topics](#related-topics)
- [FAQ](#faq)

</br>

Use the _API Product release note content type_ to make API Product-related release notes available on the developer
portal. Published API Product release note pages can be reached from the related API Product’s page by clicking the
_Release notes_ tab. You can use all functions of the
[built-in text editor](/admin/guides/built-in-text-editor/built-in-text-editor) to format your copy, add images and
tables.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="A snippet from an API Product release note"
            src="@guide_path/assets/10281_release_note_full.png" max-width="800">
            <div align="center"></em><font color="black">A snippet from an API Product release note page.</em></font>
            </div>
        </td>
		</tr>
	</tbody>
</table>
</br>

<!-- IN THIS CHAPTER (BLUE) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f4f8fa">
			<tr bgcolor="#f4f8fa">
			<td bgcolor="#5bc1de" style="width: 1px"></td>
			<td width="100%"><p><font color="#5bc1de"><strong>In this chapter</strong></font>
            </br><font color="#5bc1de">You can learn how to create API Product release note pages and how to add
            them to API Product pages.
</font></p>
			</td>
		</tr>
	</tbody>
</table>

</br>
## <a id="allianz-api-product-release-notes-intro"></a>Introduction
</br>

To create a new API Product release note page, go to _Content_ > _Add content_ > _API Product release note_ in the
administrative menu. Or go straight to `/node/add/api_product_release_note`.

<!-- IMAGE WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Add API Product release note"
            src="@guide_path/assets/10281_release_note_add.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Edit form of an API Product release note"
            src="@guide_path/assets/10281_release_note_edit.png" max-width="800">
            <div align="center"></em><font color="black">Edit form of an API Product release note content type.</em></font>
            </div></td>
		</tr>
	</tbody>
</table>

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
    <td>-</td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>API Product <font color="red">(required)</font></strong></td> <!-- TEASER -->
    <td>The name of a published API Product page. The new API Product release note is associated with it
    and become accessible via a tab on the API Product page.</td>
    <td>E.g., <em>Product name</em></td>
  </tr>
   <tr>
    <td><strong>Body</strong></td> <!-- BODY -->
    <td>The content of the API Product release note page. </br>To format the text or add links, pictures, and
    other media items,
    use the
    <a href="/admin/guides/built-in-text-editor/built-in-text-editor" alt="WYSIWYG editor" target="_self">built-in text
    editor</a>.</td>
    <td>[copy of your content]</td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>Text format</strong></td> <!-- TEXT FORMAT -->
    <td>We recommend you to use <strong>Devportal HTML</strong> format.</td>
    <td><em>Devportal HTML</em></td>
  </tr>
  <tr>
    <td><strong>Revision log message</strong></td> <!-- REVISION LOG MESSAGE -->
    <td>Create a new version of an existing content and add information about your changes for other admins.</td>
    <td>[x] </em>Create new revision</em></br></br>
    [</em>Description of the change.</em>] e.g., “Fixed formatting issues.”</td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>URL alias</strong></td> <!-- URL ALIAS -->
    <td>The URL of the page. </br>The path is automatically generated from the Title.</td>
    <td>-</td>
  </tr>
  <tr>
    <td><strong>Authoring information</strong></td> <!-- AUTHORING INFORMATION -->
    <td>Automatically generated values. Authoring information is displayed on the admin UI. </br>
    Change the author and publishing date if you are not creating your own page. </br>Leave it blank to set it as an
    anonymous user.</td>
    <td></em>Authored by</em>:</br>
    [the user you're logged in with] e.g., Admin</br></br>
    </em>Authored on</em>:</br>
    [the date of saving] e.g., 2019-09-09 14:00:00</td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>Promotion options</strong></td> <!-- PROMOTION OPTIONS -->
    <td>No need to change anything here.</td>
    <td>-</td>
  </tr>
  <tr>
    <td><strong>Published</strong></td> <!-- PUBLISHED -->
    <td><em>API Product release notes</em> are automatically published after they are saved. </br>To unpublish a
    API Product release note page, clear the <em>Published</em> check box. </br>Unpublished pages are available for
    content managers and administrators only in the Content menu, but aren’t displayed for the end users.</td>
    <td>[x] </em>Published</em></td>
  </tr>
</table>
</br>

Click _Save_ to create the content item.

</br>
## <a id="allianz-create-api-product-release-note"></a>Creating API Product release note pages
</br>

<!-- WARNING (RED) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
    <tbody>
        <tr bgcolor="#fdf7f7">
            <td bgcolor="#d9534f" style="width: 1px"></td>
            <td width="100%"><p><font color="#d9534f"><strong>Attention</strong></font>
            </br><font color="#d9534f">You must have at least one API Product page on the developer portal to create
            an API Product release note page.
            You can connect <strong>only one API Product release note page</strong> to an API Product.</font></p>
            </td>
        </tr>
    </tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Error message"
            src="@guide_path/assets/10281_error_existing_product.png" max-width="800">
            <div align="center"></em><font color="black">If you try to associate a second API Release note page for a
            Product, you get an error message.</em></font>
            </div></td>
		</tr>
	</tbody>
</table>
</br>

To **create** a new API Product release note page, follow the steps below:

1. In the administrative menu, go to _Content_ > _Add content_ > _API Product release note_.
   Or go straight to `/node/add/api_product_release_note`.

2. (required) Type or paste the _Title_ of your page. The title is displayed on the top of the related API Product
   Release note page. (e.g., _Release notes_)

3. (required) Select an available API Product page. Start typing the name of an API Product page in the _API Product_
   text box then select it from the appearing list. (e.g., _Product name 2_)

4. Create your copy. You can format the text with the
   [built-in text editor](/admin/guides/built-in-text-editor/built-in-text-editor).

5. (optional) Clear the _Published_ check box at the bottom of the page if you don’t want to publish the page yet.

6. Click _Save_ to apply your changes and create the page.

<!-- GOOD TO KNOW-->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
            </br><font color="#f0ad4e">Save your work often, and do not publish your content before it’s considered
            done.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="API Product release note page with full content"
            src="@guide_path/assets/10281_release_note_content.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>

</br>
## <a id="related-topics"></a>Related Topics
</br>

- [How to create Product landing pages with API Product content type](/admin/guides/allianz-content-types/api-product)
- [Products listing page](/admin/guides/allianz-content-types/products-listing-page)
- [Image management](/admin/guides/image-management/image-management)
- [Built-in text editor](/admin/guides/built-in-text-editor/built-in-text-editor)

</br>
## <a id="faq"></a>FAQ
</br>

- [Deleting vs. Unpublishing content?](/admin/guides/faq/faq#faq-delete-unpublish)
- [What if I made unwanted changes?](/admin/guides/faq/faq#faq-revision)
- [What is the right link format?](/admin/guides/faq/faq#faq-correct-link)

</br>

---
<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/allianz-content-types/api-product-description"
alt="API Product Description" target="_self"><< API Product Description</a> |
<a href="/admin/guides/allianz-content-types/products-listing-page"
alt="Products listing page" target="_self">Products listing page >></a></strong></p>
