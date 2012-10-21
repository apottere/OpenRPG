<?php
	include(realpath(dirname(__FILE__) . "/../../resources/config.php"));
	session_name($sess_name); session_start();

	auth_check("user");
	open_html(NULL);
	disp_banner("profile");

	$user = $_SESSION['user'];
	if(isset($_SESSION['error'])) {
		echo '<p style="color:RED;">' . $_SESSION['error'] . '</p>';
		unset($_SESSION['error']);
		session_write_close();
	}
?>

<form method="POST" action="../login.php">
	<table class="noborder">
	<tr>
		<td><p>Username: </p></td>
		<td><p><?php echo $user; ?></p></td>
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

<?php close_html(); session_write_close(); ?>
