<?php

class M_Login
{

	public static function login($username, $password) {

		global $auth_conf;
		include($auth_conf['authdir'] . "/validate_secure.php");
		include($auth_conf['authdir'] . "/login.php");
		return login($username, $password);
	}

	public static function logout() {
		global $auth_conf;
		include($auth_conf['authdir'] . "/logout.php");
		return logout();
	}
	
	public static function create($username, $password, $password2, $email, $email2) {

		global $auth_conf;
		include($auth_conf['authdir'] . "/validate_secure.php");
		include($auth_conf['authdir'] . "/create.php");
		return create($username, $password, $password2, $email, $email2);
	}

	public static function email($name, $email, $id, $msg) {
		global $auth_conf;
		include($auth_conf['authdir'] . "/email.php");
		return email($name, $email, $id, $msg);
	}

	public static function verify() {

		global $auth_conf;
		include($auth_conf['authdir'] . "/validate_secure.php");
		include($auth_conf['authdir'] . "/verify.php");
		return verify();
	}

	public static function timeout() {

		global $auth_conf;
		include($auth_conf['authdir'] . "/timeout.php");
		return timeout();
	}

	public static function invalid() {

		global $auth_conf;
		include($auth_conf['authdir'] . "/invalid.php");
		return invalid();
	}

	public static function logged_in() {

		global $auth_conf;
		include($auth_conf['authdir'] . "/logged_in.php");
		return logged_in();
	}

	public static function change_email() {

		global $auth_conf;
		include($auth_conf['authdir'] . "/validate_secure.php");
		include($auth_conf['authdir'] . "/change_email.php");
		return change_email();
	}

	public static function change_password() {

		global $auth_conf;
		include($auth_conf['authdir'] . "/validate_secure.php");
		include($auth_conf['authdir'] . "/change_password.php");
		return change_password();
	}

	public static function get_users($pattern) {

		global $auth_conf;
		include($auth_conf['authdir'] . "/validate_secure.php");
		include($auth_conf['authdir'] . "/get_users.php");
		return get_users($pattern);
	}

	public static function delete_user($name) {

		global $auth_conf;
		include($auth_conf['authdir'] . "/delete_user.php");
		return delete_user($name);
	}

	public static function toggle_admin($username, $adminval) {

		global $auth_conf;
		include($auth_conf['authdir'] . "/toggle_admin.php");
		return toggle_admin($username, $adminval);
	}
}
?>
