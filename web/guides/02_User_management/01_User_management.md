<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/goal-of-the-document/goal-of-the-document"
alt="Goal of the document" target="_self"><< Goal of the document</a> |
<a href="/admin/guides/user-management/password-policy"
alt="Password policy" target="_self">Password policy >></a></strong></p>

---

# User management

</br>

### Table of Contents

- [Login](#login)
- [Registration](#registration)
- [Roles and permissions](#roles-permissions)
    - [Changing roles](#change-roles)
    - [Deleting users](#delete-users)
- [Related topics](#related-topics)
- [FAQ](#faq)

</br>
## <a id="login"></a>Login
</br>

Site users are able to log in on the site URL by clicking on the _Log in_ menu item on the top-right side of the home
page of the developer portal.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Login"
			src="@guide_path/assets/6877_login_item.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

If you are a registered user, type your username/email address and password combination into the corresponding text
boxes on the appearing page.

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
            </br><font color="#f0ad4e">The password field is case sensitive.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Username and password"
			src="@guide_path/assets/6877_login_page.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

Click _Log in_ to enter the developer portal.

</br>
## <a id="registration"></a>Registration
</br>

<!-- IN THIS CHAPTER (BLUE) NOTIFICATION -->
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#f4f8fa">
			<tr bgcolor="#f4f8fa">
			<td bgcolor="#5bc1de" style="width: 1px"></td>
			<td width="100%"><p><font color="#5bc1de"><strong>In this chapter</strong></font>
            </br><font color="#5bc1de">In this chapter you can learn about how <strong>end users can register</strong>
			on the
			developer portal.</br>The next text walks you through the steps need to be taken to achieve a
			successful registration.</br>It covers both the aspects of end users and site administrators.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Login"
			src="@guide_path/assets/6470_login.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

1. End users can register on the developer portal by clicking on _Log in_ at top right.

2. Then users have to add:

   - their full name,
   - an email address,
   - a username,

   and click the _Create new account_ button.

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
            </br><font color="#f0ad4e">End users can’t set their password yet.
			A confirmation is needed from an administrator to prevent spam activities.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="New account"
			src="@guide_path/assets/6470_newaccount.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

3. From the end user point of view, the registration process ends here.
They get a notification that an administrator has to confirm their apply for an account:

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Confirmation"
			src="@guide_path/assets/6470_confirm.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

4. Now site administrators (or users with _administer users_ permission) can **change the status** of the newly
registered users from _Blocked_ to _Active_ at _People_ (`/admin/people`), then editing the user’s profile.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="User status"
			src="@guide_path/assets/6470_userstatus.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

Administrators can also grant [roles](#roles-permissions) (e.g., Administrator, Content editor, Internal Developer) if
need to.

5. When the administrator activates a user’s account, the user receives an email with a one-time login link, which
enables them to set a password.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Email text"
			src="@guide_path/assets/6470_emailtext.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

6. When users click the **one-time login link** in the email, they are directed to the portal where they see a
notification about the details of the registration process.
When they click the _Log in_ button, they land on their user profile, where they have to set a password.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center"
			alt="One-time password" src="@guide_path/assets/6470_onetime.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

7. Users have to give a password.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Test user"
			src="@guide_path/assets/6470_testuser.png" max-width="800">
            <div align="center"><em><font color="black">The UI where end users can set their password after clicking on
			the one-time login link.</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

8. If the password is strong enough and added properly, the whole registration process ends after the
user clicks on _Save_.
A notification pops up as a confirmation:

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Second confirmation"
			src="@guide_path/assets/6470_second_confirm.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

9. From now on, users can log in using their email address and password.

</br>
## <a id="roles-permissions"></a>Roles and permissions
</br>

End users of the developer portal are grouped into different roles. Unregistered visitors are _Anonymous users_,
while those who walked through the registration process are called _Authenticated users_.

<!-- GOOD TO KNOW (YELLOW) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fcf8f3">
			<td bgcolor="#f0ad4e" style="width: 1px"></td>
			<td width="100%"><p><font color="#f0ad4e"><strong>Good to know</strong></font>
            </br><font color="#f0ad4e">Any permissions granted to the <em>Authenticated user</em> role is given to
			any user who registered to your site.</font></p>
			</td>
		</tr>
	</tbody>
</table>
</br>

Based on your workflow, you may need more sophisticated categories (like Internal Developer, Moderator, Content
Editor), too.

Users within specific roles may have different permissions, restricted or full access to viewing, creating, editing,
deleting contents, and so on.
Those authenticated users who have full access to all the features and tools are called _Administrators_.

Be careful to ensure that only trusted users are given this access and level of control of your site.

If you are an administrator, you can access the _Roles_ and _Permissions_ pages from the _People_ item of the
administrative menu.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="People admin menu option"
			src="@guide_path/assets/6876_people_menu.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

In the _Roles_ or `/admin/people/roles` page, you can add new, or edit, delete existing roles.
Roles are only names, you have to add permissions to make them effective.

<!-- WARNING (RED) NOTIFICATION -->
</br>
<table border="0" cellpadding="8" cellspacing="5" style="width: 100%">
	<tbody>
		<tr bgcolor="#fdf7f7">
			<td bgcolor="#d9534f" style="width: 1px"></td>
			<td width="100%"><p><font color="#d9534f"><strong>Caution</strong></font>
            </br><font color="#d9534f">Do not create other roles on your own. On this level of modifications,
			programming skills are needed and changing those parts of the developer portal needs a practiced
			developer. To learn more about the questioned part(s) or you are sure that some
			modifications have to be completed, contact the project manager.</font></p>
			</td>
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Add or Edit roles."
			src="@guide_path/assets/6876_roles.png" max-width="800">
            <div align="center"><em><font color="black">Add or Edit roles. Don’t forget to save your changes.
			</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

In the _Permissions_ or `/admin/people/permissions` page, you can see all the roles set on the developer portal.
The available permissions are displayed in the list. You can grant or restrict access to the features by changing the
state of the check box under the name of the different roles.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Permission page"
			src="@guide_path/assets/6876_permissions.png"
			max-width="800">
            <div align="center"><em><font color="black">A snippet from the Permissions page. As you can see,
			Administrators have full, while anonymous and authenticated users have differently restricted access to the
			features. You can see a custom role, too, called Content editor.</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

To make the set permissions valid on the developer portal, you have to assign each user to one or more defined role(s).

_Authenticated user_ role is assigned to every registered user after an Administrator confirmed their
application for an account.

</br>
## Changing roles
</br>

1. Select _People_ from the administrative menu, or go straight to `/admin/people`.

2. Look for the name of the user you want to edit in the list.

3. Click on the _Edit_ button in the _Operations_ column.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center"
			alt="The structure of the Serenity Project’s home page."
			src="@guide_path/assets/6876_edit_role.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

4. On the next page, scroll down to find the _Roles_ field, where you can select all the available roles from the list.
(In this example, we assigned the Test User to the Content editor role.)

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="New role"
			src="@guide_path/assets/6876_new_role.png" max-width="800">
            <div align="center"><em><font color="black">As you can see, Authenticated user role is assigned to any
			registered user after an Administrator confirmed their apply for an account.</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

5. Click _Save_ to apply your changes.

6. You can see your settings in the _Roles_ field. (Content editor is displayed.)

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Role setting"
			src="@guide_path/assets/6876_new_role_set.png" max-width="800">
		</tr>
	</tbody>
</table>

</br>
## Deleting users
</br>

1. Select _People_ from the administrative menu, or go straight to `/admin/people`.

2. Look for the name of the user you want to edit in the list.

3. Click on the _Edit_ button in the _Operations_ column.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Edit role"
			src="@guide_path/assets/6876_edit_role.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

4. Scroll down to the bottom of the page and click on the _Cancel account_ link written in red.

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Cancel account"
			src="@guide_path/assets/6876_cancel_acc.png" max-width="800">
		</tr>
	</tbody>
</table>
</br>

5. You can select different options on the appearing page.

6. Select the one you need. (e.g., Delete the account and its content.
**All API apps and API keys owned by this account is deleted from Apigee Edge.**)

7. (optional) Select the _Require email confirmation to cancel account_ if you need confirmation from the user.
(A notification is sent to the user’s email address.)

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="Cancel account undone"
			src="@guide_path/assets/6876_cancel_acc_final.png" max-width="800">
		</tr>
	</tbody>
</table>

<!-- IMAGE -->
</br>
<table align="center" border="1">
	<tbody>
		<tr>
			<td bgcolor="#f3f4f4" align="center"><img align="center" alt="The confirmation email."
			src="@guide_path/assets/6876_confirmation.png" max-width="800">
            <div align="center"><em><font color="black">The confirmation email.</em></font></div></td>
		</tr>
	</tbody>
</table>
</br>

8. Click on _Cancel account_ to apply your changes.

</br>
## <a id="related-topics"></a>Related topics

- [Administrative menu](/admin/guides/administrative-menu/administrative-menu)

</br>
## <a id="faq"></a>FAQ

- [How can I group Authenticated users?](/admin/guides/faq/faq#faq-group-users)

</br>

---
<!-- NAVIGATOR -->
<p align="center"><strong><a href="/admin/guides/goal-of-the-document/goal-of-the-document"
alt="Goal of the document" target="_self"><< Goal of the document</a> |
<a href="/admin/guides/user-management/password-policy"
alt="Password policy" target="_self">Password policy >></a></strong></p>