<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/groups/generating-url-tokens"
alt="Generating URL tokens" target="_self"><< Generating URL tokens</a> |
<a href="/admin/guides/advanced-api-documentation/uploading-api-reference-files-using-curl"
alt="Uploading API reference files using cURL" target="_self">Uploading API reference files using cURL >></a></strong></p>

---
# API reference versioning
</br>

Make previous API reference documentation versions available on the developer portal while displaying the current version
by default. To use the API reference versioning feature, you have to define the `x-project-id` and the `version`
key-value pairs in the OpenAPI Specification (also known as OAS or Swagger) files before you upload them to the portal
from the UI or via cURL.

<!-- IN THIS CHAPTER (BLUE) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f4f8fa">
			<td bgcolor="#5bc1de" style="width: 1px"></td>
				<td width="100%"><p><font color="#5bc1de"><strong>In this chapter</strong></font>
					</br><font color="#5bc1de">You can learn how to prepare the OpenAPI Specification files before
                    uploading to make the version selector visible on API reference pages. Read the
                    <a href="/admin/guides/api-documentation/api-reference">API Reference chapter to learn how to upload
                    Swagger files from the UI</a>. The next chapter describes
                    <a href="/admin/guides/advanced-api-documentation/uploading-api-reference-files-using-curl">how to
                    upload or update API reference files via the command line using cURL.</a></font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

1. Open the OpenAPI Specification (also known as OAS or Swagger) JSON or YML file you want to upload with an editor.
2. Add the `x-project-id` key to the second row and define an arbitrary value. (For example, `x-project-id: testapi`,
   `x-project-id: 1234`, or `x-project-id: 1234_testapi`)

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
				<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
					</br><font color="#f0ad4e">The value of this key identifies the API reference documentation and
                    connects the different versions. The value is arbitrary. Make sure you use the same ID anytime you
                    want to upload a new version for an API reference documentation.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

3. Find the `info` object.
4. Set the `version` value according to your needs (For example, `version: v1`, `version: 1.0`). Use consistent format.
5. Save your changes.

<!-- IMAGE WITHOUT CAPTION-->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="An OpenAPI Specification file set for versioning"
			src="@guide_path/assets/10374_swagger_file.png" max-width="800" align="center">
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
					</br><font color="#5cb85c">The OpenAPI Specification file is ready to be uploaded to the developer
                    portal. You can <a href="/admin/guides/api-documentation/api-reference">add the file from the
                    UI</a> or you can
                    <a href="/admin/guides/advanced-api-documentation/uploading-api-reference-files-using-curl">upload
                    it via the command line using cURL.</a></font></p>
			</td>
		</tr>
	</tbody>
</table>

</br>
## <a id="related-topics"></a>Related topics

- [How to add new API reference to the developer portal?](/admin/guides/api-documentation/api-reference#add-api-reference)
- [About the API Reference content type](/admin/guides/api-documentation/api-reference)
- [About the API Description page content type](/admin/guides/api-documentation/api-description)
- [About the API Page Builder page content type](/admin/guides/api-documentation/api-page-builder#api-pb-intro)
- [About the API Basic page](/admin/guides/api-documentation/api-basic-page#api-basic-intro)
- [Page Builder Elements](/admin/guides/non-api-related-content-management/page-builder-elements/page-builder-elements)
- [How to create a landing page for my API?](/admin/guides/api-documentation/api-page-builder#create-api-landing-page)
- [Built-in text editor](/admin/guides/built-in-text-editor/built-in-text-editor)
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
<p align="center"><strong><a href="/admin/guides/groups/generating-url-tokens"
alt="Generating URL tokens" target="_self"><< Generating URL tokens</a> |
<a href="/admin/guides/advanced-api-documentation/uploading-api-reference-files-using-curl"
alt="Uploading API reference files using cURL" target="_self">Uploading API reference files using cURL >></a></strong></p>
