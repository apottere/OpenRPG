<?php

	if(!isset($_SESSION['logged_in'])) {
        $_SESSION['curr_page'] = $_SERVER['REQUEST_URI'];
		header("Location: /Andy/login_manager.php?a=login");

	} else if(!isset($_SESSION['verified'])) {
        $_SESSION['curr_page'] = $_SERVER['REQUEST_URI'];
		header("Location: /Andy/login_manager.php?a=verify");

	} else {
		$user = $_SESSION['user'];
	}

function disp_banner($links, $p, $user) {
	$prct = round((100/count($links)), 1);
	echo <<<EOT
		<html>
			<head>
				<title>Andy@ModelofNothing</title>
				<link rel="stylesheet" type="text/css" href="/styles/global.css">
			</head>
			<body>
			<table width=100%>
			<tr>
				<td width=33.3%>
					<br />
					<p class="banner" style="text-align:left;"><a href="/">ModelofNothing Home</a></p>
				</td>
				<td width=33.3%>
					<h1 style="text-align:center">Andy@ModelofNothing</h1>
				</td>
				<td width=33.3%>
					<br />
					<p class="banner">Logged in as: $user<br />
					<a href="/Andy/login_manager.php?a=logout">Log out</a> | <a href="/Andy/login_manager.php?a=switch">Switch user</a> | <a href="/Andy/login_manager.php?a=account">Account information</a></p>
				</td>
			</tr>
			</table>
			<table width="100%" class="nav">
			<tr>
EOT;
	foreach($links as $k => $v) {
		echo "<td width=\"$prct%\"";
		if(isset($p)) {
			if($k == $p) {
			echo " class=\"selected\"";
			}
		}
		echo "><a href=\"/Andy$v[1]\">$v[0]</a></td>";
	}
	echo '</tr></table><hr />';

}


function close_html() {
	echo "</body></html>";
}

?>
