<?php
function get_list($username) {

	// Get global conf.
	global $friends_conf;
	
	// Connect to DB.
	mysql_connect($friends_conf['db_loc'], $friends_conf['db_user'], $friends_conf['db_pass']);
	mysql_select_db($friends_conf['db_name']);
	$table = $friends_conf['table'];

	// Get required variables.
	$username = plain_escape($username);

	// Get queries.
}
?>
