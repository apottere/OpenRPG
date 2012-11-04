<?php
/*
	This file contains default functions and values for all pages.
	If you would like to change a default value, override it in a 
	different php file, and record that file location below.
*/
$local_config = "local_config.php";

/* DO NOT EDIT BELOW THIS LINE */

// VARIABLES:

$modules_dir = "/modules";
$alias = "/OpenRPG";	// Apache alias.
$stylesheet = "$alias/styles/global.css";	//Stylesheet location.
$sess_name = "OpenRPG";		// PHP session name.
$blinks = array(
	"home" => array("Home", "/index.php"),
	"friends" => array("Friends", "/friends/friends.php"),
	"battle" => array("Battle", "/battle/battle.php"),
	"profile" => array("Profile", "/profile/profile.php"),
	"admin" => array("Admin Page", "/admin/admin.php"),
	);


$modules = array(
	"auth" => (dirname(__FILE__) . $modules_dir . "/auth/auth_config.php"),
);

if(file_exists($local_config)) {
	include($local_config);
}

// FUNCTIONS:

function plain_escape($str) {
	return mysql_real_escape_string(htmlspecialchars($str));
}

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

function disp_banner($p) {
	global $blinks, $alias;

	$user = $_SESSION['user']->name;
	$prct = round((100/count($blinks)), 1);
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
EOT;
	if($_SESSION['user']->admin != 1) {
		unset($blinks['admin']);
	}

	foreach($blinks as $k => $v) {
		echo "<td width=\"$prct%\"";
		if(isset($p)) {
			if($k == $p) {
			echo " class=\"selected\"";
			}
		}
		echo "><a href=\"$alias$v[1]\">$v[0]</a></td>";
	}
	echo "</tr></table><hr />";

}

function close_html() {
	echo "</div></body></html>";
}

?>
