<?php

function check_friends($username, $friend) {

	// Get global conf.
	global $friends_conf;
	
	// Connect to DB.
	mysql_connect($friends_conf['db_loc'], $friends_conf['db_user'], $friends_conf['db_pass']);
	mysql_select_db($friends_conf['db_name']);
	$table = $friends_conf['table'];

	// Get required variables.
	$username = plain_escape($username);
	$friend = plain_escape($friend);

	// Get queries.
	$query = mysql_query("select confirmed from $table where (requested='$username' and requester='$friend') or (requester='$username' and requested='$friend');");

	if(mysql_num_rows($query) <= 0) {
		
		return new O_Friends("error", NULL);

	} else {
		$val = mysql_fetch_array($query)[0];
		return new O_Friends("success", $val);
	
	}
}

?>
