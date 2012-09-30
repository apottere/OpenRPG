<?php
	echo <<<EOT

<h1>
	Change your e-mail here.
</h1>
EOT;
	$user = $_SESSION['user'];
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
		<td><p>$user</p></td>
	</tr>
	<tr>
		<td><p>Password: </p></td>
		<td><input type="password" name="password" /></td>
	</tr>
	<tr>
		<td><p>New E-mail: </p></td>
		<td><input type="text" name="newemail" /></td>
	</tr>
	<tr>
		<td><input type="submit" name="changeemail" value="Change" /></td>
		<td><input type="submit" name="cancelchange" value="Cancel" /></td>
	</tr>
	</table>
</form>
EOT;

?>
