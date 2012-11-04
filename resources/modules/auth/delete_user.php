<?php
function delete_user($name) {

	global $auth_conf;
	
	mysql_connect($auth_conf['db_loc'], $auth_conf['db_user'], $auth_conf['db_pass']);
	mysql_select_db($auth_conf['db_name']);
	$table = $auth_conf['table'];

	$name = plain_escape($name);
	mysql_query("delete from users where username='$name';");
}
?>
