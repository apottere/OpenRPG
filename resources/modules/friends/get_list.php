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

	// Get sent requests.
	$query = mysql_query("select requested from $table where requester='$username' and confirmed=0;");
	$sent = array();
	while($row = mysql_fetch_array($query)) {
		array_push($sent, $row);
	}

	// Get pending requests.
	$query = mysql_query("select requested from $table where requested='$username' and confirmed=0;");
	$pending = array();
	while($row = mysql_fetch_array($query)) {
		array_push($pending, $row);
	}

	// Get accepted requests.
	$query = mysql_query("select requested from $table where (requester='$username' or requested='$username') and confirmed=1;");
	$accepted = array();
	while($row = mysql_fetch_array($query)) {
		array_push($accepted, $row);
	}

	// Success and return list.
	$ret = array(
		"sent" => $sent,
		"pending" => $pending,
		"accepted" => $accepted,
		);

	return new O_Friends("success", $ret);
}
?>
