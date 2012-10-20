<?php

include("validate_secure.php");
include("defaults.php");

mysql_connect($db_loc, $db_user, $db_pass);
mysql_select_db($db_name);

$name = plain_escape($_POST["username"]);
$query = mysql_query("select id from $table where username='$name';");
$salt = mysql_fetch_array($query)[0];
$pass = hash_pass($_POST["password"], $salt);
$query = mysql_query("select * from $table where username='$name' and passwd='$pass';");

if(mysql_num_rows($query) == 0) {
	$_SESSION['error'] = "Username or password incorrect, please try again.";
	session_write_close();
	header("Location: login_manager.php?a=login");
	exit;

} else {
	$row = mysql_fetch_array($query);
	$_SESSION['logged_in'] = 'true';
	$_SESSION['user'] = $row[0];
	$_SESSION['email'] = $row[2];
	$_SESSION['datetime'] = $row[4];
	$_SESSION['id'] = $row[5];
	if($row[3] == 1) {
		$_SESSION['admin'] = "true";
	}
	if($row[6] == 1) {
		$_SESSION['verified'] = "true";
	}
}

if(isset($_SESSION['curr_page'])) {
	$page = $_SESSION['curr_page'];
	unset($_SESSION['curr_page']);
	session_write_close();
	header("Location: $page");
	exit;
}

header("Location: index.php");
session_write_close();
exit;

?>
