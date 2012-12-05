<?php 
	
	// Init page.
	include(realpath(dirname(__FILE__) . "/../../resources/config.php"));
	include($modules['auth']);
	include($modules['battle']);
	session_name($sess_name); session_start();

	// Authenticate.
	auth_check("user");

	// Check POST data.
	if(isset($_POST['accept'])) {
		
		$res = M_Login::check_unique($_POST['username']);
		if($res->code == "error" ) {


		} else {
			$user = $res->value;
			$res = M_Battle::check_exists($_SESSION['user']->name, $user);

			if($res->code == "success") {
				
				M_Battle::accept_battle($_SESSION['user']->name, $user);
				header("Locaton: $alias/battle/battle.php?o=$user");

			}

		}
		
	} else if(isset($_POST['deny'])) {

		$res = M_Login::check_unique($_POST['username']);
		if($res->code == "error" ) {


		} else {
			$user = $res->value;
			$res = M_Battle::check_exists($_SESSION['user']->name, $user);

			if($res->code == "success") {
				
				M_Battle::deny_battle($_SESSION['user']->name, $user);
				header("Locaton: $alias/battle/static.php");
			}
		}

	}

	header("Location: static.php");
	session_write_close();

?>
