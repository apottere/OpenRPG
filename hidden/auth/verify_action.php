<?php
include("validate_secure.php");
include("defaults.php");

mysql_connect($db_loc, $db_user);
mysql_select_db($db_name);
	
$user = $_SESSION['user'];
$id = plain_escape($_POST['id']);

$salt = mysql_fetch_array(mysql_query("select id from $table where username='$user';"))[0];
$salt = substr($salt, 0, 10);

if($id != $salt) {
	$_SESSION['error'] = "Incorrect code, please try again.";
	session_write_close();
	header("Location: login_manager?a=verify");
	exit;
} else {
	mysql_query("update $table set validated=1 where username='$user';");
	$_SESSION['verified'] = "true";
	if(isset($_SESSION['curr_page'])) {
		$page = $_SESSION['curr_page'];
		unset($_SESSION['curr_page']);
		session_write_close();
		header("Location: $page");
		exit;
	} else {
		session_write_close();
		header("Location: index.php");
		exit;
	}
}

?>
