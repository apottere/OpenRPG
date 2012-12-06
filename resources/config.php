<?php
/*
	This file contains default functions and values for all pages.
	If you would like to change a default value, set it in a 
	different php file, and record that file location below.
*/
$local_config = "local_config.php";

/* DO NOT EDIT BELOW THIS LINE */
################################################################################
/* VARIABLES: */

$modules_dir = "/modules";					// Module directory.
$pages_dir = "/pages";
$alias = "/OpenRPG";						// Apache alias.
$stylesheet = "$alias/styles/global.css";	// Stylesheet location.
$sess_name = "OpenRPG";						// PHP session name.
$blinks = array(
	"home" => array("Home", "/index.php"),
	"friends" => array("Friends", "/friends/friends.php"),
	"profile" => array("Profile", "/profile/profile.php"),
	"battle" => array("Battle", "/battle/battle.php"),
	"admin" => array("Admin", "/admin/admin.php"),
	);										// Dynamic link array.

$modules = array(
	"auth" => (dirname(__FILE__) . $modules_dir . "/auth/auth_config.php"),
	"friends" => (dirname(__FILE__) . $modules_dir . "/friends/friends_config.php"),
	"character" => (dirname(__FILE__) . $modules_dir . "/character/character_config.php"),
	"battle" => (dirname(__FILE__) . $modules_dir . "/battle/battle_config.php"),
	);										// Module array.

$pages = array(
	"login" => (dirname(__FILE__) . $pages_dir . "/login"),
	"home" => (dirname(__FILE__) . $pages_dir . "/home"),
	"profile" => (dirname(__FILE__) . $pages_dir . "/profile"),
	"admin" => (dirname(__FILE__) . $pages_dir . "/admin"),
	"friends" => (dirname(__FILE__) . $pages_dir . "/friends"),
	"battle" => (dirname(__FILE__) . $pages_dir . "/battle"),
	);


// Include local config overrides.
if(file_exists($local_config)) {
	include($local_config);
}


################################################################################
/* FUNCTIONS: */

// Return MySQL-like date.
function mysql_date() {
	return date('Y-m-d H:i:s');
}

// Escape html and mysql.
function plain_escape($str) {
	return mysql_real_escape_string(htmlspecialchars($str));
}

// Open html block (with additions).
function open_html($add) {
	global $stylesheet;

	echo <<<EOT
	<html>
	<head>
		$add
		<title>Open RPG</title>
		<link rel="stylesheet" type="text/css" href="$stylesheet">
	</head>
	<body onload="load()">
		<div class="main">
EOT;

}


// Display dynamically created banner.
function disp_banner($p) {
	global $blinks, $alias;


	// Show/hide admin and find link width percent.
	if($_SESSION['user']->admin != 1) {
		unset($blinks['admin']);
	}

	$user = $_SESSION['user']->name;
	$prct = round((100/count($blinks)), 1);

	// Construct links.
	$links_out = "";
	foreach($blinks as $k => $v) {
		$links_out .= "<td width=\"$prct%\"><p class=\"nav\"><a class=\"nav";
		if(isset($p)) {
			if($k == $p) {
			$links_out .= " selected";
			}
		}
		$links_out .= "\" href=\"$alias$v[1]\">$v[0]</a></p></td>";
	}

	// Echo page.
	echo <<<EOT
	<div class="header_background">
	<div class="header">
	<table class="banner" width=100%>
	<tr>
		<td>
			<h1 class="title">Open RPG</h1>
		</td>
		<td>
			<table class="nav">
			$links_out
			</table>
		</td>

		<td>
			<p class="banner">$user</p>
		</td>
		<td>
			<p><a class="banner" href="/OpenRPG/login.php?a=logout">Log out</a> | <a class="banner" href="/OpenRPG/login.php?a=switch">Switch user</a></p>
		</td>
	</tr>
	</table>

	<table width="100%" class="nav">
	</table>
	</div>
	</div>
	<div class="content">
EOT;
}


// Close html block.
function close_html() {
	echo "</div></div></body></html>";
	
}

?>
