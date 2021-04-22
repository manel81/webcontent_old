<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/api-documentation/api-description"
alt="API Description" target="_self"><< API Description</a> |
<a href="/admin/guides/api-documentation/api-basic-page"
alt="API Basic page" target="_self">API Basic page >></a></strong></p>

---

# API Page Builder page

</br>

### Table of contents

- [Introduction](#api-pb-intro)
- [Creating landing pages for APIs](#create-api-landing-page)
- [Creating API Page Builder pages](#create-api-pb)
- [The ‘Benefit’ section](#create-apipb-benefit)
- [The ‘About the API’](#create-apipb-about)
- [The ‘Why use it?’](#create-apipb-why)
- [The ‘How to use?’](#create-apipb-how-to)
- [The ‘Requirements’](#create-apipb-requirements)
- [The ‘Request access’](#create-apipb-access)
- [Related topics](#related-topics)
- [FAQ](#faq)

</br>

<!-- IN THIS CHAPTER (BLUE) NOTIFICATION -->
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f4f8fa">
			<td bgcolor="#5bc1de" style="width: 1px"></td>
			<td width="100%"><p><font color="#5bc1de"><strong>In this chapter</strong></font> </br>
            </br><font color="#5bc1de">You learn how to create, edit or delete
            <a href="/admin/guides/api-documentation/api-page-builder" alt="API Page Builder pages" target="_self">
            API Page Builder pages.</a>
            </br></br>While this section only shows you the basics and you do not need to have any prerequisite
            knowledge to follow the steps, consider reading the chapters about the
            <a href="/admin/guides/api-documentation/api-reference" alt="API Reference" target="_self">API Reference
            </a>, <a href="/admin/guides/api-documentation/api-basic-page" alt="API Basic page" target="_self">
            API Basic page</a> and <a href="/admin/guides/api-documentation/api-description"
            alt="API Description page" target="_self">API Description page</a> content types,
            to get a full picture of how the API documentation works on the developer portal.</font></p>
			</td>
		</tr>
	</tbody>
</table>

</br>
## <a id="api-pb-intro"></a>Introduction
</br>

To create a new API Page Builder page, go to _Content_ > _Add content_ > API Page Builder_ in the administrative menu.
Or go straight to `/node/add/api_page_builder`.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Edit form of an API Page Builder page."
            src="@guide_path/assets/api_page_builder_ui.png" max-width="800">
            <div align="center"><em><font color="black">Edit form of an API Page Builder page</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

Complete the form fields where needed. See the table for fields and values below.
**Required fields are marked with a red ** `*` **on the UI.**

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
    <td>The title of the page that is visible for end users as the name of the API Tab, and it becomes the default URL
    alias</td>
    <td><em>Swagger Petstore</em></td>
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
	<a href="/admin/guides/built-in-text-editor/built-in-text-editor" alt="WYSIWYG editor" target="_self">
	WYSIWYG editor</a>.</td>
    <td><em>E.g., “The next generation of the [...] API is arrived.”</em></td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>Text format</strong></td> <!-- TEXT FORMAT -->
    <td>We recommend you to use <strong>Devportal HTML</strong> format.</td>
    <td>Devportal HTML</td>
  </tr>
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
    [<em>Description of the change.</em>] e.g., “Fixed formatting issues.”</td>
  </tr>
  <tr>
    <td><strong>Menu settings</strong></td> <!-- MENU SETTINGS -->
    <td>The URL of the page.</td>
    <td>[x] <em>Provide a menu link</em></br></br>
    <em>Menu link title</em>:</br>
    [The title you want to appear in the menu]</br></br>
    <em>Parent</em>:</br>
    <em>Main navigation</em></br></br>
    <em>Weight</em>: 0</td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>URL alias</strong></td> <!-- URL ALIAS -->
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td><strong>Authoring information</strong></td> <!-- AUTHORING INFORMATION -->
    <td>Automatically generated values. Displayed on the admin UI. </br>Change the author and publishing date,
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
    <td><strong>API Page Builder pages are automatically published after they are saved.</strong>
    </br>To unpublish an API Page Builder page, clear the <em>Published check box</em>. </br>Unpublished pages are
	available
    for content managers and administrators only in the Content menu, but aren’t displayed for the end users.</td>
    <td>[x] <em>Published</em></td>
  </tr>
</table>
</br>

Click _Save_ to create the new content item.

</br>
## <a id="create-api-landing-page"></a>Creating landing pages for APIs
</br>

The goal of this example is to show you the way, how you can build a visually appealing landing page for your APIs.
This chapter doesn’t give detailed explanations about the features used to page building.

This chapter guides you through the creation process of a landing page for an imaginary API created by the team of
Luke Mons, CEO of the Serenity Project. With Moon Rover Photos API the user can collect image data gathered by
moon rovers. The reference file has been uploaded and published so the corresponding Reference documentation is
available on the portal. To make the API and its features more attractive for the users, you need to create a landing
page, where all the necessary information can be found.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="The full layout of the Moon Rover Photos’
            landing page you are going to create."
            src="@guide_path/assets/6588_full_layout_result.png" max-width="800">
            <div align="center"><em><font color="black">Edit form of an API Page Builder page</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

To set up the exemplary landing page for publication, you need to take seven greater steps:

1. [You have to create an API Page builder page and associate it with an uploaded API reference (swagger) file (YML, YAML, JSON).](#create-api-pb)
2. [Create the benefit section with three Benefit cards.](#create-apipb-benefit)
3. [Create the ‘About the API’ field with formatted text.](#create-apipb-about)
4. [Create the ‘Why use it?’ section with promo image.](#create-apipb-why)
5. [Create the ‘How to use?” section with buttons and an inserted image.](#create-apipb-how-to)
6. [Create a notification about the necessary ‘Requirements’.](#create-apipb-requirements)
7. [Create a ‘Request access’ field with a button that leads a user to another page, where the user can get access to an API key.](#create-apipb-access)

For this, you have to use [Page Builder Elements](/admin/guides/page-builder-elements/page-builder-elements),
five Grids and one CTA (Call-to-action).

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="The structure of the Moon Rover Photos landing
            page."
            src="@guide_path/assets/6588_full_layout_edit.png" max-width="800">
            <div align="center"><em><font color="black">The structure of the Moon Rover Photos landing page.
            </em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

As you progress further, the descriptions become more concise. But first, let’s start the page building from th
beginning.

</br>
## <a id="create-api-pb"></a>Creating API Page Builder pages
</br>

1. In the administrative menu, go to _Content_ > _Add content_ > API Page Builder_. Or go straight to
   `/node/add/api_page_builder`.

2. (required) Give a _Title_ for this page on the appearing Edit form. This title is visible for the end users
   as an API tab on the [API Documentation page](/admin/guides/non-api-related-content-management/documentation-page)
   after the content is published. (e.g., _API Summary_)

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="The API Page Builder page is accessible"
            src="@guide_path/assets/6588_api_tab.png" max-width="800">
            <div align="center"><em><font color="black">The API Page Builder page is accessible from the API
            Documentation page after it's published</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

3. (required) Select an uploaded API reference (swagger) file. Start typing and if it matches with the name of an
existing reference file, you can select it from the appearing menu. The title of the API is automatically derived from
the swagger file: ‘Moon Rover Photos’.

4. Clear the _Published_ check box on the bottom of the page.

5. Click _Save_ to create the page.

<!-- GOOD TO KNOW-->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Best practice</strong></font>
            </br><font color="#f0ad4e">Save your work often, and do not publish your content before it’s considered
            done.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Save your work often, and do not publish your
            content before it’s considered done."
            src="@guide_path/assets/6588_draft_start_edit.png" max-width="800">
            <div align="center"><em><font color="black">Save your work often, and do not publish your content before
            it’s considered done.</em></font></div></td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="The page is connected with the corresponding
            API Reference page. You cannot see the corresponding API tab, because the content is not published yet."
            src="@guide_path/assets/6588_draft_1.png" max-width="800">
            <div align="center"><em><font color="black">The page is connected with the corresponding
            API Reference page.</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

You have created the main layout of your landing page. It’s empty, but as you can see on the picture, it's already
associated with the corresponding [API Reference documentation](/admin/guides/api-documentation/api-reference) page.
The [API Page Builder page](/admin/guides/api-documentation/api-page-builder) inherits its visual appearance from it
(e.g., [Header image](/admin/guides/header-background-settings/header-background-settings),
[categories](/admin/guides/categories-and-tags/categories-and-tags).

<!-- GOOD TO KNOW-->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Best practice</strong></font>
            </br><font color="#f0ad4e">If you navigate to somewhere else on your portal during the process, you have
            to search for this page in the <a href="/admin/guides/administrative-menu/administrative-menu#content-menu"
			 alt="Content menu" target="_self">Content menu</a> since it's not published yet.</font></p>
			</td>
		</tr>
	</tbody>
</table>

</br>
## <a id="create-apipb-benefit"></a>The ‘Benefit’ section
</br>

Click the _Edit_ action tab to get back to the Edit form.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Click the Edit action tab."
            src="@guide_path/assets/6588_action_tab.png" max-width="800">
            <div align="center"><em><font color="black">Click the Edit action tab.</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

To create a **Benefit** section, you have to use a Page Builder element called
[Grid](/admin/guides/page-builder-elements/page-builder-elements#about-grid).

1. Click the _Add Grid_ button at the bottom of the page.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Add Grid" src="@guide_path/assets/6588_add_grid.png"
			max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

2. (optional) Add an _Administrative title_ in the appearing field. This title is only visible on the edit form and it
   helps find the Page builder element. Use clear and short titles that refer to the Grid element unambiguously.
   (e.g., Benefit section)

3. Leave the _Grid title_ text field and the _Grid button_ section untouched.

4. (required) Click the _Grid layout_ drop-down menu, and select the _Three Columns - 33% 33% 33%_ item. The Grid
   layout determines the number and ratio of divisions of each section.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Grid edit form"
			src="@guide_path/assets/6588_draft_2_grid.png"
            max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>

<!-- GOOD TO KNOW-->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Best practice</strong></font>
            </br><font color="#f0ad4e">To delete a grid section, click the Remove, then click the
            the appearing Confirm deletion button.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

Now, the grid section is ready to be completed with some Benefit elements.

5. Select the _Add Benefit_ button from the _Grid elements_.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Add benefit" src="@guide_path/assets/6588_grid_elements.png"
            max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

6. (optional) Give an _Administrative title_ to this item. (e.g., _High-end solutions_)

7. Type or paste the text that is displayed on the benefit card. You can format this text as usual with
[WYSIWYG Editor](/admin/guides/built-in-text-editor/built-in-text-editor). (In this example, we used Heading 4 style for
highlighting the title of the benefit and plain text for the description.)

8. Select an _Icon_ from the drop-down menu. (e.g., _Camera_)

9. Leave _Icon color_ as it is. (default: white)

10. Set _Icon background color_ . (e.g., navy blue)

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Add benefit"
			src="@guide_path/assets/6588_draft_2_grid_benefit.png"
            max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

11. Click _Save_ to apply your changes. You can check your progress on the appearing page.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Benefit grid with one item. You can see the
            placeholder for other benefits."
            src="@guide_path/assets/6588_draft_2.png" max-width="800">
            <div align="center"><em><font color="black">Benefit grid with one item. You can see the placeholder for
			other benefits.</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

### Adding more benefits

1. Click _Edit_ and navigate back to the _Page Builder Elements_.

2. Click the [+] sign on the left side of the ‘Benefit section’ _Grid_ or on the _Expand all_ button to expand the
panel.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Add grid" src="@guide_path/assets/6588_grid_extend.png"
			max-width="800"
            align="center"></td>
		</tr>
	</tbody>
</table>
</br>

3. Select the _Add Benefit_ item from the menu and fill in the necessary fields as described above (steps 6-10).

4. Repeat step 1-3.

5. Click _Save_.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Three Benefit elements in the same Grid."
            src="@guide_path/assets/6588_draft_2_grid_benefit_all.png" max-width="800">
            <div align="center"><em><font color="black">Three Benefit elements in the same Grid.</em></font></div></td>
		</tr>
	</tbody>
</table>

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Three Benefit elements in the same Grid."
            src="@guide_path/assets/6588_draft_2_grid_benefit_2.png" max-width="800"
            align="center"></td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="The final appearance of the Benefit section."
            src="@guide_path/assets/6588_draft_3.png" max-width="800">
            <div align="center"><em><font color="black">The final appearance of the Benefit section.</em></font>
			</div></td>
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
            </br><font color="#5cb85c">You have made the first major step on the way to create a landing page for your
            API.</font></p>
			</td>
		</tr>
	</tbody>
</table>

</br>
## <a id="create-apipb-about"></a>The ‘About the API’
</br>

1. Add another _Grid_ to your page.

2. Set the _Admin title_. (e.g., _What is it?_)

3. Fill the _Grid title_ text box. The Grid title will be displayed for end users on the portal with a theme-colored bar
   on its right side. (e.g., _About the API_)

4. Select _One Column - 100%_ from the _Grid layout_ menu.

5. Leave the background color as it is. (default: white)

6. Select a _Border color_. (e.g., navy blue)

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Grid layout."
            src="@guide_path/assets/6588_draft_4_grid.png" max-width="800"
            align="center"></td>
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
            </br><font color="#5cb85c">You have done the basic settings.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

7. Select the _Add Text_ button from the _Grid elements_.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Add text."
            src="@guide_path/assets/6588_add_text.png" max-width="800"
            align="center"></td>
		</tr>
	</tbody>
</table>
</br>

8. (optional) Add an _Administrative title_ in the appearing field.

9. Type or paste the text that is displayed on the benefit card. You can format this text as usual with
   [WYSIWYG Editor](/admin/guides/built-in-text-editor/built-in-text-editor). (In this example, we used Heading 4 style
   for highlighting the title of this section and bold or plain text for the description.)

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Text grid element."
            src="@guide_path/assets/6588_draft_4_text.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

10. Click _Save_ to apply your changes. You can check your progress on the appearing page.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="The ‘About the API’ is the Grid title. You can
            see the blue border on the left side of the section." src="@guide_path/assets/6588_draft_4.png"
			max-width="800">
            <div align="center"><em><font color="black">The ‘About the API’ is the Grid title. You can see the blue
            border on the left side of the section..</em></font></div></td>
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
            </br><font color="#5cb85c">Two sections are done, four more is left. The result of the next subchapter will
            be spectacular.</font></p>
			</td>
		</tr>
	</tbody>
</table>

</br>
## <a id="create-apipb-why"></a>The ‘Why use it?’
</br>

1. Add another _Grid_ with the following parameters:

   a. Set the _Admin title_. (e.g., _Text + Promo image_)
   b. Fill the _Grid title_ text box. (e.g., _Why use it?_)
   c. Select _Two Columns - 66% 33%_ from the _Grid Layout_ menu.
   d. Select one from the available background colors. (e.g., theme green)
   e. Choose _None_ as Border color. (If you let it as default white, a white border appears on this section.)

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Grid layout."
            src="@guide_path/assets/6588_draft_5_grid.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

You will use two Grid elements in this selected layout. 66% for a Text and 33% for a Promo image.

2. Select _Add Text_, then type or insert the description you want to display on your page. You can format this
   text as usual with [WYSIWYG Editor](/admin/guides/built-in-text-editor/built-in-text-editor).
   If you are using a background color, we recommend using one of the
   [Inline styles](/admin/guides/built-in-text-editor/built-in-text-editor#format-style) to make the text more visible
   and readable. (e.g., White Text)

3. Select the _Add Promo image_ button from the _Grid elements_.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Add Promo image."
            src="@guide_path/assets/6588_add_promo_image.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

4. (optional) Add an _Administrative title_.

5. Select and upload a promo image by clicking on the _Choose file_ button. Promo images can extend out from their Grid.
   You can upload one file at once in the maximum size of 10MB, in the following format: PNG, GIF, JPG, JPEG. We
   recommend using PNG or GIF files with transparent background.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Add Promo image."
            src="@guide_path/assets/6588_add_promo_image_upload.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

6. (required) Add _Alternative text_ to the picture. It is a short description of the image, used by screen
   readers and displayed when the image is not loaded.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Add Promo image."
            src="@guide_path/assets/6588_draft_5_text_promo.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

7. Click _Save_ to apply your changes. You can review your progress on the appearing page.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Promo image section."
            src="@guide_path/assets/6588_draft_5.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

You can enhance every Grid element with [Promo images](/admin/guides/page-builder-elements/page-builder-elements#promo-image).
In the next subchapter, we show you how to create a new [Text Grid](/admin/guides/page-builder-elements/page-builder-elements#text)
with [buttons](/admin/guides/built-in-text-editor/built-in-text-editor#button) and an
[inserted image](/admin/guides/image-management/image-management#text-image).

</br>
## <a id="create-apipb-how-to"></a>The ‘How to use?’
</br>

1. Add another _Grid_ with the following parameters:

   a. Admin and Grid title: _How to use?_
   b. Grid Layout: _One Column - 100%_
   c. Leave the _Background color_ as it is.
   d. Select one from the available _Border colors_. (e.g., theme green)

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Grid layout."
            src="@guide_path/assets/6588_draft_6_grid.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

2. Select _Add Text_, then type or insert the description you want to display on your page. You can format this
   text as usual with [WYSIWYG Editor](/admin/guides/built-in-text-editor/built-in-text-editor) (ordered list, primary
   and secondary buttons, images).

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Buttons in text field"
            src="@guide_path/assets/6588_draft_6_text.png" max-width="800">
            <div align="center"><em><font color="black">If you are not familiar with the process of
            <a href="/admin/guides/built-in-text-editor/built-in-text-editor#button" alt="creating buttons"
			target="_self">creating buttons</a> or <a href="/admin/guides/image-management/image-management#text-image"
			 alt="inserting pictures in text field" target="_self">inserting pictures in text field</a>, we recommend
			 reading the related chapters.</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

3. Click _Save_ to apply your changes. You can check your progress on the appearing page.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="The formatting of the numbered list is
            changed by the theme." src="@guide_path/assets/6588_draft_6.png" max-width="800">
            <div align="center"><em><font color="black">The formatting of the numbered list is changed by the theme.
            </em></font></div></td>
		</tr>
	</tbody>
</table>

</br>
## <a id="create-apipb-requirements"></a>The ‘Requirements’
</br>

1. Add another _Grid_ with the following parameters:

   a. _Admin_ and _Grid title_: Requirements

   b. _Grid Layout_: One Column - 100%

   c. Choose _None_ as Background and Border color.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Grid layout."
            src="@guide_path/assets/6588_draft_7_grid.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

In the following, we show you how to add a new type of Grid element to this section.

2. Select the _Add Message_ button from the _Grid elements_.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Add message."
            src="@guide_path/assets/6588_add_message.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

3. Type or paste the text that is displayed on the page. You can format this text as usual with
   [WYSIWYG Editor](/admin/guides/built-in-text-editor/built-in-text-editor).

<!-- GOOD TO KNOW -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
            </br><font color="#f0ad4e">The formatting of the text can change when displayed.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

4. (required) Select _Warning_ from the _Message type_ drop-down menu. Each _Message type_ has unique
   color and icon.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Select message type."
            src="@guide_path/assets/6588_draft_7_msg.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

5. Click _Save_ to apply your changes. You can check your progress on the appearing page.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Select message type."
            src="@guide_path/assets/6588_draft_7.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

Only one section remains. In the last subchapter, we are going to use a different Page Builder Element, called
[CTA](/admin/guides/api-documentation/api-page-builder#about-cta) (Call-to-action.)

</br>
## <a id="create-apipb-access"></a>The ‘Request access’
</br>

1. Click the _Add CTA_ button at the bottom of the page.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Add CTA."
            src="@guide_path/assets/6588_add_cta.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

2. (optional) Add an _Administrative title_ in the appearing field. (e.g., _Access_)

3. Type or paste the text that is displayed on the benefit card. You can format this text as usual with
   [WYSIWYG Editor](/admin/guides/built-in-text-editor/built-in-text-editor).

4. Provide a valid [URL address](/admin/guides/faq/faq#faq-correct-link) (internal or external) in the _URL_ box on the
   _Buttons_ panel.
   This button leads the user toward another (e.g., _the API key requesting_) page. To refer to an
   internal page, use this format: /url-of-the-page.

5. Add a _Link text_. This text is displayed on the button.

6. Choose a button style from the _Select a style_ drop-down menu. (e.g., Primary button)

7. Select one from the available _Background colors_. (e.g., dark navy blue)

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="CTA edit."
            src="@guide_path/assets/6588_draft_8_cta.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

8. Click _Save_ to apply your changes. You can review your progress on the appearing page.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="CTA result."
            src="@guide_path/assets/6588_draft_8.png" max-width="800" align="center"></td>
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
            </br><font color="#5cb85c">You’re done. You have created a whole landing page for the ‘Moon Rover Photos’
            API. Time to publish your work. Navigate back to the _Edit_ form, then check the _Publish_ box, then
            click _Save_. The ‘API Summary’ is now accessible for the end users (with the right permissions and
            access control settings) from the API Documentation page of the corresponding API.
 </font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="CTA result."
            src="@guide_path/assets/6588_draft_8_tab.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>

</br>
## <a id="related-topics"></a>Related topics

- [API Description page content type](/admin/guides/api-documentation/api-description)
- [API pages](/admin/guides/api-documentation/api-pages)
- [API Tab Sorting](/admin/guides/api-documentation/api-tabs-sorting)
- [Image management](/admin/guides/image-management/image-management)
- [Built-in text editor](/admin/guides/built-in-text-editor/built-in-text-editor)

</br>
## <a id="faq"></a>FAQ

- [What is the difference between CTAs (Call-to-Action) and buttons?](/admin/guides/faq/faq#faq-diff-ctas-btns)
- [When should I use CTAs (Call-to-Action)?](/admin/guides/faq/faq#faq-call-to-action)

</br>

---
<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/api-documentation/api-description"
alt="API Description" target="_self"><< API Description</a> |
<a href="/admin/guides/api-documentation/api-basic-page"
alt="API Basic page" target="_self">API Basic page >></a></strong></p>