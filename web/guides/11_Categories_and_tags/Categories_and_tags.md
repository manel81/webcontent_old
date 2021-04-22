<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/header-background-settings/header-background-settings"
alt="Header background settings" target="_self"><< Header background settings</a> |
<a href="/admin/guides/page-builder-elements/page-builder-elements"
alt="Page Builder Elements" target="_self">Page Builder Elements >></a></strong></p>

---

# Categories and tags

</br>

### Prerequisite knowledge

- [API Reference content type](/admin/guides/api-documentation/api-reference)
- [Blog post content type](/admin/guides/non-api-related-content-management/blog-post)
- [FAQ item content type](/admin/guides/non-api-related-content-management/faq-item)

</br>

### Table of contents

- [Assigning content](#assign-category)
- [Editing attributes](#edit-category)
- [Reordering](#reorder-category)
- [Removing from content](#remove-category)
- [Deleting from the portal](#delete-category)
- [Related topics](#related-topics)

<!-- IN THIS CHAPTER (BLUE) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f4f8fa">
			<tr bgcolor="#f4f8fa">
			<td bgcolor="#5bc1de" style="width: 1px"></td>
			<td width="100%"><p><font color="#5bc1de"><b>In this chapter</b></font>
            </br><font color="#5bc1de">Grouping your content into categories or providing them tags can help users find
			the information they need to solve their tasks. <strong>You can create new categories or tags, use or adjust
			the existing ones, or delete the ones that are not needed anymore</strong> in a few steps. You can maintain
			the API categories, the Blog post categories, and the FAQ tags in the same way.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

You can add categories or tags when creating or editing items of the listed **content types**:

- **API Reference:** API categories give important information to users about the field of usage or the status
   of your APIs. API categories are displayed in the API Catalog, on the API cards, and on the API header section.
- **Blog post:** Blog post categories make it easier for users to browse an extensive Blog page and find the relevant
   content without friction. Blog post categories are displayed on the Blog page.
- **FAQ item:** FAQ tags can shorten users’ time to find the answer they are looking for and getting back on track
   with development. FAQ tags are displayed on the FAQ page.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="API categories displayed in the API Catalog
            and on the API cards as tags." src="@guide_path/assets/categories_api.png" max-width="800">
            <div align="center"><em><font color="black">API categories displayed in the API Catalog and on the API cards
            as tags.</em></font></div></td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="API categories displayed as tags in the API
            header field." src="@guide_path/assets/categories_api_header.png" max-width="800">
            <div align="center"><em><font color="black">API categories displayed as tags in the API header field.
            </em></font></div></td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Blog post categories displayed on the Blog
            page." src="@guide_path/assets/categories_blog.png" max-width="800">
            <div align="center"><em><font color="black">Blog post categories displayed on the Blog page.
            </em></font></div></td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="FAQ tags displayed on the FAQ page."
            src="@guide_path/assets/8105_faq_tags.png" max-width="800">
            <div align="center"><em><font color="black">FAQ tags displayed on the FAQ page.
            </em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

_All topics_ is the default tag on the FAQ page, and _-Any-_ is the default tag on the Blog page and in the API Catalog.
Content items without categories or tags appear on the page under the default tag only.

You can create, adjust, or delete both categories and tags manually. To learn about **the best ways to maintain**
**categories and tags**, read the step-by-step guides below:

- [Assigning content](#assign-category)
- [Editing attributes](#edit-category)
- [Reordering](#reorder-category)
- [Removing from content](#remove-category)
- [Deleting from the portal](#delete-category)
- [Related topics](#related-topics)

Categories and tags are stored as taxonomy terms in the vocabulary of your site. You can access the different
vocabularies (_API categories_, _Blog post categories_, _FAQ tags_) from the _Taxonomy_ menu and manage
the terms they contain.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Taxonomy flyout menu."
            src="@guide_path/assets/categories_taxonomy_flyout.png" max-width="800">
            </em></font></div></td>
		</tr>
	</tbody>
</table>

</br>
## <a id="assign-category"></a>Assigning content
</br>

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
            </br><font color="#f0ad4e">It doesn’t matter if you are about to create the content or it's already
            available, you can assign it to a new or an existing category or tag on its edit form.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

To assign any content to a category or tag on the **edit form** of the content, follow the steps below:

1. In the administrative menu, go to _Content_.

   - If you have **the content already available** on the developer portal, find the title of the content. You can use
   the _Filter_ option to make search easier and filter the page by _Title_ or _Content type_. Click _Edit_ at the
   end of the row.

   - To **create or upload the content now**, click _Add content_ and select the content type you
   need. ([API Reference](/admin/guides/api-documentation/api-reference),
   [Blog post](/admin/guides/non-api-related-content-management/blog-post),
   [FAQ item](/admin/guides/non-api-related-content-management/faq-item).

2. Enter the name of the category at the category/tag field of the edit form. The category and tag
   names are **case sensitive**.

   - API Reference:

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="The snippet of the API Reference’s edit form
            where you can add the new categories." src="@guide_path/assets/categories_api_create2.png" max-width="800">
            <div align="center"><em><font color="black">The snippet of the API Reference’s edit form where you can
            add the new categories.</em></font></div></td>
		</tr>
	</tbody>
</table>

   - Blog post:

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="The snippet of Blog post’s edit form where you
            can add the new category." src="@guide_path/assets/categories_blog_create2.png" max-width="800">
            <div align="center"><em><font color="black">The snippet of Blog post’s edit form where you can add the new
            category.</em></font></div></td>
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
            </br><font color="#f0ad4e">If a <strong>blog post</strong> is already assigned to a category
			(or categories), type the name of the new category into the same field and separate the items with commas.
			See the picture below.
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
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Adding more categories."
            src="@guide_path/assets/categories_blog_createmore.png" max-width="800">
            </em></font></div></td>
		</tr>
	</tbody>
</table>

   - FAQ item

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="The snippet of FAQ item’s edit form where you
            can add the new category." src="@guide_path/assets/categories_faq_create2.png" max-width="800">
            <div align="center"><em><font color="black">The snippet of FAQ item’s edit form where you can add the new
            category.</em></font></div></td>
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
            </br><font color="#f0ad4e">If you need to assign the content to <strong>an existing category</strong>,
			start typing the name of the category or tag into the field and select the right name from the
            appearing list.
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
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="The snippet of FAQ item’s edit form where you
            can add the new category." src="@guide_path/assets/categories_existing.png" max-width="800">
            <div align="center"><em><font color="black">The snippet of FAQ item’s edit form where you can add the new
            category.</em></font></div></td>
		</tr>
	</tbody>
</table>

3. Click _Save_ to apply your changes or create the new content and the new category or tag.

If you created a **new category** or tag for your content, they are visible for end-users in the API
Catalog, on the Blog page, or on the FAQ page with the content related to it.

If you added an **existing category** or tag to your content, this content item appears under that category or tag on
the API Catalog, Blog, or FAQ page.

To see your changes, navigate back to the API Catalog, to the Blog page, or to the FAQ page.
If you can’t see your changes, [try flushing all caches](/admin/guides/faq/faq#faq-cache).

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Exceptional use case*</strong></font>
            </br><font color="#f0ad4e">What if you uploaded a new content and created a new category for it, as well,
            but you decide not to publish the new content right away? <strong>The new category
            appears for end-users, even if the content related to it is unpublished.</strong> The new category is empty
            until you link it to a published content. If you can’t see your changes,
            <a href="/admin/guides/faq/faq#faq-cache" alt="try flushing all caches" target="_self">try
			flushing all caches</a>
            We recommend you to create a new category if you upload or assign any published
            content to it right away.
</font></p>
			</td>
		</tr>
	</tbody>
</table>

</br>
## <a id="edit-category"></a>Editing attributes
</br>

**You can change all API categories, Blog post categories, and FAQ tags in the same way.** In this tutorial we edit Blog
post categories to show you the workflow and what you have to know about adjusting attributes.

Categories and tags are stored as taxonomy terms in the vocabulary of your site. You can access them from the _Taxonomy_
menu and manage them when it's necessary, for example editing their attributes.

The **four attributes** of categories and tags are:

- **Name:** The name of the category that is visible for end-users. The names are case sensitive. _Name_ is a required
   field.
- **Description:** An annotation about the category that can help other site administrators to assign the right category
   to the right content. _Description_ isn't visible for end-users.
- **Relations:** The order of the items. They are displayed for end-users in ascending order by their weight. Default
   settings: _Parent item_ is set to _`<root>`_, _Weight_ is set to 0. It's a required field but you don't have to
   change anything.
- **URL alias:** An alternative path helps site administrators or end-users access the content assigned to
   the particular category or tag. No need to change anything here.

<!--MILESTONE -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f1f9f1">
			<td bgcolor="#5cb85c" style="width: 1px"></td>
			<td width="100%"><p><font color="#5cb85c"><strong>User story</strong></font>
            </br><font color="#5cb85c">Assume that you have several Blog post categories but a new series of content is
            coming and you want to draw attention to it on your Blog. For the sake of simplicity, you wouldn’t
            like to create more categories but you need to find a group for the new content as well:</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

In this case,

- You might change the name of an existing category to widen its scope.

- Also, you might let other site administrators know about the modifications by providing a description.

To **modify the attributes** of your blog post categories:

1. In the administrative menu, go to _Structure_ > _Taxonomy_ and select the option with the content type you need, now
   it is _Blog post categories_.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Blog flyout"
			src="@guide_path/assets/categories_blog_flyout.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

2. Find the category you want to modify in the list and click _Edit_ at the end of the row.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Editing the Blog post category called Space."
            src="@guide_path/assets/categories_edit1.png" max-width="800">
            <div align="center"><em><font color="black">Editing the Blog post category called Space.</em></font></div>
			</td>
		</tr>
	</tbody>
</table>
</br>

3. Make your changes. E.g. add a new _Name_ to the category and provide a _Description_.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="The edit form of Blog post categories."
            src="@guide_path/assets/categories_edit2.png" max-width="800">
            <div align="center"><em><font color="black">The edit form of Blog post categories. You find the exact same
            form when editing API categories or FAQ tags via Taxonomy. Fill in the fields accordingly.
			</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

4. Click _Save_ to apply your changes.

Navigate back to the Blog page to see your changes. The modified category name appears with **all the content that was**
**assigned to it**. With this modification, all these content items are updated with the new category name.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Blog post categories."
			src="@guide_path/assets/categories_edit3.png"
            max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

If you can’t see your changes, [try flushing all caches](/admin/guides/faq/faq#faq-cache).

</br>
## <a id="reorder-category"></a>Reordering
</br>

Categories and tags are stored as taxonomy terms in the vocabulary of the developer portal. You can access them
from the _Taxonomy_ menu and manage them when it's necessary.

**You can reorder all API categories, Blog post categories, and FAQ tags in the same way.** In this tutorial we chose
API categories to show you the common workflow.

<!--MILESTONE -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f1f9f1">
			<td bgcolor="#5cb85c" style="width: 1px"></td>
			<td width="100%"><p><font color="#5cb85c"><strong>User story</strong></font>
            </br><font color="#5cb85c">Assume that you created a new API category called _New_, which is now the last
            item appearing in the API Catalog. You need to change its place along with others to provide a smooth
            order of your categories. The new order is visible for end-users.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Blog post categories."
            src="@guide_path/assets/categories_create_taxonomy3.png"
            max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

To **reorder** your API categories:

1. In the administrative menu, go to _Structure_ > _Taxonomy_ > _API categories_.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="API categories flyout."
            src="@guide_path/assets/categories_api_flyout.png"
            max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

2. On the appearing page, click the small cross arrow on the left side of the items and reorder the elements by
dragging and dropping them to their new place.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="API categories reorder."
            src="@guide_path/assets/categories_reorder2.png"
            max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

3. After the modification, a small asterisk appears on the right side of each moved item and a notification points out
   that you have unsaved changes.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="API categories reorder."
            src="@guide_path/assets/categories_reorder.png"
            max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

Click _Save_ to apply your changes. You get a notification. Navigate back to your API Catalog. Your categories
appear by the new order. If you can’t see your changes,
[try flushing all caches](/admin/guides/faq/faq#faq-cache).

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="API categories."
            src="@guide_path/assets/categories_reorder3.png"
            max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>

</br>
## <a id="remove-category"></a>Removing from content
</br>

**You can remove all API categories, Blog post categories, and FAQ tags in the same way.** In this tutorial we chose FAQ
tags to show you the common workflow.

To **remove a category or tag from one content item**, the content stays available for end-users under the
default tag (_All topics_ or _Any_), or under other categories or tags the content belongs to.

Assume that you have an FAQ item that is related to an FAQ tag (called _Getting started_) but you don’t want that item
to appear under that tag anymore.

To **remove** an FAQ tag from a particular content item, follow the steps below:

1. In the administrative menu, go to _Content_.

2. Filter the page by _Content type_ (FAQ item) and find the content item you need.

3. Click the _Edit_ button in the _Operations_ column.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Delete categories."
            src="@guide_path/assets/categories_delete4.png"
            max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

4. On the appearing page, delete the no longer needed tag name from the _Tags_ field.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Delete categories."
            src="@guide_path/assets/categories_delete5.png"
            max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

5. Click _Save_ to apply your changes.

<!-- MILESTONE -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f1f9f1">
			<td bgcolor="#5cb85c" style="width: 1px"></td>
			<td width="100%"><p><font color="#5cb85c"><strong>Milestone</strong></font>
            </br><font color="#5cb85c">After removing the tag name from the edit form, the particular content doesn’t
            appear under that tag anymore but stays available for end-users under the default tag
			(<em>-Any-</em> or <em>All topics</em>) or other tags it's related to.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

Navigate back to the FAQ page and check what is displayed under the tag. If you don’t see your changes,
[try flushing all caches](/admin/guides/faq/faq#faq-cache).

</br>
## <a id="delete-category"></a>Deleting from the portal
</br>

**You can delete all API categories, Blog post categories, and FAQ tags in the same way.** In this tutorial we chose FAQ
 tags to show you the common workflow.

You can **delete a category or tag from your portal**. In this case, the
deleted category or tag names are also removed from the content items they are assigned to. **All the content**
**assigned to a deleted category or tag remain available for end-users under the default tag**
(_-Any-_ or _All topics_), or other categories or tags the content belongs to.

Categories and tags are stored as taxonomy terms in the vocabulary of the developer portal. You can access them from
the _Taxonomy_ menu and manage them when it's necessary. **You can delete a category or**
**tag from your portal from the _Taxonomy_ menu.**

Imagine that you created an FAQ tag (called _Getting started_), supposing that you write
question-answer items on that topic. It turns out that your users find the answers they need elsewhere and
the FAQ tag is empty, no FAQ items are assigned to it. You decide to delete that FAQ tag from the site to
reduce confusion.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="You decide to delete one of your FAQ tags."
            src="@guide_path/assets/8105_delete_tag.png" max-width="800">
            <div align="center"><em><font color="black">You decide to delete one of your FAQ tags.</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

To **permanently delete** a tag from the portal, follow the steps below:

1. In the administrative menu, go _Structure_ > _Taxonomy_ > _FAQ tags_.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="FAQ tags flyout."
            src="@guide_path/assets/categories_faq_flyout.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

2. Find the category or tag that you need to delete and click _Delete_ under _Operations_ at the end of the
   row.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Deleting a tag."
            src="@guide_path/assets/8105_delete_taxonomy.png" max-width="800">
            <div align="center"><em><font color="black">Deleting the Getting started FAQ tag. Content items assigned
            to it remain available for end-users on the FAQ page under All topics tag.</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

3. You get a confirmation message. Click _Delete_ to remove the category or tag for sure, or
_Cancel_ to leave the page without changes. You will get a notification about the successful operation.

Navigate back to the FAQ page. If you don’t see your changes,
[try flushing all caches](/admin/guides/faq/faq#faq-cache).

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="FAQ tags after the modification."
            src="@guide_path/assets/8105_delete_result.png" max-width="800">
            <div align="center"><em><font color="black">FAQ tags after the modification.</em></font></div></td>
		</tr>
	</tbody>
</table>

</br>
## <a id="related-topics"></a>Related topics

- [API Reference content type](/admin/guides/api-documentation/api-reference)
- [Blog post content type](/admin/guides/non-api-related-content-management/blog-post)
- [FAQ item content type](/admin/guides/non-api-related-content-management/faq-item)

</br>
## <a id="faq"></a>FAQ

- [Why can't I delete my API Catalog, FAQ, or Blog pages?](/admin/guides/faq/faq#faq-delete-catalog-faq-blog)
- [Why can't I modify the URL of my API Catalog, FAQ, or Blog pages?](/admin/guides/faq/faq#faq-urls-catalog-faq-blog)
- [Can I add a header background image to a specific page in a (blog, api catalog or documentation) node group?](/admin/guides/faq/faq#faq-add-header-group)

</br>

---
<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/header-background-settings/header-background-settings"
alt="Header background settings" target="_self"><< Header background settings</a> |
<a href="/admin/guides/page-builder-elements/page-builder-elements"
alt="Page Builder Elements" target="_self">Page Builder Elements >></a></strong></p>