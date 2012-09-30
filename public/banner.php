<?php

function auth_check() {
	if(!isset($_SESSION)) {
		header("Location: /OpenRPG/index.php");
		exit;

	} else if(!isset($_SESSION['logged_in'])) {
        $_SESSION['curr_page'] = $_SERVER['REQUEST_URI'];
		header("Location: /OpenRPG/login_manager.php?a=login");

	} else if(!isset($_SESSION['verified'])) {
        $_SESSION['curr_page'] = $_SERVER['REQUEST_URI'];
		header("Location: /OpenRPG/login_manager.php?a=verify");

	} else {
		$user = $_SESSION['user'];
	}
}

function open_html($add) {
	echo <<<EOT
	<html>
	<head>
		$add
		<title>Open RPG</title>
		<link rel="stylesheet" type="text/css" href="/OpenRPG_styles/global.css">
	</head>
	<body>
		<div class="main">
EOT;

}

function disp_banner($p) {
	include("/home/andrew/public_html/testing/public_html/hidden/banner/links.php");
	$user = $_SESSION['user'];
	$prct = round((100/count($blinks)), 1);
	echo <<<EOT
			<table width=100%>
			<tr>
				<td width=33.3%>
				<br />
					<p class="banner" style="text-align:left;"><a href="/">ModelofNothing Home</a></p>
				</td>
				<td width=33.3%>
					<h1 style="text-align:center">Open RPG</h1>
				</td>
				<td width=33.3%>
					<br />
					<p class="banner">Logged in as: $user<br />
					<a href="/OpenRPG/login_manager.php?a=logout">Log out</a> | <a href="/OpenRPG/login_manager.php?a=switch">Switch user</a> | <a href="/OpenRPG/login_manager.php?a=account">Account information</a></p>
				</td>
			</tr>
			</table>
			<table width="100%" class="nav">
			<tr>
EOT;
	foreach($blinks as $k => $v) {
		echo "<td width=\"$prct%\"";
		if(isset($p)) {
			if($k == $p) {
			echo " class=\"selected\"";
			}
		}
		echo "><a href=\"/OpenRPG$v[1]\">$v[0]</a></td>";
	}
	echo "</tr></table><hr />";

}

function close_html() {
	echo "</div></body></html>";
}

?>
