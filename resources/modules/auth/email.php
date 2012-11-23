<?php
function email($user, $email, $salt) {

	// Get required variables.
	$salt = substr($plain_escape($salt), 0, 10);
	$subject = "OpenRPG Verification Code";
	$user = plain_escape($user);
	$message = "Dear $user,

	\tThank you for registering at OpenRPG.  Please enter this code at modelofnothing.no-ip.org/OpenRPG/login.php?a=verify:

	Your code: $salt

	Have a nice day!";

	// Wrap the message and add headers.
	$message = wordwrap($message, 70);
	$headers = 'From: OpenRPG@modelofnothing.no-ip.org' . "\r\n";

	// Send mail.
	mail($plain_escape($email), $subject, $message, $headers);

}
?>
