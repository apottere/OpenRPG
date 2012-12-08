<?php 

	// Include default config and needed modules.
	include(realpath(dirname(__FILE__) . "/../resources/config.php"));
	include($modules['auth']);
	include($modules['character']);
	session_name($sess_name); session_start();

	// Check the user has authenticated.
	auth_check("user");

	// Open HTML tags and display banner.
	open_html(NULL);
	disp_banner("home");

	// Set variables.
	$srcdir = $pages['home'];

	// Diplay page.
	include("$srcdir/home.php");

	// Close HTML and session.

	close_html();

	session_write_close();

?>

