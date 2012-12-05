<?php

// API for friends list.
class M_Friends
{
	public static function request($requester, $requested) {

		global $friends_conf;
		include($friends_conf['friendsdir'] . "/request.php");
		return request($requester, $requested);
	}

	public static function deny($username, $requester) {
		
		global $friends_conf;
		include($friends_conf['friendsdir'] . "/deny.php");
		return deny($username, $requester);

	}

	public static function remove($username, $requester) {
		
		global $friends_conf;
		include($friends_conf['friendsdir'] . "/remove.php");
		return remove($username, $requester);

	}

	public static function confirm($username, $requester) {
		
		global $friends_conf;
		include($friends_conf['friendsdir'] . "/confirm.php");
		return confirm($username, $requester);

	}

	public static function get_list($username) {

		global $friends_conf;
		include($friends_conf['friendsdir'] . "/get_list.php");
		return get_list($username);
	}
}
?>
