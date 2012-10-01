<?php 

	include("page_defaults.php");
	session_name($sess_name); session_start();
	
	if(isset($_POST['login'])) {
		include("$authdir/login_action.php");

	} else if(isset($_POST['cancelverify'])) {
		include("$authdir/quick_logout.php");
		exit;

	} else if(isset($_POST['verify'])) {
		include("$authdir/verify_action.php");
		exit;

	} else if(isset($_POST['requestemail'])) {
		include("$authdir/email.php");
		exit;

	} else if(isset($_POST['cancelchange'])) {
		header("Location: login_manager.php?a=account");
		exit;

	} else if(isset($_POST['changepassword']) || isset($_POST['changeusername']) || isset($_POST['changeemail'])) {
		include("$authdir/change_action.php");

	} else if(isset($_POST['create'])) {
		include("$authdir/create_action.php");

	} else if(isset($_POST['cancelcreate'])) {
		header("Location: login_manager.php?a=login");
		exit;

	} else if(isset($_POST['cancellogin'])) {
		header("Location: /");
		exit;
	
	} else if(isset($_GET['a'])) {
		$a = $_GET['a'];
		include("$authdir/links.php");
		$page = $links["$a"][1];
		$perms = $links["$a"][2];

		if(isset($_SESSION['logged_in']) && !isset($_SESSION['verified']) && $a != "verify") {
			header("Location: login_manager.php?p=verify");
			exit;

		} else if(isset($_SESSION['logged_in']) && $perms == 0) {
			open_html(NULL);
			include("$authdir/logged_in.php");
			close_html();

		} else if(!isset($_SESSION['logged_in']) && $perms == 1) {
			open_html(NULL);
			include("$authdir/logged_in.php");
			close_html();

		} else if(($perms == 1) && $a != "switch" && $a != "logout" && $a != "verify"){
			open_html(NULL);
			disp_banner(NULL, $links_loc, $alias);
			include("$authdir$page");
			close_html();

		} else {
			open_html(NULL);
			include("$authdir$page");
			close_html();
		}
		
	} else {
		header("Location: login_manager.php?a=login");
		exit;
	}

?>
