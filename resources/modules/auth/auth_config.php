<?php
/*
	This is a list of default values, DO NOT EDIT THIS LIST.
	If you want to change a value, copy the value you want to
	change to a new php file, and record the location in the 
	variable below.  Any variables defined there will override 
	their counterparts here.
*/

$local_auth_config = "local_auth_config.php";

/* DO NOT EDIT BELOW THIS LINE */
################################################################################
/* VARIABLES: */

$auth_conf = array(
	"authdir" => realpath(dirname(__FILE__)),
	"db_loc" => "localhost",
	"db_user" => "openrpg",
	"db_name" => "openrpg",
	"db_pass" => "",
	"table" => "users",
);

if(file_exists(realpath(dirname(__FILE__)) . "/" . $local_auth_config)) {
	include($local_auth_config);
}

include("M_Login.php");
include("User.php");
include("O_Login.php");

################################################################################
/* FUNCTIONS: */

function auth_check($type) {
	global $alias, $auth_conf;

	if(!isset($_SESSION)) {
		header("Location: $alias/login.php?a=login");
		exit();

	} else if(!isset($_SESSION['user'])) {
		$_SESSION['curr_page'] = $_SERVER['REQUEST_URI'];
		header("Location: $alias/login.php?a=login");
		exit();

	} else if(!($_SESSION['user']->verified == 1)) {
		$_SESSION['curr_page'] = $_SERVER['REQUEST_URI'];
		header("Location: $alias/login.php?a=verify");
		exit();
	}

	mysql_connect($auth_conf['db_loc'], $auth_conf['db_user'], $auth_conf['db_pass']);
	mysql_select_db($auth_conf['db_name']);
	$table = $auth_conf['table'];

	$hash = $_SESSION['user']->login_hash;
	$user = $_SESSION['user']->name;
	$query = mysql_query("select login_hash from $table where login_hash='$hash' and username='$user';");
	if(mysql_num_rows($query) == 0) {
		header("Location: $alias/login.php?a=timeout");
	}

	// Authorize for admin pages.
	if($type == "admin" && ($_SESSION['user']->admin != 1)) {
		header("Location: $alias/index.php");
	}
}
?>

