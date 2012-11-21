<?php
function verify($name, $id) {

	// Load global conf.
	global $auth_conf;

	// Connect to DB.
	mysql_connect($auth_conf['db_loc'], $auth_conf['db_user']);
	mysql_select_db($auth_conf['db_name']);
	$table = $auth_conf['table'];

	// Get required variables and queries.
	$user = plain_escape($name);
	$id = plain_escape($id);
	$salt = mysql_fetch_array(mysql_query("select id from $table where username='$user';"))[0];
	$salt = substr($salt, 0, 10);

	// Test id.
	if($id != $salt) {
		
		// Error and return.
		return new O_Login("error", "Incorrect code, please try again.");

	} else {

		// Set verified and return.
		mysql_query("update $table set verified=1 where username='$user';");
		return new O_Login("success", NULL);
	}

}
?>
