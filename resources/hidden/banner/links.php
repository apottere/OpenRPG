<?php
	$blinks = array(
		"home" => array("Home", "/index.php"),
		"friends" => array("Friends", "/friends/friends.php"),
		"battle" => array("Battle", "/battle/battle.php"),
		"profile" => array("Profile", "/profile/profile.php"),
	);

	if(isset($_SESSION['admin'])) {
		$blinks["admin"] = array("Admin Page", "/admin/admin.php");
	}

?>
