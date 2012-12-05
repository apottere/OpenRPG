<?php

function delete_all($username) {

	// Get global conf.
	global $char_conf;
	
	// Connect to DB.
	mysql_connect($char_conf['db_loc'], $char_conf['db_user'], $char_conf['db_pass']);
	mysql_select_db($char_conf['db_name']);
	$table = $char_conf['table'];

	// Get required variables.
	$username = plain_escape($username);

	// Get queries.
	$query = mysql_query("delete from $table where username='$username';");
	

	return new O_Character("success", NULL);
}

?>
