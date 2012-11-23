<?php

function change_password($user, $salt, $pass, $newpass, $newpass2) {
	
	// Get global conf.
	global $auth_conf;

	// Connect to DB.
	mysql_connect($auth_conf['db_loc'], $auth_conf['db_user']);
	mysql_select_db($auth_conf['db_name']);
	$table = $auth_conf['table'];

	// Get required variables.
	$user = plain_escape($user);
	$salt = plain_escape($salt);
	$pass = hash_pass(plain_escape($password), $salt);
	$newpass = hash_pass(plain_escape($newpass), $salt);
	$newpass2 = hash_pass(plain_escape($newpass2), $salt);

	// Get query.
	$query = mysql_query("select * from $table where username='$user' and passwd='$pass';");

	// Test authentication.
	if(mysql_num_rows($query) == 0) {
		
		// Error and return.
		return new O_Login("error", "Username or password incorrect, please try again."
	}

	// Test new password.
	if($newpass != $newpass2) {
		
		// Error and return.
		return new O_Login("error", "New passwords did not match, please try again."
	}

	// Change password and success.
	mysql_query("update $table set passwd='$newpass' where username='$user';");
	return new O_Login("success", "Password updated successfully!"
}
?>
