<?php 

	include(realpath(dirname(__FILE__) . "/../../resources/config.php"));
	include($modules['auth']);
	include($modules['friends']);
	include($modules['character']);
	include($modules['battle']);
	session_name($sess_name); session_start();

	auth_check("user");

	// Check for GET data.
	if(!isset($_GET['o'])) {
	
		header("Location: battle.php?o=");

	} else {
		
		$op = $_GET['o'];

		open_html(NULL);
		disp_banner("battle");

		if($op != "" && $op != NULL) {

			$res = M_Login::check_unique($op);
			
			if($res->code == "error") {
				
				$_SESSION['error'] = "No user by that name.";
				header("Location: $alias/battle/battle.php?op=");

			} else if($res->code == "success" && $res->value == $_SESSION['user']->name) {

				$_SESSION['error'] = "Get some friends or something.";
				header("Location: $alias/battle/battle.php?op=");

			} else {
				
				init_battle($op);
			
			}



		} else {

			header("Location: $alias/battle/static.php");
		}

		close_html();
	}
	session_write_close();

/* FUNCTIONS ----------------------------------------------------- */

	function init_battle($op) {

		$res = M_Battle::check_exists($_SESSION['user']->name, $op);
		if($res->code == "error") {
			
			create_new_battle($op);
	
		} else {

			if($res->value) {

				display_battle($op);

			} else {
				
				$_SESSION['error'] = "The battle has not been accepted yet.";
				header("Location: static.php");
				
			}

		}

	}


	function create_new_battle($op) {

		$char1 = M_Character::get_char_obj($_SESSION['user']->name)->value;
		$char2 = M_Character::get_char_obj($op)->value;

		M_Battle::create_battle($_SESSION['user']->name, $op, $char1->hp, $char2->hp);

		header("Location: static.php");

	}

	function display_battle($op) {

		$template['error'] = "";
		if(isset($_SESSION['error'])) {
			$template['error'] = $_SESSION['error'];
			unset($_SESSION['error']);
		}

		$template['op'] = $op;
		include($pages['battle'] . "/battle.php");


	}

?>
