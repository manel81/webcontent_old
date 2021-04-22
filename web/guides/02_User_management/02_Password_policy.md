<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/user-management/user-management"
alt="User management" target="_self"><< User management</a> |
<a href="/admin/guides/user-management/vocabulary-access-control"
alt="Administrative menu" target="_self">Vocabulary access control >></a></strong></p>

---

# Password policies

</br>

### Prerequisite knowledge

- [Roles and permissions](/admin/guides/user-management/user-management#registration)

</br>
### Table of Contents

- [Setting password policies](#setting-policies)
- [Constraint types and priorities](#constraints)

</br>

<!-- IN THIS CHAPTER (BLUE) NOTIFICATION -->
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f4f8fa">
			<tr bgcolor="#f4f8fa">
			<td bgcolor="#5bc1de" style="width: 1px"></td>
			<td width="100%"><p><font color="#5bc1de"><strong>In this chapter</strong></font>
            </br><font color="#5bc1de">You can learn how to apply password policies and create constraints that enforce
            users to use stronger passwords for their developer portal account.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

**Password policies** are a set of **constraints** (password requirements) that enforce end-users with different roles
to create and use stronger passwords when registering on the developer portal.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Registration form"
            src="@guide_path/assets/8988_password_constraints.png" max-width="800">
            <div align="center"><em><font color="black">Registration form with password constraints.</em></font>
			</div></td>
		</tr>
	</tbody>
</table>
</br>

Only admin users (or other users with the right permissions) can apply password policies.

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
            </br><font color="#f0ad4e">If the password policy isn't available on the developer portal,
            contact the Project Manager.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

## <a id="setting-policies"></a>Setting password policies
</br>

You can set different **password policies for the user role** that are enabled on the developer portal.
To create a password policy, you can select from predefined **constraint** options and then customize their particular
requirements (e.g., number of characters, required numbers, capitalized letters).

1. To set policies, go to _People_ > _Roles_ (`/admin/people/roles`) in the administrative menu.
2. Find the role you want to apply a password policy to and click _Edit_ at the end of the row.

<!-- WARNING (RED) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fdf7f7">
			<td bgcolor="#d9534f" style="width: 1px"></td>
			<td width="100%"><p><font color="#d9534f"><strong>Caution</strong></font>
      </br><font color="#d9534f">You can’t set a password policy for _Anonymous users_ as they don’t have passwords.
	  When a user is registering, the _Authenticated user_ role's policy applies.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Click to edit the user role's settings."
            src="@guide_path/assets/8988_password_enhancement_edit.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

3. Select the _Apply password policy to this role_ check box.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Select the Apply password policy to this role
            check box."
            src="@guide_path/assets/8988_password_enhancement_apply.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

4. The _Password policy_ section appears on the page, where you can set:

   - The number of the **minimum required constraints**: if this number is 1 but you set more than 1 constraints, the
      rest of the constraints appears as optional for end-users when setting their password. If you want all
      the selected constraints to be required, set this number equal to the number of constraints.
   - **Password expiration**: set the number of days till a password is effective, and that how many days before
     expiration should a warning message appear for end-users. Leave the box unchecked to set passwords to never expire.
   - **Constraints**: select lower-case, upper-case, minimum characters, special characters,
      or numbers options as password requirements from the list.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Setting password policy attributes."
            src="@guide_path/assets/8988_password_policy_settings.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

5. Select the first constraint from the drop-down menu and click _Save_

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Select constraints from the drop-down."
            src="@guide_path/assets/8988_password_select_constraint.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

6. Set the attributes of the constraint:

   - Select the _Required_ check box, otherwise the constraint remains optional.
   - The attributes allow you to customize the requirements but are different for each constraint option.

7. Click _Add constraint_.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Customize and add constraint."
            src="@guide_path/assets/8988_password_edit_constraint.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

8. If the password policy is applied, the user role is updated with the settings and the summary of the constraint.
   You can make further modifications or delete the constraints separately.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="The new constraint is applied."
            src="@guide_path/assets/8988_password_constraint_applied.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

9. Add as many constraints as you want (or at least up to the number you set as the _Minimum required constraints_):
   repeat step 5-7.

10. Click _Save_ when you finished.

</br>
## <a id="constraints"></a>Constraint types and priorities
</br>

**Unique constraints**: constraints you can use only once per policy:

- _Minimum characters_
- _Upper-case_
- _Lower-case_
- _Number_

**Non-unique constraints**: more than one of these constraints can be used per policy:

- _Special character_

For example, you can create a policy for registered users with min characters + lower case + special character: `*` + a
special character: `/`, then you can create a policy for content editors with min characters + lower case + number.

**Priority of constraints** applies if other user roles enabled on the developer portal (e.g., Content editor)
besides the default _Anonymous_, _Authenticated_, and _Admin_ roles. Site admins can apply password policies - a set of
constraints - to each role.

What if a user is assigned to more than one roles - and any of these roles is _Authenticated user_ -
but each role has a unique password policy?

In this case, the constraints of the role with the bigger weight (major role) overrides the constraints of the role with
the lighter weight (minor role).
This rule applies only if the **same constraint type** is set for both roles but with different values.

If a minor role has **more than one Non-unique constraint type defined** and a major role has also a Non-unique
constraint type defined but with different values, this constraint of the major role overrides any and all non-unique
constraints of the minor role.

Roles that are major to the _Authenticated user_ role inherit those constraints of the _Authenticated user_
role that they have no defined requirement for.

<!-- WARNING (RED) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fdf7f7">
			<td bgcolor="#d9534f" style="width: 1px"></td>
			<td width="100%"><p><font color="#d9534f"><strong>Caution</strong></font>
            </br><font color="#d9534f">You can’t apply password policy for <strong>Anonymous users</strong> as they
			don’t have passwords. When the user is registering, the Authenticated user role policy is used</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

User roles are ordered by their weight: the first item in the list has the smallest weight. (Click _Show row weight_
at the upper right corner of the list to see the weights)
You can change the order of the roles by dragging and dropping them on the UI. (Only if row weights are hidden.)

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Drag and drop the item you want to change."
            src="@guide_path/assets/8988_password_roles_order.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

**Let's see an example of overriding constraints:**

There are 4 different roles on the developer portal: _Anonymous user_, _Authenticated user_, _Admin_, _Content editor_
where this latter one has the biggest weight.

You apply different password policies for the 3 roles:

- Constraint of the _Authenticated user_: **Minimum character** is _4_, at least 1 **Number**, 1 **Special character**:
  _#_, 2 **Special character** out of: _! ? /_
- Constraints of the _Admin_ user: **Minimum character** is _6_, 1 **Special character** out of: _()_
- Constraints of the _Content editor_ role: **Minimum character** is _8_, 2 **Special character** out of: _% " []_

In case a user is assigned both to the _Admin_ and the _Content editor_ role, their password requirement looks like:

- **Minimum character** is _8_, 2 **Special character** out of: _% " []_, and at least 1 **Number**.

</br>

---
<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/user-management/user-management"
alt="User management" target="_self"><< User management</a> |
<a href="/admin/guides/user-management/vocabulary-access-control"
alt="Administrative menu" target="_self">Vocabulary access control >></a></strong></p>