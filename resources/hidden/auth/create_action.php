<?php
	include("defaults.php");
	include("validate_secure.php");

	mysql_connect($db_loc, $db_user, $db_pass);
	mysql_select_db($db_name);

	$salt = rand_string(16);
	$name = plain_escape($_POST["username"]);
	$pass = hash_pass(htmlspecialchars($_POST["password"]), $salt);
	$pass2 = hash_pass(htmlspecialchars($_POST["password2"]), $salt);
	$email = plain_escape($_POST['email']);

	$query = mysql_query("select * from $table where username='$name';");
	$query2 = mysql_query("select * from $table where email='$email';");
	$auth = mysql_fetch_array($query);

	if(mysql_num_rows($query) != 0) {
		$_SESSION['error'] = "Username already taken, please try again.";
		session_write_close();
		header("Location: login_manager.php?a=create");
		exit;
		
	} else if(!validate_username($name)) {
		$_SESSION['error'] = "Username is invalid, please try again.";
		session_write_close();
		header("Location: login_manager.php?a=create");
		exit;

	} else if(mysql_num_rows($query2) != 0) {
		$_SESSION['error'] = "E-mail is already associated with another account, please try again.";
		session_write_close();
		header("Location: login_manager.php?a=create");
		exit;

	} else if($pass != $pass2) {
		$_SESSION['error'] = "Passwords did not match, please try again.";
		session_write_close();
		header("Location: login_manager.php?a=create");
		exit;

	} else if(!check_email_address($email)) {
		$_SESSION['error'] = "E-mail address is not valid, please try again.";
		session_write_close();
		header("Location: login_manager.php?a=create");
		exit;
	
	} else {
		mysql_query("insert into $table (username, passwd, email, admin, created, id, validated) values('$name', '$pass', '$email', 0, now(), '$salt', 0);");
		include("$srcdir/auth/email.php");
		$_SESSION['error'] = "Account created successfully!";
		session_write_close();
		header("Location: login_manager.php?a=login");
		exit;
	}
?>

