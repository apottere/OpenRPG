<?php
	// Last is bool, true if viewable iff logged in, 2 for both
	$links = array(
		"login" => array("Login", "/auth/login.php", 0),
		"logout" => array("Log out", "/auth/logout.php", 1),
		"change" => array("Change Account Info", "/auth/change.php" , 1),
		"create" => array("Create Account", "/auth/create.php", 0),
		"switch" => array("Switch User", "/auth/switch.php", 1),
		"account" => array("Account Info", "/auth/account.php", 1),
		"verify" => array("Verify E-mail", "/auth/verify.php", 1),
	);
?>
