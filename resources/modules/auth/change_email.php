<?php
function change_email() {
	global $auth_conf;
		
	mysql_connect($auth_conf['db_loc'], $auth_conf['db_user']);
	mysql_select_db($auth_conf['db_name']);
	$table = $auth_conf['table'];

	$user = $_SESSION['user']->name;
	$salt = $_SESSION['user']->id;
	$pass = hash_pass(plain_escape($_POST["password"]), $salt);

	$query = mysql_query("select * from $table where username='$user' and passwd='$pass';");
	if(mysql_num_rows($query) == 0) {
		$_SESSION['error'] = "Username or password incorrect, please try again.";
		return "error";
	}

	$newemail = plain_escape($_POST["newemail"]);

	$query = mysql_query("select * from $table where email='$newemail';");

	if(!check_email_address($newemail)) {
		$_SESSION['error'] = "Invalid e-mail address, please try again.";
		return "error";

	} else if(mysql_num_rows($query) != 0) {
		$_SESSION['error'] = "E-mail is already associated with another account, please try again.";
		return "error";

	} else {
		mysql_query("update $table set email='$newemail', verified=0 where username='$user';");

		$_SESSION['error'] = "E-mail updated successfully!";
		return $newemail;
	}
}

?>
