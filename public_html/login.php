<?php 

// Init page.
include(realpath(dirname(__FILE__) . "/../resources/config.php"));
include($modules['auth']);
session_name($sess_name); session_start();
$srcdir = $pages['login'];

// Check if a user is logged in.
function logged_in() {
	if(isset($_SESSION['user'])) {
		return TRUE;
	} else {
		return FALSE;
	}
}

// Checks if user is verified.
function verified() {
	if($_SESSION['user']->verified) {
		return TRUE;
	} else {
		return FALSE;
	}
}

// Check for url argument.
if(isset($_GET['a'])) {

	// Get variable, open html, and switch on it.
	$a = $_GET['a'];
	open_html(NULL);

	switch($a) {

		case "login":

			// Check for logged in.
			if(logged_in()) {
				header("Location: $alias/login.php?a=invalid");

			} else {

				// Otherwise check POST data.
				if(isset($_POST['cancellogin'])) {
					
					// Cancel log in, return to home.
					header("Location: /");

				} else if(isset($_POST['login'])) {

					// Get POST credentials and log in.
					$res = M_Login::login($_POST['username'], $_POST['password']);
					// Test return code.
					if($res->code == "error") {

						// Error, return to login.
						$_SESSION['error'] = $res->value;
						header("Location: $alias/login.php?a=login");

					} else if($res->code == "success") {

						// Success, log user in and return to desired page.
						$_SESSION['user'] = $res->value;
							
						$page = "$alias/index.php";
						if(isset($_SESSION['curr_page'])) {
							$page = $_SESSION['curr_page'];
							unset($_SESSION['curr_page']);
						}

						header("Location: $page");

					}

				} else {

					// Else display login page.
					$error = "";
					if(isset($_SESSION['error'])) {
						$error = $_SESSION['error'];
						unset($_SESSION['error']);
					}
					include("$srcdir/login.php");
				}
			}
			
			break; // End login.

		case "logout":

			// Check for logged in.
			if(!logged_in()) {
				header("Location: $alias/login.php?a=invalid");

			} else {

				// Else log user out.
				M_Login::logout();
				header("Refresh: 5; url=/");
				unset($_SESSION['user']);
				session_unset();
				include("$srcdir/logout.php");
			}

			break; // End logout.

		case "switch":

			// Check for logged in.
			if(!logged_in()) {
				header("Location: $alias/login.php?a=invalid");

			} else {
				
				// Otherwise switch user.
				M_Login::logout();
				header("Refresh: 3; url=login.php?a=login");
				unset($_SESSION['user']);
				session_unset();
				include("$srcdir/switch.php");
			}

			break; // End switch.

		case "create":

			// Check for logged in.
			if(logged_in()) {
				header("Location: $alias/login.php?a=invalid");

			} else {

				// Check for POST data.
				if(isset($_POST['cancelcreate'])) {

					// Return to login.
					header("Location: $alias/login.php?a=login");

				} else if(isset($_POST['create'])) {

					// Create account.
					$res = M_Login::create($_POST['username'], $_POST['password'], $_POST['password2'], $_POST['email'], $_POST['email2']);

					// Check return code.
					if($res->code == "error") {

						// Return to create.
						$_SESSION['error'] = $res->value;
						header("Location: $alias/login.php?a=create");

					} else if($res->code == "success") {
						
						// Email and return to login.
						M_Login::email($res->value[0], $res->value[1], $res->value[2]);
						$_SESSION['error'] = "Account created successfully.";
						header("Location: $alias/login.php?a=login");

					}

				} else {
					
					// Else return create page.
					$error = "";
					if(isset($_SESSION['error'])) {
						$error = $_SESSION['error'];
						unset($_SESSION['error']);
					}
					include("$srcdir/create.php");

				}
			}

			break; // End create.

		case "verify":
			
			// Check logged in.
			if(!logged_in() || verified()) {
				header("Location: $alias/login.php?a=invalid");

			} else {

				// Check POST data.
				if(isset($_POST['cancelverify'])) {

					// Logout and return to login.
					M_Login::logout();
					unset($_SESSION['user']);
					session_unset();
					header("Location: $alias/login.php?a=login");

				} else if(isset($_POST['requestemail'])) {

					// Send email and return.
					M_Login::email($_SESSION['user']->name, $_SESSION['user']->email, $_SESSION['user']->id);
					$_SESSION['error'] = "E-mail sent as requested.";
					header("Location: $alias/login.php?a=verify");

				} else if(isset($_POST['verify'])) {

					// Verify user.
					$res = M_Login::verify($_SESSION['user']->name, $_POST['id']);

					// Check return code.
					if($res->code == "error") {

						// Return to verify.
						$_SESSION['error'] = $res->value;
						header("Location: $alias/login.php?a=verify");

					} else if($res->code == "success") {
						
						// Success and proceed to site.
						$_SESSION['user']->verified = 1;

						$page = "$alias/index.php";
						if(isset($_SESSION['curr_page'])) {
							$page = $_SESSION['curr_page'];
							unset($_SESSION['curr_page']);
						}
						header("Location: $page");
					}

				} else {
				
					// Display page.
					$error = "";
					if(isset($_SESSION['error'])) {
						$error = $_SESSION['error'];
						unset($_SESSION['error']);
					}
					include("$srcdir/verify.php");
				}
			}

			break; // End verify.

		case "timeout":

			// Check logged in.
			if(!logged_in()) {
				header("Location: $alias/login.php?a=invalid");

			} else {

				// Logout.
				unset($_SESSION['user']);
				session_unset();
				
				// Display page.
				include("$srcdir/timeout.php");

			}

			break; // End timeout.

		default:
			
			// Test logged in.
			if(logged_in()) {
				
				// Return to OpenRPG home.
				header("Refresh: 3; url=$alias");

				// Display page.
				include("$srcdir/invalid.php");

			} else {

				// Return to login.
				header("Refresh: 3; url=login.php?a=login");
			}

			break; // End default.
	}

	// Clost HTML tags.
	close_html();

} else {

	// Go to login.
	header("Location: $alias/login.php?a=login");
}

session_write_close();

?>
