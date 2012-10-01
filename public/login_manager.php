<?php 

	include("page_defaults.php");
	session_name($sess_name); session_start();
	
	// Check for POST data.
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
		header("Location: profile/profile.php");
		exit;

	} else if(isset($_POST['changepassword'])) {
		include("$authdir/change_password_action.php");

	} else if(isset($_POST['changeemail'])) {
		include("$authdir/change_email_action.php");

	} else if(isset($_POST['create'])) {
		include("$authdir/create_action.php");

	} else if(isset($_POST['cancelcreate'])) {
		header("Location: login_manager.php?a=login");
		exit;

	} else if(isset($_POST['cancellogin'])) {
		header("Location: /");
		exit;
	
	// Else handle argument.
	} else if(isset($_GET['a'])) {
		$a = $_GET['a'];
		include("$authdir/links.php");

		if(isset($links["$a"])) {
			$page = $links["$a"][1];
			$perms = $links["$a"][2];
			$banner_type = $links["$a"][3];
		} else {
			header("Location: login_manager.php?a=login");
		}

		// Check user is verified.
		if(isset($_SESSION['logged_in']) && !isset($_SESSION['verified']) && $a != "verify") {
			header("Location: login_manager.php?p=verify");
			exit;

		// Check if user has correct state for page.
		} else if(isset($_SESSION['logged_in']) && $perms == 0) {
			open_html(NULL);
			include("$authdir/logged_in.php");
			close_html();

		// Check if user has correct state for page.
		} else if(!isset($_SESSION['logged_in']) && $perms == 1) {
			open_html(NULL);
			include("$authdir/logged_in.php");
			close_html();

		// Load page with banner.
		} else if($banner_type != "0"){
			open_html(NULL);
			disp_banner($banner_type, $links_loc, $alias);
			include("$authdir$page");
			close_html();

		// Load page without banner.
		} else {
			open_html(NULL);
			include("$authdir$page");
			close_html();
		}
		
	// Else go to login.
	} else {
		header("Location: login_manager.php?a=login");
		exit;
	}

?>
