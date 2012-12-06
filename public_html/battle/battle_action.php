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
	if( isset($_POST['magic']) ||
			isset($_POST['ranged']) ||
			isset($_POST['melee']) ) {
		
		$res = M_Login::check_unique($_POST['op']);
		if($res->code == "error" ) {

			header("Location: $alias/battle/battle.php");

		} else {

			$op = $res->value;
			$res = M_Battle::check_exists($_SESSION['user']->name, $op);

			if($res->code == "success") {
				
				$inverted = plain_escape($_POST['inverted']);
				$battle = M_Battle::get_battle($_SESSION['user']->name, $op)->value;

				if( ($inverted && ($battle->p2turn != "")) ||
					(!$inverted && ($battle->p1turn != "")) ) {

					header("Location: $alias/battle/battle.php");

				} else {

					if(isset($_POST['magic'])) {
						$attk = "magic";

					} else if(isset($_POST['ranged'])) {
						$attk = "ranged";

					} else if(isset($_POST['melee'])) {
						$attk = "melee";

					}

					game_logic($battle, $inverted, $attk);

				}

			} else {

				header("Location: $alias/battle/battle.php");
			}
		}
		
	} else {

		header("Location: $alias/battle/battle.php");
	
	}

	session_write_close();


/* FUNCTIONS --------------------------------------------------- */

	function game_logic($battle, $inverted, $attk) {
		global $alias;

		if($inverted) {
			$battle->p2turn = $attk;
			$user = $battle->p2;
		} else {
			$battle->p1turn = $attk;
			$user = $battle->p1;
		}

		$battle->log .= mysql_date() . "---> " . $user . " has selected an attack.\n";

		M_Battle::store_battle($battle);
		$_SESSION['error'] = "Attack recorded successfully.";
		

		if($battle->p1turn != "" && $battle->p2turn != "") {

			battle_evaluate($battle);

		}

		header("Location: $alias/battle/battle.php");
	}
	

	function battle_evaluate($battle) {
		
		$p1name = $battle->p1;
		$p2name = $battle->p2;

		$p1 = $battle->p1turn;
		$p2 = $battle->p2turn;

		$advantage = 0;
		$log = "";
		
		if($p1 == "magic") {
			$p1attk = $battle->p1mc;
			$log .= mysql_date() . "---> \t" . $p1name . " used magic at power " . $p1attk . ".\n";


			if($p2 == "ranged") {
				$p2attk = $battle->p2rg;
				$log .= mysql_date() . "---> \t" . $p2name . " used ranged at power " . $p2attk . ".\n";

				$advantage = 1;

			} else if($p2 == "melee") {
				$p2attk = $battle->p2ml;
				$log .= mysql_date() . "---> \t" . $p2name . " used melee at power " . $p2attk . ".\n";

				$advantage = 2;

			} else if($p2 == "magic") {
				$p2attk = $battle->p2mc;
				$log .= mysql_date() . "---> \t" . $p2name . " used magic at power " . $p2attk . ".\n";
				$advantage = 0;
			}



		} else if($p1 == "ranged") {
			$p1attk = $battle->p1rg;
			$log .= mysql_date() . "---> \t" . $p1name . " used ranged at power " . $p1attk . ".\n";



			if($p2 == "magic") {
				$p2attk = $battle->p2mc;
				$log .= mysql_date() . "---> \t" . $p2name . " used magic at power " . $p2attk . ".\n";

				$advantage = 2;

			} else if($p2 == "melee") {
				$p2attk = $battle->p2ml;
				$log .= mysql_date() . "---> \t" . $p2name . " used melee at power " . $p2attk . ".\n";

				$advantage = 1;

			} else if($p2 == "ranged") {
				$p2attk = $battle->p2rg;
				$log .= mysql_date() . "---> \t" . $p2name . " used ranged at power " . $p2attk . ".\n";
				$advantage = 0;
			}



		} else if($p1 == "melee") {
			$p1attk = $battle->p1ml;
			$log .= mysql_date() . "---> \t" . $p1name . " used melee at power " . $p1attk . ".\n";



			if($p2 == "magic") {
				$p2attk = $battle->p2mc;
				$log .= mysql_date() . "---> \t" . $p2name . " used magic at power " . $p2attk . ".\n";

				$advantage = 1;

			} else if($p2 == "ranged") {
				$p2attk = $battle->p2rg;
				$log .= mysql_date() . "---> \t" . $p2name . " used ranged at power " . $p2attk . ".\n";

				$advantage = 2;

			} else if($p2 == "melee") {
				$p2attk = $battle->p2ml;
				$log .= mysql_date() . "---> \t" . $p2name . " used melee at power " . $p2attk . ".\n";
				$advantage = 0;

			}


		}
		
		if($advantage == 0) {

			$log .= mysql_date() . "---> \tNo advantage.  " . $p1name . " deals " . $p1attk . " " . $p1 . " dmg and " . $p2name . " deals " . $p2attk . " " . $p2 . " dmg.\n";
		} else if($advantage == 1) {
			$p1attk = round($p1attk + sqrt($p1attk) + 0.5, 1);

			$log .= mysql_date() . "---> \tAdvantage " . $p1name . ".  " . $p1name . " deals " . $p1attk . " " . $p1 . " dmg and " . $p2name . " deals " . $p2attk . " " . $p2 . " dmg.\n";

		} else if($advantage == 2) {
			$p2attk = round($p2attk + sqrt($p2attk) + 0.5, 1);

			$log .= mysql_date() . "---> \tAdvantage " . $p2name . ".  " . $p1name . " deals " . $p1attk . " " . $p1 . " dmg and " . $p2name . " deals " . $p2attk . " " . $p2 . " dmg.\n";


		}

		if($p1attk > $p2attk) {
			$dmg = $p1attk - $p2attk;
			$battle->p2hp -= $dmg;
			$log .= mysql_date() . "---> \t" . $p1name . " hits " . $p2name . " for " . $dmg . " hp.\n";

		} else if($p2attk > $p1attk) {
			$dmg = $p2attk - $p1attk;
			$battle->p1hp -= $dmg;
			$log .= mysql_date() . "---> \t" . $p2name . " hits " . $p1name . " for " . $dmg . " hp.\n";


		} else if($p1attk == $p2attk) {
			$log .= mysql_date() . "---> \tNo hit is landed.\n";

		}

		$battle->p1turn = "";
		$battle->p2turn = "";
		$battle->log .= $log;

		$log = "";

		if($battle->p1hp <= 0) {
			$log .= mysql_date() . "---> " . $p2name . " wins!\n";
			M_Character::level_up($p2name, 5, 1, 1, 1, 1, 1);
			M_Battle::delete_battle($p1name, $p2name);
			

		} else if($battle->p2hp <= 0) {
			$log .= mysql_date() . "---> " . $p1name . " wins!\n";
			M_Character::level_up($p1name, 5, 1, 1, 1, 1, 1);
			M_Battle::delete_battle($p1name, $p2name);

		} else {

			M_Battle::store_battle($battle);
		}

		$_SESSION['error'] = $log;

	}





?>
