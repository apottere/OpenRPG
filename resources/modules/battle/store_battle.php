<?php
function store_battle($battle) {

	global $battle_conf;

	mysql_connect($battle_conf['db_loc'], $battle_conf['db_user'], $battle_conf['db_pass']);
	mysql_select_db($battle_conf['db_name']);
	$table = $battle_conf['table'];

	$battle->store();

	return new O_Battle("success", NULL);

}

?>
