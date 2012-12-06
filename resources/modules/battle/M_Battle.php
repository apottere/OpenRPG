<?php

// API for friends list.
class M_Battle
{
	public static function get_list($username) {

		global $battle_conf;
		include($battle_conf['battledir'] . "/get_list.php");
		return get_list($username);

	}

	public static function store_battle($battle) {

		global $battle_conf;
		include_once($battle_conf['battledir'] . "/store_battle.php");
		return store_battle($battle);

	}


	public static function remove_all($user) {

		global $battle_conf;
		include($battle_conf['battledir'] . "/remove_all.php");
		return b_remove_all($user);

	}

	public static function accept_battle($user, $op,
						$p1hp, $p2hp, $p1mc, $p2mc,
						$p1rg, $p2rg, $p1ml, $p2ml,
						$p1lvl, $p2lvl, $time ) {

		global $battle_conf;
		include($battle_conf['battledir'] . "/accept_battle.php");
		return accept_battle($user, $op,
						$p1hp, $p2hp, $p1mc, $p2mc,
						$p1rg, $p2rg, $p1ml, $p2ml,
						$p1lvl, $p2lvl, $time );

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

	public static function delete_battle($username, $opponent) {

		global $battle_conf;
		include($battle_conf['battledir'] . "/delete_battle.php");
		return delete_battle($username, $opponent);
	}

	public static function create_battle($p1, $p2, $time) {

		global $battle_conf;
		include($battle_conf['battledir'] . "/create_battle.php");
		return create_battle($p1, $p2, $time);
	}

}

?>
