<br /> <br /> <br />
<h1 align="center">
	This page requires authentication!
</h1>
<p align="center">If you have already registered, please log in.  If not, <a href="login.php?a=create">create an account</a> or go back to <a href="/">the homepage</a>.</p>

<p class="error"><?php echo $template['error']; ?></p>

<br />
<table class="noborder" align="center">
	<form method="POST" action="login.php?a=login">
	<tr>
		<td><p>Username: </p></td><td><input type="text" name="username" /></td>
	</tr>
	<tr>
		<td><p>Password: </p></td><td><input type="password" name="password" /></td>
	</tr>
	<tr>
		<td><input type="submit" name="login" value="Log in" /></td>
		<td><input type="submit" name="cancellogin" value="Cancel" /></td>
	</tr>
	</form>
</table>
