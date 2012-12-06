<?php

function check_exists($user, $op) {

	global $battle_conf;

	mysql_connect($battle_conf['db_loc'], $battle_conf['db_user'], $battle_conf['db_pass']);
	mysql_select_db($battle_conf['db_name']);
	$table = $battle_conf['table'];

	$query = mysql_query("select accepted from $table where (p1='$user' and p2='$op') or (p1='$op'and p2='$user');");

	if(mysql_num_rows($query) > 0) {

		$temp = mysql_fetch_array($query);
		$temp = $temp[0];

		return new O_Battle("success", $temp);

	} else {

		return new O_Battle("error", NULL);

	}

}
?>
