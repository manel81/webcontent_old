<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/categories-and-tags/categories-and-tags"
alt="Categories and tags" target="_self"><< Categories and tags</a> |
<a href="/admin/guides/non-api-related-content-management/basic-page"
alt="Basic page" target="_self">Basic page >></a></strong></p>

---

# Page Builder Elements

</br>

### Prerequisite knowledge

- [Page Builder](/admin/guides/non-api-related-content-management/page-builder)
- [API Page Builder](/admin/guides/api-documentation/api-page-builder)
- [API Description page](/admin/guides/api-documentation/api-description)

</br>

### Table of Contents

- [About Grid](#about-grid)
- [Grid elements](#grid-elements)
    - [Grid](#grid)
    - [Block](#block)
    - [Card](#card)
    - [Text](#text)
    - [Image](#image)
    - [Benefit](#benefit)
    - [Promo Image](#promo-image)
    - [Featured API](#featured-api)
    - [Message](#message)
- [About CTA (Call-to-action)](#about-cta)
- [Related Topics](#related-topics)

<!-- IN THIS CHAPTER (BLUE) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f4f8fa">
			<tr bgcolor="#f4f8fa">
			<td bgcolor="#5bc1de" style="width: 1px"></td>
			<td width="100%"><p><font color="#5bc1de"><strong>In this chapter</strong></font>
            </br><font color="#5bc1de">Informative and eloquent written content is fundamental to keep the visitors of
            your portal engaged, but the way you present this information also can’t be secondary. Create custom page
            layouts with Page Builder elements.</font></p>
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
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font></br><font color="#f0ad4e">Show the
            benefits of your API, present featured APIs or recent blog posts as interactive cards and add images to help
            users harness the key information, then lead them one step closer to their goal with a
            call-to-action. <strong>Page Builder elements are available for Page Builder content types: Page Builder,
            API Description page, and API Page Builder.<strong> You can use two types of Page Builder elements:
            <a href="#grid-elements">Grid</a> and <a href="#about-cta">CTA</a>.</font></p></td></tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="A landing page with Page Builder elements."
            src="@guide_path/assets/6598_page_builder_elements.png" max-width="800" align="center">
            <div align="center"><em><font color="black">A landing page with Page Builder elements.</em></font></div>
            </td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="A new Page Builder page is about to be created with Page
            Builder Elements (highlighted)." src="@guide_path/assets/6598_page_builder_elements_edit.png"
            max-width="800" align="center">
            <div align="center"><em><font color="black">A landing page with Page Builder elements.</em></font></div>
            </td>
		</tr>
	</tbody>
</table>

</br>
## <a id="about-grid"></a>About Grid
</br>

<strong>Grids</strong> are one of the two building units of Page Builder pages. Use them to organize the content on your
page in a creative and user-friendly way. <strong>Divide each</strong> Grid to smaller sections or <strong>embed them
</strong> with each other to <strong> create more complex layouts</strong>: define the <strong>background and border
color</strong> of your content, <strong>add different kinds of buttons</strong> to it. Select from the available
specific <strong>Grid elements</strong> and fill in the necessary sections with <strong>customized content</strong>.

<!-- REFERENCE TABLE -->
</br>
<table border="0" cellpadding="5" cellspacing="5" style="width: 100%">
  <tr> <!-- HEADER -->
    <th><center><strong>Field name</font></strong><center></th>
    <th><center><strong>Description</font></strong><center></th>
    <th><center><strong>Example/default value(s)</font></strong><center></th>
  </tr>
  <tr>
    <td><strong>Administrative title</strong></td> <!-- ADMIN TITLE -->
    <td>This title is only visible on the edit form and it helps to identify the page builder element. Use clear and
    short titles that refer to the Grid element unambiguously.</td>
    <td>E.g. <em>Four benefits</em>,</br><em>Commercial text + Promo Image</em>,</br><em>Featured APIs</em></td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>Grid title</strong></td> <!-- GRID TITLE -->
    <td>A title displayed above the corresponding Grid section on your page. If you don’t need a title, leave it blank.
    </td>
    <td>E.g. <em>Recent Blog post</em>,</br><em>About this portal</em></td>
  </tr>
  <tr>
    <td><strong>Grid Button</strong></td> <!-- GRID BUTTON -->
    <td>You can use the buttons to navigate the user to other pages. This button is displayed on the upper-right side of
    the Grid. If you don’t need a button, leave it blank.</td>
    <td>E.g. <em>Our APIs</em>, <em>More Posts</em></td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>Select a style</strong> (for Grid Button)</td> <!-- SELECT A STYLE -->
    <td>Choose from different button styles from the drop-down menu to customize the appearance of the Grid Button.
    <a href="/admin/guides/built-in-text-editor/built-in-text-editor#button">Read more about the different button
    styles.</a></td>
    <td>Primary Button, Primary Inverted Button, Secondary Button, Secondary Inverted Button, Link button.</td>
  </tr>
  <tr>
    <td><strong>Grid Layout</strong> <font color="red">(required)</font></td> <!-- GRID LAYOUT -->
    <td>This value determines the subdivision of the Grid. You can split your Grid into one to four pieces, and you can
    use different Grid elements in each.</td>
    <td>On Column - 100%,</br>Two Columns - 50% 50%,</br>Two Columns - 33% 66%,</br>Two Columns - 66% 33%,</br>Three
    Columns - 33% 33% 33%,</br>Four Columns - 25% 25% 25% 25%,</br>Default: None
</td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>Background Color</strong></td> <!-- BACKGROUND COLOR -->
    <td>Choose a background color and set its opacity. Opacity is a real number between 0 (transparent) and 1 (opaque).
    </td>
    <td>Default color: #ffffff (white)</br>Default opacity: 1 (full visible)</br>E.g. Opacity: 0,25 (25% visible)
</td>
  </tr>
  <tr>
    <td><strong>Border Color</strong></td> <!-- BORDER COLOR -->
    <td>Choose a border color and set its opacity. Opacity is a real number between 0 (transparent) and 1 (opaque).</td>
    <td>Default color: #ffffff (white)</br>Default opacity: 1 (full visible)</br>E.g. Opacity: 0,25 (25% visible)</td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>Grid elements</strong></td> <!-- GRID ELEMENTS -->
    <td>Select from various Grid elements.</td>
    <td>Grid, Block, Card, Text, Image, Benefit, Promo Image, Featured API, Message</td>
  </tr>
</table>
</br>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Divide each Grid to smaller sections"
            src="@guide_path/assets/6598_grid_units.png" max-width="800" align="center">
            <div align="center"><em><font color="black">"Divide each Grid to smaller sections" by selecting a value from
            the (dark gray) Grid layout drop-down menu. You can see the available Grid elements in the highlighted area.
            </em></font></div></td>
		</tr>
	</tbody>
</table>

</br>
## <a id="grid-elements"></a>Grid elements
</br>

### <a id="grid"></a>Grid

You can use Grids as Grid elements: You can embed more Grid elements to create complex layouts.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Grid elements embedded to each other"
            src="@guide_path/assets/6598_grid_levels.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Grid elements embedded to each other.</em></font></div></td>
		</tr>
	</tbody>
</table>

</br>
### <a id="block"></a>Block

The block element allocates a section on your page where you can insert different kinds of content from the provided
drop-down menu. (e.g., _Blog posts_).

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="The edit form of a Block element"
            src="@guide_path/assets/6598_empty_block_grid.png" max-width="800" align="center">
            <div align="center"><em><font color="black">The edit form of a Block element with the (dark grey) drop-down
            list of available options. See the default result of picking the Blog posts item on the picture below.</em>
            </font></div></td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Recent blog posts in a One Column"
            src="@guide_path/assets/6598_block_recent_blog_posts.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Recent blog posts in a One Column - 100% Grid Layout with a Grid
            Button called “More posts”.</em></font></div></td>
		</tr>
	</tbody>
</table>

</br>
### <a id="card"></a>Card

Upload an image and write a description with the
[WYSIWYG Editor](/admin/guides/built-in-text-editor/built-in-text-editor). Create informative and visually appealing
cards on your page, link them to URLs to make them interactive.

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font></br><font color="#f0ad4e">You can
            upload one image file to a card in the maximum size of 10MB, in the following formats: PNG, GIF, JPG,
            JPEG, SVG. If you add buttons to the text of the cards using the
            <a href="/admin/guides/built-in-text-editor/built-in-text-editor">WYSIWYG Editor</a>, it won’t be functional
            on the page. Set a Grid Button instead.</font></p></td></tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="The edit form of a Card Grid element."
            src="@guide_path/assets/6598_card_grid_unit_marked.png" max-width="800" align="center">
            <div align="center"><em><font color="black">The edit form of a Card Grid element.</em></font></div></td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Differently formatted Cards in a Four Columns Grid Layout."
            src="@guide_path/assets/6598_card_grid_element.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Differently formatted Cards in a Four Columns - 25% 25% 25% 25%
            Grid Layout.</em></font></div></td>
		</tr>
	</tbody>
</table>

</br>
### <a id="text"></a>Text

Use the [WYSIWYG Editor](/admin/guides/built-in-text-editor/built-in-text-editor) and combine it with other Grid
elements to enhance your written content.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="The edit form of a Text Grid element."
            src="@guide_path/assets/6598_text_grid_edit_marked.png" max-width="800" align="center">
            <div align="center"><em><font color="black">The edit form of a Text Grid element.</em></font></div></td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Text Grid element in a One Column"
            src="@guide_path/assets/6598_grid_text_unit.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Text Grid element in a One Column - 100% Grid Layout, with
            greenish background color. The title is Heading 1 and the main text is in white inline format with an
            additional Secondary Button.</em></font></div></td>
		</tr>
	</tbody>
</table>

</br>
### <a id="image"></a>Image

Insert an image to your Grid in the maximum size of 10MB, in the following formats: PNG, GIF, JPG, JPEG, or SVG. You can
add a maximum of 4 pictures to the same Grid if you choose the corresponding Grid Layout. All the images are cropped
and displayed with identical height and width dimensions on your page to achieve a visually appealing layout if the
images are combined with other Grid elements (e.g., _Text_).

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="The edit form of an Image Grid element."
            src="@guide_path/assets/6598_grid_picture_edit_marked.png" max-width="800" align="center">
            <div align="center"><em><font color="black">The edit form of an Image Grid element.</em></font></div></td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="A single image displayed on a Page Builder Page"
            src="@guide_path/assets/6598_picture_grid_layout.png" max-width="800" align="center">
            <div align="center"><em><font color="black">A single image displayed on a Page Builder Page with (default)
            One Column - 100% Grid Layout. Tip: Add a Text Grid element to the same section and use the image as
            illustration to your content.</em></font></div></td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Four pictures are uploaded in the same Grid"
            src="@guide_path/assets/6598_picture_grid_fourcolumns.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Four pictures are uploaded in the same Grid in a Four columns -
            25% 25% 25% 25% Grid Layout. You can find other examples on the first screenshot above and in the related
            chapters.</em></font></div></td>
		</tr>
	</tbody>
</table>

</br>
### <a id="benefit"></a>Benefit

Add easy to comprehend and engaging benefit cards to your API documentation, or other pages. Write a summary,
add a link, select an icon from the list and define its color. We recommend using three Benefit elements in the
same Grid with Three Columns - 33% 33% 33% Grid Layout.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="The edit form of a Benefit Grid element"
            src="@guide_path/assets/6598_benefit_grid_unit_edit_marked.png" max-width="800" align="center">
            <div align="center"><em><font color="black">The edit form of a Benefit Grid element.</em></font></div></td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Benefit section"
            src="@guide_path/assets/6598_benefit_grid_layout.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Benefit section in a Three columns - 33% 33% 33% Grid Layout and
            with different icon colors.</em></font></div></td>
		</tr>
	</tbody>
</table>

</br>
### <a id="promo-image"></a>Promo image

Promo images are visual elements without height restriction. Not like Images, they can expand beyond their Grids’ upper
borders.

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font></br><font color="#f0ad4e">You can
            upload only one file at once in the maximum size of 10MB, in the following format: PNG, GIF, JPG, JPEG, SVG.
            We recommend using it combined with other Grid elements (e.g., <em>Text</em>).</font></p></td></tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="The edit form of a Promo Image Grid element"
            src="@guide_path/assets/6598_promo_image_grid_edit_marked.png" max-width="800" align="center">
            <div align="center"><em><font color="black">The edit form of a Promo Image Grid element.</em></font></div>
            </td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="A Promo image and a Text Grid element"
            src="@guide_path/assets/6598_promo_image_grid_layout.png" max-width="800" align="center">
            <div align="center"><em><font color="black">A Promo image and a Text Grid element in a Two Columns - 33% 66%
            Grid Layout with blue background color. See other examples on the first screenshot above and in the related
            chapter.</em></font></div>
            </td>
		</tr>
	</tbody>
</table>

</br>
### <a id="featured-api"></a>Featured API

To help users find their interests, display your newest or your most important APIs as cards in one page by selecting
the corresponding reference (OAS) files from a list.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Featured API Edit"
      src="@guide_path/assets/6598_featured_api_edit.png"
      max-width="800" align="center">
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
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font></br><font color="#f0ad4e">Use separate
            Grid elements for every single reference (OAS) file.</font></p></td></tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Every reference (OAS) file is selected"
            src="@guide_path/assets/6598_featured_api_multiple_slot.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Every reference (OAS) file is selected in a different
            Featured API Grid element in a Four Column - 25% 25% 25% 25% Grid Layout.</em></font></div>
            </td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Featured API Cards"
            src="@guide_path/assets/6598_featured_api_2_layout.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Featured API Cards in a Four Column - 25% 25% 25% 25% Grid
            Layout.</em></font></div>
            </td>
		</tr>
	</tbody>
</table>

</br>
### <a id="message"></a>Message

With this unique text format you can highlight your notifications written with the
[WYSIWYG Editor](/admin/guides/built-in-text-editor/built-in-text-editor) in the form of the predefined system messages:
info, success, warning, error. Use it when you want to highlight information for the users (e.g.,
_Under maintenance_, _A new feature is available_).

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="The edit form of a Message Grid element"
            src="@guide_path/assets/6598_message_grid_edit.png" max-width="800" align="center">
            <div align="center"><em><font color="black">The edit form of a Message Grid element. You have to
            select one item from the highlighted Message type menu.</em></font></div>
            </td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="The four types of messages"
            src="@guide_path/assets/6598_message_layout.png" max-width="800" align="center">
            <div align="center"><em><font color="black">The four types of messages in a One Column - 100% Grid Layout.
            </em></font></div>
            </td>
		</tr>
	</tbody>
</table>

</br>
## <a id="about-cta"></a>About CTA
</br>

CTA or call-to-action is the other building block you can use on a Page Builder page. Its function is simple yet
crucial: to provide a section that triggers the user to take action. Select a background color for your text written
with the [WYSIWYG Editor](/admin/guides/built-in-text-editor/built-in-text-editor) then add buttons that lead users
towards their goal (e.g.: to register, to send a message, to get support, or to access the sandbox page).

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="The edit form of a CTA section"
            src="@guide_path/assets/6598_cta_edit_marked.png" max-width="800" align="center">
            <div align="center"><em><font color="black">The edit form of a CTA section.</em></font></div>
            </td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="The edit form of a CTA section"
            src="@guide_path/assets/6598_cta_layout.png" max-width="800" align="center">
            <div align="center"><em><font color="black">A CTA section displayed on a Page Builder page with a text and a
            Primary and a Secondary button. A CTA section is full page width long and has no border.
            </em></font></div>
            </td>
		</tr>
	</tbody>
</table>

</br>
## <a id="related-topics"></a>Related Topics

- [Page Builder page content type](/admin/guides/non-api-related-content-management/page-builder)
- [API Description page content type](/admin/guides/api-documentation/api-description)
- [API Page Builder page content type](/admin/guides/api-documentation/api-page-builder)
- [How to create landing pages with Page Builder](/admin/guides/non-api-related-content-management/page-builder)
- [How to create landing pages with API Page Builder](/admin/guides/create-landing-page)
- [Recent blog posts](/admin/guides/non-api-related-content-management/blog-post#recent-blog-posts)
- [Image management](/admin/guides/image-management/image-management)
- [Built-in text editor](/admin/guides/built-in-text-editor/built-in-text-editor)

</br>

---
<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/categories-and-tags/categories-and-tags"
alt="Categories and tags" target="_self"><< Categories and tags</a> |
<a href="/admin/guides/non-api-related-content-management/basic-page"
alt="Basic page" target="_self">Basic page >></a></strong></p>
