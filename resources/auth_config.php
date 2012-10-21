<?php
/*
This is a list of default values, DO NOT EDIT THIS LIST.
If you want to change a value, copy the value you want to
change to a new php file, and record the location in the 
variable below.  Any variables defined there will override 
their counterparts here.
*/
$local_auth_config = "local_auth_config.php";

$db_loc = "localhost";
$db_user = "openrpg";
$db_name = "openrpg";
$db_pass = "";
$table = "users";
$authdir = realpath(dirname(__FILE__) . "/auth");
// Second to last is bool, true if viewable iff logged in, 2 for either.
// Last is for banner, 0 for no banner or any other banner value.
$links = array(
	"login" => array("Login", "/login.php", 0, 0),
	"logout" => array("Log out", "/logout.php", 1, 0),
	"timeout" => array("Time Out", "/timeout.php", 1, 0),
	"change" => array("Change Account Info", "/change.php" , 1, "account"),
	"create" => array("Create Account", "/create.php", 0, 0),
	"switch" => array("Switch User", "/switch.php", 1, 0),
	"verify" => array("Verify E-mail", "/verify.php", 1, 0),
	);

if(file_exists($local_auth_config)) {
	include($local_auth_config);
}


function auth_check($type) {
	global $alias, $authdir, $db_loc, $db_user, $db_pass, $db_name;

	if(!isset($_SESSION)) {
		header("Location: $alias/login.php?a=login");
		exit();

	} else if(!isset($_SESSION['logged_in'])) {
		$_SESSION['curr_page'] = $_SERVER['REQUEST_URI'];
		header("Location: $alias/login.php?a=login");
		exit();

	} else if(!isset($_SESSION['verified'])) {
		$_SESSION['curr_page'] = $_SERVER['REQUEST_URI'];
		header("Location: $alias/login.php?a=verify");
		exit();
	}

	mysql_connect($db_loc, $db_user, $db_pass);
	mysql_select_db($db_name);

	$hash = $_SESSION['login_hash'];
	$user = $_SESSION['user'];
	$query = mysql_query("select login_hash from users where login_hash='$hash' and username='$user';");
	if(mysql_num_rows($query) == 0) {
		header("Location: $alias/login.php?a=timeout");
	}

	// Authorize for admin pages.
	if($type == "admin" && !isset($_SESSION["admin"])) {
		header("Location: $alias/index.php");
	}
}
?>
