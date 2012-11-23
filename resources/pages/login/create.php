<br /><br /><br />
<div style="text-align: center">
<h1>
	Create a username here.
</h1>
<p>Please enter your e-mail address and your desired username and password.</p>
<p class="error"><?php echo $template['error']; ?></p>
<br />
<form method="POST" action="login.php?a=create">
	<table class="noborder" align="center">
	<tr>
		<td><p>Username: </p></td>
		<td><input type="text" name="username" /></td>
		<td><p style="margin-left:10px"> -- 4-50 characters, alphanumeric</p></td>
	</tr>
	<tr>
		<td><p>Password: </p></td>
		<td><input type="password" name="password" /></td>
	</tr>
	<tr>
		<td><p>Confirm password: </p></td>
		<td><input type="password" name="password2" /></td>
	</tr>
	<tr>
		<td><p>E-mail: </p></td>
		<td><input type="text" name="email" /></td>
	</tr>
	<tr>
		<td><p>Confirm e-mail: </p></td>
		<td><input type="text" name="email2" /></td>
	</tr>
	<tr>
		<td><input type="submit" name="create" value="Create" /></td>
		<td><input type="submit" name="cancelcreate" value="Cancel" /></td>
	</tr>
	</table>
</form>
</div>
