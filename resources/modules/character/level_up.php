<?php
function level_up($username, $exp, $lvl, $hp, $magic, $melee, $ranged) {

		$con = mysql_connect('localhost', 'openrpg', '');

		mysql_select_db('openrpg');

		$query = mysql_query("update `character` set 
				hp=hp + $hp,
				exp=exp + $exp,
				level=level + $lvl,
				melee=melee + $melee,
				magic=magic + $magic,
				`range`=`range` + $ranged 
				where `username`='$username';");
		

		return new O_Character("success", NULL);


}
?>
