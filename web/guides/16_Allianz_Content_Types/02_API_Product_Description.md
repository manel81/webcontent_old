<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/allianz-content-types/api-product"
alt="API Product" target="_self"><< API Product</a> |
<a href="/admin/guides/allianz-content-types/api-product-release-note"
alt="API Product release note" target="_self">API Product release note >></a></strong></p>

---
# API Product Description Page

The API Product Description can be a part of your [API Product](/admin/guides/allianz-content-types/api-product)
documentation along with the [API Product Release notes](/admin/guides/allianz-content-types/api-product-release-notes).
An **API Product Description Page must be related to an existing API Product page**.

You can add various
[Page Builder elements](/admin/guides/page-builder-elements/page-builder-elements) to customize the layout of the page.
Each section created with Page Builder elements can be edited individually.

End-users can reach the published API Product Description Pages from the related API Product’s page by clicking the
_Overview_ tab.

<!--GOOD TO KNOW -->
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
            </br><font color="#f0ad4e">You can add only one API Product Description Page to an API Product page.
            </font></p>
			</td>
		</tr>
	</tbody>
</table>

</br>
## <a id="allianz-api-product-description-intro"></a>Introduction
</br>

To create a new API Product Description Page, go to _Content_ > _Add content_ > _API Product Description Page_ in the
administrative menu. Or go straight to `/node/add/api_product_description_page`.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Add a new API Product Description content item."
			src="@guide_path/assets/10281_api_product_description_menu.png" max-width="800" align="center">
        </tr>
	</tbody>
</table>
</br>

Complete the form fields where needed. See the table for fields and values below.
**Required fields are marked with a red** `*` **on the UI.**

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
    <td>The title of the content item that is visible for end-users. It's displayed in the header region of the page.</td>
    <td>-</td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>API Product</strong> <font color="red">(required)</font></td> <!-- VERSION -->
    <td>The name of an existing API Product page. The new API Product Description page is associated with it and
    become accessible as a tab on the API Product’s page.</td>
    <td>E.g., <em>New Product</em></td>
  </tr>
    <td><strong>Page Builder Elements</strong></td> <!-- PAGE BUILDER ELEMENTS -->
    <td>Select from the listed building units to create various sections and build a landing page for your API Product.</td>
    <td><a href="/admin/guides/page-builder-elements/page-builder-elements#grid-elements" alt="Grid" target="_self"><em>Grid</em></a>,
    <a href="/admin/guides/page-builder-elements/page-builder-elements#about-cta" alt="CTA" target="_self"><em>CTA</em></a></td>
  </tr>
   <tr bgcolor="#efefef">
    <td><strong>Revision log message</strong></td> <!-- REVISION LOG MESSAGE -->
    <td>Create a new version of an existing content and add information about your changes for other admins.</td>
    <td>[x] <em>Create new revision</em></br></br>
    [<em>Description of the change.</em>] e.g., “Fixed formatting issues.”</td>
  </tr>
  <tr>
    <td><strong>URL alias</strong></td> <!-- URL ALIAS -->
    <td>The URL of the page. </br>The path is automatically generated from the Title.</td>
    <td>E.g., <em>/products/description-name</em></td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>Authoring information</strong></td> <!-- AUTHORING INFORMATION -->
    <td>Automatically generated values that are displayed on the admin UI. </br>Change the author and publishing date,
    if you are not creating your own page. </br>Leave it blank to set it as an anonymous user.</td>
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
    <td><em>API Product pages</em> are automatically published after they are saved. </br>To unpublish an API Product
    page, clear the <em>Published box</em>. </br>Unpublished pages are available for content managers and administrators
    only in the <em>Content</em> menu, but aren’t displayed for the end-users.</td>
    <td>[x] <em>Published</em></td>
  </tr>
</table>
</br>

Click _Save_ to create the content item.

## <a id="related-topics"></a>Related topics

- [API Product](/admin/guides/allianz-content-types/api-product)
- [API Product release notes content type](/admin/guides/allianz-content-types/api-product-release-notes)
- [Products listing page](/admin/guides/allianz-content-types/products-listing-page)

</br>

## <a id="faq"></a>FAQ

- [Can I add a header background image to a specific page in a node group?](/admin/guides/faq/faq#faq-add-header-group)
- [Deleting vs. Unpublishing content?](/admin/guides/faq/faq#faq-delete-unpublish)
- [What if I made unwanted changes?](/admin/guides/faq/faq#faq-revision)
- [What is the optimal image size?](/admin/guides/faq/faq#faq-image-size)
- [What is the right link format?](/admin/guides/faq/faq#faq-correct-link)
- [When should I use CTAs?](/admin/guides/faq/faq#faq-call-to-action)
- [What is the difference between CTAs and buttons?](/admin/guides/faq/faq#faq-diff-ctas-btns)
- [What’s the difference between Documentation pages and API documentation?](/admin/guides/faq/faq#faq-diff-docu-apidoc)

</br>
---
<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/allianz-content-types/api-product"
alt="API Product" target="_self"><< API Product</a> |
<a href="/admin/guides/allianz-content-types/api-product-release-note"
alt="API Product release note" target="_self">API Product release note >></a></strong></p>