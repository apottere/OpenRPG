<?php
	// Last is bool, true if viewable iff logged in, 2 for both
	$links = array(
		"login" => array("Login", "/login.php", 0),
		"logout" => array("Log out", "/logout.php", 1),
		"change" => array("Change Account Info", "/change.php" , 1),
		"create" => array("Create Account", "/create.php", 0),
		"switch" => array("Switch User", "/switch.php", 1),
		"account" => array("Account Info", "/account.php", 1),
		"verify" => array("Verify E-mail", "/verify.php", 1),
	);
?>
