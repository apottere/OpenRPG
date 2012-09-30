<?php
	echo <<<EOT

<h1>
	Change your password here.
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
		<td><p>Existing password: </p></td>
		<td><input type="password" name="password" /></td>
	</tr>
	<tr>
		<td><p>New password: </p></td>
		<td><input type="password" name="newpassword" /></td>
	</tr>
	<tr>
		<td><p>Confirm new password: </p></td>
		<td><input type="password" name="newpassword2" /></td>
	</tr>
	<tr>
		<td><input type="submit" name="changepassword" value="Change" /></td>
		<td><input type="submit" name="cancelchange" value="Cancel" /></td>
	</tr>
	</table>
</form>
EOT;

?>
