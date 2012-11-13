<?php

	// Init page.
	include(realpath(dirname(__FILE__) . "/../../resources/config.php"));
	include($modules['auth']);
	session_name($sess_name); session_start();

	// Authenticate.
	auth_check("user");

	// Handle POST data.
	if(isset($_POST['changeemail'])) {
		// Change email submitted.
		
		// Call login manager function.
		$res = M_Login::change_email();

		// Handle result.
		if($res == "error") {
			header("Location: change_email.php");
		
		} else {
			$_SESSION['user']->email = $res;
			$_SESSION['user']->verified = 0;

			M_Login::email($_SESSION['user']->name, $_SESSION['user']->email, $_SESSION['user']->id, FALSE); 
			header("Location: profile.php");
		}

	} else if(isset($_POST['cancelchange'])) {
		header("Location: profile.php");
	} else {

		open_html(NULL);
		disp_banner("profile");

		$user = $_SESSION['user']->name;
		$email = $_SESSION['user']->email;
		$error = "";
		if(isset($_SESSION['error'])) {
			$error = '<p style="color:RED;">' . $_SESSION['error'] . '</p>';
			unset($_SESSION['error']);
		}
		echo <<<EOT

	<h1>
		Change your e-mail here.
	</h1>
	$error
	<form method="POST">
		<table class="noborder">
		<tr>
			<td><p>Username: </p></td>
			<td><p>$user</p></td>
		</tr>
		<tr>
			<td><p>Current E-mail: </p></td>
			<td><p>$email</p></td>
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

		close_html();
	}

	session_write_close();

?>
