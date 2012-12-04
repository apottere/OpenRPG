<?php

// API for friends list.
class M_Friends
{
	public static function request($requester, $requested) {

		global $friends_conf;
		include($friends_conf['friendsdir'] . "/request.php");
		return request($requester, $requested);
	}

	public static function respond($username, $requester, $response) {

	}

	public static function get_list($username) {

		global $friends_conf;
		include($friends_conf['friendsdir'] . "/get_list.php");
		return get_list($username);
	}
}
?>
