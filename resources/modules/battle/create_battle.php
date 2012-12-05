<?php
function create_battle($p1, $p2, $p1hp, $p2hp) {

	global $battle_conf;

	mysql_connect($battle_conf['db_loc'], $battle_conf['db_user'], $battle_conf['db_pass']);
	mysql_select_db($battle_conf['db_name']);
	$table = $battle_conf['table'];

	$p1 = plain_escape($p1);
	$p2 = plain_escape($p2);
	$p1hp = plain_escape($p1hp);
	$p2hp = plain_escape($p2hp);

	$query = mysql_query("insert into $table (p1, p2, p1hp, p2hp, accepted, date, p1turn, p2turn) values('$p1', '$p2', '$p1hp', '$p2hp', 0, now(), 0, 0);");


	return new O_Battle("success", NULL);

}

?>
