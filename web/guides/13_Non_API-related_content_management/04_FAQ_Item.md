<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/non-api-related-content-management/blog-post"
alt="Blog post" target="_self"><< Blog post</a> |
<a href="/admin/guides/non-api-related-content-management/page-builder"
alt="Page Builder" target="_self">Page Builder >></a></strong></p>

---

# FAQ item

</br>

<!-- IN THIS CHAPTER (BLUE) NOTIFICATION -->
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f4f8fa">
			<tr bgcolor="#f4f8fa">
			<td bgcolor="#5bc1de" style="width: 1px"></td>
			<td width="100%"><p><font color="#5bc1de"><strong>In this chapter</strong></font>
            </br><font color="#5bc1de">You can learn about the <strong>FAQ</strong> content item: how to create, edit
            and delete it, and what are the most common fields of usage.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

### Table of contents

- [Introduction](#faq-intro)
- [Using FAQ pages](#using-faq-page)
- [Deleting FAQ items](#delete-faq-item)
- [Quick links to FAQ items](#link-faq-item)
- [Related topics](#related-topics)
- [FAQ](#faq)

</br>
## <a id="faq-intro"></a>Introduction
</br>

To create a new FAQ item, go to _Content_ > _Add content_ > _FAQ item_ in the administrative menu. Or go straight to
`/node/add/faq_item`.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Edit form of an FAQ item"
            src="@guide_path/assets/faq_item_ui.png" max-width="800" align="center">
            <div align="center"><em><font color="black">Edit form of an FAQ item.</em></font></div></td>
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
    <td><strong>Title</strong></br><font color="red">(required)</font></td> <!-- TITLE -->
    <td>Add your question that is visible on the FAQ page in a question-answer format.</td>
    <td>E.g. <em>What is OAuth 2.0?</em></td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>Weight</br>(required)</strong></td> <!-- WEIGHT -->
    <td>The weight of the FAQ item in the FAQ list. Items with lower weights are displayed at the top of the list. Valid
    values are whole numbers, they can be either positive or negative.</br>By default weight is 0.
</td>
    <td>E.g. “OAuth 2.0 is an authorization protocol that used on our Developer Portal to secure API usage.”</em></td>
  </tr>
  <tr>
    <td><strong>Answer</br>(Edit summary)</strong></td> <!-- ANSWER -->
    <td>Provide an answer to the question.</br>To format the text or add links, pictures, and other media items, use the
    <a href="/admin/guides/built-in-text-editor/built-in-text-editor" alt="WYSIWYG editor" target="_self">WYSIWYG editor
    </a></td>
    <td>Devportal HTML</td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>Text format</strong></td> <!-- TEXT FORMAT -->
    <td>We recommend you to use <strong>Devportal HTML</strong> format.</td>
    <td>Devportal HTML</td>
  </tr>
  <tr>
    <td><strong>Revision log message</strong></td> <!-- REVISION LOG MESSAGE -->
    <td>Create a new version of an existing content and add information about your changes for other admins.</td>
    <td>[x] <em>Create new revision</em></br></br>
    [<em>Description of the change.</em>] e.g. “Fixed formatting issues.”</td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>URL alias</strong></td> <!-- URL ALIAS -->
    <td>No need to change anything here.</td>
    <td>-</td>
  </tr>
  <tr>
    <td><strong>Authoring information</strong></td> <!-- AUTHORING INFORMATION -->
    <td>No need to change anything here.</td>
    <td>-</td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>Promotion options</strong></td> <!-- PROMOTION OPTIONS -->
    <td>No need to change anything here.</td>
    <td>-</td>
  </tr>
  <tr>
    <td><strong>Published</strong></td> <!-- PUBLISHED -->
    <td><strong>FAQ items are automatically published after they are saved.</strong> </br>To unpublish a FAQ item, clear
    the <em>Published check box</em>. </br>Unpublished items are available for content managers and administrators only
    in the Content menu, but aren’t displayed for the end-users.</td>
    <td>[x] <em>Published</em></td>
  </tr>
</table>
</br>

Click _Save_ to create the content item.

</br>
## <a id="using-faq-page"></a>Using FAQ pages
</br>

<!-- IN THIS CHAPTER (BLUE) NOTIFICATION -->
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f4f8fa">
			<tr bgcolor="#f4f8fa">
			<td bgcolor="#5bc1de" style="width: 1px"></td>
			<td width="100%"><p><font color="#5bc1de"><strong>In this chapter,</strong></font>
            </br><font color="#5bc1de">You can learn how to add, edit, or delete FAQ items.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

The FAQ or Frequently Asked Questions page lists useful information about the services of your portal for end-users
in Question-Answer pair formats. The Question-Answer pairs are called FAQ items (e.g., _What is OAuth 2.0?_, _How can I_
_report a bug?_, _How can I start using the API?_). FAQ items are displayed as accordions on the FAQ page. Compose your
questions to focus on the user’s perspective. The answers must be informative, punctual and brief with internal or
external links to other pages. To help users find what they need, give relevant tags to each FAQ item.

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
            </br><font color="#f0ad4e">The FAQ page is a part of the developer portal, you can't create a new one or
            delete it entirely: you can edit the FAQ items only. The path of the URL page <strong>(/faq)</strong> is
            also hard-coded, so you can’t change it either.
            But you can <a href="/admin/guides/menu-settings/menu-settings#delete-main"
            alt="delete its reference from any menu" target="_self">delete its reference from any menu</a>, if you, for
            any reason, would like to hide this page from the end-users.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="An FAQ page with categories and the accordion list of FAQ
            item." src="@guide_path/assets/8105_faq_opened.png" max-width="800" align="center">
            <div align="center"><em><font color="black">The FAQ page with categories and the accordion list of FAQ
            items.
            </em></font></div></td>
		</tr>
	</tbody>
</table>

</br>
## <a id="create-faq-item"></a>Creating new FAQ item
</br>

Let’s assume that you have to update the FAQ section of your portal with a new entry about how to create an
FAQ item. You have to write a question-answer pair and assign it to an existing (e.g., _General_) and to a new
(e.g., _About FAQ_) tag.

To **create** an FAQ content item, follow these steps:

1. In the administrative menu, go to _Content_ > _Add content_ > _FAQ Item_. Or go straight to `/node/add/faq_item`.

2. (recommended) Add a _Title_ that is visible at the top of the accordion. Often a question. (e.g.,
   _How can I create a new FAQ item?_)

3. Provide tag(s) to this FAQ item. Start typing the name of it in the text box under the _Tags_. If it matches with an
   existing tag, you can select it from the appearing menu, but you can add new tags, too. (e.g., _About FAQ_, this
   is a new tag.)

4. To add another tag, click _Add another item_. (e.g., General, i's an existing tag. You can see the ID
   of this tag in brackets next to its name.)

5. (recommended) You have to set the _Weight_ of your FAQ item. By default, new items appear somewhere in the FAQ list
   depending on other entries weight. Items with lower weights are displayed at the top of the list. (e.g., _0_)

6. Type or paste the answer for the question into the _Answer_ text field. You can format this text as usual with the
   [WYSIWYG Editor](/admin/guides/built-in-text-editor/built-in-text-editor).

7. (optional) Clear the _Published_ check box to keep the FAQ item unpublished after saving. Unpublished
   pages are available for content managers and administrators only, under the _Content_ menu tab but aren’t displayed
   for the site users.

8. Click _Save_ to apply your changes. You get a notification. The appearing page is for administrative purposes
   only, navigate to your FAQ page to see the results.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="The edit page of an FAQ item with example data."
            src="@guide_path/assets/6594_faq_new_edit.png" max-width="800" align="center">
            <div align="center"><em><font color="black">The edit page of an FAQ item with example data.
            </em></font></div></td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="The FAQ page is updated with the new entry and with the
            new tag. In the About, FAQ category only the highlighted FAQ item is displayed."
            src="@guide_path/assets/8105_new_faq_item.png" max-width="800" align="center">
            <div align="center"><em><font color="black">The FAQ page is updated with the new entry and with the
            new tag. In the About FAQ category, only the highlighted FAQ item is displayed.
            </em></font></div></td>
		</tr>
	</tbody>
</table>

</br>
## <a id="edit-faq-item"></a>Editing FAQ items
</br>

Imagine, you created an entry about how a user can create a new FAQ item that is the forth item in
the list, which is not an eminent place. You can move this item to the top of the list by changing its weight attribute.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="FAQ edit UI."
            src="@guide_path/assets/8105_move_faq.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

To **edit** an existing FAQ item, follow the steps below:

1. In the Administrative menu, go to _Content_.

2. Filter the _Content type_ to _FAQ Item_.

3. Click _Edit_ under _Operations_ at the end of the selected item’s row.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Editing FAQ item."
            src="@guide_path/assets/6594_faq_edit_edit.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

4. On the appearing page, you can make your changes. To move an item upper in the list, decrease the value of its
   weight. Weight can be negative, but must be a whole number (e.g., -1). If you are not sure what value to add,
   check the weight of the top element.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="FAQ weight."
            src="@guide_path/assets/8105_faq_weight.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

5. Click _Save_ to apply your changes. You get a notification. The appearing page is for
   administrative purposes only, navigate to the FAQ page to see the results.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="FAQ items."
            src="@guide_path/assets/8105_faq_weight_result.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>

</br>
## <a id="delete-faq-item"></a>Deleting FAQ items
</br>

This section describes how to delete FAQ items. For example, you have an FAQ page with the following
items:

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="The About APIs category is selected on the FAQ page."
            src="@guide_path/assets/8105_delete_faq.png" max-width="800" align="center">
            <div align="center"><em><font color="black">FAQ items with About FAQ tag listed on the FAQ page.
            </em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

Let’s suppose that you received an email from one of your colleagues. The letter says your co-worker published an entry
to the FAQ page about the same topic as you, right after you've clicked on the save button. But since your solution is
much better, you have set an agreement, the other item has to be deleted.

1. In the Administrative menu, go to _Content_.

2. Filter the _Content type_ to _FAQ Item_.

3. Select the _Delete_ operation from the drop-down menu at the end of the row.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Deleting FAQ items"
            src="@guide_path/assets/6594_faq_delete_edit.png" max-width="800" align="center"></td>
		</tr>
	</tbody>
</table>
</br>

4. You get a confirmation message. Click _Delete_ to remove the content item for sure, or
   _Cancel_ to leave the page without changes. Navigate back to your home page.

<!-- IMAGE: WITHOUT CAPTION -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="FAQ delete results"
            src="@guide_path/assets/8105_delete_faq_result.png" max-width="800" align="center"></td>
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
            </br><font color="#f0ad4e">You can hide items from the FAQ page without deleting them by unchecking the
            <em>Published</em> button on their edit screen.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- WARNING (RED) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fdf7f7">
			<td bgcolor="#d9534f" style="width: 1px"></td>
			<td width="100%"><p><font color="#d9534f"><strong>Note</strong></font>
            </br><font color="#d9534f">The FAQ tag you create is displayed on the FAQ page, even if it
            doesn’t have any related FAQ items (because you deleted the items, or removed the tag from the item). To
            delete a no longer needed FAQ tag, read the
            <a href="/admin/guides/categories-and-tags/categories-and-tags#delete-category"
            alt="Deleting categories and tags from the portal" target="_self">Deleting categories and tags from the
            portal</a> chapter.</font></p>
			</td>
		</tr>
	</tbody>
</table>

</br>
## <a id="link-faq-item"></a>Quick links to FAQ items
</br>

A permalink generator option is available on the developer portal. If the feature is enabled, every published FAQ item
gains an individual and copyable quick link.

Admin users can use these unique URLs to directly navigate end-users to individual FAQ items. For example, if you have
an FAQ item that answers an important question about how to start working with your APIs, you can place its link
on your Getting started (or on any relevant) page.

If the feature is enabled:

1. A copy-to-clipboard icon appears next to the title when users expand an FAQ item. When users hover over the
   icon, a _Copy link_ text appears.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="FAQ page with quick link icon."
            src="@guide_path/assets/faq_unique_link.png" max-width="800" align="center">
            </td>
		</tr>
	</tbody>
</table>
</br>

2. When users click the icon, a fade-away _Link copied to clipboard_ text appears at the bottom of the page.
   The unique link is copied and visible in the address bar too.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="FAQ page with quick link icon."
            src="@guide_path/assets/copied_faq_link.png" max-width="800" align="center">
            </td>
		</tr>
	</tbody>
</table>
</br>

3. If users arrive at the FAQ page via a unique FAQ quick link, the page scrolls down to the expanded FAQ item.

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
            </br><font color="#f0ad4e">The feature isn't enabled by default. To turn it on the developer
            portal, contact the project manager.</font></p>
			</td>
		</tr>
	</tbody>
</table>

</br>
## <a id="related-topics"></a>Related topics

- [FAQ item content type](/admin/guides/what-content-type-should-i-use/what-content-type-should-i-use#faq-item)
- [Categories and tags](/admin/guides/categories-and-tags/categories-and-tags)

</br>
## <a id="faq"></a>FAQ

- [Why can't I modify the URL of my API Catalog, FAQ, or Blog pages?](/admin/guides/faq/faq#faq-urls-catalog-faq-blog)
- [Why can't I delete my API Catalog, FAQ, or Blog pages?](/admin/guides/faq/faq#faq-delete-catalog-faq-blog)
- [Can I add a header background image to a specific page in a (blog, api catalog or documentation) node group?](/admin/guides/faq/faq#faq-add-header-group)

</br>

---
<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/non-api-related-content-management/blog-post"
alt="Blog post" target="_self"><< Blog post</a> |
<a href="/admin/guides/non-api-related-content-management/page-builder"
alt="Page Builder" target="_self">Page Builder >></a></strong></p>