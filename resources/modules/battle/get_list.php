<?php
function get_list($username) {

	// Get global conf.
	global $battle_conf;
	
	// Connect to DB.
	mysql_connect($battle_conf['db_loc'], $battle_conf['db_user'], $battle_conf['db_pass']);
	mysql_select_db($battle_conf['db_name']);
	$table = $battle_conf['table'];

	// Get required variables.
	$username = plain_escape($username);

	// Get sent requests.
	$query = mysql_query("select p2,date from $table where p1='$username' and accepted=0;");
	$sent = array();
	while($row = mysql_fetch_array($query)) {
		array_push($sent, $row);
	}

	// Get pending requests.
	$query = mysql_query("select p1 from $table where p2='$username' and accepted=0;");
	$pending = array();
	while($row = mysql_fetch_array($query)) {
		array_push($pending, $row[0]);
	}

	// Get accepted requests.
	$query = mysql_query("select p2,date,p2turn,p1turn from $table where p1='$username' and accepted=1;");

	$accepted = array();
	while($row = mysql_fetch_array($query)) {
		array_push($accepted, $row);
	}

	$query = mysql_query("select p1,date,p1turn,p2turn from $table where p2='$username' and accepted=1;");

	while($row = mysql_fetch_array($query)) {
		array_push($accepted, $row);
	}

	// Success and return list.
	$ret = array(
		"sent" => $sent,
		"pending" => $pending,
		"accepted" => $accepted,
		);

	return new O_Battle("success", $ret);
}
?>
