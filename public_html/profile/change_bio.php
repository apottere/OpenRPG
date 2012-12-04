<?php

	// Init page.
	include(realpath(dirname(__FILE__) . "/../../resources/config.php"));
	include($modules['auth']);
	include($modules['character']);
	session_name($sess_name); session_start();

	// Authenticate.
	auth_check("user");

	// Handle POST data.
	if(isset($_POST['changeestuff'])) {


		// Change email submitted.
		
		$newstuff = $_POST['newstuff'];

		$user = $_SESSION['user']->name;
		$email = $_SESSION['user']->email;

		$res = M_Character::get_character($user);
		$res['bio'] = $newstuff;
		M_Character::update_character($res);

		header("Location: profile.php");

		

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
		Enter Bio: 
	</h1>
	$error
	<form method="POST">
		<table class="noborder">
		<tr>
			<td><p>Username: </p></td>
			<td><p>$user</p></td>
		</tr>
		<tr>
			<td><p>Bio: </p></td>
			<td><input type="text" name="newstuff" /></td>
		</tr>
		<tr>
			<td><input type="submit" name="changeestuff" value="Change" /></td>
			<td><input type="submit" name="cancelchange" value="Cancel" /></td>
		</tr>
		</table>
	</form>
EOT;

		close_html();
	}

	session_write_close();

?>
