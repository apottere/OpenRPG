<?php
	$blinks = array(
		"home" => array("Home", "/index.php"),
		"friends" => array("Friends", "/friends/friends.php"),
		"battle" => array("Battle", "/battle/battle.php"),
		"account" => array("Profile", "/account/account.php"),
	);

	if(isset($_SESSION['admin'])) {
		$blinks["admin"] = array("Admin Page", "/account/account.php");
	}

?>
