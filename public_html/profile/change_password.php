<?php

include(realpath(dirname(__FILE__) . "/../../resources/config.php"));
include($modules['auth']);
session_name($sess_name); session_start();

auth_check("user");

if(isset($_POST['changepassword'])) {

	$res = M_Login::change_password($_SESSION['user']->name, $_SESSION['user']->id, $_POST['password'], $_POST['newpassword'], $_POST['newpassword2']);

	if($res->code == "error") {
		$_SESSION['error'] = $res->value;
		session_write_close();
		header("Location: change_password.php");
	
	} else {
		$_SESSION['error'] = $res->value;
		session_write_close();

		header("Location: profile.php");
	}

} else if(isset($_POST['cancelchange'])) {
	header("Location: profile.php");

} else {

	open_html(NULL);
	disp_banner("profile");

	$user = $_SESSION['user']->name;
	$error = "";
	if(isset($_SESSION['error'])) {
		$error = '<p style="color:RED;">' . $_SESSION['error'] . '</p>';
		unset($_SESSION['error']);
		session_write_close();
	}

	echo <<<EOT
$error
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

	close_html(); 
}

session_write_close();
?>
