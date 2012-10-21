<br /> <br /> <br />
<h1 align="center">
	This page requires authentication!
</h1>
<p align="center">If you have already registered, please log in.  If not, <a href="login.php?a=create">create an account</a> or go back to <a href="/">the homepage</a></p>
<?php
	if(isset($_SESSION['error'])) {
		echo '<p class="error">' . $_SESSION['error'] . "</p>";
		unset($_SESSION['error']);
		session_write_close();
	}
?>
<br />
<table class="noborder" align="center">
<form method="POST" action="login.php">
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
