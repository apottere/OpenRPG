<?php
class M_Character {

	public static function delete_all($username) {

		global $char_conf;
		include($char_conf['chardir']. "/delete_all.php");
		return delete_all($username);
	}

	public static function get_character($user) {


		$con = mysql_connect('localhost', 'openrpg', '');


		mysql_select_db('openrpg');

		$query = mysql_query("select * from `character` where `username`='$user';");
		$temp = mysql_fetch_array( $query );

		return $temp;

}


	public static function update_character($array){

		//print_r($array);

		$html = $array['html'];	
		$bio=$array['bio'];
		$gender=$array['gender'];
		$picture=$array['picture'];
		$level=$array['level'];
		$exp=$array['exp']; 
		$hp=$array['hp']; 
		$mp=$array['mp']; 
		$melee=$array['melee'];
		$magic=$array['magic']; 
		$range=$array['range'];
		$username=$array['username'];

//		echo $username;
		

		$con = mysql_connect('localhost', 'openrpg', '');


		mysql_select_db('openrpg');


		$query = "update `character` set `gender`='$gender', `html`='$html', `bio`='$bio', `picture`='$picture', `level`='$level', `exp`='$exp', `hp`='$hp', `mp`='$mp', `melee`='$melee', `magic`='$magic', `range`='$range' where `username`='$username';";
		print_r($query);
		mysql_query($query);


	}
}

?>
