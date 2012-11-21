<?php
function change_email($user, $pass, $salt, $email) {

	// Get global conf.
	global $auth_conf;
		
	// Connect to DB.
	mysql_connect($auth_conf['db_loc'], $auth_conf['db_user']);
	mysql_select_db($auth_conf['db_name']);
	$table = $auth_conf['table'];

	// Get required variables.
	$user = plain_escape($user);
	$salt = plain_escape($salt);
	$pass = hash_pass(plain_escape($_POST["password"]), $salt);
	$newemail = plain_escape($email);

	// Get password query.
	$query = mysql_query("select * from $table where username='$user' and passwd='$pass';");

	// Test password.
	if(mysql_num_rows($query) == 0) {
		
		// Error and return.
		return new O_Login("error", "Username or password incorrect, please try again.");
	}

	// Get email query.
	$query = mysql_query("select * from $table where email='$newemail';");

	// Check email result.
	if(!check_email_address($newemail)) {
		
		// Error and return.
		return new O_Login("error", "Invalid e-mail address, please try again.");

	} else if(mysql_num_rows($query) != 0) {
		
		// Error and return.
		return new O_Login("error", "E-mail is already associated with another account, please try again.");

	} else {

		// Success and return email.
		mysql_query("update $table set email='$newemail', verified=0 where username='$user';");
		return new O_Login("success", $newemail);
	}
}

?>
