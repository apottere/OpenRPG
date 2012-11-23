<?php
function create($username, $password, $password2, $email, $email2) {

	// Get global conf.
	global $auth_conf;
	
	// Connect to DB.
	$table = $auth_conf['table'];
	mysql_connect($auth_conf['db_loc'], $auth_conf['db_user'], $auth_conf['db_pass']);
	mysql_select_db($auth_conf['db_name']);

	// Get needed variables.
	$salt = rand_string(16);
	$name = plain_escape($username);
	$pass = hash_pass(plain_escape($password), $salt);
	$pass2 = hash_pass(plain_escape($password2), $salt);
	$email = plain_escape($email);
	$email2 = plain_escape($email2);

	// Get needed queries.
	$query = mysql_query("select username from $table where username='$name';");
	$query2 = mysql_query("select email from $table where email='$email';");

	// Check for errors.
	if(mysql_num_rows($query) != 0) {
		
		// Error, username taken.
		return new O_Login("error", "Username already taken, please try again.");
		
		
	} else if(!validate_username($name)) {

		// Error, username invalid.
		return new O_Login("error", "Username is invalid, please try again.");

	} else if(strtolower($email) != strtolower($email2)) {
		
		// Error, email mismatch.
		return new O_Login("error", "E-mails did not match, please try again.");

	} else if(mysql_num_rows($query2) != 0) {

		// Error, email taken.
		return new O_Login("error", "E-mail is already associated with another account, please try again.");

	} else if($pass != $pass2) {
		
		// Error, password mismatch.
		return new O_Login("error", "Passwords did not match, please try again.");

	} else if(!check_email_address($email)) {

		// Error, email invalid.
		return new O_Login("error", "E-mail address is not valid, please try again.");
	
	} else {

		// Success, add user and return.
		mysql_query("insert into $table (username, passwd, email, admin, created, id, verified) values('$name', '$pass', '$email', 0, now(), '$salt', 0);");

		//makes a character entry
		mysql_query(" insert into `character` values( '$name','none','none','none',1,1,1,1,1,1,1,'none');");

		$_SESSION['error'] = "Account created successfully!";
		return new O_Login("success", array($name, $email, $salt));
	}
}
?>
