<?php 

	include(realpath(dirname(__FILE__) . "/../../resources/config.php"));
	include($modules['auth']);
	include($modules['friends']);
	include($modules['character']);
	include($modules['battle']);
	session_name($sess_name); session_start();

	auth_check("user");

	// Check for GET data.
	open_html(NULL);
	disp_banner("battle");

	if(isset($_GET['p']) && (
				$_GET['p'] == "battles" ||
				$_GET['p'] == "pending" ||
				$_GET['p'] == "sent" )) {


		$res = M_Battle::get_list($_SESSION['user']->name);

		$template['accepted'] = $res->value['accepted'];
		$template['pending'] = $res->value['pending'];
		$template['sent'] = $res->value['sent'];
		
		$template['page'] = $_GET['p'];

		$template['error'] = "";
		if(isset($_SESSION['error'])) {
			$template['error'] = $_SESSION['error'];
			unset($_SESSION['error']);
		}

		include($pages['battle'] . "/static.php");


	} else {
		
		header("Location: $alias/battle/static.php?p=battles");
	}

	close_html();

	session_write_close();
?>
