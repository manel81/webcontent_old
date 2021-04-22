<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/advanced-api-documentation/api-reference-versioning"
alt="API reference versioning" target="_self"><< API reference versioning</a> |
<a href="/admin/guides/advanced-api-documentation/uploading-markdown-files-using-curl"
alt="Uploading Markdown files using cURL" target="_self">Uploading Markdown files using cURL >></a></strong></p>

---
# Uploading API reference files using cURL
</br>

### Prerequisite knowledge

- [Managing groups](/admin/guides/groups/managing-groups)
- [Generating URL tokens](/admin/guides/groups/generating-url-tokens)
- [API reference versioning](/admin/guides/advanced-api-documentation/api-reference-versioning)

</br>
### Table of Contents

- [Uploading API references using command line](#cicd-upload-api-reference)
  - [cURL command template](#cicd-curl-template)
  - [Defining the values of the cURL command](#cicd-curl-values)
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
            </br><font color="#5bc1de">You can learn how to upload OpenAPI Specification (also known as Swagger) files
			to the developer portal via a cURL command to create or update API reference pages.
			</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

**Overview**

1. Have an API reference (OAS) file to upload in _JSON_ or _YAML_ format.
2. [Generate a URL token for a group](/admin/guides/groups/generating-url-tokens) on the developer portal.
3. [Prepare the upload cURL command](#cicd-upload-api-reference).
4. Run the command from the command line to create an unpublished API reference page on the developer portal.

</br>
<a id="cicd-upload-api-reference"></a>## Uploading API references using command line
</br>

In the next section, you find a template for the upload cURL command that you can edit according to your needs. You can
also learn how to define the values of the command to upload API reference files to the developer portal.

</br>

<a id="cicd-curl-template"></a>### cURL command template

`curl -X POST -H "Content-Type: application/yaml" -H "X-Project-Id: PROJECT_ID" --data-binary @name_of_the_reference_file.yaml BASE_URL/dp-trigger/[TOKEN]`

</br>

<a id="cicd-curl-values"></a>### Defining the values of the cURL command

Learn how to edit the template above by following the steps of this example:

1. `"Content-Type: application/yaml"` defines the format of the OpenAPI Specification file. Change `yaml` to `json`
   to upload JSON files: `"Content-Type: application/json"`.
2. `"X-Project-Id: PROJECT_ID"` is a key-value pair you also have to define in the OpenAPI Specification file. This is
    the [ID of the API reference project, and required for versioning.](/admin/guides/advanced-api-documentation/api-reference-versioning)
    The `PROJECT_ID` value connects the different API reference documentation versions together. (For example,
    `1234_testapi`.)
3. `@name_of_the_reference_file.yaml` is the name of the OpenAPI Specification file you want to upload. Keep the `@`
   character in the reference, and change `yaml` to `json` to upload JSON files: `@name_of_the_reference_file.json`.
4. Use the `BASE_URL/dp-trigger/[TOKEN]` URL format, where `BASE_URL` looks like this: `https://username:password@FQDN`.
   FQDN is the Fully Qualified Domain Name of the developer portal, for example `allianz.site.devportal.io`.
5. Define the value of the `BASE_URL` in the following format:

   - Add a valid _user name_ and _password_ for the developer portal _separated with a colon `:`_ after the
   _https://_ part of the `BASE_URL` value. **Use an [URL encoder](https://www.url-encode-decode.com/) to convert the**
   **special characters in your password to the acceptable format.** (For example, the password `François`, would be
   encoded as `Fran%C3%A7ois`).
   - After the valid credentials, you must _add an et [`@`] character_, then
   - _type the URL of the developer portal_.

   (Example BASE_URL: `"https://johndoe:Fran%C3%A7ois@allianz.site.devportal.io"`)

6. Paste the [generated token](/admin/guides/groups/generating-url-tokens) for the value of `[TOKEN]`. (For example,
   `bOWQqR8rWrQEAlNNFG0EhV3ejPFT70FPVIN5DuvaK1JxuKA2OkzECGMqloyUyZ4X`)

The cURL command should look something like this:

`curl -X POST -H "Content-Type: application/yaml" -H "X-Project-Id: 1234_testapi" --data-binary @swagger.yaml https://johndoe:Fran%C3%A7ois@allianz.site.devportal.io/dp-trigger/bOWQqR8rWrQEAlNNFG0EhV3ejPFT70FPVIN5DuvaK1JxuKA2OkzECGMqloyUyZ4X`

7. Run the command from the Terminal or another command line tool.

Check the new instance on the developer portal on the _Content_ page.

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
            </br><font color="#f0ad4e">The newly created or the updated API Reference pages are unpublished by default.
            Publish it to make them visible for end-users.
            </font></p>
			</td>
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
					</br><font color="#5cb85c">Now that you have a published API reference page on the developer portal,
					you can <a href="/admin/guides/advanced-api-documentation/uploading-markdown-files-using-curl">add
					supporting documentation to the page (for example, Release notes) generated from plain text Markdown
					files</a>.
               </font></p>
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
<p align="center"><strong><a href="/admin/guides/advanced-api-documentation/api-reference-versioning"
alt="API reference versioning" target="_self"><< API reference versioning</a> |
<a href="/admin/guides/advanced-api-documentation/uploading-markdown-files-using-curl"
alt="Uploading Markdown files using cURL" target="_self">Uploading Markdown files using cURL >></a></strong></p>
