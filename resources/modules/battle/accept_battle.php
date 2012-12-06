<?php
function accept_battle($user, $op, $p1hp, $p2hp, $p1mc, $p2mc,
						$p1rg, $p2rg, $p1ml, $p2ml,
						$p1lvl, $p2lvl, $time ) {

	global $battle_conf;

	mysql_connect($battle_conf['db_loc'], $battle_conf['db_user'], $battle_conf['db_pass']);
	mysql_select_db($battle_conf['db_name']);
	$table = $battle_conf['table'];

	$user = plain_escape($user);
	$op = plain_escape($op);

	$string = $time . "---> Battle accepted by " . $user . ".\n";

	$query = mysql_query("update $table set accepted=1,date=now(),
							p1hp='$p2hp', p2hp='$p1hp',
							p1maxhp='$p2hp', p2maxhp='$p1hp',
							p1mc='$p2mc', p2mc='$p1mc',
							p1ml='$p2ml', p2ml='$p1ml',
							p1rg='$p2rg', p2rg='$p1rg',
							p1lvl='$p2lvl', p2lvl='$p1lvl',
							log=concat(log, '$string') 
							where p1='$op' and p2='$user';");
	
	return new O_Battle("success", NULL);

}

?>
