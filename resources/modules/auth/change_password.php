<?php

function change_password() {
	global $auth_conf;

	mysql_connect($auth_conf['db_loc'], $auth_conf['db_user']);
	mysql_select_db($auth_conf['db_name']);
	$table = $auth_conf['table'];

	$user = $_SESSION['user']->name;
	$salt = mysql_fetch_array(mysql_query("select id from $table where username='$user';"))[0];
	$pass = hash_pass($_POST["password"], $salt);

	$query = mysql_query("select * from $table where username='$user' and passwd='$pass';");
	if(mysql_num_rows($query) == 0) {
		$_SESSION['error'] = "Username or password incorrect, please try again.";
		return "error";
	}

	$newpass = hash_pass($_POST["newpassword"], $salt);
	$newpass2 = hash_pass($_POST["newpassword2"], $salt);

	if($newpass != $newpass2) {
		$_SESSION['error'] = "New passwords did not match, please try again.";
		return "error";
	}

	mysql_query("update $table set passwd='$newpass' where username='$user';");
	$_SESSION['error'] = "Password updated successfully!";
	return "success";

}
?>
