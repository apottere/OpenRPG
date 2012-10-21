<?php

include("validate_secure.php");
include("defaults.php");

mysql_connect($db_loc, $db_user);
mysql_select_db($db_name);

$name = $_SESSION['user'];
$salt = mysql_fetch_array(mysql_query("select id from $table where username='$name';"))[0];
$pass = hash_pass($_POST["password"], $salt);

$query = mysql_query("select * from $table where username='$name' and passwd='$pass';");
if(mysql_num_rows($query) == 0) {
	$_SESSION['error'] = "Username or password incorrect, please try again.";
	session_write_close();
	header("Location: $alias/profile/change_password.php");
	exit;
}

$newpass = hash_pass($_POST["newpassword"], $salt);
$newpass2 = hash_pass($_POST["newpassword2"], $salt);

if($newpass != $newpass2) {
	$_SESSION['error'] = "New passwords did not match, please try again.";
	session_write_close();
	header("Location: $alias/profile/change_password.php");
	exit;
}

mysql_query("update $table set passwd='$newpass' where username='$name';");
$_SESSION['error'] = "Password updated successfully!";
session_write_close();
header("Location: $alias/profile/profile.php");

?>
