<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/advanced-api-documentation/uploading-api-reference-files-using-curl"
alt="Uploading API reference files using cURL" target="_self"><< Uploading API reference files using cURL</a> |
<a href="/admin/guides"
alt="Table of contents" target="_self">Table of contents >></a></strong></p>

---
# Uploading Markdown files using cURL
</br>

### Prerequisite knowledge

- [About the API Reference page](/admin/guides/api-documentation/api-reference)
- [About the API Description page](/admin/guides/api-documentation/api-description)
- [About the API Basic page](/admin/guides/api-documentation/api-basic-page)
- [Managing groups](/admin/guides/groups/managing-groups)
- [Generating URL tokens](/admin/guides/groups/generating-url-tokens)
- [API reference versioning](/admin/guides/advanced-api-documentation/api-reference-versioning)
- [Uploading API reference files using cURL](/admin/guides/advanced-api-documentation/uploading-api-reference-files-using-curl)

</br>
### Table of Contents

- [cURL command to create API Basic pages](#cicd-curl-template-md-api-basic)
- [cURL command to create API Description pages](#cicd-curl-template-md-api-description)
- [Related topics](#related-topics)
- [FAQ](#faq)

</br>

<!-- IN THIS CHAPTER (BLUE) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f4f8fa">
			<td bgcolor="#5bc1de" style="width: 1px"></td>
				<td width="100%"><p><font color="#5bc1de"><strong>In this chapter</strong></font>
					</br><font color="#5bc1de">You can learn how to upload Release notes or other supporting documentation
               files in Markdown format to the developer portal via a cURL command for published API reference pages.
               </font></p>
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
				<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
					</br><font color="#f0ad4e">You can upload the supporting documentation using the API Basic
                    page or the API Description page content type. For a complete overview about the available content
                    types, read the
                    <a href="/admin/guides/what-content-type-should-i-use/what-content-type-should-i-use">What content
                    type should I use</a> chapter.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

**Overview**

<!-- WARNING (RED) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fdf7f7">
			<td bgcolor="#d9534f" style="width: 1px"></td>
				<td width="100%"><p><font color="#d9534f"><strong>Caution</strong></font>
					</br><font color="#d9534f">You must have a published API reference page generated from an OpenAPI
                    Specification file with properly defined <code>x-project-id</code> and <code>version</code>
                    key-value pairs to go further.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

1. Have a supporting documentation file to upload in _MD_ format.
2. [Prepare the upload cURL command](#cicd-upload-md).
3. Run the command from the Terminal or another command line tool to create an unpublished API reference page on the
   developer portal.

</br>
<a id="cicd-curl-template-md-api-basic"></a>## cURL command to create API Basic pages
</br>

Use the cURL command template below to upload text from Markdown files for a published API reference page on the
developer portal. The uploaded page becomes available as a tab on the related API reference page after it's published.

`curl -X POST -H "Content-Type: text/markdown" --data-binary @file_name.md BASE_URL/dp-trigger/[TOKEN]/api_basic_page?title=[TITLE]&api_name=[NAME_OF_THE_API]&version=[VERSION_NUMBER]`

Set the parameters of the command like the following:

1. `"Content-Type: text/markdown"` defines the format of the text file. **Don't change this value.**
2. `@file_name.md` is the name of the Markdown file you want to upload. (For example `release_notes.md`)
   **Keep the `@` character in the reference.**
3. Use the `BASE_URL/dp-trigger/[TOKEN]/api_basic_page?title=[TITLE]&api_name=[NAME_OF_THE_API]&version=[VERSION_NUMBER]`
   URL format, where `BASE_URL` looks like this: `https://username:password@FQDN`.
   FQDN is the Fully Qualified Domain Name of the developer portal, for example `allianz.site.devportal.io`.
4. Define the value of the `BASE_URL` in the following format:

   - Add a valid _user name_ and _password_ for the developer portal _separated with a colon `:`_ after the
   _https://_ part of the `BASE_URL` value. **Use an [URL encoder](https://www.url-encode-decode.com/) to convert the**
   **special characters in your password to the acceptable format.** (For example, the password `François`, would be
   encoded as `Fran%C3%A7ois`).
   - After the valid credentials, you must _add an et [`@`] character_, then
   - _type the URL of the developer portal_.

   (Example BASE_URL: `"https://johndoe:Fran%C3%A7ois@allianz.site.devportal.io"`)

5. Paste the [generated token](/admin/guides/groups/generating-url-tokens) for the value of `[TOKEN]`. (For example,
   `bOWQqR8rWrQEAlNNFG0EhV3ejPFT70FPVIN5DuvaK1JxuKA2OkzECGMqloyUyZ4X`)
6. Set the title of the page by changing the `[TITLE]` parameter.
7. Add the name of the OpenAPI Specification file (defined in the `info.title` property of the file) as the
   `[NAME_OF_THE_API]` value. This parameter connects the supporting documentation to the uploaded API reference
   documentation.
8. Change the [VERSION_NUMBER] to set the version of the API reference for which the supporting documentation is being
   uploaded.

**Use an [URL encoder](https://www.url-encode-decode.com/) to convert the special characters to the acceptable**
**data-binary format.**

The cURL command should look something like this:

`curl -X POST -H "Content-Type: text/markdown" --data-binary @release_notes.md https://johndoe:Fran%C3%A7ois@allianz.site.devportal.io/dp-trigger/bOWQqR8rWrQEAlNNFG0EhV3ejPFT70FPVIN5DuvaK1JxuKA2OkzECGMqloyUyZ4X/api_basic_page?title=Release%20Notes&api_name=swagger%20petstore&version=3.0.0`

</br>
<a id="cicd-curl-template-md-api-description"></a>## cURL command to create API Description pages
</br>

You can use the API Description page content type to create a complex, visually appealing layout to your API
documentation with the [Page Builder elements](/admin/guides/non-api-related-content-management/page-builder-elements/page-builder-elements)
and the [built-in text editor](/admin/guides/built-in-text-editor/built-in-text-editor). You can upload the plain text
content of API Description pages using the cURL command template below. The uploaded page becomes available as a tab on
the related API reference page after it's published.

`curl -X POST -H "Content-Type: text/markdown" --data-binary @file_name.md BASE_URL/dp-trigger/[TOKEN]/api_description_page?title=[TITLE]&api_name=[NAME_OF_THE_API]&version=[VERSION_NUMBER]`

Set the parameters of the command like the following:

1. `"Content-Type: text/markdown"` defines the format of the text file. **Don't change this value.**
2. `@file_name.md` is the name of the Markdown file you want to upload. (For example `release_notes.md`)
   **Keep the `@` character in the reference.**
3. Use the `BASE_URL/dp-trigger/[TOKEN]/api_description_page?title=[TITLE]&api_name=[NAME_OF_THE_API]&version=[VERSION_NUMBER]`
   URL format, where `BASE_URL` looks like this: `https://username:password@FQDN`.
   FQDN is the Fully Qualified Domain Name of the developer portal, for example `allianz.site.devportal.io`.
4. Define the value of the `BASE_URL` in the following format:

   - Add a valid _user name_ and _password_ for the developer portal _separated with a colon `:`_ after the
   _https://_ part of the `BASE_URL` value. **Use an [URL encoder](https://www.url-encode-decode.com/) to convert the**
   **special characters in your password to the acceptable format.** (For example, the password `François`, would be
   encoded as `Fran%C3%A7ois`).
   - After the valid credentials, you must _add an et [`@`] character_, then
   - _type the URL of the developer portal_.

   (Example BASE_URL: `"https://johndoe:Fran%C3%A7ois@allianz.site.devportal.io"`)

5. Paste the [generated token](/admin/guides/groups/generating-url-tokens) for the value of `[TOKEN]`. (For example,
   `bOWQqR8rWrQEAlNNFG0EhV3ejPFT70FPVIN5DuvaK1JxuKA2OkzECGMqloyUyZ4X`)
6. Set the title of the page by changing the `[TITLE]` parameter.
7. Add the name of the OpenAPI Specification file (defined in the `info.title` property of the file) as the
   `[NAME_OF_THE_API]` value. This parameter connects the supporting documentation to the uploaded API reference
   documentation.
8. Change the [VERSION_NUMBER] to set the version of the API reference for which the supporting documentation is being
   uploaded.

**Use an [URL encoder](https://www.url-encode-decode.com/) to convert the special characters to the acceptable**
**data-binary format.**

The cURL command should look something like this:

`curl -X POST -H "Content-Type: text/markdown" --data-binary @release_notes.md https://johndoe:Fran%C3%A7ois@allianz.site.devportal.io/dp-trigger/bOWQqR8rWrQEAlNNFG0EhV3ejPFT70FPVIN5DuvaK1JxuKA2OkzECGMqloyUyZ4X/api_description_page?title=Release%20Notes&api_name=swagger%20petstore&version=3.0.0`

<!--MILESTONE -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f1f9f1">
			<td bgcolor="#5cb85c" style="width: 1px"></td>
				<td width="100%"><p><font color="#5cb85c"><strong>Milestone</strong></font>
					</br><font color="#5cb85c">Now you can upload supporting documentation to published API reference
                    pages on the developer portal.</font></p>
			</td>
		</tr>
	</tbody>
</table>

</br>
## <a id="related-topics"></a>Related topics

- [About the API Reference content type](/admin/guides/api-documentation/api-reference)
- [About the API Description page content type](/admin/guides/api-documentation/api-description)
- [About the API Page Builder page content type](/admin/guides/api-documentation/api-page-builder#api-pb-intro)
- [About the API Basic page](/admin/guides/api-documentation/api-basic-page#api-basic-intro)
- [How to create static pages?](/admin/guides/api-documentation/api-basic-page#create-api-basic-pages)
- [Page Builder Elements](/admin/guides/non-api-related-content-management/page-builder-elements/page-builder-elements)
- [How to create a landing page for my API?](/admin/guides/api-documentation/api-page-builder#create-api-landing-page)
- [Built-in text editor](/admin/guides/built-in-text-editor/built-in-text-editor)
- [How to add new API reference to the developer portal?](/admin/guides/api-documentation/api-reference#add-api-reference)
- [API Catalog](/admin/guides/api-documentation/api-catalog)
- [API Tab Sorting](/admin/guides/api-documentation/api-tabs-sorting)
- [Content management](/admin/guides/content-management/content-management)
- [Categories and tags](/admin/guides/categories-and-tags/categories-and-tags)
- [Reviewing past revisions](/admin/guides/reviewing-past-revisions/reviewing-past-revisions)

</br>
## <a id="faq"></a>FAQ

- [What’s the difference between Documentation pages and API documentation?](/admin/guides/faq/faq#faq-diff-docu-apidoc)
- [What is on the API cards?](/admin/guides/faq/faq#faq-api-card-what)
- [Can I reorder the pages of the documentation overview page](/admin/guides/faq/faq#faq-reorder-pages-doc-overview)
- [How can I add APIs to the API Catalog?](/admin/guides/faq/faq#faq-add-api-to-catalog)
- [What is the Error badge on the API Reference page?](/admin/guides/faq/faq#faq-apiref-error-badge)

</br>

---
<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/advanced-api-documentation/uploading-api-reference-files-using-curl"
alt="Uploading API reference files using cURL" target="_self"><< Uploading API reference files using cURL</a> |
<a href="/admin/guides"
alt="Table of contents" target="_self">Table of contents >></a></strong></p>
