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
		
		$inject = "<script> function load() { document.getElementById('DIV1').scrollTop =document.getElementById('DIV1').scrollHeight; } </script>";

		open_html($inject);
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


		M_Battle::create_battle($_SESSION['user']->name, $op, mysql_date());

		header("Location: static.php");

	}


	function display_battle($op) {
		
		global $pages;

		$template['error'] = "";
		if(isset($_SESSION['error'])) {
			$template['error'] = $_SESSION['error'];
			unset($_SESSION['error']);
		}

		$template['op'] = $op;
		$res = M_Battle::get_battle($_SESSION['user']->name, $op);
		$template['battle'] = $res->value;

		include($pages['battle'] . "/battle.php");

	}

	function healthbar($prct) {
		$percent = floor($prct);
		$notpercent = 100-$percent;

		?>

		<table class="healthbar" >
		   <tr>
			   <td style="padding: 0px; background-color:green; width:<?php echo $percent; ?>%;"></td>
			   <td style="padding: 0px; background-color:red; width:<?php echo $notpercent; ?>%;"></td>
		   </tr>
	   </table>

	   <?php

	}

	function display_buttons($p, $pt, $inverted) {
		
//		echo "P: " . $p . "PT: " . $pt; exit;

		if($pt != "") {
			$disabled = "disabled=\"disabled\"";
		} else {
			$disabled = "";
		}

		?>

		<td></td>

		<form method="POST" action="battle_action.php">
		<input type="hidden" name="op" value="<?php echo $p; ?>" />
		<input type="hidden" name="inverted" value="<?php echo $inverted; ?>" />

		<td>
			<input <?php echo $disabled ?> type="submit" name="magic" value="Magic Attack" />
		</td>
		<td>
			<input <?php echo $disabled ?> type="submit" name="ranged" value="Ranged Attack" />
		</td>
		<td>
			<input <?php echo $disabled ?> type="submit" name="melee" value="Melee Attack" />
		</td>
		</form>

		<td></td>

		<?php

	}

	function choose_color($p, $inverted) {

		$green = "#DFD";
		$red = "#FFCBCB";

		if($inverted) {
			if($p == 2) {
				return $green;
			} else {
				return $red;
			}
		} else {
			if($p == 2) {
				return $red;
			} else {
				return $green;
			}
		}


	}


?>
