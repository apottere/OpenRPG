<?php
	include(realpath(dirname(__FILE__) . "/../../resources/config.php"));
	session_name($sess_name); session_start();

	auth_check("user");
	open_html(NULL);
	disp_banner("profile");

?>

<h1>
	Change your e-mail here.
</h1>

<?php
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

<?php close_html(); session_write_close(); ?>
