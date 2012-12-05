<?php
function confirm($username, $requester) {

	// Get global conf.
	global $friends_conf;
	
	// Connect to DB.
	mysql_connect($friends_conf['db_loc'], $friends_conf['db_user'], $friends_conf['db_pass']);
	mysql_select_db($friends_conf['db_name']);
	$table = $friends_conf['table'];

	// Get required variables.
	$username = plain_escape($username);
	$requester = plain_escape($requester);

	// Get queries.
	$query = mysql_query("update $table set confirmed=1 where requester='$requester' and requested='$username';");

	return new O_Friends("success", NULL);
}
?>
