<?php

class Manager
{

	public static function login() {
		if(isset($_POST['cancellogin'])) {
			return "cancel";
		}

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

	public static function email($name, $email, $id) {
		global $auth_conf;
		include($auth_conf['authdir'] . "/email.php");
		return email($name, $email, $id);
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
}
?>
