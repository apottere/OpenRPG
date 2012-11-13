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
				header("Location: $alias/login.php?a=logged_in");

			} else {

				if(isset($_POST['cancellogin'])) {
					header("Location: /");

				} else if(isset($_POST['login'])) {
					$res = M_Login::login();

					if($res->code == "error") {
						header("Location: $alias/login.php?a=login");

					} else if($res->code == "success")) {

						$_SESSION['user'] = $res->value;
							
						$page = "$alias/index.php";
						if(isset($_SESSION['curr_page'])) {
							$page = $_SESSION['curr_page'];
							unset($_SESSION['curr_page']);
						}

						header("Location: $page");

					}

				} else {

					if(isset($_SESSION['error'])) {
						M_Login()::login($_SESSION['error']);

					} else {
						M_Login()::login();
					}
				}
			}
			
			break;

		case "logout":
			if(!logged_in()) {
				session_write_close();
				header("Location: $alias/login.php?a=invalid");
			} else {
				M_Login::logout();
			}
			break;

		case "switch":
			if(!logged_in()) {
				session_write_close();
				header("Location: $alias/login.php?a=invalid");
			} else {
				M_Login::switch_user();
			}
			break;

		case "create":
			if(logged_in()) {
				session_write_close();
				header("Location: $alias/login.php?a=logged_in");
			} else {
				$res = M_Login::create();
				if($res == "error") {
					session_write_close();
					header("Location: $alias/login.php?a=create");
				} else if($res == "cancel") {
					session_write_close();
					header("Location: $alias/login.php?a=login");
				} else if($res != null) {
					M_Login::email($res[0], $res[1], $res[2], FALSE);
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
				$res = M_Login::verify();

				if($res == "error") {
					session_write_close();
					header("Location: $alias/login.php?a=verify");
				} else if($res == "cancel") {
					M_Login::quick_logout();
					session_write_close();
					header("Location: $alias/login.php?a=login");
				} else if($res == "email") {
					M_Login::email($_SESSION['user']->name, $_SESSION['user']->email, $_SESSION['user']->id, TRUE);
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
				M_Login::timeout();
				session_write_close();
			}
			break;

		case "logged_in":
			if(!logged_in()) {
				session_write_close();
				header("Location: $alias/login.php?a=invalid");
			} else {
				M_Login::logged_in();
				session_write_close();
			}
			break;
			
		default:
			M_Login::invalid();
			session_write_close();
			break;
	}

	close_html();
	session_write_close();

} else {
	session_write_close();
	header("Location: $alias/login.php?a=login");
}

?>
