<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/non-api-related-content-management/page-builder"
alt="Page Builder" target="_self"><< Page Builder</a> |
<a href="/admin/guides/api-documentation/api-description"
alt="API Description" target="_self">API Description >></a></strong></p>

---
# API Reference
</br>

### Table of Contents

- [Introduction](#api-ref-intro)
- [Adding API Reference](#add-api-reference)
- [Swagger UI extensions](#swagger-extensions)
   - [Integrating Postman](#postman)
   - [Displaying manual code samples](#code-sample)
- [Adding new reference versions](#add-new-versions)
- [Reverting reference versions](#reverting-versions)
- [Deleting reference versions](#deleting-versions)
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
            <a href="/admin/guides/what-content-type-should-i-use/what-content-type-should-i-use#api-reference">
            API Reference content type</a>: how to create, edit and delete a content item, what are the most common
            fields of
            its usage and how it relates to other content types. You can also learn how to manage reference versioning:
            adding new versions of a reference file, reverting or deleting old ones. </br>While this section only shows
            you the basics and you do
            not need to have any prerequisite knowledge to follow the steps, consider reading the chapters about the
            <a href="/admin/guides/api-documentation/api-basic-page">API Basic Page</a>,
            <a href="/admin/guides/api-documentation/api-description">API
            Description</a>, and <a href="/admin/guides/api-documentation/api-page-builder">API Page Builder</a>
            content types to get a
            full picture of how the API documentation works on the developer portal.
            </font></p>
			</td>
		</tr>
	</tbody>
</table>

</br>
## <a id="api-ref-intro"></a>Introduction
</br>

To create a new API Reference content item, go to _Content_ > _Add content_ > _API reference_ in the administrative
menu. Or go straight to `/node/add/api_reference.`

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Edit form of an API Reference page"
            src="@guide_path/assets/api_reference_ui.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Edit form of an API Reference page</em></font></div></td>
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
    <td><strong>Mode</strong> <font color="red">(required)</font></td> <!-- MODE -->
    <td>Choose the mode to create the API reference.</br>Upload a file, or fill the necessary values manually.</td>
    <td>[x] <em>Upload an API reference file</em></br>[ ] <em>Fill in the values manually</em>
</td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>Source file</strong> <font color="red">(required if the default option is selected, otherwise it won’t
    be displayed)</font></td> <!-- SOURCE FILE -->
    <td>Browse and upload a new or select an already uploaded API reference file. Supported OAS versions: 2.0. and 3.0.
    </br>
    The developer portal automatically creates the whole content of the page (title, description, version) from it.</br>
    The new API Reference page appears as an API card in the Catalog.</td>
    <td>E.g., <em>petstore.json</em></br>One file only.</br>10 MB limit.</br>Allowed types: YAML, YML, JSON.
</td>
  </tr>
  <tr>
    <td><strong>Title</strong> <font color="red">(required if the <em>Fill in the values manually</em> option is
    selected)
    </font></td> <!-- TITLE -->
    <td>The title of the API that is visible for end-users.</td>
    <td>E.g., <em>Swagger Petstore</em></td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>Description</strong> <font color="red">(required if the <em>Fill in the values manually</em> option is
    selected)</font></td> <!-- DESCRIPTION -->
    <td>Add a description to your API.</br>This content is displayed on the site under the <em>Description title</em>.
    </br>Edit the content with the <a href="/admin/guides/built-in-text-editor/built-in-text-editor">WYSIWYG editor</a>.
    </td>
    <td>E.g., “This API intends to provide an interface between [...]. The API is designed on a REST model using JSON
    structures.”</td>
  </tr>
  <tr>
    <td><strong>Version</strong> <font color="red">(required if the <em>Fill in the values manually</em> option is
    selected)</font></td> <!-- VERSION -->
    <td>Add the version of the API. This value is displayed above the API’s title in a colored box.</td>
    <td>E.g., <em>1.0.0.0.</em>, <em>v.1.0.</em></td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>API header</strong></td> <!-- API HEADER -->
    <td>This text is displayed under the title of the API on the API reference page.</br>Consider it as a short
    description of what the user can do with the API.</br>To format the text or add links, pictures, and
    other media items, use the <a href="/admin/guides/built-in-text-editor/built-in-text-editor">WYSIWYG editor</a>.
    </td>
    <td>E.g., “With this API you can get up-to-date information about [...]”
</td>
  </tr>
  <tr>
    <td><strong>Text format</strong></td> <!-- TEXT FORMAT -->
    <td>We recommend you to use <strong>Devportal HTML</strong> format.
    </td>
    <td><em>Devportal HTML</em></td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>API category</strong></td> <!-- API CATEGORY -->
    <td>Group your related APIs to <a href="/admin/guides/categories-and-tags/categories-and-tags">categories</a>.
    Categories are displayed in the
    <a href="/admin/guides/api-documentation/api-catalog">API Catalog page</a>, on the API cards, and on the related
    <a href="/admin/guides/api-documentation/api-pages">pages of the API.</a></td>
    <td>E.g. <em>New</em>, <em>Live</em>, <em>In progress</em>, <em>Retired</em></td>
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
    <td>The URL of the page.</br>The path is automatically generated from the name of the API / Title when the page is
    saved.</td>
    <td>[x] <em>Generate automatic URL alias</em></br>E.g. <em><strong><font color="red">/api-catalog</font></strong>
    /swagger-pet-store</em></td></tr>
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
    <td><strong><font color="red">API Reference pages are NOT automatically published after they are saved.</font>
    </strong></br>
    To publish the page, check the <em>Published box</em>.
    </br>Unpublished pages are available for content managers and administrators only in the Content menu, but aren’t
    displayed for the end-users.</td>
    <td>[x] <em>Published</em></td>
  </tr>
</table>
</br>

Click _Save_ to create the new content item.

<!-- WARNING (RED) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fdf7f7">
			<td bgcolor="#d9534f" style="width: 1px"></td>
			<td width="100%"><p><font color="#d9534f"><strong>Caution</strong></font>
            </br><font color="#d9534f">Deleting an API Reference content item also deletes all its associated API pages
            (API Description, API Page Builder and API Basic page) and this action cannot be undone.</font></p>
			</td>
		</tr>
	</tbody>
</table>

</br>
## <a id="add-api-reference"></a>Adding API Reference

<!-- IN THIS CHAPTER (BLUE) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f4f8fa">
			<tr bgcolor="#f4f8fa">
			<td bgcolor="#5bc1de" style="width: 1px"></td>
			<td width="100%"><p><font color="#5bc1de"><strong>In this tutorial</strong></font>
            </br><font color="#5bc1de">You can learn about how to add new reference documentation to the developer
            portal and how users can access it.
            </font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

Imagine that you want to add a new API reference documentation to the developer portal. You have the reference file
prepared on your computer, you have to upload it and customize the look of the Reference page a bit to make
clear the scope of the API for end-users. To achieve this, you can write a brief description of the API and add
categories to it.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Reference documentation page with category tags and description."
            src="@guide_path/assets/8986_api_reference_new_ui.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Reference documentation page of OAS 3.0 with category tags and
            description in the header section.</em></font></div>
      </td>
		</tr>
	</tbody>
</table>
</br>

To **create** a new Reference documentation, follow the steps below:

1. In the administrative menu, go to _Content_ > _Add content_ > _API Reference_. Or go straight to
   `/node/add/api_reference.`

2. Select the _Upload an API reference file_ mode.

3. Click _Choose file_ and browse the file on your computer.

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font></br><font color="#f0ad4e">You can
            upload one reference file (.yaml, .yml, .json) only. Supported OAS versions are 2.0 and 3.0.</font></p>
            </td></tr>
	</tbody>
</table>
</br>

4. Add a brief description to the _API header_ field about the API’s capabilities. It appears under the name of the API
   at the top of the page and visible for end-users. To upload a header background image
   (see screenshot above), read the
   [Header background settings](/admin/guides/header-background-settings/header-background-settings) chapter.

5. Add _API categories_ to group the API. You can add existing categories by start typing their name then selecting
   it, or create a new one by typing the whole new category name into the filed.

<!-- WARNING (RED) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fdf7f7">
			<td bgcolor="#d9534f" style="width: 1px"></td>
			<td width="100%"><p><font color="#d9534f"><strong>Caution</strong></font>
            </br><font color="#d9534f">Category names are case sensitive.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

6. Click _Add another_ item to add more categories.

7. Mark the _Published_ check box to publish the API Reference page after saving. Published content items
   are available for users with the right permission.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Upload the new API reference file and customize the page."
            src="@guide_path/assets/8986_api_reference_uploading.png" max-width="800" align="center">
      </td>
		</tr>
	</tbody>
</table>
</br>

8. Click _Save_ to create the page.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="The new API Reference page with tags and description"
            src="@guide_path/assets/8986_api_reference_content_item.png" max-width="800" align="center">
            <div align="center"><em><font color="black">The new API Reference page with tags and description in the
            header, and populated data.
            </em></font></div></td>
		</tr>
	</tbody>
</table>

<!-- MILESTONE -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f1f9f1">
			<td bgcolor="#5cb85c" style="width: 1px"></td>
			<td width="100%"><p><font color="#5cb85c"><strong>Milestone</strong></font>
            </br><font color="#5cb85c">After you <strong>uploaded and published</strong> the new API reference file,
            it appears in the API Catalog as an API card (displayed under the assigned categories) so end-users with the
            right permission can access it and read the documentation.
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
			<td bgcolor="#f3f4f4" align="center"><img alt="API Catalog with API cards."
            src="@guide_path/assets/8986_api_card.png" max-width="800" align="center">
            <div align="center"><em><font color="black">The API Catalog and the API cards with category tags visible for
            end-users.</em></font></div></td>
		</tr>
	</tbody>
</table>

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font></br>
      <font color="#f0ad4e"><strong>You can add supporting documentation to every uploaded API reference file</strong>
      to address different user needs (e.g., non-technical description about the API’s capabilities and methods, or a
      changelog to keep users up-to-date about the API). To learn how to add new
      <a href="/admin/guides/api-documentation/api-pages">API pages</a> to a Reference page, go to the related
      topics below.</font></p></td></tr>
	</tbody>
</table>

<!-- WARNING (RED) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fdf7f7">
			<td bgcolor="#d9534f" style="width: 1px"></td>
			<td width="100%"><p><font color="#d9534f"><strong>Caution</strong></font>
            </br><font color="#d9534f">Deleting an API Reference also deletes all its associated API pages (API
            Description, API Page Builder and API Basic page) and this action cannot be undone.</font></p>
			</td>
		</tr>
	</tbody>
</table>

</br>
## <a id="swagger-extensions"></a>Swagger UI extensions
</br>

By adding extra attributes to the reference files, you can benefit from different Swagger UI extension.

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
            </br><font color="#f0ad4e">These features aren't turned on by default. If you cannot see the changes after
            modifying the reference file, contact the Project manager.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

### <a id="postman"></a>Integrating Postman

It is possible to integrate a direct connection to Postman into the Swagger UI.

If the feature is enabled on the developer portal, a _Run in Postman_ button appears on the UI of those API reference
documentation that has the **`x-postman-collection-id` string added to the reference file's `info` object**.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Run in Postman button."
            src="@guide_path/assets/8986_run_in_postman.png" max-width="800" align="center">
            <div align="center"><em><font color="black">OAS 3.0 reference file's Swagger UI with Run in Postman button.</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

This integration allows end-users to easily collaborate with other developers in Postman either in browser or via
desktop application.

</br>
### <a id="code-sample"></a>Displaying manual code samples

It is possible to display code samples on the Swagger UI. If the reference file contains an **`x-code-samples` attribute**
**in a certain parameter**, a code sample field appears on the Swagger UI at the defined parameter.

This feature is useful if you want to override automatically generated code samples. (If you want to enable
automatically generated code samples on the Swagger UI, contact the Project Manager.)

Add the extra `x-code-samples` attribute to a parameter of the reference file in the following format:

```
x-code-samples:
  - lang: 'C#'
    source: |
      PetStore.v1.Pet pet = new PetStore.v1.Pet();
      pet.setApiKey("your api key");
      pet.petType = PetStore.v1.Pet.TYPE_DOG;
      pet.name = "Rex";
      // set other fields
      PetStoreResponse response = pet.create();
      if (response.statusCode == HttpStatusCode.Created)
      {
        // Successfully created
      }
      else
      {
        // Something wrong -- check response for errors
        Console.WriteLine(response.getRawResponse());
      }
```
<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Code sample field."
			src="@guide_path/assets/9444_code_sample.png" max-width="800" align="center">
      </tr>
	</tbody>
</table>

</br>
## <a id="add-new-versions"></a>Adding new reference versions
</br>

Let's assume you have a new release available for one of your APIs so you need to update the related API reference
documentation on the developer portal. You cannot edit the reference file directly on the UI, but you can **upload a**
**new (or updated) file to the portal**.

To add a new version of an API reference file, follow the steps below:

1. In the administrative menu, go to _</>Devportal_ > _API References_, or go straight to
   `/admin/devportal/api-reference`. The _API References_ overview page appears. Here you can manage every uploaded
   reference file.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="API Reference management via the admin menu."
			src="@guide_path/assets/api_ref_management_admin_menu.png" max-width="800" align="center">
      </tr>
	</tbody>
</table>
</br>

2. Find the API Reference content item you need in the list and click _Edit_ in the _Operations_ column at the end
   of the row.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Select the API reference file you want to edit."
			src="@guide_path/assets/api_ref_overview_edit.png" max-width="800" align="center">
      </tr>
	</tbody>
</table>
</br>

3. The edit form of the API Reference content item appears. Here you can directly amend the related API Reference page
   like assigning the API to categories or editing the header content.

4. You can review (and download) the version of the available documentation in the _All Uploaded files_ field.

5. Click _Choose file_ in the _Source file_ field to browse and upload the new file from your computer.
   Allowed file formats are .yaml, .yml, and .json.

<!-- WARNING (RED) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fdf7f7">
			<td bgcolor="#d9534f" style="width: 1px"></td>
			<td width="100%"><p><font color="#d9534f"><strong>Caution</strong></font>
            </br><font color="#d9534f">You can upload reference files with the same title, but <strong>you cannot add
            files with the same version number if the title of the files are identical</strong>. Make sure to update the
            version number in the reference file before uploading. You get a notification message about unsuccessful
            file uploads.</font></p></td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="The edit form of the API Reference page."
			src="@guide_path/assets/api_ref_edit_release.png" max-width="800" align="center">
      </tr>
	</tbody>
</table>
</br>

6. Click _Save_ at the bottom of the page.

7. The new file appears in the _All Uploaded files_ field with the version number in brackets rendered from the file.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="The new file uploaded."
			src="@guide_path/assets/api_ref_new_file_uploaded.png" max-width="800" align="center">
      </tr>
	</tbody>
</table>
</br>

For end-users, the latest API reference documentation becomes automatically available.

</br>
## <a id="reverting-versions"></a>Reverting reference versions
</br>

You can revert the available API reference documentation to an older version. If you need to make available
a previous version of the reference documentation for end-users but you don't want to upload an already uploaded file to
the portal, follow the steps below:

1. In the administrative menu, go to _</>Devportal_ > _API References_, or go straight to
   `/admin/devportal/api-reference`. The _API References_ overview page appears. Here you can manage every uploaded
   reference file.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="API Reference management via the admin menu."
			src="@guide_path/assets/api_ref_management_admin_menu.png" max-width="800" align="center">
      </tr>
	</tbody>
</table>
</br>

2. Find the API Reference content item you need in the list and click _Edit_ in the _Operations_ column at the end
   of the row.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Select the API reference file you want to edit."
			src="@guide_path/assets/api_ref_overview_edit.png" max-width="800" align="center">
      </tr>
	</tbody>
</table>
</br>

3. Select the _Revisions_ tab.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Select the Revisions tab"
			src="@guide_path/assets/api_ref_revisions_tab.png" max-width="800" align="center">
      </tr>
	</tbody>
</table>
</br>

4. On the revision page of the related API reference documentation, you can track the differences between
   different versions of the documentation and get information about the date of uploading. By clicking the publishing
   date of a version, you can go to the API Reference page that is rendered from the related API reference file to see
   the differences.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="The revisions page of the related API reference."
			src="@guide_path/assets/api_ref_revisions_page.png" max-width="800" align="center">
      </tr>
	</tbody>
</table>
</br>

5. To revert to an older version, find the version in the list you need and click _Revert_ in the _Operations_ column at
   the end of the row.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Click Revert."
			src="@guide_path/assets/api_ref_revert.png" max-width="800" align="center">
      </tr>
	</tbody>
</table>
</br>

6. You have to confirm the action on the appearing page: select _Revert_ to apply your changes or
   _Cancel_ to leave the page without any changes.

7. You get a notification message of the successful action. A copy of the reverted version becomes the current
   version and is available for end-users. The publishing date of this copy is the day of your changes. The originally
   uploaded version remains available on the portal, as well.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Successfully restored version."
			src="@guide_path/assets/api_ref_reverted_version.png" max-width="800" align="center">
      </tr>
	</tbody>
</table>

</br>
## <a id="deleting-versions"></a>Deleting reference versions
</br>

You can remove older versions of an API reference file from the developer portal that you don't need anymore.

<!-- WARNING (RED) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fdf7f7">
			<td bgcolor="#d9534f" style="width: 1px"></td>
			<td width="100%"><p><font color="#d9534f"><strong>Caution</strong></font>
            </br><font color="#d9534f">You cannot delete the current version of the documentation.</font></p></td>
		</tr>
	</tbody>
</table>
</br>

To remove older reference versions from the portal, follow the steps below:

1. In the administrative menu, go to _</>Devportal_ > _API References_, or go straight to
   `/admin/devportal/api-reference`. The _API References_ overview page appears. Here you can manage every uploaded
   reference file.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="API Reference management via the admin menu."
			src="@guide_path/assets/api_ref_management_admin_menu.png" max-width="800" align="center">
      </tr>
	</tbody>
</table>
</br>

2. Find the API Reference content item you need from the list and click _Edit_ in the _Operations_ column at the end
   of the row.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Select the API reference file you want to edit."
			src="@guide_path/assets/api_ref_overview_edit.png" max-width="800" align="center">
      </tr>
	</tbody>
</table>
</br>

3. Select the _Revisions_ tab.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Select the Revisions tab"
			src="@guide_path/assets/api_ref_revisions_tab.png" max-width="800" align="center">
      </tr>
	</tbody>
</table>
</br>

4. The revision page of the related API Reference content item appears. Find the version in the list you want to remove
   and click the arrow next to _Revert_ at the end of the row and select _Delete_ from the drop-down menu.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Delete version you don't need anymore."
			src="@guide_path/assets/api_ref_delete_version.png" max-width="800" align="center">
      </tr>
	</tbody>
</table>
</br>

5. You have to confirm the deletion on the appearing page: select _Delete_ to apply your changes or _Cancel_ to leave
   the page without any changes.

6. You get a notification message about the successful action. The version is no longer available on the developer
   portal.

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
            </br><font color="#f0ad4e">After you have reverted an older reference version, you can delete the
            original file as its copy stays available on the portal. Remove versions only if you don't need them anymore
            for any purposes, like version control or keeping track of version differences.</font></p>
			</td>
		</tr>
	</tbody>
</table>

</br>
## <a id="related-topics"></a>Related topics

- [API Description page content type](/admin/guides/api-documentation/api-description)
- [API Basic page content type](/admin/guides/api-documentation/api-basic-page)
- [API Page Builder content type](/admin/guides/api-documentation/api-page-builder)
- [API Catalog](/admin/guides/api-documentation/api-catalog)
- [API pages](/admin/guides/api-documentation/api-pages)
- [API Tab Sorting](/admin/guides/api-documentation/api-tabs-sorting)
- [Categories and tags](/admin/guides/categories-and-tags/categories-and-tags)
- [Reviewing past revisions](/admin/guides/reviewing-past-revisions/reviewing-past-revisions)

</br>
## <a id="faq"></a>FAQ

- [How can I add APIs to the API Catalog?](/admin/guides/faq/faq#faq-add-api-to-catalog)
- [What is on the API cards?](/admin/guides/faq/faq#faq-api-card-what)
- [What is the Error badge on the API Reference page?](/admin/guides/faq/faq#faq-apiref-error-badge)

</br>

---
<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/non-api-related-content-management/page-builder"
alt="Page Builder" target="_self"><< Page Builder</a> |
<a href="/admin/guides/api-documentation/api-description"
alt="API Description" target="_self">API Description >></a></strong></p>