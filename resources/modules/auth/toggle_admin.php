<?php
function toggle_admin($username, $adminval) {

	// Load global conf.
	global $auth_conf;

	// Connect to DB.
	mysql_connect($auth_conf['db_loc'], $auth_conf['db_user'], $auth_conf['db_pass']);
	mysql_select_db($auth_conf['db_name']);
	$table = $auth_conf['table'];

	// Get required variables.
	$adminval = plain_escape(!$adminval);

	// Correct possible null.
	if($adminval == null) {
		$adminval = 0;
	}

	// Update adminval.
	$username = plain_escape($username);
	$result = mysql_query("update users set admin=$adminval where username='$username';");

	// If admin revoked, invalidate session.
	if(!$adminval) {
		$result = mysql_query("update users set login_hash=NULL where username='$username';");
	}
	
}
?>
