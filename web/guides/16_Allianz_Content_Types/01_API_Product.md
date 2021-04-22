<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/faq/faq"
alt="FAQ" target="_self"><< FAQ</a> |
<a href="/admin/guides/allianz-content-types/api-product-description"
alt="API Product Description" target="_self">API Product Description >></a></strong></p>

---
# API Product page
</br>

### Prerequisite knowledge

- [Page Builder Elements](/admin/guides/page-builder-elements/page-builder-elements)

### Table of contents

- [About the API Product content type](#allianz-about-api-product)
- [Introduction](#allianz-api-product-intro)
- [Creating API Product pages](#allianz-create-api-product)
- [The Why use it section](#allianz-benefit-api-product): Benefit grid element
- [The How to use it section](#allianz-text-api-product): Text and Image grid elements
- [The Used API section](#allianz-featured-api-product): Featured API grid element
- [The Are you interested in the offer section](#allianz-cta-api-product): CTA grid element
- [Sorting API Product pages](#allianz-api-product-sorting)

<!-- IN THIS CHAPTER (BLUE) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f4f8fa">
			<tr bgcolor="#f4f8fa">
			<td bgcolor="#5bc1de" style="width: 1px"></td>
			<td width="100%"><p><font color="#5bc1de"><strong>In this chapter</strong></font>
               </br><font color="#5bc1de">You can learn how to use the API Product content type to create visually
			   appealing and informative landing pages for your API Products.
			   </font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

## <a id="allianz-about-api-product"></a>About the API Product content type

Use the API Product content type to create visually appealing and informative description (or detail) pages for your
API Products and make available the API documentation that belong to the Product. You can add various
[Page Builder elements](/admin/guides/page-builder-elements/page-builder-elements) to customize the layout of the page.
Each section created with Page Builder elements can be edited individually.

**End-users can reach the API Product page via the Documentation tab.**

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="An example API Product landing page."
			src="@guide_path/assets/10281_api_product.gif" max-width="800" align="center">
            <div align="center"><em><font color="black">An example API Product landing page built with
            different Page Builder elements.</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

Published API Product pages are available for end-users in the
[_Products_](/admin/guides/allianz-content-types/products-listing-page) listing page as API Product cards.

An **API Product card** consists of a title (name of the Product), an icon, a description (summary of the Product), and
a link to the API Product page. You can set these attributes and values when you are creating or editing an API
Product page.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="The Products listing page with API Product cards."
			src="@guide_path/assets/10281_api_product_card.png" max-width="800" align="center">
            <div align="center"><em><font color="black">The API Products listing page with interactive API Product
            cards.</em></font></div></td>
		</tr>
	</tbody>
</table>

</br>

## <a id="allianz-api-product-intro"></a>Introduction
</br>

To create a new API Product page, go to _Content_ > _Add content_ > _API Product_ in the administrative menu.
Or go straight to `/node/add/api_product`.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Add a new API Product content item."
			src="@guide_path/assets/10281_path_admin.png" max-width="800" align="center">
        </tr>
	</tbody>
</table>
</br>

<!-- IMAGE -->
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="A snippet of the form of an API Product page."
			src="@guide_path/assets/10281_api_product_edit_ui.png" max-width="800" align="center">
            <div align="center"><em><font color="black">A snippet of the edit form of an API Product page.</em>
			</font></div></td>
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
    <td><strong>Version</strong></td> <!-- VERSION -->
    <td>Add the version of the API Product. This value is displayed next to the Product title in a colored box.</td>
    <td>E.g., <em>1.1.0</em>, <em>v1.2.1</em></td>
  </tr>
  <tr>
    <td><strong>API Product category</strong></td> <!-- CATEGORY-->
    <td>Group your API Products to categories. <a href="/admin/guides/categories-and-tags/categories-and-tags"
    alt="Categories" target="_self">Categories</a> are displayed in the <em>Products</em> listing page.
</br>API Product category names are <strong>case sensitive</strong>.</td>
    <td>E.g., <em>Economy</em></td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>Icon</strong></td> <!-- ICON -->
    <td>The icon is visible for end-users and displayed on the API Product card. Select the <em>Icon color</em> and the
    <em>Icon background color</em> and set the <em>Opacity</em>: the value must be less than or equal to 1.</td>
    <td>Opacity: e.g., 1 (opaque); 0,50 (50% visible); 0 (not visible)</td>
  </tr>
    <td><strong>Description</strong></td> <!-- DESCRIPTION -->
    <td>Add a description to your API Product. This content is displayed on the API Product card. </br>To format the
    text or add links and pictures,
    use the <a href="/admin/guides/built-in-text-editor/built-in-text-editor" alt="built-in text editor" target="_self">
	built-in text editor</a>.</td>
    <td>[copy of your content]</td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>API header</strong></td> <!-- HEADER -->
    <td>A short but informative introduction to your API Product that is displayed under the API Product title in the
    header region of the page.
    Use the <a href="/admin/guides/built-in-text-editor/built-in-text-editor" alt="built-in text editor" target="_self">
	built-in text editor</a> to format the text.</td>
   <td>[copy of your content]</td>
  </tr>
    <td><strong>Text format</strong></td> <!-- TEXT FORMAT -->
    <td>We recommend you to use <strong>Devportal HTML</strong> format.</td>
    <td><em>Devportal HTML</em></td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>Page Builder Elements</strong></td> <!-- PAGE BUILDER ELEMENTS -->
    <td>Select from the listed building units to create various sections and build a landing page for your API Product.</td>
    <td><a href="/admin/guides/page-builder-elements/page-builder-elements#grid-elements" alt="Grid" target="_self"><em>Grid</em></a>,
    <a href="/admin/guides/page-builder-elements/page-builder-elements#about-cta" alt="CTA" target="_self"><em>CTA</em></a></td>
  </tr>
    <td><strong>Revision log message</strong></td> <!-- REVISION LOG MESSAGE -->
    <td>Create a new version of an existing content and add information about your changes for other admins.</td>
    <td>[x] <em>Create new revision</em></br></br>
    [<em>Description of the change.</em>] e.g., “Fixed formatting issues.”</td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>URL alias</strong></td> <!-- URL ALIAS -->
    <td>The URL of the page. </br>The path is automatically generated from the Title.</td>
    <td>E.g., <em>/products/product-name</em></td>
  </tr>
  <tr>
    <td><strong>Authoring information</strong></td> <!-- AUTHORING INFORMATION -->
    <td>Automatically generated values that are displayed on the admin UI. </br>Change the author and publishing date,
    if you are not creating your own page. </br>Leave it blank to set it as an anonymous user.</td>
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
    <td><em>API Product pages</em> are automatically published after they are saved. </br>To unpublish an API Product
    page, clear the <em>Published box</em>. </br>Unpublished pages are available for content managers and administrators
    only in the <em>Content</em> menu, but aren’t displayed for the end-users.</td>
    <td>[x] <em>Published</em></td>
  </tr>
</table>
</br>

Click _Save_ to create the content item.

</br>
## <a id="allianz-create-api-product"></a>Creating API Product pages
</br>

Next, you can learn how to create the complete layout of an API Product page. First you have to
**create the new content item**, then **add Page Builder elements (grid and CTA sections)** to fill it with content.
If you don’t add any Page Builder element to the page, only the page title is displayed.

To **create** a new API Product page, follow the steps below:

1. In the administrative menu, go to _Content_ > _Add content_ > _API Product_. Or go straight to
   `/node/add/api_product`.

2. (required) Type or paste the _Title_ of your page. This is displayed in the header region of the page and as the
   title of the API Product card. (e.g., _Product name_)

3. Add a _Version_ number to the API Product. This is displayed next to the Product title in the header region of the
   page. (e.g., _v1.1.0_ or _1.1.1_)

4. Add one or more _API Product category_ to group the Products. You can add existing categories by start typing
   their names then selecting them from the appearing menu. Or you an create a new one by typing the new category name.
   The categories appear in the _Products_ listing page as tabs. **Category names are case sensitive**.

5. Select an image from the _Icon_ list to display an icon on the API Product card. You can choose the _Icon color_ and
   the _Icon background color_ from the color palettes.

6. You have to set the _Opacity_ values for the selected colors. The value has to be less than equal to 1, where 0
   is not visible and 1 is 100% visible.

7. (Optional) Leave the icon fields empty in case you don’t need an icon, or click _Remove_
   and confirm the deletion.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Setting API Product card icon."
			src="@guide_path/assets/10281_icon_api_product.png" max-width="800" align="center">
        </tr>
	</tbody>
</table>
</br>

8. Give a _Description_ for the API Product. The description is visible for end-users and displayed on the API Product
   card only. You can format the copy with the
   [built-in text editor](/admin/guides/built-in-text-editor/built-in-text-editor).

9. Give a _Header_ text for the API Product. Header is visible for end-users and displayed in the header section of the
   API Product page under the Product title. You can format the copy with the
   [built-in text editor](/admin/guides/built-in-text-editor/built-in-text-editor).

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Format Description text."
			src="@guide_path/assets/10281_text_api_product.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Use the built-in text editor's toolbar to format the
            text of the Description and the Header field.</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

10. Click _Save_ to create the new content item.

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
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
</br>

<!--MILESTONE -->
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f1f9f1">
			<td bgcolor="#5cb85c" style="width: 1px"></td>
			<td width="100%"><p><font color="#5cb85c"><strong>Milestone</strong></font>
           	</br><font color="#5cb85c">You have created the basic layout of a new API Product page. Next,
            you can learn how to add different Page Builder elements to create an appealing and informative landing
			page. You can also <a href="/admin/guides/header-background-settings/header-background-settings">add Header
			background images</a> to individual pages or to a collection of pages (node groups).</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

<!-- IMAGE -->
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="You have created the basic layout of the new API Product
			page." src="@guide_path/assets/10281_basic_layout.png" max-width="800" align="center">
            <div align="center"><em><font color="black">The basic layout of a new API Product page with a
			Header background image. Click Edit to go back to the edit form to fill the page with content.</em></font>
			</div></td>
		</tr>
	</tbody>
</table>
</br>

Next, you can learn how to add grids with Page builder elements and a CTA section to the landing page.
The four major steps you have to take are:

1. [Create a Benefit section](#allianz-benefit-api-product) to show consumers why use the Product.
2. [Create a Text and Image section](#allianz-text-api-product) to show how to use it.
3. [Add a Featured APIs section](#allianz-featured-api-product) to showcase the related API documentation.
4. [Create a Call-to-action section](#cta-api-product) to navigate users to the registration form or to the Contact
   page.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Page Builder elements added to the API Product page."
			src="@guide_path/assets/10281_grid_elements.png" max-width="800" align="center">
            <div align="center"><em><font color="black">The result: Page Builder elements added to the
            API Product page.</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

### <a id="allianz-benefit-api-product"></a>The Why use it section

Click the _Edit_ action tab on the API Product page to get back to the edit form. The _Why use it_ section uses three
_Benefit_ grid elements in a 33%-33%-33% grid layout.

1. Click the _Add Grid_ button at the bottom of the page.

2. Add an _Administrative title_ in the appearing field. Administrative title is only visible on the edit form and it
   helps find the Page builder element. Use clear and short titles that describes the Grid element unambiguously.
   (e.g., _Why use it?_)

3. Add a _Grid title_. Grid title appears on the landing page as the section title and visible for end-users.
   (e.g., _Why use it?_)

4. Leave the _Grid button_ section untouched for now.

5. (required) Click the _Grid layout_ drop-down menu, and select _Three Columns - 33% 33% 33%_. The Grid layout
   determines the number and ratio of divisions of each section.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Grid layout settings."
			src="@guide_path/assets/10281_benefit_grid_layout.png" max-width="800" align="center">
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
           	</br><font color="#f0ad4e">To delete a grid section later, click <em>Remove</em>
            and confirm the deletion.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

The new grid section is ready to be completed with _Benefit_ elements.

6. Click the _Add Benefit_ button from the _Grid elements_.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Add Benefit."
			src="@guide_path/assets/10281_benefit_add_new.png" max-width="800" align="center">
        </tr>
	</tbody>
</table>
</br>

7. Give an _Administrative title_ for the Benefit item. (e.g., _Benefit 1_)

8. Type or paste the text that is displayed on the benefit card. You can format the text with the
   [built-in text editor](/admin/guides/built-in-text-editor/built-in-text-editor). In this example, we used Heading 4
   style for highlighting the title of the benefit and some plain text for the description. We also added a
   "Read more" _Card-link with arrow_ style button to navigate users to the documentation.

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
           	</br><font color="#f0ad4e">To <strong>create buttons in text fields</strong> select the piece of text you
			want to turn into a button and click the ‘link’ icon in the text editor’s toolbar. Add an URL path in the
			pop-up window and click Save. Select the button format you need from the <strong>Object Styles</strong>
            drop-down menu. Read the
			<a href="/admin/guides/built-in-text-editor/built-in-text-editor#buttons-in-text-field">Buttons in text
			field</a> section for more details.</font></p></td>
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
           	</br><font color="#f0ad4e">If Benefit cards contain a link they grow bigger when users hover over
            the card.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Format the text with the editor."
			src="@guide_path/assets/10281_benefit_full_text.png" max-width="800" align="center">
        </tr>
	</tbody>
</table>
</br>

9. Select an _Icon_ from the drop-down menu. (e.g., compass)

10. Leave the _Icon color_ and the _Opacity_ as it is. (default: white, 1)

11. Set _Icon background color_ and _Opacity_. (e.g., orange, 1)

12. Set the _Background color_ and the _Opacity_ of the Benefit cards. (e.g., light blue, 1)

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Set Benefit icon."
			src="@guide_path/assets/10281_benefit_icon_set.png" max-width="800" align="center">
        </tr>
	</tbody>
</table>
</br>

12. (optional) You can now click _Save_ to apply your changes and check your progress on the appearing page. To add more
    _Benefit_ elements, go back to the edit form by clicking the _Edit_ action tab. Click the [+] sign in the
	_Why use it?_ grid section to add a new Benefit card or to edit an existing one.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Add more Benefit."
			src="@guide_path/assets/10281_benefit_expand.png" max-width="800" align="center">
        </tr>
	</tbody>
</table>
</br>

13. Click _Add Benefit_ to add the next grid element and complete the necessary fields as described in steps 7-11.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Three Benefit elements added."
			src="@guide_path/assets/10281_benefit_all_three.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Three Benefit elements added to the Why use it?
            grid section.</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

14. Click _Save_ and check your progress on the appearing page.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Three Benefit elements added."
			src="@guide_path/assets/10281_benefit_final.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Benefit cards in the Why use it section: one interactive card
            with a link.</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

Go back to the edit form of the page to add more grid sections.

### <a id="allianz-text-api-product"></a>The How to use it section

The _How to use it_ section uses the _Text_ and the _Image_ grid elements in a 66%-33% grid layout.

1. Click _Add Grid_ to create the next section.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Add text grid element."
			src="@guide_path/assets/10281_add_new_grid.png" max-width="800" align="center">
        </tr>
	</tbody>
</table>
</br>

2. Add an _Administrative title_. Use clear and short titles that describes the Grid element unambiguously.
   (e.g., _Why use it?_)

3. Add a _Grid title_. This title appears on the landing page as the section title and visible for end-users.
   (e.g., _Why use it?_)

4. Leave the _Grid button_ section untouched for now.

5. (required) Click the _Grid layout_ drop-down menu, and select _Two Columns - 66% 33%_. The Grid layout determines
   the number and ratio of divisions of each section.

6. Select _Background_ and _Border color_ for the grid section to distinguish visually from the previous one
   (e.g., light blue). Set the _Opacity_ value to 1.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Set grid layout and background color."
			src="@guide_path/assets/10281_text_image_layout.png" max-width="800" align="center">
        </tr>
	</tbody>
</table>
</br>

The new grid section is ready to be completed with the _Text_ and _Image_ elements.

7. Select _Add Text_ from the _Grid elements_.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Add text grid element."
			src="@guide_path/assets/10281_text_grid_add.png" max-width="800" align="center">
        </tr>
	</tbody>
</table>
</br>

8. Add an _Administrative title_. The Administrative tile isn’t visible for end-users.

9. Type or paste the copy in the _Text_ field. You can format this text with the
   [built-in text editor](/admin/guides/built-in-text-editor/built-in-text-editor). In this example, we used bold and
   plain text for the description and a numbered list. We also added two buttons to navigate users to the
   documentation page and a registration form.

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
           	</br><font color="#f0ad4e">To <strong>create buttons in text fields</strong> select the piece of text you
			want to turn into a button and click the ‘link’ icon in the text editor’s toolbar. Add an URL path in the
			pop-up window and click Save. Select the button format you need from the <strong>Object Styles</strong>
            dropdown menu. Read the
			<a href="/admin/guides/built-in-text-editor/built-in-text-editor#buttons-in-text-field">Buttons in text
			field</a> section for more details.</font></p></td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Edit text grid element."
			src="@guide_path/assets/10281_text_grid_edit.png" max-width="800" align="center">
        </tr>
	</tbody>
</table>
</br>

10. Select _Add Image_ from the grid elements.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Add image grid element."
			src="@guide_path/assets/10281_image_add.png" max-width="800" align="center">
        </tr>
	</tbody>
</table>
</br>

11. Add an _Administrative title_. Administrative title isn’t visible for end-users.

13. Click _Choose file_ to browse and upload an image from your computer.
    You can upload only one file in _.PNG_, _.GIF_, _.JPG_, or _.JPEG_ format. Use a high-resolution image that is less
	than 2 MB.

14. (required) Add an _Alternative text_ to the image. This text is visible for screen readers, search engines,
    and displayed only when the image cannot be loaded.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Upload image."
			src="@guide_path/assets/10281_image_upload.png" max-width="800" align="center">
        </tr>
	</tbody>
</table>
</br>

15. Click _Save_ and check your progress on the appearing page.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Text and Image grid element section."
			src="@guide_path/assets/10281_text_image_final.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Text and Image grid elements with buttons.</em>
			</font></div></td>
		</tr>
	</tbody>
</table>
</br>

Go back to the edit form by clicking on the _Edit_ action tab and add the next grid section where you can list the
API documentation that belong to the API Product.

### <a id="allianz-featured-api-product"></a>The Used APIs section

The _Used APIs_ section uses _Featured API_ grid elements.

<!-- WARNING (RED) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fdf7f7">
			<td bgcolor="#d9534f" style="width: 1px"></td>
			<td width="100%"><p><font color="#d9534f"><strong>Attention</strong></font>
           	</br><font color="#d9534f">To list API references documentation cards on an API Product page, you have
            to upload API reference files to the developer portal. To do that, go to <em>Content</em> >
			<em>Add content</em> > <em>API Reference</em> in the administrative menu. You can find more details in
			the <a href="/admin/guides/api-documentation/api-reference">API Reference</a> chapter</font></p></td>
		</tr>
	</tbody>
</table>
</br>

Add a grid section with the following parameters:

1. Add an _Administrative title_. (e.g., _Used APIs_)

2. Add a _Grid title_. (e.g., _Used APIs_)

3. Fill the _Grid button_ section with these parameters:

   - Set the vale for the _URL_ as `/api-catalog`,
   - Set the _Link text_ as _Browse API catalog_,
   - Choose _Secondary button_ from the _Select a style_ drop-down menu.

4. Select the _Three columns 33% 33% 33%_ _Grid layout_ from the list.

5. Leave the _Background_ and the _Border color_ as default.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Set the grid layout for Featured APIs."
			src="@guide_path/assets/10281_featured_apis_layout.png" max-width="800" align="center">
        </tr>
	</tbody>
</table>
</br>

The new grid section is ready to be completed with _Featured API_ elements.

6. Click _Add Featured API_.

7. Start typing the name of the API reference that needs to be added to the API Product. Select the item you need from
   the appearing list.

8. Click _Add Featured API_ again to add more API documentation cards to the API Product page.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Add Featured API grid element."
			src="@guide_path/assets/10281_featured_apis_elements.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Select the API you need then click Add Featured API to add
            another API reference card to the API Product page.</font></div></td>
		</tr>
	</tbody>
</table>
</br>

9. Click _Save_ to apply your changes and check your progress on the appearing page.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Featured API grid element with 3 column layout."
			src="@guide_path/assets/10281_featured_apis_final.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Featured API grid with 33%-33%-33% grid layout and
            interactive API cards that lead to API reference documentation.</font></div></td>
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
           	</br><font color="#f0ad4e">You can add as many Featured API as you need. The grid layout settings
            define the appearance.</font></p></td>
		</tr>
	</tbody>
</table>
</br>

Go back to the edit form of the page by clicking on the _Edit_ action tab to add the CTA section to the landing page.


### <a id="allianz-cta-api-product"></a>The Are you interested in the offer section

1. Click the _Add CTA_ button at the bottom of the page.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Add CTA section."
			src="@guide_path/assets/10281_add_new_cta.png" max-width="800" align="center">
        </tr>
	</tbody>
</table>
</br>

2. Add an _Administrative title_ in the appearing field. (e.g., _Are you interested in the offer?_)

3. Type or paste the copy in the _Text_ field. You can format this text with the
   [built-in text editor](/admin/guides/built-in-text-editor/built-in-text-editor).
   In this example, we used a Heading 1 title and some plain text, and applied _Light text_ Inline style.

4. Fill the _Buttons_ section to add Call-to-actions to the page. Add a valid _URL_ and add
   a _Link text_ that is displayed on the button, then choose an item from the _Select a style_ drop-down menu.

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
           	</br><font color="#f0ad4e">You can create two Call-to-action buttons in one CTA section.</font></p></td>
		</tr>
	</tbody>
</table>
</br>

5. Select a _Background color_.

6. Click _Save_ to apply your changes and check your progress on the appearing page.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="The CTA section."
			src="@guide_path/assets/10281_cta_final.png" max-width="800" align="center">
            <div align="center"><em><font color="black">The CTA section of the landing page with two Call-to-action
            buttons.</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

<!--MILESTONE -->
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f1f9f1">
			<td bgcolor="#5cb85c" style="width: 1px"></td>
			<td width="100%"><p><font color="#5cb85c"><strong>Milestone</strong></font>
           	</br><font color="#5cb85c">You have created a visually appealing and informative landing
			page for an API Product. Create more to fill the <em>Products</em> listing page with interactive cards.
			</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

## <a id="allianz-api-product-sorting"></a>Sorting API Product pages

You can change the order of the API Product tabs.

1. Click the _API Product pages_ action tab on an API Product page. The API Product Sorting Tabs page opens.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Click API Product pages to open the sorting page"
			src="@guide_path/assets/10281_product_page_sort.png" max-width="800" align="center">
        </tr>
	</tbody>
</table>
</br>

2. Drag the items to change the order of the API Product tabs.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Click API Product pages to open the sorting page"
			src="@guide_path/assets/10281_product_order.png" max-width="800" align="center">
        </tr>
	</tbody>
</table>
</br>

3. Click _Save Order_ to apply your changes.

Go back to the page and see the new layout by clicking the _View_ action tab.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Click API Product pages to open the sorting page"
			src="@guide_path/assets/10281_product_order_success.png" max-width="800" align="center">
        </tr>
	</tbody>
</table>
</br>

## <a id="related-topics"></a>Related topics

- [API Product release notes content type](/admin/guides/allianz-content-types/api-product-release-notes)
- [API Product Description](/admin/guides/allianz-content-types/api-product-description)
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
<p align="center"><strong><a href="/admin/guides/faq/faq"
alt="FAQ" target="_self"><< FAQ</a> |
<a href="/admin/guides/allianz-content-types/api-product-description"
alt="API Product Description" target="_self">API Product Description >></a></strong></p>
