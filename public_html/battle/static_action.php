<?php 
	
	// Init page.
	include(realpath(dirname(__FILE__) . "/../../resources/config.php"));
	include($modules['auth']);
	include($modules['battle']);
	include($modules['character']);
	session_name($sess_name); session_start();

	// Authenticate.
	auth_check("user");

	// Check POST data.
	if(isset($_POST['accept'])) {
		
		$res = M_Login::check_unique($_POST['username']);
		if($res->code == "error" ) {

			header("Location: $alias/battle/static.php");

		} else {
			$user = $res->value;
			$res = M_Battle::check_exists($_SESSION['user']->name, $user);

			if($res->code == "success") {
				
				$char1 = M_Character::get_char_obj($_SESSION['user']->name)->value;
				$char2 = M_Character::get_char_obj($user)->value;

				M_Battle::accept_battle($_SESSION['user']->name, $user,
						$char1->hp, $char2->hp,
						$char1->magic, $char2->magic,
						$char1->ranged, $char2->ranged,
						$char1->melee, $char2->melee,
						$char1->level, $char2->level,
						mysql_date()
						);

				header("Location: $alias/battle/battle.php?o=$user");

			}

		}
		
	} else if(isset($_POST['deny'])) {

		$res = M_Login::check_unique($_POST['username']);
		if($res->code == "error" ) {
			
			header("Location: $alias/battle/static.php");

		} else {
			$user = $res->value;
			$res = M_Battle::check_exists($_SESSION['user']->name, $user);

			if($res->code == "success") {
				
				M_Battle::deny_battle($_SESSION['user']->name, $user);
				header("Location: $alias/battle/static.php");
			}
		}

	} else {

		header("Location: $alias/battle/static.php");
	
	}

	session_write_close();

?>
