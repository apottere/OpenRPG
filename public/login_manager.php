<?php session_name("orpg"); session_start();

	include("banner.php");
	$srcdir = "../hidden";
	
	if(isset($_POST['login'])) {
		include("$srcdir/auth/login_action.php");

	} else if(isset($_POST['cancelverify'])) {
		include("$srcdir/auth/quick_logout.php");
		exit;

	} else if(isset($_POST['verify'])) {
		include("$srcdir/auth/verify_action.php");
		exit;

	} else if(isset($_POST['requestemail'])) {
		include("$srcdir/auth/email.php");
		exit;

	} else if(isset($_POST['cancelchange'])) {
		header("Location: login_manager.php?a=account");
		exit;

	} else if(isset($_POST['changepassword']) || isset($_POST['changeusername']) || isset($_POST['changeemail'])) {
		include("$srcdir/auth/change_action.php");

	} else if(isset($_POST['create'])) {
		include("$srcdir/auth/create_action.php");

	} else if(isset($_POST['cancelcreate'])) {
		header("Location: login_manager.php?a=login");
		exit;

	} else if(isset($_POST['cancellogin'])) {
		header("Location: /");
		exit;
	
	} else if(isset($_GET['a'])) {
		$a = $_GET['a'];
		include("$srcdir/auth/links.php");
		$page = $links["$a"][1];
		$perms = $links["$a"][2];

		if(isset($_SESSION['logged_in']) && !isset($_SESSION['verified']) && $a != "verify") {
			header("Location: login_manager.php?p=verify");
			exit;

		} else if(isset($_SESSION['logged_in']) && $perms == 0) {
			open_html(NULL);
			include("$srcdir/auth/logged_in.php");
			close_html();

		} else if(!isset($_SESSION['logged_in']) && $perms == 1) {
			open_html(NULL);
			include("$srcdir/auth/logged_in.php");
			close_html();

		} else if(($perms == 1) && $a != "switch" && $a != "logout" && $a != "verify"){
			open_html(NULL);
			disp_banner(NULL);
			include("$srcdir$page");
			close_html();

		} else {
			open_html(NULL);
			include("$srcdir$page");
			close_html();
		}
		
	} else {
		header("Location: login_manager.php?a=login");
		exit;
	}

?>
