<?php
function request($requester, $requested) {

	// Get global conf.
	global $friends_conf;
	
	// Connect to DB.
	mysql_connect($friends_conf['db_loc'], $friends_conf['db_user'], $friends_conf['db_pass']);
	mysql_select_db($friends_conf['db_name']);
	$table = $friends_conf['table'];

	// Get required variables.
	$username = plain_escape($requester);
	$requested = plain_escape($requested);

	// Get queries.
	$query = mysql_query("select requester from $table where requester='$username' and requested='$requested';");
	$query2 = mysql_query("select requester from $table where requester='$requested' and requested='$username';");

	// Check for errors.
	if(strtolower($username) == strtolower($requested)) {

		// Error and return.
		return new O_Friends("error", "You must be lonely.");

	} else if(mysql_num_rows($query) || mysql_num_rows($query2)) {
		
		// Error and return.
		return new O_Friends("error", "A request for that friend was already submitted.");
	}

	// Make friend request and return.
	mysql_query("insert into $table (requester, requested, confirmed, date) values('$username', '$requested', 0, now());");

	return new O_Friends("success", NULL);
}
?>
