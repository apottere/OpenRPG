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


	// Get necessary variables.
	$srcdir = $pages['profile'];
	$user = $_SESSION['user']->name;
	$email = $_SESSION['user']->email;
	$datetime = date('g\:i\:s a \o\n F j\, Y' , strtotime($_SESSION['user']->dob));

	// Set error if exists.
	$error = "";
	if(isset($_SESSION['error'])) {
		$error = $_SESSION['error'];
		unset($_SESSION['error']);
	}

	// Set user type.
	if($_SESSION['user']->admin) {
		$type = "Admin";
	} else {
		$type = "User";
	}

	// Display page.
	include("$srcdir/profile.php");

	// Close html block and end session.
	close_html();
	session_write_close();

?>
