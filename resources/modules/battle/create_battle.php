<?php
function create_battle($p1, $p2, $time) {

	global $battle_conf;

	mysql_connect($battle_conf['db_loc'], $battle_conf['db_user'], $battle_conf['db_pass']);
	mysql_select_db($battle_conf['db_name']);
	$table = $battle_conf['table'];

	$p1 = plain_escape($p1);
	$p2 = plain_escape($p2);
	
	$string = $time . "---> Battle requested by " . $p1 . ".\n";

	$query = mysql_query("insert into $table (p1, p2, accepted, date, log) values('$p1', '$p2', 0, now(), '$string');");


	return new O_Battle("success", NULL);

}

?>
