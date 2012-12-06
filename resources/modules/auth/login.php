<?php
function login($username, $password) {

	// Get global conf.
	global $auth_conf;

	// Connect to DB.
	mysql_connect($auth_conf['db_loc'], $auth_conf['db_user'], $auth_conf['db_pass']);
	mysql_select_db($auth_conf['db_name']);
	$table = $auth_conf['table'];

	// Get required variables and queries.
	$name = plain_escape($username);
	$query = mysql_query("select id from $table where username='$name';");
	$salt = mysql_fetch_array($query)[0];
	$pass = hash_pass(plain_escape($password), $salt);
	$query = mysql_query("select * from $table where username='$name' and passwd='$pass';");

	// Check query return.
	if(mysql_num_rows($query) == 0) {

		// Error, login failed.
		return new O_Login("error", "Username or password incorrect, please try again.");

	} else {
		
		// Login success, set hash and return new user row.
		$login_hash = sha1(uniqid());
		mysql_query("update users set login_hash='$login_hash' where username='$name';");
		$query = mysql_query("select * from $table where username='$name' and passwd='$pass';");
		$row = mysql_fetch_array($query);

		return new O_Login("success", new User($row));
	}
}
?>
