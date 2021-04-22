<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/api-documentation/api-tabs-sorting"
alt="API Tabs Sorting" target="_self"><< API Tabs Sorting</a> |
<a href="/admin/guides"
alt="Table of contents" target="_self">Table of contents >></a></strong></p>

---
# Frequently Asked Questions
</br>

### Table of Contents

- [Can I add new pages to the existing Documentation Overview Page?](#faq-page-to-doc-overview)
- [Can I modify the content of the API card?](#faq-modify-api-card)
- [Can I reorder the pages of the documentation overview page?](#faq-reorder-pages-doc-overview)
- [Can I add a header background image to a specific page in a node group?](#faq-add-header-group)
- [Deleting vs. unpublishing content?](#faq-delete-unpublish)
- [Focal point](#faq-focal-point)
- [Flushing all cache](#faq-cache)
- [How can I add APIs to the API Catalog?](#faq-add-api-to-catalog)
- [How can I group authenticated users?](#faq-group-users)
- [What if I made unwanted changes?](#faq-revision)
- [What is on the API cards?](#faq-api-card-what)
- [What is the right link format?](#faq-correct-link)
- [What is the difference between CTAs (Call-to-Action) and buttons?](#faq-diff-ctas-btns)
- [What is the difference between Documentation pages and API documentation?](#faq-diff-docu-apidoc)
- [What is the Error badge on the API Reference page?](#faq-apiref-error-badge)
- [What is the optimal image size?](#faq-image-size)
- [When should I use CTAs (Call-to-Action)?](#faq-call-to-action)
- [Where are the uploaded pictures stored on the developer portal?](#faq-where-to-find-images)
- [Why can’t I delete my API Catalog, FAQ, or Blog pages?](#faq-delete-catalog-faq-blog)
- [Why can’t I modify the URLs of my API Catalog, FAQ, or Blog pages?](#faq-urls-catalog-faq-blog)

</br></br>
## <a id="faq-page-to-doc-overview"></a>Can I add new pages to the existing Documentation Overview Page
</br>

First, you have to create the content of the new page. You have to use the Documentation page content type.

1. In the administrative menu, go to _Content_ > _Add content_ > _Documentation page_.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Add content faq"
            src="@guide_path/assets/6573_add_content.png" max-width="800" align="center">
            </td>
		</tr>
	</tbody>
</table>
</br>

2. <font color="red">(required)</font> Add a title that is visible on the top of the page.

3. Add your copy to the body field. You can use all the functions of the
[WYSIWYG editor](/admin/guides/built-in-text-editor/built-in-text-editor) to format your copy and add media (images,
videos).

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font></br><font color="#f0ad4e">
			If you use level 2
            headings in your text, they become clickable elements in the sidebar navigation after the content is
            published.
            </td></tr>
	</tbody>
</table>
</br>

<!-- IMAGE -->
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="add_copy_heading faq"
            src="@guide_path/assets/6573_add_copy_heading.png" max-width="800" align="center">
            </td>
		</tr>
	</tbody>
</table>
</br>

Now your content is ready (after saving), but the procedure does not end here. You have to **add the page to the**
**Documentation Overview Page**:

4. Check the _Provide a menu link_ box in Menu settings.

5. Provide a _Menu link title_ that is shown in the sidebar navigation menu. We recommend you to use the title of
the Documentation page (like we used in step 2), but this is not a requirement.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Menu link titles in the sidebar navigation menu."
            src="@guide_path/assets/6573_menu_link_title.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Menu link titles in the sidebar navigation menu.</em></font>
			</div>
            </td>
		</tr>
	</tbody>
</table>
</br>

6. Now you have to add it to the Documentation menu as a menu item. Select _< Documentation >_ from the _Parent item_
drop-down menu. You can also change the URL alias of the page, but it must start with
<font color="red">**/docs/**</font>.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="menu_settings"
            src="@guide_path/assets/6573_menu_settings.png" max-width="800" align="center">
            </td>
		</tr>
	</tbody>
</table>
</br>

7. Your Documentation page is almost ready. After you click _Save_, it becomes visible on the portal as part of the
documentation overview page.

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font></br><font color="#f0ad4e">
			If you don’t
            want to display your documentation page for end users yet, clear the <em>Published</em> check box.
            Unpublished pages are available for content managers and administrators only in the
            <a href="/admin/guides/administrative-menu/administrative-menu#content-menu">Content menu</a>.</td></tr>
	</tbody>
</table>
</br>

7. Click _Save_ to apply your changes.

---

</br>
## <a id="faq-modify-api-card"></a>Can I modify the content of the API card?
</br>

You can’t edit the content straight from the Catalog because it is only a **visual representation of the available**
**APIs** where end users can search for API documentation or filter APIs by categories.

---

</br>
## <a id="faq-reorder-pages-doc-overview"></a>Can I reorder the pages of the documentation overview page
</br>

Let’s suppose you created a new page called Getting started. By default the freshly created page is the last among the
menu items, but you want to move it to the first place, because this is the most important part of the
documentation:

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="6573_last_item"
            src="@guide_path/assets/6573_last_item.png" max-width="800" align="center">
            </td>
		</tr>
	</tbody>
</table>
</br>

1. Go to _Structure_ > _Menus_ > _Documentation_.

Here you can see the documentation pages in the documentation menu. To reorder the pages,
drag the menu items to their new places.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="6573_drag_and_drop"
            src="@guide_path/assets/6573_drag_and_drop.png" max-width="800" align="center">
            </td>
		</tr>
	</tbody>
</table>
</br>

2. Click _Save_ to apply your changes.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="6573_demo"
            src="@guide_path/assets/6573_demo.png" max-width="800" align="center">
            </td>
		</tr>
	</tbody>
</table>

---

</br>
## <a id="faq-add-header-group"></a>Can I add a header background image to a specific page in a node group?
</br>

You can, by increasing the weight of the item that contains the settings regarding to the specific node group, or by
decreasing the weight of the new item (Weight can be either a positive or a negative whole number).

Let’s make this more clear with an example. A general Header Background image has been set for all the API documentation
pages in the /api-catalog/* URL group. The weight of this item in the Header Background List is 0.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="6861_faq_1"
            src="@guide_path/assets/6861_faq_1.png" max-width="800" align="center">
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
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font></br><font color="#f0ad4e">
			If you don’t
            see the weight column, click the <em>Show row weights</em> link on the top-right side of the table.</td>
        </tr>
	</tbody>
</table>
</br>

<!-- IMAGE -->
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="6861_faq_1"
            src="@guide_path/assets/6861_faq_show_weight.png" max-width="800" align="center">
            </td>
		</tr>
	</tbody>
</table>
</br>

Now, let’s consider you have to change the Header background image for two specific APIs’ documentation, in this example
for the Serenity Weather Forecast and for the Serenity Video Library. The (relative) URL of these specific APIs
reference documentation are:

- /api-catalog/serenity-weather-forecast,
- /api-catalog/serenity-video-library.

1. First, you have to upload a new
   [Header background image](/admin/guides/header-background-settings/header-background-settings).

2. Click _Pages_ in the Visibility section and type the URLs of the pages into the text field.

3. Set the weight of this element to -1.

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font></br><font color="#f0ad4e">
			With this
            setting, the weight of this entity becomes smaller than the element that contains the settings for the whole
            URL group: the new Header image, like a new layer, is getting on the top of the previous Header picture.
            </td>
        </tr>
	</tbody>
</table>
</br>

4. Click _Save_ to apply your changes. You get a notification after a successful modification.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="6861_faq_1"
            src="@guide_path/assets/6861_faq_2_add_new.png" max-width="800" align="center">
            </td>
		</tr>
	</tbody>
</table>
</br>

Now, the new Header Background image appears in the specified pages.

---

</br>
## <a id="faq-delete-unpublish"></a>Deleting vs. Unpublishing content?
</br>

You can **hide contents from the end users in two different ways**.

To **keep the page** on the developer portal but **make it** (temporarily) **inaccessible**
(for example because maintenance reasons), we recommend **unpublishing** it. Unpublished pages are
**visible for content managers and administrators only** in the Content menu, they aren’t displayed for the end users.

If you **are sure you never want to use a content again** (for example it's out-dated), you can **delete** it from the
site. Deleted pages are **erased from the portal permanently** and **cannot be restored** again. Always consider
unpublishing before deleting.

### Unpublishing

To unpublish content, follow these steps:

1. Go to the _Edit_ page of the content item.

2. Scroll down to find the _Published_ check box.

3. Clear the _Published_ checkbox.

4. Click the _Save_ button to apply your changes.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="6861_faq_1"
            src="@guide_path/assets/6572_faq_unpublish.png" max-width="800" align="center">
            </td>
		</tr>
	</tbody>
</table>
</br>

### Deleting

To delete a content, follow these steps, or read the
[detailed guide](/admin/guides/content-management/content-management#delete-ct) if you need more help:

1. Select _Content_ from the administration menu.

2. Scroll down to find the title of the erasable content item.

3. Select _Delete_ from the drop-down menu under _Operations_.

4. Click the _Delete_ button again on the appearing page.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="6861_faq_1"
            src="@guide_path/assets/6572_faq_delete.png" max-width="800" align="center">
            </td>
		</tr>
	</tbody>
</table>
</br>

---

</br>
## <a id="faq-focal-point"></a>Focal point
</br>

If you are uploading a Teaser picture or a Header background image, a small white cross in the middle of the thumbnail
picture indicates the focal point. Its purpose is to let the content creator set the most valuable part of the image,
which always becomes visible even on large or mobile screen resolutions: enhances the responsive design.

You can set the focal point by moving the cross (clicking the picture).

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="blog_focal_point"
            src="@guide_path/assets/6575_blog_focal_point.png" max-width="800" align="center">
            </td>
		</tr>
	</tbody>
</table>
</br>

---

</br>
## <a id="faq-cache"></a>Flushing all cache
</br>

Flushing all caches is necessary after every change you made on the portal in case your modifications are not
visible after you saved your work.

Hover over the _Drupal icon_ on the administrative menu and click _Flush all caches_ on the
appearing fly-out menu.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="drupal_flush"
            src="@guide_path/assets/6665_drupal_flush.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Flush all caches after every change you made on the portal.</em>
            </font></div>
            </td>
		</tr>
	</tbody>
</table>
</br>

---

</br>
## <a id="faq-add-api-to-catalog"></a>How can I add APIs to the API Catalog?
</br>

You can’t do it directly from the Catalog. After you **uploaded and published an API reference**
source file (_.yaml_, _.yml_, or _.json_), it becomes automatically available in the Catalog as an API card. It means,
first you have to create and publish an
[API Reference](/admin/guides/what-content-type-should-i-use/what-content-type-should-i-use#api-reference) content item.

---

</br>
## <a id="faq-group-users"></a>How can I group authenticated users?
</br>

End users of the developer portal are grouped into different roles. Unregistered visitors are _Anonymous users_, while
those who walked through the registration process are called _Authenticated users_. Users within specific roles can have
different permissions, restricted or full access to viewing, creating, editing, deleting contents, and so on.

If you are an administrator, you can access the _Roles_ and _Permissions_ pages from the administrative menu and
<a href="/admin/guides/roles-permissions#change-roles">assign users to different groups</a>.

---

</br>
## <a id="faq-revision"></a>What if I made unwanted changes?
</br>

Every saved change made on a content by any user is collected on the **Revisions page** if the _Create new version_
check box is marked on the _Edit_ screen of the content.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="The Revision information panel"
            src="@guide_path/assets/6575_blog_revision_edit.png" max-width="800" align="center">
            <div align="center"><em><font color="black">The Revision information panel of an unpublished content.</em>
            </font></div></td>
		</tr>
	</tbody>
</table>
</br>

Revisions are only accessible with the right permissions and never displayed to end users. If you made unwanted changes,
you can restore an earlier state of the content by clicking the _Revert_ button in the row of the selected
version.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="The Revision information panel of an unpublished content"
            src="@guide_path/assets/6575_blog_revision_rev_2.png" max-width="800" align="center">
            <div align="center"><em><font color="black">The Revision information panel of an unpublished content.</em>
            </font></div></td>
		</tr>
	</tbody>
</table>
</br>

You can find a detailed explanation of this feature in the
[Reviewing past revisions](/admin/guides/reviewing-past-revisions/reviewing-past-revisions) chapter.

---

</br>
## <a id="faq-api-card-what"></a>What’s on the API cards?
</br>

An API card consists of the _title of the API_, the _categories_ the API is assigned to, a _description_ of the API, and
an _API documentation_ link that leads to the selected API's reference documentation.

For more information, read the [API Catalog](/admin/guides/api-documentation/api-catalog) chapter.

---

</br>
## <a id="faq-correct-link"></a>What is the right link format?
</br>

To answer this question, it's important to draw a distinction between internal and external links.

**External links:** To direct the user outside the developer portal, use absolute paths
starting with `https://`. We recommend **opening the external page on another browser tab**, then copy the address from
the browser and insert it. A correct link address looks like `https://www.example.com/`.

<!-- WARNING (RED) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fdf7f7">
			<td bgcolor="#d9534f" style="width: 1px"></td>
			<td width="100%"><p><font color="#d9534f"><strong>Caution</strong></font>
            </br><font color="#d9534f">Other forms like "www.example.com" won’t open, but give a <strong><em>
			The requested page could not be found</em></strong> warning message.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

**Internal links:** To direct the user to a different page on the developer portal, always use
relative paths. In this case, a correct link address looks like /name-of-the-node, for example: `/about` or
`/api-catalog/petstore`.

---

</br>
## <a id="faq-diff-ctas-btns"></a>What is the difference between CTAs (Call-to-Action) and buttons?
</br>

The CTA (Call-to-Action) on the developer portal is a
[Page Builder element](/admin/guides/non-api-related-content-management/page-builder-elements/page-builder-elements#about-cta)
and is **only** available for the for the
[Page Builder](/admin/guides/what-content-type-should-i-use/what-content-type-should-i-use#page-builder), the
[API Description Page](/admin/guides/what-content-type-should-i-use/what-content-type-should-i-use#api-description),
and the
[API Page Builder](/admin/guides/what-content-type-should-i-use/what-content-type-should-i-use#api-page-builder)
content types.

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font></br><font color="#f0ad4e">
			<strong>CTA is a
            section with buttons</strong> that encourages users to interact more with your website. These building units
			are
            separate, visually different sections on a page and you can use them to lead users toward a particular
            action (e.g., Read documentation, Get your API key, and so on).</br></br><strong>Buttons are tools to
            navigate users and don’t work as separate sections</strong>. They are features of every content type that
			has a
            <a href="/admin/guides/built-in-text-editor/built-in-text-editor">WYSIWYG editor</a>, but you can add
			buttons to Grid sections (the other Page Builder element), or to some of the Grid elements, too.</td>
        </tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="cta_vs_button"
            src="@guide_path/assets/cta_vs_button.png" max-width="800" align="center">
            </td>
		</tr>
	</tbody>
</table>
</br>

---

</br>
## <a id="faq-diff-docu-apidoc"></a>What’s the difference between Documentation pages and API documentation?
</br>

**The Documentation page** on the developer portal is the right place to collect your documentation that is not API
specific, rather universal and related to the usage of the developer portal (Authorization, Authentication, Getting
started, How to get API keys). It also can be enhanced with a sidebar navigation menu.

To learn more about the Documentation page, read the
[Creating Documentation pages from scratch](/admin/guides/non-api-related-content-management/documentation-page#create-documentation-page)
chapter.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Documentation page with a sidebar navigation menu."
            src="@guide_path/assets/6576_documentation_page.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Documentation page with a sidebar navigation menu.</em></font>
            </div>
            </td>
		</tr>
	</tbody>
</table>
</br>

[**API pages**](/admin/guides/api-documentation/api-pages) (built with the _API reference_, _API description_,
_API basic page_, _API page builder_ content types) are contain API specific content. The procedure always starts with
the [API reference](/admin/guides/what-content-type-should-i-use/what-content-type-should-i-use#api-reference): you have
to upload a valid YAML/JSON source file. Then you can provide additional conceptual documentation with the above
mentioned content types.

For example, you upload _petstore.json_ file to create an API reference. Then you create an API description and an API
Basic page (Release notes) to provide more details and connect them with the API reference.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="A snippet from an API Reference page"
            src="@guide_path/assets/6576_api_pages.png" max-width="800" align="center">
            <div align="center"><em><font color="black">A snippet from an API Reference page. You can the related (API
            Description and a Release notes) pages as tabs. </em></font></div>
            </td>
		</tr>
	</tbody>
</table>
</br>

---

</br>
## <a id="faq-apiref-error-badge"></a>What is the Error badge on the API Reference page?
</br>

Every API reference (swagger) file (e.g., YAML or JSON) is passing through an automated test as part of the uploading
process. Both Swagger 2.0 and OpenAPI 3.0 are supported and the version is automatically detected by the parser.
If the validator can access the uploaded file and the file is written in a well-formatted syntax, a green
validation badge appears on the bottom right side of the corresponding API Reference page.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Valid badge"
            src="@guide_path/assets/6585_validation_valid_badge.png" max-width="800" align="center">
            </td>
		</tr>
	</tbody>
</table>
</br>

You can encounter a red validation error badge in two cases:

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Error badge"
            src="@guide_path/assets/6585_validation_error_badge.png" max-width="800" align="center">
            </td>
		</tr>
	</tbody>
</table>
</br>

- When the API reference **file** has syntax **errors**.

- When the **online validator can't access the swagger file** (e.g., the site has HTTP authentication).

---

</br>
## <a id="faq-image-size"></a>What is the optimal image size?
</br>

We recommend using pictures in high-resolution **but under 2 MB**. Pictures larger than 2 MB can be slow to load,
when using it on a mobile device. This recommendation can vary depending on the content. All size and
format-related restrictions are visible on the UI where image uploading is possible, also, you can find this information
in the corresponding parts of this user guide.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Image uploading field of the Image grid element."
            src="@guide_path/assets/6863_image_ui.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Image uploading field of the Image grid element.</em>
            </font></div></td>
		</tr>
	</tbody>
</table>
</br>

<!-- IMAGE -->
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="A snippet from the user guide. Recommendations are
            highlighted with red."
            src="@guide_path/assets/6863_image_guide.png" max-width="800" align="center">
            <div align="center"><em><font color="black">A snippet from the user guide. Recommendations are highlighted
            with red.</em>
            </font></div></td>
		</tr>
	</tbody>
</table>
</br>

---

</br>
## <a id="faq-call-to-action"></a>When should I use CTAs (Call-to-Action)?
</br>

Usually, CTAs (Call-to-Actions) are buttons or hyperlink texts that leads users toward a particular action. The text on
them formulates a clear message of what users can do as the next step after clicking on them (e.g., Read documentation,
Get your API key, and so on.) A CTA can also encourage users to interact more with your website.

The CTA on the developer portal is a
[Page Builder element](/admin/guides/non-api-related-content-management/page-builder-elements/page-builder-elements#about-cta)
and is
available for the [Page Builder](/admin/guides/what-content-type-should-i-use/what-content-type-should-i-use#page-builder),
the
[API Description Page](/admin/guides/what-content-type-should-i-use/what-content-type-should-i-use#api-description),
and the
[API Page Builder](/admin/guides/what-content-type-should-i-use/what-content-type-should-i-use#api-page-builder)
content types only.

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font></br><font color="#f0ad4e">
			Use CTA to create a separate, visually different section on a page that asks users to do an
            action (e.g., Read documentation, Get your API key, and so on).</td>
        </tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="cta need help"
            src="@guide_path/assets/cta_need_help.png" max-width="800" align="center">
            </td>
		</tr>
	</tbody>
</table>
</br>

---

</br>
## <a id="faq-where-to-find-images"></a>Where are the uploaded pictures stored on the developer portal?
</br>

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font></br><font color="#f0ad4e">
			You can’t
            find a specific admin folder on the developer portal for the images. They are stored locally in the node
            where they are uploaded. What does this mean in practice? For example, to delete a picture
            from your home page, you have to go to the
			<a href="/admin/guides/content-management/content-management#edit-ct"> edit form of the page</a> and make
			the changes there.</p></td></tr>
	</tbody>
</table>
</br>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="A snippet from an exemplary landing page"
            src="@guide_path/assets/6864_img_page.png" max-width="800" align="center">
            <div align="center"><em><font color="black">A snippet from an exemplary landing page. The highlighted image
            is stored locally and can be reached through the page’s edit form.</em>
            </font></div></td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="The thumbnail of an image in the edit form"
            src="@guide_path/assets/6864_img_edit.png" max-width="800" align="center">
            <div align="center"><em><font color="black">The thumbnail of an image in the edit form. You can open
            the image by clicking its name (highlighted) to check it for some reason, and you can remove
            it from here.</em>
            </font></div></td>
		</tr>
	</tbody>
</table>
</br>

---

</br>
## <a id="faq-delete-catalog-faq-blog"></a>Why can’t I delete my API Catalog, FAQ, or Blog pages?
</br>

The content and the layout of the API Catalog, the FAQ and the Blog page are automatically populated from the pages of
their related content type: [API Reference](/admin/guides/api-documentation/api-reference),
[FAQ item](/admin/guides/non-api-related-content-management/faq-item), and
[Blog post](/admin/guides/non-api-related-content-management/blog-post).
That means, these pages don’t have original content on their own, and there are no other pages where you can display
those content items

To prevent any function-related issue on the developer portal, the URLs of these pages are hard coded and you can’t
delete or modify them. If you don’t want to display any of them on your site, you can
[hide them from the end users](#faq-delete-unpublish).

---

</br>
## <a id="faq-urls-catalog-faq-blog"></a>Why can’t I modify the URLs of my API Catalog, FAQ, or Blog pages?
</br>

The content and the layout of the API Catalog, the FAQ and the Blog page are automatically populated from the pages of
their related content type: [API Reference](/admin/guides/api-documentation/api-reference),
[FAQ item](/admin/guides/non-api-related-content-management/faq-item), and
[Blog post](/admin/guides/non-api-related-content-management/blog-post). That means, these pages don’t have original
content on their own, and you can't display those content items on other pages.

To prevent any function-related issue on the developer portal, the URLs of these pages are **hard coded** (/api-catalog,
/faq, /blog) and you can’t [delete](#faq-delete-catalog-faq-blog) or modify them.

</br>

---
<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/api-documentation/api-tabs-sorting"
alt="API Tabs Sorting" target="_self"><< API Tabs Sorting</a> |
<a href="/admin/guides"
alt="Table of contents" target="_self">Table of contents >></a></strong></p>