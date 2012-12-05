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
			$res = M_Friends::request($_SESSION['user']->name, $res->value);

			// Check code.
			if($res->code == "error") {

				// Set session error.
				$_SESSION['error'] = $res->value;

			} else {
				$_SESSION['error'] = "Friend request sent.";
			}
		}

	} else if(isset($_POST['denyFriend'])) {

		// Remove friend request.
		$res = M_Friends::deny($_SESSION['user']->name, $_POST['username']);


	} else if(isset($_POST['confirmFriend'])) {
	
		// Confirm friend request.
		$res = M_Friends::confirm($_SESSION['user']->name, $_POST['username']);

	} else if(isset($_POST['remove'])) {
		
		// Delete from friends.
		$res = M_Friends::remove($_SESSION['user']->name, $_POST['username']);

	} else if(isset($_POST['search'])) {
		$p = $_POST['username'];
		header("Location: $alias/profile/profile_look.php?search=$p");
		session_write_close();
		exit;
	}

	header("Location: friends.php");
	session_write_close();

?>
