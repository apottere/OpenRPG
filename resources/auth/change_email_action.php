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
	header("Location: $alias/profile/change_email.php");
	exit;
}

$newemail = plain_escape($_POST["newemail"]);

$query = mysql_query("select * from $table where email='$newemail';");

if(!check_email_address($newemail)) {
	$_SESSION['error'] = "Invalid e-mail address, please try again.";
	session_write_close();
	header("Location: $alias/profile/change_email.php");
	exit;

} else if(mysql_num_rows($query) != 0) {
	$_SESSION['error'] = "E-mail is already associated with another account, please try again.";
	session_write_close();
	header("Location: $alias/profile/change_email.php");
	exit;

} else {
	mysql_query("update $table set email='$newemail' where username='$name';");
	mysql_query("update $table set validated=0 where username='$name';");
//	$_SESSION['error'] = "E-mail updated successfully!";
	$_SESSION['email'] = $newemail;
	unset($_SESSION['verified']);
	session_write_close();
	header("Location: $alias/profile/profile.php");
	exit;
}

?>
