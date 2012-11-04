<?php 

include(realpath(dirname(__FILE__) . "/../resources/config.php"));
include($modules['auth']);
session_name($sess_name); session_start();

function logged_in() {
	if(isset($_SESSION['user'])) {
		return TRUE;
	} else {
		return FALSE;
	}
}

if(isset($_GET['a'])) {
	$a = $_GET['a'];
	open_html(NULL);

	switch($a) {
		case "login":
			if(logged_in()) {
				session_write_close();
				header("Location: $alias/login.php?a=logged_in");
			} else {
					
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
			}
			
			break;

		case "logout":
			if(!logged_in()) {
				session_write_close();
				header("Location: $alias/login.php?a=invalid");
			} else {
				Manager::logout();
			}
			break;

		case "switch":
			if(!logged_in()) {
				session_write_close();
				header("Location: $alias/login.php?a=invalid");
			} else {
				Manager::switch_user();
			}
			break;

		case "create":
			if(logged_in()) {
				session_write_close();
				header("Location: $alias/login.php?a=logged_in");
			} else {
				$res = Manager::create();
				if($res == "error") {
					session_write_close();
					header("Location: $alias/login.php?a=create");
				} else if($res == "cancel") {
					session_write_close();
					header("Location: $alias/login.php?a=login");
				} else if($res != null) {
					Manager::email($res[0], $res[1], $res[2], FALSE);
					session_write_close();
					header("Location: $alias/login.php?a=login");
				}
			}
			break;

		case "verify":
			if(!logged_in()) {
				session_write_close();
				header("Location: $alias/login.php?a=invalid");
			} else {
				$res = Manager::verify();

				if($res == "error") {
					session_write_close();
					header("Location: $alias/login.php?a=verify");
				} else if($res == "cancel") {
					Manager::quick_logout();
					session_write_close();
					header("Location: $alias/login.php?a=login");
				} else if($res == "email") {
					Manager::email($_SESSION['user']->name, $_SESSION['user']->email, $_SESSION['user']->id, TRUE);
					session_write_close();
					header("Location: $alias/login.php?a=verify");


				} else if($res == "success") {

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

		case "timeout":
			if(!logged_in()) {
				session_write_close();
				header("Location: $alias/login.php?a=invalid");
			} else {
				Manager::timeout();
				session_write_close();
			}
			break;

		case "logged_in":
			if(!logged_in()) {
				session_write_close();
				header("Location: $alias/login.php?a=invalid");
			} else {
				Manager::logged_in();
				session_write_close();
			}
			break;
			
		default:
			Manager::invalid();
			session_write_close();
			break;
	}
	close_html();

} else {
	session_write_close();
	header("Location: $alias/login.php?a=login");
}

?>
