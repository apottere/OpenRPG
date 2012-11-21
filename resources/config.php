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
	"battle" => array("Battle", "/battle/battle.php"),
	"profile" => array("Profile", "/profile/profile.php"),
	"admin" => array("Admin Page", "/admin/admin.php"),
	);										// Dynamic link array.

$modules = array(
	"auth" => (dirname(__FILE__) . $modules_dir . "/auth/auth_config.php"),
	"friends" => (dirname(__FILE__) . $modules_dir . "/friends/friends_config.php"),
	);										// Module array.

$pages = array(
	"login" => (dirname(__FILE__) . $pages_dir . "/login"),
	"home" => (dirname(__FILE__) . $pages_dir . "/home"),
	"profile" => (dirname(__FILE__) . $pages_dir . "/profile"),
	);


// Include local config overrides.
if(file_exists($local_config)) {
	include($local_config);
}


################################################################################
/* FUNCTIONS: */

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
	<body>
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
		$links_out .= "<td width=\"$prct%\"";
		if(isset($p)) {
			if($k == $p) {
			$links_out .= " class=\"selected\"";
			}
		}
		$links_out .= "><a href=\"$alias$v[1]\">$v[0]</a></td>";
	}

	// Echo page.
	echo <<<EOT
	<table width=100%>
	<tr>
		<td width=33.3%>
		<br />
			<p class="banner" style="text-align:left;"><a href="/">Home</a></p>
		</td>
		<td width=33.3%>
			<h1 style="text-align:center">Open RPG</h1>
		</td>
		<td width=33.3%>
			<br />
			<p class="banner">Logged in as: $user<br />
			<a href="/OpenRPG/login.php?a=logout">Log out</a> | <a href="/OpenRPG/login.php?a=switch">Switch user</a></p>
		</td>
	</tr>
	</table>

	<table width="100%" class="nav">
		<tr>
			$links_out
		</tr>
	</table>
	<hr />
EOT;
}


// Close html block.
function close_html() {
	echo "</div></body></html>";
}

?>
