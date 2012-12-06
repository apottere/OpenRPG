<?php
function get_battle($username, $opponent) {

	global $battle_conf;

	mysql_connect($battle_conf['db_loc'], $battle_conf['db_user'], $battle_conf['db_pass']);
	mysql_select_db($battle_conf['db_name']);
	$table = $battle_conf['table'];

	$user = plain_escape($username);
	$op = plain_escape($opponent);

	$query = mysql_query("select * from $table where (p1='$user' and p2='$op') or (p1='$op' and p2='$user');");

	if(mysql_num_rows($query) <= 0) {
		
		return new O_Battle("error", "Battle does not exist.");

	} else {
		
		$row = mysql_fetch_object($query, 'Battle');
		return new O_Battle("success", $row);

	}

}

?>
