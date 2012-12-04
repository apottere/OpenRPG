<?php 
	
	// Init page.
	include(realpath(dirname(__FILE__) . "/../../resources/config.php"));
	include($modules['auth']);
	include($modules['friends']);
	session_name($sess_name); session_start();

	// Authenticate.
	auth_check("user");

	// Check POST data.
	if(isset($_POST['add'])) {

		// Check name exists.
		$res = M_Login::check_unique($_POST['name']);

		// Check code.
		if($res->code == "error") {
			
			// Set session error.
			$_SESSION['error'] = $res->value;

		} else {

			// Proceed with friend request.
			$res = M_Friends::request($_SESSION['user']->name, $_POST['name']);

			// Check code.
			if($res->code == "error") {

				// Set session error.
				$_SESSION['error'] = $res->value;
			}
		}
	}
	header("Location: friends.php");
	session_write_close();

?>
