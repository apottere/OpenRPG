<?php
if(isset($_SESSION['logged_in'])) {
	$user = $_SESSION['user'];
	$email = $_SESSION['email'];
	$salt = $_SESSION['id'];

} else {
	$user = $name;
}

$salt = substr($salt, 0, 10);
$subject = "OpenRPG Verification Code";
$message = "Dear $user,

\tThank you for registering at OpenRPG.  Please enter this code at modelofnothing.no-ip.org/OpenRPG/login_manager.php?a=verify:

Your code: $salt

Have a nice day!";

shell_exec("echo \"$message\" | mailx -s \"$subject\" $email");

if(isset($_SESSION['logged_in'])) {
	$_SESSION['error'] = "Mail sent as requested.";
	session_write_close();
	header("Location: login_manager.php?a=verify");
}
?>