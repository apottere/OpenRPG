<?php
function check_unique($username) {

	// Get global conf.
	global $auth_conf;
	
	// Connect to DB.
	mysql_connect($auth_conf['db_loc'], $auth_conf['db_user'], $auth_conf['db_pass']);
	mysql_select_db($auth_conf['db_name']);
	$table = $auth_conf['table'];

	// Query user.
	$name = plain_escape($username);
	$query = mysql_query("select username from users where username='$name';");

	// Check results.
	if(mysql_num_rows($query) != 1) {

		// Error and return.
		return new O_Login("error", "No single user found with that name.");

	} else {
		
		// Success and exit.
		return new O_Login("success", mysql_fetch_array($query)[0]);
	}
}
?>
