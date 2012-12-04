<?php 
	
	// Init page.
	include(realpath(dirname(__FILE__) . "/../../resources/config.php"));
	include($modules['auth']);
	include($modules['friends']);
	session_name($sess_name); session_start();

	// Authenticate.
	auth_check("user");

	// Get friends from database.
	$res = M_Friends::get_list($_SESSION['user']->name);

	// Handle return value and set template variables.
	$template['sent'] = $res->value['sent'];
	$template['pending'] = $res->value['pending'];
	$template['accepted'] = $res->value['accepted'];

	$template['user'] = $_SESSION['user']->name;
	$template['error'] = "";

	if(isset($_SESSION['error'])) {
		$template['error'] = $_SESSION['error'];
		unset($_SESSION['error']);
	}

	// Open HTML and banner.
	open_html(NULL);
	disp_banner("friends");

	include($pages['friends'] . "/friends.php");

	// Close HTML and session.
	close_html();
	session_write_close();

?>
