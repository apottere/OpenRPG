<?php 

include(realpath(dirname(__FILE__) . "/../resources/config.php"));
session_name($sess_name); session_start();
include($modules['auth']);

if(isset($_GET['a'])) {
	$a = $_GET['a'];
	open_html(NULL);

	switch($a) {
		case "login":
			$res = Manager::login();

			if(isset($_SESSION['error'])) {
				session_write_close();
				header("Location: $alias/login.php?a=login");

			} else if(isset($res)) {
				if($res == "cancel") {
					session_write_close();
					header("Location: /");
				} else {
					$_SESSION['user'] = $res;
					
					$page = "$alias/index.php";
					if(isset($_SESSION['curr_page'])) {
						$page = $_SESSION['curr_page'];
						unset($_SESSION['curr_page']);
					}
					session_write_close();
					header("Location: $page");
				}
			}
			
			break;

		case "logout":
			Manager::logout();
			break;

		case "switch":
			Manager::switch_user();
			break;

		case "create":
			$res = Manager::create();
			if($res == "error") {
				session_write_close();
				header("Location: $alias/login.php?a=create");
			} else if($res == "cancel") {
				session_write_close();
				header("Location: $alias/login.php?a=login");
			} else if($res != null) {
				Manager::email($res);
				session_write_close();
				header("Location: $alias/login.php?a=login");
			}
			break;

		case "verify":
			$res = Manager::verify();

			if($res == "error") {
				session_write_close();
				header("Location: $alias/login.php?a=verify");
			} else if($res == "cancel") {
				session_write_close();
				header("Location: $alias/login.php?a=switch");
			} else if($res == "success") {

				$page = "$alias/index.php";
				if(isset($_SESSION['curr_page'])) {
					$page = $_SESSION['curr_page'];
					unset($_SESSION['curr_page']);
				}
				session_write_close();
				header("Location: $page");

			}

		default:
			session_write_close();
			header("$alias/login.php?a=login");
			break;
	}
	close_html();
} else {
	session_write_close();
	header("$alias/login.php?a=login");
}

?>
