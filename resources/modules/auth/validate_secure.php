<?php
// Functions for escaping, hashing, and validating.

// Hash a password with 256-bit Blowfish Crypt.
function hash_pass($pass, $salt) {

	$salt = substr($salt, 0, 16);
	$salt = "$2y$10$".$salt."$";

	return crypt($pass, $salt);
}

// Get a random alphanum string of arbitrary length.
function rand_string($length, $charset='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')
{
    $str = '';
    $count = strlen($charset) - 1;
    while ($length--) {
        $str .= $charset[mt_rand(0, $count)];
    }
    return $str;
}

// Check if a username is valid.
function validate_username($user) {
	
	$len = strlen($user);
	if($len < 4) {
		$_SESSION['error'] = "Username too short, please try again.";
		return false;

	} else if($len > 50) {
		$_SESSION['error'] = "Username too long, please try again.";
		return false;
	
	} else if(!ctype_alnum($user)) {
		$_SESSION['error'] = "Illegal characters in username, please try again.";
		return false;
	} else {
		return true;
	}

}

// Check if an email address is valid.
function check_email_address($email) {
  // First, we check that there's one @ symbol, 
  // and that the lengths are right.
  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
    // Email invalid because wrong number of characters 
    // in one section or wrong number of @ symbols.
    return false;
  }
  // Split it into sections to make life easier
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) {
    if
(!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~>-]{0,63})|(\"[^(\\|\")]{0,62}\"))$",$local_array[$i])) {
      return false;
    }
  }
  // Check if domain is IP. If not, 
  // it should be valid domain name
  if (!ereg("^\[?[0-9>]+\]?$", $email_array[1])) {
    $domain_array = explode(".", $email_array[1]);
    if (sizeof($domain_array) < 2) {
        return false; // Not enough parts to domain
    }
    for ($i = 0; $i < sizeof($domain_array); $i++) {
      if
(!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|
↪([A-Za-z0-9]+))$",
$domain_array[$i])) {
        return false;
      }
    }
  }
  return true;
}

?>
