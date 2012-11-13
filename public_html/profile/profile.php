<?php 

	// Init page.
	include(realpath(dirname(__FILE__) . "/../../resources/config.php"));
	include($modules['auth']);
	session_name($sess_name); session_start();

	// Authenticate.
	auth_check("user");

	// Open html block and banner.
	open_html(NULL);
	disp_banner("profile");


	// Get necessary variables from session.
	$user = $_SESSION['user']->name;
	$email = $_SESSION['user']->email;
	$datetime = date('g\:i\:s a \o\n F j\, Y' , strtotime($_SESSION['user']->dob));

	// Set error if exists.
	$error = "";
	if(isset($_SESSION['error'])) {
		$error = '<p style="color:RED;">' . $_SESSION['error'] . '</p>';
		unset($_SESSION['error']);
	}

	// Set user type.
	if($_SESSION['user']->admin) {
		$type = "Admin";
	} else {
		$type = "User";
	}

	// Echo page.
	echo <<<EOT
	<h1>Welcome to your account management page!</h1>
	$error
	<table>
	<tr>
		<td><p>Account: </p></td><td><p style="margin-left:7px">$type</p></td>
	</tr>
	<tr>
		<td><p>D.O.B: </p></td><td><p style="margin-left:7px">$datetime</p></td>
	</tr>
	<tr>
		<td><p>Username: </p></td><td><p style="margin-left:7px">$user</p></td>
	</tr>
	<tr>
		<td><p>Password: </p></td><td><p style="margin-left:7px">[Redacted]</p></td><td><a style="margin-left:7px" class="nav" href="change_password.php">change</a></td>
	</tr>
	<tr>
		<td><p>E-mail: </p></td><td><p style="margin-left:7px">$email</p></td><td><a style="margin-left:7px" class="nav" href="change_email.php">change</a></td>
	</tr>
	</table>
EOT;

	// Close html block and end session.
	close_html();
	session_write_close();
?>
