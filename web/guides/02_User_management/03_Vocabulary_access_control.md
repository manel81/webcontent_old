<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/user-management/password-policy"
alt="Password policy" target="_self"><< Password policy</a> |
<a href="/admin/guides/administrative-menu/administrative-menu"
alt="Administrative menu" target="_self">Administrative menu >></a></strong></p>

---

# Vocabulary access control

</br>

### Table of contents

- [About vocabulary access control](#about-vocabulary)
   - [Actions based on vocabulary permissions](#permissions)
- [Adding terms to vocabularies](#add-terms)
- [Grouping content items](#node-group)
- [Grouping users](#user-group)

</br>
## <a id="about-vocabulary"></a>About vocabulary access control
</br>

Vocabulary access control allows Site administrators to restrict end-users’ access to content items of a selected
content type.

A **vocabulary consists of** different **terms** where each term can be understood as a content visibility rule that
defines different access groups (like Internal, Private, Public).

When a vocabulary is applied to a content type, the
given terms are displayed as selectable items on the edit form of the content type. Selecting one or more terms
restricts the visibility of the content item to that group or groups.

You can handle every content item individually.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Content type node with vocabulary access field."
            src="@guide_path/assets/9520_vocab_access_field_ct_node.png" max-width="800">
            <div align="center"><em><font color="black">An API Basic page with enabled vocabulary access field. Only
            users that are assigned to the selected Private access group can see the content of this page after it’s published.</em>
			</font></div></td>
		</tr>
	</tbody>
</table>
</br>

By default, the visibility of the pages isn't bound to any terms, which means, every end-user can view the published
pages if other access control settings don't restrict them.

One vocabulary can be applied to more than one content type.

Every vocabulary enabled on the developer portal is displayed on the **user profile pages**, too. Site administrators
can assign every registered end-user individually to the access groups (terms). This way, only users that are assigned
to a certain access group (term) can see pages that’s visibility is restricted to the same group.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="User profile page with vocabulary access field."
            src="@guide_path/assets/9520_vocab_access_field_user_node.png" max-width="800">
            <div align="center"><em><font color="black">User profile page (edit form) with enabled vocabulary access
            field. The user is assigned to Private and Public access groups so can see pages that’s visibility is
            restricted to any of these groups.</em>
			</font></div></td>
		</tr>
	</tbody>
</table>
</br>

One end-user can be assigned to more than one access group (term).
End-users assigned to different access groups can see unrestricted pages, too.

</br>
### <a id="permissions"></a>Actions based on vocabulary permissions

Based on the permissions given to a vocabulary, users can perform different actions on content items assigned to their
access group.

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
            </br><font color="#f0ad4e">Permissions are given to a vocabulary when the vocabulary is created, but they
            can be changed later. If you want to know more or change the permissions of a vocabulary, contact the
            Project Manager.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

Every vocabulary have its own permission settings. A vocabulary can have from 0 to 4 permissions.

Permissions:

- _View_: users assigned to the access group that can view-only the content item.

- _Update_: users assigned to the access group that can see the content item are able to edit details of the
   content item (like page title, tags, page builder elements, or reference file).

- _Delete_: users assigned to the access group that can see the content item are able to delete it.

- _Create_: only Site administrators or users with the right permissions can create new content items.

If a content item's visibility isn't restricted to any of the access groups, default visibility and management
permissions remain in effect.

</br>
## <a id="add-terms"></a>Adding terms to vocabularies
</br>

Site Administrators can update and maintain vocabulary terms in the _Taxonomy_ menu.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Taxonomy menu."
            src="@guide_path/assets/9520_taxonomy_menu.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

To add terms to a vocabulary:

1. Go to _Structure_ > _Taxonomy_ and select the vocabulary you need from the fly-out menu.

2. Click _+Add term_.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Click +Add term."
            src="@guide_path/assets/9520_add_term.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

3. Add the _Name_ of the term. This name is displayed on the content type edit forms and on the user profile pages.

4. (optional) Add the description of the term.

5. Click _Save_ to create the new term.

Terms are displayed in alphabetical order on pages by default. You can change the display order by setting their
row weight: listing starts with item of the smallest number.

If you hide row weights, you can also drag the items to the desired places.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Hide row weights."
            src="@guide_path/assets/9520_hide_row_weigths.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

Click _Reset to alphabetical order_ to apply the default order.

<!-- WARNING (RED) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fdf7f7">
			<td bgcolor="#d9534f" style="width: 1px"></td>
			<td width="100%"><p><font color="#d9534f"><b>Caution</b></font>
            </br><font color="#d9534f">If you need to remove a vocabulary from the developer portal, contact the Project
            Manager.</font></p>
			</td>
		</tr>
	</tbody>
</table>

</br>
## <a id="node-group"></a>Grouping content items
</br>

You can assign content items to access groups by marking the check box of the term you need on the edit form of the
content item. You can do it when creating or when later editing a content item.

Only vocabularies applied on the content type are displayed on the edit form.

</br>
## <a id="user-group"></a>Grouping users
</br>

You can assign every registered user to different access groups. Every vocabulary enabled on the developer portal is
displayed on the edit form of user profile page's: you can assign a user to each and any of them by marking the check
box of the terms you need.

User profile edit forms are available under the _People_ menu.

</br>
## Related topics

- [Editing content items](/admin/guides/content-management/content-management#editing-content-items)
- [What content type should I use](/admin/guides/what-content-type-should-i-use/what-content-type-should-i-use)

</br>

---

<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/user-management/password-policy"
alt="Password policy" target="_self"><< Password policy</a> |
<a href="/admin/guides/administrative-menu/administrative-menu"
alt="Administrative menu" target="_self">Administrative menu >></a></strong></p>