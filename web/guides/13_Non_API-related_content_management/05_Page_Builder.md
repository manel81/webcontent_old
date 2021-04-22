<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/non-api-related-content-management/faq-item"
alt="FAQ Item" target="_self"><< FAQ Item</a> |
<a href="/admin/guides/api-documentation/api-reference"
alt="API Reference" target="_self">API Reference >></a></strong></p>

---

# Page Builder

</br>

### Table of Contents

- [Introduction](#introduction)
- [Creating landing pages](#create-landing-page)
	- [Creating a Page Builder page](#create-new-page-builder)
	- [Filling in the Header field](#fill-header)
	- [The ‘Benefit’ section](#create-benefit)
        - [Add more benefits](#add-more-benefit)
	- [The ‘Getting Started’](#create-getting-started)
	- [The ‘Featured APIs’](#create-featured-apis)
	- [The ‘How to start?’](#create-how-to-start)
	- [The ‘About this portal’](#create-about)
    - [The ‘Need help?’](#create-need-help)
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
            </br><font color="#5bc1de">You can learn about the
			<a href="/admin/guides/what-content-type-should-i-use/what-content-type-should-i-use#page-builder">
            Page Builder content type</a>: how to create, edit and delete it, and what are the most common fields of its
            usage.
            </font></p>
			</td>
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
            </br><font color="#f0ad4e">The <strong>Page Builder</strong> content type allows you to create appealing and
			effective landing pages (e.g., Homepage). Use the
			<a href="/admin/guides/page-builder-elements/page-builder-elements">Page Builder Elements</a> (Grid, CTA) to
			share information about the portal and services in visually separate sections. You can adjust and maintain
			these sections one-by-one.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

<!-- GIF IMAGE: DISPLAYED WITHOUT BORDER: DON'T USE IT HERE -->
<div align="center"><img alt="final landing page" src="@guide_path/assets/full_layout.gif" max-width="800">
</div>
<div align="center"><em>The full layout of a homepage created with Page Builder content type.</em></div>
</br>

## Introduction
</br>

To create a new Page Builder page, go to _Content_ > _Add content_ > _Page Builder_ in the administrative menu. Or go
straight to `/node/add/page_builder`.


<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Edit form of a Page Builder page"
            src="@guide_path/assets/page_builder_ui.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Edit form of a Page Builder page</em></font></div></td>
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
    <td>The title of the content item that is visible only on the admin UI to help content identification.</td>
    <td>E.g. <em>Homepage</em></td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>Header</strong></td> <!-- HEADER -->
    <td>Provide overall information or a short and informative welcoming message for your page.</br>
    Edit the content with the <a href="/admin/guides/built-in-text-editor/built-in-text-editor">WYSIWYG text editor</a>
	and add buttons or links to the field.
    </td>
    <td>E.g. “User Guides for the Universe - Explore the space through the APIs of the serenity project”</td>
  </tr>
  <tr>
    <td><strong>Text format</strong></td> <!-- TEXT FORMAT -->
    <td>We recommend you to use <strong>Devportal HTML</strong> format.</td>
    <td><em>Devportal HTML</em></td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>Page Builder Elements</strong></td>
    <!-- PAGE BUILDER ELEMENTS -->
    <td>Select from the listed building units to create various sections and build a landing page for your content.</td>
    <td><em>
	<a href="/admin/guides/non-api-related-content-management/page-builder-elements/page-builder-elements#grid-elements">
	Grid</a></em>,
	<em><a href="/admin/guides/page-builder-elements/page-builder-elements#about-cta">CTA</a></em></td>
  </tr>
  <tr>
    <td><strong>Revision log message</strong></td> <!-- REVISION LOG MESSAGE -->
    <td>Create a new version of an existing content and add information about your changes for other admins.</td>
    <td>[x] <em>Create new revision</em></br></br>
    [<em>Description of the change.</em>] e.g. “Fixed formatting issues.”</td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>Menu settings</strong></td> <!-- MENU SETTINGS -->
    <td>You can place your Page Builder page into one of the menus as a menu item.</br>For further information, read the
    <a href="/admin/guides/menu-settings/menu-settings">Menu settings</a> section.</td>
    <td>[x] <em>Provide a menu link</em></br></br>
    <em>Menu link title</em>:</br>
    [The title you want to appear in the menu]</br></br>
    <em>Parent</em>:</br>
    &lt;Main navigation&gt;</br></br>
    <em>Weight</em>: 0</td>
  </tr>
  <tr>
    <td><strong>URL alias</strong></td> <!-- URL ALIAS -->
    <td>The URL of the page. It can be provided manually.</td>
    <td>E.g. <em>/home</em></br>Default: <em>/node/</em>[number of the node]</td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>Authoring information</strong></td> <!-- AUTHORING INFORMATION -->
    <td>Automatically generated values. Displayed on the admin UI.</br>Change the author and publishing date, if
    you are not creating your own page.</br>Leave blank to set it as an anonymous user.</td>
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
    <td><strong>Page Builder pages are automatically published after they are saved.</strong></br>To unpublish the page,
	clear the <em>Published</em> checkbox.</br>Unpublished pages are available for content managers and administrators
	only in the Content menu, but aren’t displayed for the end users.</td>
    <td>[x] <em>Published</em></td>
  </tr>
</table>
</br>

Click _Save_ to create the new content item.

</br>
## <a id="create-landing-page"></a>Creating landing pages
</br>

<!-- IN THIS CHAPTER (BLUE) NOTIFICATION -->
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f4f8fa">
			<tr bgcolor="#f4f8fa">
			<td bgcolor="#5bc1de" style="width: 1px"></td>
			<td width="100%"><p><font color="#5bc1de"><strong>In this chapter</strong></font>
            </br><font color="#5bc1de">This chapter guides you through the creation process of a homepage for an
            imaginary API developer company, called Serenity Project. APIs are uploaded, their
            documentation is ready to be published, and every necessary content is available, too. To make the company’s
            services more attractive for users (for developers, and other decision makers too), you need to
            create a page where all essential information can be found.</br></br>The goal of this example is to show
            you how to build a visually appealing homepage for a developer portal.
            This chapter doesn’t give detailed explanation about the building units. You don't need to have any
            prerequisite knowledge to follow the steps, consider reading the chapters about the
            <a href="/admin/guides/what-content-type-should-i-use/what-content-type-should-i-use#page-builder">Page
			Builder content type</a> and the <a href="/admin/guides/page-builder-elements/page-builder-elements">Page
			Builder Elements</a>,
			to get the full picture of how all these features work on the developer portal. The
			<a href="/admin/guides/api-documentation/api-page-builder">API Page Builder</a>
			and the <a href="/admin/guides/api-documentation/api-description">API Description page</a>
			content types work with the same building units.
            </font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

<!-- GIF IMAGE: DISPLAYED WITHOUT BORDER -->
<div align="center"><img alt="final landing page" src="@guide_path/assets/full_layout.gif" max-width="800">
</div>
<div align="center"><em>The full layout of the homepage you are going to create.</em></div>
</br>

To set up the exemplary homepage for publication, you need to take seven major steps:

1. You have to <a href="#create-landing-page">create a Page builder page</a> and <a href="#fill-header">
   format the Header text</a> of the page with the
   [WYSIWYG text editor](/admin/guides/built-in-text-editor/built-in-text-editor).

2. <a href="#create-benefit">Create the benefit section</a> with three Benefit cards.

3. <a href="#create-getting-started">Create the ‘Getting started’ field</a> with formatted text and a promo
   image.

4. <a href="#create-featured-apis">Create the ‘Featured APIs’ section</a>.

5. <a href="#create-how-to-start">Create the ‘How to start’ section</a> with cards.

6. <a href="#create-about">Create the ‘About this portal’ section</a> with two images and
   texts.

7. <a href="#create-need-help">Create the ‘Need help?’ CTA field</a> with a button that leads users to the
   support page.

To achieve this, you have to use
[Page Builder Elements](/admin/guides/page-builder-elements/page-builder-elements),
six [Grids](/admin/guides/non-api-related-content-management/page-builder-elements/page-builder-elements#grid-elements)
and one [CTA](/admin/guides/page-builder-elements/page-builder-elements#about-cta) (Call-to-action).

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="The structure of the homepage."
            src="@guide_path/assets/9196_full_layout_edit.png" max-width="800" align="center">
            <div align="center"><em><font color="black">The structure of the Serenity Project’s homepage you are going
            to build.</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

As you progress further, the descriptions become more concise. But first, let’s start the page building from the
beginning.

</br>
## <a id="create-new-page-builder"></a>Creating a Page Builder page
</br>

1. In the administrative menu, go to _Content_ > _Add content_ > _Page Builder_. Or go straight to
   `/node/add/page_builder`.

2. <font color="red">(required)</font> Give a _Title_ for this page on the appearing edit form. This title doesn’t
   appear for the end-users, and is for administrative purposes only. (e.g., _APIs for the universe_)

3. Add a custom URL alias to your page in the _URL alias_ menu. (e.g., _/new-homepage_)

</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
            </br><font color="#f0ad4e">You can use this URL later to add a header background image and to set this page
			as a new homepage of the portal.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

4. Clear the _Published_ checkbox at the bottom of the page.

5. Click _Save_ to create the page.

</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
            </br><font color="#f0ad4e">Save your work often and do not publish your content before it’s considered
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
			<td bgcolor="#f3f4f4" align="center"><img alt="Save your work often"
            src="@guide_path/assets/6567_draft_start_edit.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="The Page builder page has been created."
            src="@guide_path/assets/6567_draft_1.png" max-width="800" align="center">
            <div align="center"><em><font color="black">The Page builder page has been created.</em></font></div></td>
		</tr>
	</tbody>
</table>

<!--MILESTONE -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f1f9f1">
			<td bgcolor="#5cb85c" style="width: 1px"></td>
			<td width="100%"><p><font color="#5cb85c"><strong>Milestone</strong></font>
            </br><font color="#5cb85c">You have created a new page, now you have to fill it with content.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!--GOOD TO KNOW -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
            </br><font color="#f0ad4e">If you navigate to somewhere else on the portal during the process, you have to
            search for this page in the <a href="/admin/guides/administrative-menu/administrative-menu#content-menu">
			Content menu</a> since it's not published yet.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

Let’s complete the header region of the page with a formatted text.

</br>
## <a id="fill-header"></a>Complete the Header field
</br>

1. Type or copy-paste the content into the _Header_ text field.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Plain text of the Header."
            src="@guide_path/assets/6567_header_raw.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Plain text in the Header field.</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

2. Format your copy with the [WYSIWYG text editor](/admin/guides/built-in-text-editor/built-in-text-editor).
  (e.g., Set the _Style_ of the ‘API for the universe’ text as _Heading 1 - Hero Variant_, apply _Light Text_ Inline
  Style to the second paragraph, then
  <a href="/admin/guides/built-in-text-editor/built-in-text-editor#button">create a _Primary button_ from the
  ‘Get Started’ and a _Secondary Inverted button_ from the ‘Browse APIs’ texts</a>). To learn how to upload a header
  background image (see screenshot above), read the
  [Header background settings](/admin/guides/header-background-settings/header-background-settings) chapter.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Formatted header."
            src="@guide_path/assets/6567_header_formatted.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

3. Click _Save_ to apply your changes. You can check your progress on the appearing page.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Header result."
            src="@guide_path/assets/6567_header_result.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>

</br>
## <a id="create-benefit"></a>The ‘Benefit’ section
</br>

<!-- IMAGE -->
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Benefit section."
            src="@guide_path/assets/6598_benefit_grid_layout.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Benefit section with three benefit cards and colored icons.
			</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

Click the _Edit_ action tab to get back to the edit form.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Click the Edit action tab."
            src="@guide_path/assets/6588_action_tab.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Click the Edit action tab.</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

To create the **Benefit** section, you have to use the grid element called
[Benefit](/admin/guides/page-builder-elements/page-builder-elements#benefit).

1. Click the _Add Grid_ button at the bottom of the page.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Add grid."
            src="@guide_path/assets/6588_add_grid.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

2. (optional) Add an _Administrative title_ in the appearing field.

<!-- GOOD TO KNOW-->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
            </br><font color="#f0ad4e">This title is only visible on the edit form and it helps to find the Page
            Builder Element. Use clear and short titles that describes the building unit unambiguously. (e.g., Benefits)
            </font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

3. Leave the _Grid title_ text field and the _Grid button_ section untouched.

4. <font color="red">(required)</font> Click the _Grid layout_ drop-down menu, and select the _Three Columns - 33%_
   _33% 33%_ item. The grid layout determines the number and ratio of divisions of each section.

5. Set _Background Color_ and _Border Color_ to transparent.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Edit grid." src="@guide_path/assets/6567_grid_edit.png"
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
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
            </br><font color="#f0ad4e">To delete a grid section later on, click <em>Remove</em>,
            then confirm deletion on the appearing page.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

Now, the grid section is ready to be completed with three benefit cards.

6. <a id="add_more_item_example_1"></a>Select the _Add Benefit_ button from _Grid elements_.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Grid elements."
            src="@guide_path/assets/6588_grid_elements.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

7. (optional) Give an _Administrative title_ for this item. (e.g., _This is rocket science_)

8. Type or paste the text and the title that is displayed on the benefit card. You can format this text as usual with
   [WYSIWYG text editor](/admin/guides/built-in-text-editor/built-in-text-editor). (In this example, we used _Heading 5_
   style for highlighting the title of the benefit, plain text for the description and a link button.)

9. Select an _Icon_ from the drop-down menu. (e.g., _Moon_)

10. Leave the _Icon color_ as it is. (default: white)

11. Set the _Icon background color_ . (e.g., _dark navy blue_)

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Grid benefit, edit."
            src="@guide_path/assets/6567_benefit_1_edit.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

12. Click _Save_ to apply your changes. You can check your progress on the appearing page.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Benefit grid with one item"
            src="@guide_path/assets/6567_benefit_1_placeholder.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Benefit grid section with one item. The placeholder (with
			invisible background) for other benefits is highlighted in red.</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

### <a id="add-more-benefit"></a>Adding more benefits

1. Click _Edit_ and navigate back to the _Page Builder Elements_.

2. Click the [+] sign on the left side of the ‘Benefits’ section _Grid_ or on the _Expand all_ button to expand the
   panel.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Expand grid."
            src="@guide_path/assets/6567_grid_benefit_expand.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

3. Select the _Add Benefit_ item from _Grid elements_ and fill in the necessary fields as described above
(<a href="#add_more_item_example_1">steps 6-11</a>).

4. Repeat step 1-3.

5. Click _Save_.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Three Benefit elements in the same Grid."
            src="@guide_path/assets/6567_draft_2_grid_benefit_all.png" max-width="800" align="center">
            </td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Grid benefit 2"
            src="@guide_path/assets/6567_draft_2_grid_benefit_2.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Three Benefit elements in the same grid (up: expanded, down:
            collapsed).</em></font></div></td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="The final appearance of the Benefit section."
            src="@guide_path/assets/6567_draft_3.png" max-width="800" align="center">
            <div align="center"><em><font color="black">The final appearance of the Benefit section.</em></font></div>
            </td>
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
            </br><font color="#5cb85c">You have made the first major step on the way to create the homepage for the
            Serenity Project.</font></p>
			</td>
		</tr>
	</tbody>
</table>

</br>
## <a id="create-getting-started"></a>The ‘Getting Started’
</br>

<!-- IN THIS PART OF THE TUTORIAL (BLUE) NOTIFICATION -->
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
			<tr bgcolor="#f4f8fa">
			<td bgcolor="#5bc1de" style="width: 1px"></td>
			<td width="100%"><p><font color="#5bc1de"><strong>In this part of the tutorial</strong></font>
            </br><font color="#5bc1de">The ‘Getting started’ section is created with a two columns grid layout using the
            <a href="/admin/guides/page-builder-elements/page-builder-elements#text">Text</a> and
            <a href="/admin/guides/page-builder-elements/page-builder-elements#promo-image">Promo Image</a> grid
			elements.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

1. Add another _Grid_ to your page.

2. Set the _Administrative title_. (e.g., _Getting started section_)

3. Complete the _Grid title_ text box. This title is displayed for end-users on the portal with a theme-colored bar
   on its right side. (e.g., _Getting started_)

4. Select _Two Columns - 66% 33%_ from the _Grid Layout_ menu.

5. Select one from the available background colors. (e.g., green)

6. Choose _None_ as Border color.

<!-- GOOD TO KNOW -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
            </br><font color="#f0ad4e">If you let it as default white, a white border appears at this section.
            </em></font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Grid, promo image."
            src="@guide_path/assets/6567_promo_grid.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

You are done with the basic grid settings. You have to use two _Grid elements_ to fill the selected 2 columns grid
layout: a _Text_ for the 66% and a _Promo image_ for the 33%.

7. Select the _Add Text_ button from the _Grid elements_.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Add text" src="@guide_path/assets/6588_add_text.png"
            max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

8. (optional) Add an _Administrative title_ in the appearing field.

9. Type or paste the text that you want to display on the portal. You can format this text as usual with the
[WYSIWYG text editor](/admin/guides/built-in-text-editor/built-in-text-editor). (In this example, we used normal text
and a numbered list with _Light Text_ Inline Style, and a _Secondary Inverted button_.)

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Text field with formatted text."
            src="@guide_path/assets/6567_promo_text_grid.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Text field with formatted text.</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

After you've formatted the main text, let's add the promo image to the section.

10. Select the _Add Promo image_ button from the _Grid elements_.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Add promo image."
            src="@guide_path/assets/6588_add_promo_image.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

11. (optional) Add an _Administrative title_.

12. Select and upload a promo image by clicking the _Choose file_ button.

<!-- GOOD TO KNOW -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
            </br><font color="#f0ad4e">Promo images can extend out from their grid. You can upload only one file at once
            in the maximum size of 10MB, in the following format: <em>png</em>, <em>gif</em>, <em>jpg</em>,
			<em>jpeg</em>. We recommend using <em>.png</em> or <em>.gif</em> files with transparent background.
			</em></font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Add promo image: upload."
            src="@guide_path/assets/6588_add_promo_image_upload.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

13. <font color="red">(required)</font> Add _Alternative text_ to the picture. Alternative text is a short description
   of the image, used by screen readers and displayed when the image is not loaded.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Add promo image: upload, result."
            src="@guide_path/assets/6567_promo_image.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

14. Click _Save_ to apply your changes. You can check your progress on the appearing page.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="The final appearance of the Getting Started section."
            src="@guide_path/assets/6567_promo_result.png" max-width="800" align="center">
            <div align="center"><em><font color="black">The final appearance of the Getting Started section.</em></font>
            </div></td>
		</tr>
	</tbody>
</table>

</br>
## <a id="create-featured-apis"></a>The ‘Featured APIs’
</br>

<!-- IN THIS PART OF THE TUTORIAL -->
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f4f8fa">
			<td bgcolor="#5bc1de" style="width: 1px"></td>
			<td width="100%"><p><font color="#5bc1de"><strong>In this part of the tutorial</strong></font>
            </br><font color="#5bc1de">We use another grid element called <em>Featured API</em> to display API reference
            cards on the homepage. These reference cards inherit their content from the reference (swagger) files, and
            each has a link to the documentation page of the corresponding API. We insert a button, too, to help
            users navigate directly to the API Catalog from this section.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

1. Add another _Grid_ with the following parameters:

	- Set the _Administrative title_ and the _Grid title_. (e.g., _Featured APIs_)

	- Type the URL of the API Catalog in the _URL_ field of the _Gird Button_ section. (e.g., /api-catalog)
	<font color="red">(Recommended if the _Grid button_ URL is filled in.)</font>

	- Add a _Link text_. This text is displayed on the button. (e.g., API Catalog)

	- Select the _Button Style_. (e.g., _Secondary button_)

	- Select _Three Columns - 33% 33% 33%_ from the _Grid Layout_ menu.

	- Set the _Background color_ and the _Border color_ to transparent.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Featured API grid."
            src="@guide_path/assets/6567_featured_grid.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

The main grid layout is ready to be enhanced further. We add one
[Featured API](/admin/guides/page-builder-elements/page-builder-elements#featured-api) to each column.

2. Select the _Add Featured API_ button from the _Grid elements_.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Add Featured API."
            src="@guide_path/assets/6567_add_featured_api.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

3. Select an uploaded API reference (swagger) file. Start typing the name of the API and select it from the appearing
list.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="An API reference file is getting selected."
            src="@guide_path/assets/6567_add_reference.png" max-width="800" align="center">
            <div align="center"><em><font color="black">An API reference file is getting selected.
            </em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

4. To add another API reference to the Featured API grid section, select the _Add Featured API_ grid element again,
   and repeat step 3.

<!-- GOOD TO KNOW -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
            </br><font color="#f0ad4e">You can add as many API references to the same grid section as you want. They are
            displayed according to the selected grid layout option.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Three embedded Featured API elements."
            src="@guide_path/assets/9196_featured_embedded.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Three embedded Featured API elements.
            </em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

5. Click _Save_ to apply your changes. You can check your progress on the appearing page.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Six API references added as Featured APIs."
            src="@guide_path/assets/6567_featured_result.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Six API references added as Featured APIs to the landing page,
            selected grid layout: three columns: 33%-33%-33%</em></font></div></td>
		</tr>
	</tbody>
</table>

</br>
## <a id="create-how-to-start"></a>The ‘How to start?’
</br>

<!-- IN THIS PART OF THE TUTORIAL -->
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f4f8fa">
			<td bgcolor="#5bc1de" style="width: 1px"></td>
			<td width="100%"><p><font color="#5bc1de"><strong>In this part of the tutorial</strong></font>
            </br><font color="#5bc1de">To create the ‘How to start?’ section we use the <em>
			<a href="/admin/guides/page-builder-elements/page-builder-elements#card">
			Card</a></em> grid element. Cards can be used as links, but you can add a background image and a brief text
			to each. First, set up the grid layout as usual.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

1. Add another _Grid_ with the following parameters:

	 - _Administrative_ and _Grid title_: How to start.

	 - _Grid Layout_: _Three Columns - 33% 33% 33%_.

	 - Set the _Background color_ to white.

	 - Choose the transparent _Border color_.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="The settings of the Grid Layout."
            src="@guide_path/assets/6567_card_grid.png" max-width="800" align="center">
            <div align="center"><em><font color="black">The settings of the grid layout.</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

According to the selected _Grid Layout_ (Three Columns - 33% 33% 33%), we add three _Card_ elements:
‘Getting Started’, ‘Browsing API Catalog’, and ‘FAQ’.

2. <a id="edit_card_1"></a>Select the _Add Card_ button from the _Grid elements_.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Add card."
            src="@guide_path/assets/6567_add_card.png" max-width="800" align="center">
            </td>
		</tr>
	</tbody>
</table>
</br>

3. (optional) Set the _Administrative title_.

4. Upload an image to the _Card_ element by clicking the _Choose file_ button at the Image field.

<!-- GOOD TO KNOW -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
            </br><font color="#f0ad4e">You can upload one image file only in the maximum size of 10MB, in the following
            formats: PNG, GIF, JPG, JPEG, VG.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

5. (optional) Give an _Alternative text_.

6. Mark the _Image as background_ check box.

7. Type or paste the text you want to display on the card. You can format this text as usual with the
   [WYSIWYG text editor](/admin/guides/built-in-text-editor/built-in-text-editor). (In this example, we used _Heading 4_
   and normal text with _Light Text_ Inline Style to enhance visibility.)

8. Provide a [valid URL address](/admin/guides/faq/faq#faq-correct-link) in the _Target_ field. This button leads the
   user toward another (e.g., the FAQ or Contact) page.

<!-- GOOD TO KNOW -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
            </br><font color="#f0ad4e">If the <em>Target</em> field is filled, the card becomes interactive and
			functions as a quicklink to navigate users toward the targeted page. To refer to an internal page,
			use the relative format: _/url-of-the-page_.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Edit Card." src="@guide_path/assets/6567_card_edit.png"
            max-width="800" align="center"></td>
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
            </br><font color="#5cb85c">The first interactive <em>Card</em> element has been created. </font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

To create two more, scroll back and <a href="#edit_card_1">follow steps 2-8</a>.

9. Click _Save_ to apply your changes. You can check your progress on the appearing page.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Card result" src="@guide_path/assets/6567_card_result.png"
            max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>

</br>
## <a id="create-about"></a>The ‘About this portal’
</br>

<!-- IN THIS PART OF THE TUTORIAL -->
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f4f8fa">
			<td bgcolor="#5bc1de" style="width: 1px"></td>
			<td width="100%"><p><font color="#5bc1de"><strong>In this part of the tutorial</strong></font>
            </br><font color="#5bc1de">We create a section that describes the history and credo of the Serenity
            Project. To break the monotony of a simple written text, we divide the full description into two
            different grids and add images to them.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

1. Add another _Grid_ with the following parameters:

	 - _Administrative title_: _Text + image_.

	 - _Grid title_: _About this portal_.

	 - Grid button _URL_: _/history_.

	 - Grid button _Link text_: _Section button_.

	 - Grid button style: _Secondary button_.

	 - _Grid Layout_: _Two Columns - 33% 66%_.

	 - Set the _Background color_ to white.

	 - Choose the transparent _Border color_.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Text_Image edit."
            src="@guide_path/assets/6567_image_text_edit.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

The main layout for this grid has been created. Next, we add an image first (that is to be displayed on the left
side of the section). For this, we use the [Image](/admin/guides/page-builder-elements/page-builder-elements#image)
grid element.

2. Select the _Add Image_ button from _Grid elements_.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Add image." src="@guide_path/assets/6567_add_image.png"
            max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

3. (optional) Give an _Administrative Title_.

4. Upload an image by clicking the _Choose file_ button at the _Image_ field.

<!-- GOOD TO KNOW -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
            </br><font color="#f0ad4e">You can upload one image file only in the maximum size of 20MB, in the following
            formats: PNG, GIF, JPG, JPEG.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

5. Give a short description of the image in the _Alternative text_ field, e.g., _Space image_.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Space image."
			src="@guide_path/assets/6567_image_uploaded.png"
            max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

Now, click _Save_ to check out your progress.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="@guide_path/assets/6567_image_text_half.png"
            src="@guide_path/assets/6567_image_text_half.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

We fill in the placeholder with a text using the [Text](/admin/guides/page-builder-elements/page-builder-elements#text)
grid element.

6. Select the _Add Text_ button from _Grid elements_.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="@guide_path/assets/6567_add_text.png"
            src="@guide_path/assets/6567_add_text.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

7. (optional) Add an _Administrative title_.

8. Type or paste the text you want to display in the section. You can format this text as usual with the
   [WYSIWYG text editor](/admin/guides/built-in-text-editor/built-in-text-editor). (In this example, we used
   _Heading 5_, normal text and a link to another page.)

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Image and Text elements are embedded."
            src="@guide_path/assets/6567_image_text_edit_final.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Image and Text elements are embedded to the same Grid creating a
            complex layout.</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

9. Click _Save_ to apply your changes. You can check your progress on the appearing page.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="@guide_path/assets/6567_text_image_half_result.png"
            src="@guide_path/assets/6567_text_image_half_result.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

This section is half-way done.</br></br>We divided our long text into two shorter units. We have to
create another grid with a _Two Columns - 66% 33%_ layout to achieve a reader-friendly distribution to
our remaining content, as well.</br></br>We don’t use grid buttons this time, and we add the _Text_ element first, then
the _Image_ to change the order of their display.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="The final layout of the second Grid
            section." src="@guide_path/assets/6567_image_text_second_edit.png" max-width="800" align="center">
            <div align="center"><em><font color="black">The final layout of the second grid in the ‘About this portal’
            section containing the second half of the whole introduction text and another image.</em></font></div></td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="The result displayed on the portal."
            src="@guide_path/assets/6567_text_image_final_result.png" max-width="800" align="center">
            <div align="center"><em><font color="black">The result displayed on the portal.</em></font></div></td>
		</tr>
	</tbody>
</table>

</br>
## <a id="create-need-help"></a>The ‘Need help?’
</br>

<!-- IN THIS PART OF THE TUTORIAL -->
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f4f8fa">
			<td bgcolor="#5bc1de" style="width: 1px"></td>
			<td width="100%"><p><font color="#5bc1de"><strong>In this part of the tutorial</strong></font>
            </br><font color="#5bc1de">Only one section remains. In the last subchapter, you use a different
            Page Builder Element, called
			<a href="/admin/guides/non-api-related-content-management/page-builder-elements/page-builder-elements#about-cta">
			CTA (Call-to-action.)
            </font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

1. Click the _Add CTA_ button at the bottom of the page.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="@guide_path/assets/6588_add_cta.png"
            src="@guide_path/assets/6588_add_cta.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

2. (optional) Add an _Administrative title_ in the appearing field.

3. Type or paste the text that you want to display in this section. You can format this text as usual with the
   [WYSIWYG text editor](/admin/guides/built-in-text-editor/built-in-text-editor). Links added to the text use the theme
   color (green in this example).

4. Provide a [valid URL address](/admin/guides/faq/faq#faq-correct-link) (internal or external) in the _URL_ box on
the _Buttons_ panel. This button leads the user toward another (e.g., the FAQ or Contact) page.

<!-- GOOD TO KNOW -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
            </br><font color="#f0ad4e">To refer to an internal page, use the relative format:
            /url-of-the-page.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

5. Add a _Link text_. This text is displayed on the button.

6. Choose a button style from the _Select a style_ drop-down menu. (e.g., _Primary button_)

7. To use two buttons, go back to step 4 and follow the instructions.

8. Select one from the available _Background colors_. (e.g., dark navy blue)

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="CTA section."
            src="@guide_path/assets/6567_cta_edit.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Text field is filled and two buttons added to the CTA section.
            </em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

9. Click _Save_ to apply your changes. You can check your progress on the appearing page.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="@guide_path/assets/6567_cta_final.png"
            src="@guide_path/assets/6567_cta_final.png" max-width="800" align="center"></td>
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
            </br><font color="#5cb85c">You’re done with the page building. You have created a whole landing page
            for the Serenity Project. Time to publish your work. Navigate back to the <em>Edit</em> form, mark the
            <em>Publish</em> check box, then click <em>Save</em>. Your page can be reached for the end users.</font></p>
			</td>
		</tr>
	</tbody>
</table>

</br>
## <a id="related-topics"></a>Related Topics

- [Page Builder elements](/admin/guides/non-api-related-content-management/page-builder-elements/page-builder-elements)
- [WYSIWYG text editor](/admin/guides/built-in-text-editor/built-in-text-editor)
- [Header background management](/admin/guides/header-background-settings/header-background-settings)

</br>
## <a id="faq"></a>FAQ

- [What is the difference between CTAs and buttons?](/admin/guides/faq/faq#faq-diff-ctas-btns)
- [Deleting vs. Unpublishing content?](/admin/guides/faq/faq#faq-delete-unpublish)
- [What if I made unwanted changes?](/admin/guides/faq/faq#faq-revision)
- [What is the right link format?](/admin/guides/faq/faq#faq-correct-link)

</br>

---
<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/non-api-related-content-management/faq-item"
alt="FAQ Item" target="_self"><< FAQ Item</a> |
<a href="/admin/guides/api-documentation/api-reference"
alt="API Reference" target="_self">API Reference >></a></strong></p>