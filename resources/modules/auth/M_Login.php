<?php

class M_Login
{

	public static function login($username, $password) {

		global $auth_conf;
		include($auth_conf['authdir'] . "/validate_secure.php");
		include($auth_conf['authdir'] . "/login.php");
		return login();
	}

	public static function logout() {
		global $auth_conf;
		include($auth_conf['authdir'] . "/logout.php");
		return logout();
	}
	
	public static function switch_user() {
		global $auth_conf;
		include($auth_conf['authdir'] . "/switch.php");
		return switch_user();
	}

	
	public static function create() {
		if(isset($_POST['cancelcreate'])) {
			return "cancel";
		}

		global $auth_conf;
		include($auth_conf['authdir'] . "/validate_secure.php");
		include($auth_conf['authdir'] . "/create.php");
		return create();
	}

	public static function email($name, $email, $id, $msg) {
		global $auth_conf;
		include($auth_conf['authdir'] . "/email.php");
		return email($name, $email, $id, $msg);
	}

	public static function verify() {
		if(isset($_POST['cancelverify'])) {
			return "cancel";
		} else if(isset($_POST['requestemail'])) {
			return "email";
		}

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

	public static function quick_logout() {

		global $auth_conf;
		include($auth_conf['authdir'] . "/quick_logout.php");
		return quick_logout();
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
