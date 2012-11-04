<?php
function get_users($pattern) {

	global $auth_conf;

	if($pattern == null) {
		$pattern = '.*';
	}

	mysql_connect($auth_conf['db_loc'], $auth_conf['db_user'], $auth_conf['db_pass']);
	mysql_select_db($auth_conf['db_name']);
	$table = $auth_conf['table'];

	$pattern = plain_escape($pattern);
	$result = mysql_query("select * from users where username rlike '$pattern';");
	$users = array();
	
	if($result != FALSE) {
		while($row = mysql_fetch_array($result)) {
			array_push($users, new User($row));
		}
	}

	return $users;

}
?>
