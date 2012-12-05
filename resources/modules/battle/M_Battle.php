<?php

// API for friends list.
class M_Battle
{
	public static function get_list($username) {

		global $battle_conf;
		include($battle_conf['battledir'] . "/get_list.php");
		return get_list($username);

	}

	public static function accept_battle($user, $op) {

		global $battle_conf;
		include($battle_conf['battledir'] . "/accept_battle.php");
		return accept_battle($user, $op);

	}

	public static function deny_battle($user, $op) {

		global $battle_conf;
		include($battle_conf['battledir'] . "/deny_battle.php");
		return deny_battle($user, $op);

	}

	public static function check_exists($user, $op) {

		global $battle_conf;
		include($battle_conf['battledir'] . "/check_exists.php");
		return check_exists($user, $op);

	}

	public static function get_battle($username, $opponent) {

		global $battle_conf;
		include($battle_conf['battledir'] . "/get_battle.php");
		return get_battle($username, $opponent);
	}

	public static function create_battle($p1, $p2, $p1hp, $p2hp) {

		global $battle_conf;
		include($battle_conf['battledir'] . "/create_battle.php");
		return create_battle($p1, $p2, $p1hp, $p2hp);
	}

}

?>
