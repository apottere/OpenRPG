<?php
	if(isset($_GET['s'])) {
		$s = $_GET['s'];
	} else {
		$s = "password";
	}

	$user = $_SESSION['user'];
	$email = $_SESSION['email'];

	if($s == "password") {
		include("$srcdir/auth/change_password.php");

	} else if($s == "email") {
		include("$srcdir/auth/change_email.php");
	}

?>
