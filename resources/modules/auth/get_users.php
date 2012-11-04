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
	$result = mysql_query("select username, email, admin, created, id, verified from users where username rlike '$pattern';");
	$users = array();
	
	if($result != FALSE) {
		while($row = mysql_fetch_array($result)) {
			array_push($users, $row);
		}
	}

	return $users;

}
?>
