<?php
	echo <<<EOT

<h1>
	Change your username here.
</h1>
EOT;

	if(isset($_SESSION['error'])) {
		echo '<p style="color:RED;">' . $_SESSION['error'] . '</p>';
		unset($_SESSION['error']);
		session_write_close();
	}
	echo <<<EOT
<form method="POST">
	<table class="noborder">
	<tr>
		<td><p>Username: </p></td>
		<td><input type="text" name="username" /></td>
	</tr>
	<tr>
		<td><p>Password: </p></td>
		<td><input type="password" name="password" /></td>
	</tr>
	<tr>
		<td><p>New Username: </p></td>
		<td><input type="text" name="newusername" /></td>
	</tr>
	<tr>
		<td><input type="submit" name="changeusername" value="Change" /></td>
		<td><input type="submit" name="cancelchange" value="Cancel" /></td>
	</tr>
	</table>
</form>
EOT;

?>
