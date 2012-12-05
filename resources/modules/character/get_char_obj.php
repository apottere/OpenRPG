<?php
function get_char_obj($user) {


		$con = mysql_connect('localhost', 'openrpg', '');

		mysql_select_db('openrpg');

		$user = plain_escape($user);

		$query = mysql_query("select * from `character` where `username`='$user';");
		$temp = mysql_fetch_array( $query );

		return new O_Character("success", new Character($temp));


}
?>
