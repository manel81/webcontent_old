<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/groups/managing-groups"
alt="Managing groups" target="_self"><< Managing groups</a> |
<a href="/admin/guides/advanced-api-documentation/api-reference-versioning"
alt="API reference versioning" target="_self">API reference versioning >></a></strong></p>

---
# Generating URL tokens
</br>

<!-- IN THIS CHAPTER (BLUE) NOTIFICATION -->
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f4f8fa">
			<td bgcolor="#5bc1de" style="width: 1px"></td>
				<td width="100%"><p><font color="#5bc1de"><strong>In this chapter</strong></font>
					</br><font color="#5bc1de">You can learn how to generate URL tokens for a selected group to upload
					and update API reference and supporting API documentation files in JSON, YML, and MarkDown format
					using cURL.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

1. In the administrative menu, go to _Groups_ > _List_. Or go straight to `/admin/group`.
2. Click the name of the group to which you want to generate the URL token, or
   [create a new group](/admin/guides/groups/managing-groups#creating-groups).
3. Click the _Tokens_ tab on the appearing page.
4. Click the _Create Token_ button if you don't find an existing token.

<!-- IMAGE WITHOUT CAPTION-->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Create Token"
			src="@guide_path/assets/10208_create_token.png" max-width="800" align="center">
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
            </br><font color="#f0ad4e">These URL tokens on the developer portal never expire. If you have an existing
            token you can use it to upload API reference files, you don't need to create a new one. In case you have
            a URL token already, skip steps 5-6.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

5. Give a _Title_ to the token.
6. Click _Save_ to generate the token. The set data with the generated link appears on the _Tokens_ page. Now, you can
   send API Reference files referring to this token.
7. Copy the token (the latter part of the link after `dp-trigger/`) to your clipboard:
   (For example, if the generated link is
   `https://name-of-the-portal.apiportals.org/dp-trigger/q4AeyXwGs2N2KrYtfvRX19LQ6Ef6u03gUfSwfVKE4836aCiBKnQw8ZR3NERW25ts`,
   the token is **q4AeyXwGs2N2KrYtfvRX19LQ6Ef6u03gUfSwfVKE4836aCiBKnQw8ZR3NERW25ts**).

<!-- IMAGE WITHOUT CAPTION-->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img alt="Token URL"
			src="@guide_path/assets/10208_token_url.png" max-width="800" align="center">
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
					</br><font color="#5cb85c">You can use the generated token to
					<a href="/admin/guides/advanced-api-documentation/uploading-api-reference-files-using-curl">upload
					OpenAPI Specification (also known as Swagger) files in JSON or YML</a> and
					<a href="/admin/guides/advanced-api-documentation/uploading-markdown-files-using-curl">supporting
					documentation files in Markdown format</a> using cURL.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

</br>
## <a id="related-topics"></a>Related topics

- [Administrative menu](/admin/guides/administrative-menu/administrative-menu)
- [User management](/admin/guides/user-management/user-management)
- [Managing groups](/admin/guides/groups/managing-groups)
- [Password policy](/admin/guides/user-management/password-policy)
- [Vocabulary access control](/admin/guides/user-management/vocabulary-access-control)
- [API reference versioning](/admin/guides/advanced-api-documentation/api-reference-versioning)
- [Uploading API reference files using cURL](/admin/guides/advanced-api-documentation/uploading-api-reference-files-using-curl)
- [Uploading Markdown files using cURL](/admin/guides/advanced-api-documentation/uploading-markdown-files-using-curl)

</br>
## <a id="faq"></a>FAQ

- [How can I group Authenticated users?](/admin/guides/faq/faq#faq-group-users)

</br>

---
<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/groups/managing-groups"
alt="Managing groups" target="_self"><< Managing groups</a> |
<a href="/admin/guides/advanced-api-documentation/api-reference-versioning"
alt="API reference versioning" target="_self">API reference versioning >></a></strong></p>
