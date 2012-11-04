<?php
function email($user, $email, $salt, $msg) {

	$salt = substr($salt, 0, 10);
	$subject = "OpenRPG Verification Code";
	$message = "Dear $user,

	\tThank you for registering at OpenRPG.  Please enter this code at modelofnothing.no-ip.org/OpenRPG/login.php?a=verify:

	Your code: $salt

	Have a nice day!";

	$message = wordwrap($message, 70);
	$headers = 'From: OpenRPG@modelofnothing.no-ip.org' . "\r\n";

	mail($email, $subject, $message, $headers);

	if($msg) {
		$_SESSION['error'] = "Mail sent as requested, please check your spam folder.";
	}
}
?>
