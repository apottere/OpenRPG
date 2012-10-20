<?php
	// Second to last is bool, true if viewable iff logged in, 2 for either.
	// Last is for banner, 0 for no banner or any other banner value.
	$links = array(
		"login" => array("Login", "/login.php", 0, 0),
		"logout" => array("Log out", "/logout.php", 1, 0),
		"change" => array("Change Account Info", "/change.php" , 1, "account"),
		"create" => array("Create Account", "/create.php", 0, 0),
		"switch" => array("Switch User", "/switch.php", 1, 0),
		"verify" => array("Verify E-mail", "/verify.php", 1, 0),
	);
?>
