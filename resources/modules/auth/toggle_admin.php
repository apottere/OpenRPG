<?php
function toggle_admin($username, $adminval) {

	global $auth_conf;


	mysql_connect($auth_conf['db_loc'], $auth_conf['db_user'], $auth_conf['db_pass']);
	mysql_select_db($auth_conf['db_name']);
	$table = $auth_conf['table'];

	$adminval = plain_escape(!$adminval);
	if($adminval == null) {
		$adminval = 0;
	}

	$username = plain_escape($username);
	$result = mysql_query("update users set admin=$adminval where username='$username';");
	
}
?>
