<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/api-documentation/api-reference"
alt="API Reference" target="_self"><< API Reference</a> |
<a href="/admin/guides/api-documentation/api-page-builder"
alt="API Page Builder" target="_self">API Page Builder >></a></strong></p>

---

# API Description page

</br>

<!-- IN THIS CHAPTER (BLUE) NOTIFICATION -->
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f4f8fa">
			<td bgcolor="#5bc1de" style="width: 1px"></td>
			<td width="100%"><p><font color="#5bc1de"><strong>In this chapter,</strong></font> </br>
            </br><font color="#5bc1de">You learn how to create, edit or delete
            <a href="/admin/guides/api-documentation/api-description" alt="API Description pages" target="_self">
            API Description pages.</a>
            </br></br>While this section only shows you the basics and you do not need to have any prerequisite
            knowledge to follow the steps, consider reading the chapters about the
            <a href="/admin/guides/api-documentation/api-reference" alt="API Reference" target="_self">API Reference
            </a>, <a href="/admin/guides/api-documentation/api-basic-page" alt="API Basic page" target="_self">
            API Basic page</a> and <a href="/admin/guides/api-documentation/api-page-builder"
            alt="API Page Builder" target="_self">API Page Builder</a> content types,
            to get a full picture of how the API documentation works on the developer portal.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

### Table of contents

- [Introduction](#api-descr-intro)
- [Creating API Description pages](#create-api-description)
- [Creating API Description pages](#create-api-description)
- [Related topics](#related-topics)

</br>
## <a id="api-descr-intro"></a>Introduction
</br>

To create a new API Description page, go to _Content_ > _Add content_ > API Description page_ in the administrative
menu. Or go straight to `/node/add/api_description_page`.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Edit form of an API Description page"
            src="@guide_path/assets/api_description_ui.png" max-width="800">
            <div align="center"><em><font color="black">Edit form of an API Description page.</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

Complete the form fields where needed. See the table for fields and values below.
**Required fields are marked with a red * on the UI**.

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
    <td><em>Swagger Petstore Description</em></td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>API Reference (required)</strong></td> <!-- API REFERENCE -->
    <td>The name of an already uploaded API reference file. The new API Description page is associated with it and
    become accessible as a tab on the API’s page.</td>
    <td><em>Swagger Petstore demo</em></td>
  </tr>
  </tr>
    <td><strong>Header</strong></td> <!-- HEADER -->
    <td>A short and informative welcoming message for your API. Displayed above the Title on the site.
    </br>To format the text or add links, pictures, and other media items, use the
    <a href="/admin/guides/built-in-text-editor/built-in-text-editor" alt="WYSIWYG editor" target="_self">WYSIWYG editor
    </a></td>
    <td><em>Swagger Petstore demo</em></td>
  </tr>
 <tr bgcolor="#efefef">
    <td><strong>Text format</strong></td> <!-- TEXT FORMAT -->
    <td>We recommend you to use <strong>Devportal HTML</strong> format.</td>
    <td><em>Devportal HTML</em></td>
  </tr>
    <td><strong>Page builder elements</strong></td> <!-- Page builder elements -->
    <td>Select from the listed building units to create various sections and build a landing page for your API.</td>
    <td><em><a href="/admin/guides/page-builder-elements/page-builder-elements#about-grid" alt="Grid" target="_self">
    Grid</a>,
    <a href="/admin/guides/api-documentation/api-page-builder#about-cta" alt="CTA" target="_self">CTA</a></em></td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>Revision log message</strong></td> <!-- REVISION LOG MESSAGE -->
    <td>Create a new version of an existing content and add information about your changes for other admins.</td>
    <td>[x] <em>Create new revision</em></br></br>
    [<em>Description of the change.</em>] e.g. “Fixed formatting issues.”</td>
  </tr>
  <tr>
    <td><strong>Menu settings</strong></td> <!-- MENU SETTINGS -->
    <td>No need to change anything here.</td>
    <td>-</td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>URL alias</strong></td> <!-- URL ALIAS -->
    <td>The URL of the page.</br>The path is automatically generated from the Title when the page is saved.</td>
    <td>[x] <em>Generate automatic URL alias</em></br></br>E.g.</br>
    <em>/<strong>api-catalog</strong>/swagger-pet-store-description</em></td>
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
    <td><strong>API Description pages are automatically published after they are saved.</strong></br>To unpublish an API
    Description page, clear the <em>Published check box</em>.
    </br>Unpublished pages are available for content managers and administrators only in the Content menu, but aren’t
    displayed for the end users.</td>
    <td>[x] <em>Published</em></td>
  </tr>
</table>
</br>

Click _Save_ to create the new content item.

</br>
## <a id="create-api-description"></a>Create API Description page
</br>

The API Description content type works the same way as the API Page Builder content type does. The main difference is
that the title of an API Description page displayed on the API tab is always stays ‘API Description’, you cannot
change it.
The title of an API Page Builder page is customizable.

<!--GOOD TO KNOW -->
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
            </br><font color="#f0ad4e">You can add only one API Description page to an API Reference. If you need more
            additional API pages with similar attributes to the same reference documentation, use the
            <a href="/admin/guides/api-documentation/api-page-builder"
            alt="API Page Builder content type" target="_self">API Page Builder content type.</a>
            </font></p>
			</td>
		</tr>
	</tbody>
</table>

</br>
## <a id="related-topics"></a>Related topics

- [API Page Builder content type](/admin/guides/api-documentation/api-page-builder)
- [How to create a landing page to APIs with API Page Builder](/admin/guides/non-api-related-content-management/page-builder#create-landing-page)
- [Page Builder Elements](/admin/guides/page-builder-elements/page-builder-elements)
- [API pages](/admin/guides/api-documentation/api-pages)
- [Image management](/admin/guides/image-management/image-management)

</br>
## <a id="faq"></a>FAQ

- [What is on the API cards?](/admin/guides/faq/faq#faq-api-card-what)

</br>

---
<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/api-documentation/api-reference"
alt="API Reference" target="_self"><< API Reference</a> |
<a href="/admin/guides/api-documentation/api-page-builder"
alt="API Page Builder" target="_self">API Page Builder >></a></strong></p>