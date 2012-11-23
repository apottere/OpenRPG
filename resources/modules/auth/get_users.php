<?php
function get_users($pattern) {

	// Get global conf.
	global $auth_conf;

	// Check for null pattern.
	if($pattern == null) {
		$pattern = '.*';
	}

	// Connect to DB.
	mysql_connect($auth_conf['db_loc'], $auth_conf['db_user'], $auth_conf['db_pass']);
	mysql_select_db($auth_conf['db_name']);
	$table = $auth_conf['table'];

	// Get pattern and query.
	$pattern = plain_escape($pattern);
	$result = mysql_query("select * from users where username rlike '$pattern';");

	// Get user array and return.
	$users = array();
	
	if($result != FALSE) {
		while($row = mysql_fetch_array($result)) {
			array_push($users, new User($row));
		}
	}

	return new O_Login("success", $users);

}
?>
