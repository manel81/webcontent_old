<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/non-api-related-content-management/documentation-page"
alt="Documentation page" target="_self"><< Documentation page</a> |
<a href="/admin/guides/non-api-related-content-management/faq-item"
alt="FAQ Item" target="_self">FAQ Item >></a></strong></p>

---

# Blog post

</br>

### Table of Contents

- [Introduction](#blog-post-intro)
- [Managing blog posts](#manage-blog-posts)
- [Creating blog posts](#create-blog-posts)
- [Teaser pictures as Header images](#teaser-picture-as-header)
- [Recent blog posts](#recent-blog-posts)
- [Related topics](#related-topics)
- [FAQ](#faq)

</br>

<!-- IN THIS CHAPTER (BLUE) NOTIFICATION -->
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f4f8fa">
			<tr bgcolor="#f4f8fa">
			<td bgcolor="#5bc1de" style="width: 1px"></td>
			<td width="100%"><p><font color="#5bc1de"><strong>In this chapter</strong></font>
            </br><font color="#5bc1de">You learn about the procedure of creating, editing and deleting
			<a href="/admin/guides/what-content-type-should-i-use/what-content-type-should-i-use#blog-post"
			alt="Blog posts" target="_self">Blog posts</a>.</font></p>
			</td>
		</tr>
	</tbody>
</table>

</br>
## <a id="blog-post-intro"></a>Introduction
</br>

To create a new Blog post, go to _Content_ > _Add content_ > _Blog post_ in the administrative menu. Or go straight to
`/node/add/blog_post`.

<!-- SCREENSHOT FROM THE UI-->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Edit form of a Blog post."
            src="@guide_path/assets/blog_post_ui.png" max-width="800">
            <div align="center"><em><font color="black">Edit form of a Blog post.</em></font></div></td>
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
    <td>The title of the content item that is visible for end users.</td>
    <td>-</td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>Teaser picture</strong> <font color="red">(required)</font></td> <!-- TEASER -->
    <td>Upload a picture and set the focal point to select the area that is displayed on a blog card and visible for end
    users. </br>The picture can be used as header image of the blog post.</td>
    <td>E.g. <em>image.jpg</em></br></br>
    One file only.</br>
    10 MB limit.</br></br>
    Allowed types: PNG, GIF, JPG, and JPEG</br></br>
    Teaser picture size: 426x240</td>
  </tr>
  <tr>
    <td><strong>Preview (visible if Teaser picture is uploaded)</strong> <font color="red">(required)</font></td>
	<!-- PREVIEW -->
    <td>Check the appearance of the Teaser picture in the pop-up window.</td>
    <td>-</td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>Alt text (required if Teaser picture is uploaded)</strong> <font color="red">(required)</font></td>
	<!-- ALT TEXT -->
    <td>Short description of the image, used by screen readers and displayed when the image is not loaded.</td>
    <td>E.g. [the title of the blog post]</td>
  </tr>
    <td><strong>Body</strong></td> <!-- BODY -->
    <td>The content of the particular blog post. </br>To format the text or add links, pictures, and other media items,
    use the <a href="/admin/guides/built-in-text-editor/built-in-text-editor" alt="WYSIWYG editor" target="_self">
	WYSIWYG editor</a>.</td>
    <td>[copy of your content]</td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>Edit summary</strong> <font color="red">(required)</font></td> <!-- SUMMARY -->
    <td>Provide a summary of the text. </br>If the summary is not edited manually, it's automatically trimmed from the
    beginning of the text. </br>Displayed on the blog card visible for end users.</td>
    <td>[copy of your content]</td>
  </tr>
    <td><strong>Text format</strong></td> <!-- TEXT FORMAT -->
    <td>We recommend you to use <strong>Devportal HTML</strong> format.</td>
    <td><em>Devportal HTML</em></td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>Blog post categories</strong></td> <!-- CATEGORIES -->
    <td>Blog posts can be grouped and filtered by categories on the Blog page.
	</br><a href="/admin/guides/categories-and-tags/categories-and-tags" alt="Create a new category" target="_self">
	Create a new category</a> or select
    an existing one by entering its title to the field.</td>
    <td>E.g. <em>Technical</em>, <em>News</em></td>
  </tr>
    <td><strong>Revision log message</strong></td> <!-- REVISION LOG MESSAGE -->
    <td>Create a new version of an existing content and add information about your changes for other admins.</td>
    <td>[x] <em>Create new revision</em></br></br>
    [<em>Description of the change.</em>] e.g. “Fixed formatting issues.”</td>
  </tr>
  <tr bgcolor="#efefef">
    <td><strong>URL alias</strong></td> <!-- URL ALIAS -->
    <td>The URL of the page. </br>The path is automatically generated from the Title.</td>
    <td>E.g. <em>/blog/the-title-of-the-blog-post</em></td>
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
    <td><em>Blog posts</em> are automatically published after they are saved. </br>To unpublish a blog post, clear the
    <em>Published check box</em>. </br>Unpublished pages are available for content managers and administrators only in
	the Content menu, but aren’t displayed for the end users.</td>
    <td>[x] <em>Published</em></td>
  </tr>
</table>
</br>

Click _Save_ to create the content item.

</br>
## <a id="manage-blog-posts"></a>Managing blog posts
</br>

<!-- IN THIS CHAPTER (BLUE) NOTIFICATION -->
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f4f8fa">
			<tr bgcolor="#f4f8fa">
			<td bgcolor="#5bc1de" style="width: 1px"></td>
			<td width="100%"><p><font color="#5bc1de"><strong>In the following</strong></font>
            </br><font color="#5bc1de">You learn how to create, edit, delete and organize blog posts on your page.
			</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

**All published posts are displayed in chronological order on the Blog page as cards under the selected category/**
**categories.**

By default, three cards are in the same row and maximum nine cards are visible on one page. After the 9th card,
**a pager** helps you navigating between the pages.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Blog page."
            src="@guide_path/assets/6575_blog_page_ui.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

A blog post card:

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="A blog post card."
            src="@guide_path/assets/6575_blog_card_ui.png" max-width="800">
		</tr>
	</tbody>
</table>

</br>
## <a id="create-blog-post"></a>Creating Blog posts
</br>

Let’s suppose that one of your colleagues from the content writing team has made an interview with Luke Mons, CEO of the
Serenity Project about a groundbreaking new API called “Moon Rover Photos”. You have to create a new blog post from the
transcript and the available images but it must remain unpublished for now because further editing is needed. The
created blog post have to be sorted into two categories: _Space developer_ (which is an existing one) and _Interviews_
(which is new).

To set up a blog post for publication, you have to:

- Add a title, upload a teaser picture and add its alternative text. [(Steps 1-5)](#step-1-5)

- Write or paste a summary and the main text of your blog post, define its category. [(Steps 6-8)](#step-6-8)

- Set the publication information, like the name of the author and the date of the publication.
  [(Steps 9-12)](#step-9-12)

To **create** a new Blog post, follow the steps below:

1. <a id="step-1-5"></a>In the administrative menu, go to Content > Add content > Blog post. Or go straight to
   `/node/add/blog_post`.

2. (required) Type or paste the _Title_ of your blog post. This will be displayed on the Blog page as the title of the
   blog post card too. (e.g., _“Introducing Moon Rover Photos API”_)

3. Upload a _Teaser Picture_ by clicking on the _Choose file_ button. This image is displayed on the blog post card
   on the Blog page. You can upload one image file only in the maximum size of 10MB, in the following formats: PNG,
   GIF, JPG, JPEG.

4. Set the [Focal point](/admin/guides/faq/faq#faq-focal-point) of the teaser picture by moving the cross on it with the
  cursor or clicking the image. Click _Preview_ to see the result of your settings.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Focal point."
            src="@guide_path/assets/6575_blog_focal_point.png" max-width="800">
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="The preview window of the Teaser picture."
            src="@guide_path/assets/6575_blog_focal_point_pre.png" max-width="800">
            <div align="center"><em><font color="black">The preview window of the Teaser picture.</em></font></div></td>
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
            </br><font color="#f0ad4e">To display the whole picture as Teaser picture, use an image
            with the resolution of 426x240. Otherwise the developer portal crops the image to keep the appealing
			aspect ratio.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

5. (required) Give a short description of the image in the _Alternative text_ field. The _Alternative text_ is used by
   screen readers and shown when the image is not loaded.

The basic visual appearance of the blog post is now set. In the following, you add content and place the blog post
in categories.

6. (optional) Click the _Edit Summary_ link next to the _Body_ to write a summary of your blog post. The summary
   appears on the blog post card only. Leave it blank to use a trimmed value of full text as the summary.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Edit summary."
            src="@guide_path/assets/6575_blog_edit_summary.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

7. Type or paste the main text of your blog post into the _Body_ field. You can format this text as usual with the
   [WYSIWYG Editor](/admin/guides/built-in-text-editor/built-in-text-editor).

8. Define the category of this Blog post by typing the name of it in the text box under the _Blog post categories_.
   If it matches with an existing category, you can select it from the appearing menu, but you can add new categories,
   too (e.g., _Space developer_, _Interviews_).

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
            </br><font color="#f0ad4e">To add multiple categories, separate them with commas.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Defined categories of the blog post."
            src="@guide_path/assets/6575_blog_edit_categories.png" max-width="800">
            <div align="center"><em><font color="black">Defined categories of the blog post. The
            existing category (Space Developer) has an ID (11).</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

After you have created the main content of your blog post, it's time to select the name of the author and the time of
publishing:

9. Set the _Authoring information_ in the _Published_ field. You can select the author by typing the name of it in the
   ext box under _Authored by_. If it matches with an existing user name, you can select it from the appearing menu.

10. Change or set the date of publishing by modifying the values under the _Authored on_ text in the format:
   YYYY-MM-DD HH:MM:SS.


<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Authoring information."
            src="@guide_path/assets/6575_blog_edit_authoring.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

11. (optional) Clear the Published check box if you want the FAQ item to remain unpublished after saving.
   Unpublished pages are available for content managers and administrators only, under the Content menu tab but isn't
   displayed to the site users.

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
            </br><font color="#f0ad4e">If you create a new category for an unpublished blog post, the new category link
            is visible for the end users. (In this example, this blog post is unpublished.)</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

12. Click _Save_ to apply your changes. In the appearing page, you can see the created blog post. If you
   navigate to the Blog page and your blog post is unpublished it won’t be among the cards, otherwise it has to be the
   first one (it depends on the time and date of publication).


<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Defined categories of the blog post."
            src="@guide_path/assets/6575_blog_post_page.png" max-width="800">
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Defined categories of the blog post."
            src="@guide_path/assets/6575_blog_unpublished_result.png" max-width="800">
            <div align="center"><em><font color="black">The first page of the Blog. The unpublished content is not
            displayed but the new category is visible.</em></font></div></td>
		</tr>
	</tbody>
</table>

</br>
## <a id="teaser-picture-as-header"></a>Teaser pictures as Header images
</br>

<!-- IN THIS CHAPTER (BLUE) NOTIFICATION -->
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f4f8fa">
			<tr bgcolor="#f4f8fa">
			<td bgcolor="#5bc1de" style="width: 1px"></td>
			<td width="100%"><p><font color="#5bc1de"><strong>In this chapter</strong></font>
            </br><font color="#5bc1de">The uploaded images for your blog posts only appear on
            your blog post cards by default. Now you learn how to set the selected Teaser pictures as Header images
            to your blog posts.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Teaser pictures on the blog cards."
            src="@guide_path/assets/6581_blog_teaser_heading_ui.png" max-width="800">
            <div align="center"><em><font color="black">A snippet from the Blog page. One of the Teaser pictures is
            highlighted in red.</em></font></div></td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Default appearance of a blog post."
            src="@guide_path/assets/6581_blog_teaser_heading_default_display.png" max-width="800">
            <div align="center"><em><font color="black">The default appearance of the selected blog post.</em></font></div></td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Blog post with header image."
            src="@guide_path/assets/6581_blog_teaser_heading_result.png" max-width="800">
            <div align="center"><em><font color="black">A snippet from a Blog page after the settings.</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

You can achieve this enhancement by following the steps below:

1. Click _Appearance_ and select _Settings_ next to the name of the theme you are using.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Select theme settings under Appearance."
            src="@guide_path/assets/6581_blog_teaser_heading_theme_set.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

2. Check the box under the _Blog post header image_ category.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Tick the Blog post header image checkbox."
            src="@guide_path/assets/6581_blog_teaser_heading_theme_set_header.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

3. Scroll down and press the _Save configuration_ button. The teaser pictures are displayed as Blog post headers.

After these changes, **all** of your Teaser pictures become Header images, too.

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
            </br><font color="#f0ad4e">Your <a href="/admin/guides/faq/faq#faq-focal-point" alt="focal point" target="_self">focal point</a>
			settings do not affect how the Header image is displayed.</font></p>
			</td>
		</tr>
	</tbody>
</table>

</br>
## <a id="recent-blog-posts"></a>Recent Blog posts
</br>

<!-- IN THIS CHAPTER (BLUE) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f4f8fa">
			<tr bgcolor="#f4f8fa">
			<td bgcolor="#5bc1de" style="width: 1px"></td>
			<td width="100%"><p><font color="#5bc1de"><strong>In this chapter</strong></font>
            </br><font color="#5bc1de">You learn how to place a grid section that displays the most recent blog
            posts as cards to the layout of a selected page of the developer portal.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Recent blog post section."
            src="@guide_path/assets/6440_recent_blog_post_page.png" max-width="800">
            <div align="center"><em><font color="black">Page builder page with Recent Blog Post grid section
            (default settings)</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

Display a specified number of blog post cards related to the latest blog posts with the _Recent blog post_ feature
on pages that use page builder elements.

To create a grid section with the most recent blog posts, follow the steps below:

1. **Create** or go to the **edit** screen of the page where you want to display the recent blog post cards.

2. Select _Add Grid_ from the _Page Builder Element_ section.

3. Select the _One column - 100%_ option from the _Grid layout_ drop-down menu.

4. Select _Add block_ from the _Grid element_ radio buttons.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Adding a Block grid element."
            src="@guide_path/assets/6440_grid_add_block.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

5. Click _Block_ drop-down menu and choose _Blog post_ from the list.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Selecting Blog posts from the drop-down menu."
            src="@guide_path/assets/6440_blog_block.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

6. (Optional) If you **don't** want to display title for this section on your site, uncheck the _Display title_ box.
   (Checked by default.)

7. Choose the number of the blog post cards you would like to display on your page from the _Items per block_ menu.
   (By default: 3, optional values: 5, 10, 20, 40)

8. (Optional) To add a **custom** title to your featured blog post section, check the _Override title_
   box. This action overrides the default title to your own.

9. (Optional) Type your custom title in the _Title_ field. (By default: the title of this section is _Recent blog posts_.)
   **NOTE:** You have to check both the _Display title_ and the _Override title_ boxes to make your custom title visible.

10. After saving your changes, you can see the recent blog cards on the selected page.

</br>
## <a id="related-topics"></a>Related topics

- [Image management](/admin/guides/image-management/image-management)
- [Categories and tags](/admin/guides/categories-and-tags/categories-and-tags)
- [Built-in text editor](/admin/guides/built-in-text-editor/built-in-text-editor)
- [Create landing pages with Page Builder](/admin/guides/non-api-related-content-management/page-builder#create-landing-page)
- [Page Builder Elements](/admin/guides/page-builder-elements/page-builder-elements)

</br>
## <a id="faq"></a>FAQ

- [Why can't I modify the URL of my API Catalog, FAQ, or Blog pages?](/admin/guides/faq/faq#faq-urls-catalog-faq-blog)
- [Why can't I delete my API Catalog, FAQ, or Blog pages?](/admin/guides/faq/faq#faq-delete-catalog-faq-blog)

</br>

---
<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/non-api-related-content-management/documentation-page"
alt="Documentation page" target="_self"><< Documentation page</a> |
<a href="/admin/guides/non-api-related-content-management/faq-item"
alt="FAQ Item" target="_self">FAQ Item >></a></strong></p>