<?php
$srcdir = "../hidden";
include("$srcdir/auth/validate_secure.php");
mysql_connect("localhost", "andrew");
mysql_select_db("andrew");
$name = $_SESSION['user'];
$table = "orpg_users";

function start($name, $s) {

	$salt = mysql_fetch_array(mysql_query("select id from $table where username='$name';"))[0];
	$pass = hash_pass($_POST["password"], $salt);

	$query = mysql_query("select * from $table where username='$name' and passwd='$pass';");
	if(mysql_num_rows($query) == 0) {
		$_SESSION['error'] = "Username or password incorrect, please try again.";
		session_write_close();
		header("Location: login_manager.php?a=change&s=$s");
		exit;
	}
}

if(isset($_POST['changepassword'])) {
	start($name, "password");
	$newpass = hash_pass($_POST["newpassword"], $salt);
	$newpass2 = hash_pass($_POST["newpassword2"], $salt);

	if($newpass != $newpass2) {
		$_SESSION['error'] = "New passwords did not match, please try again.";
		session_write_close();
		header("Location: login_manager.php?a=change&s=password");
		exit;
	}

	mysql_query("update $table set passwd='$newpass' where username='$name';");
	$_SESSION['error'] = "Password updated successfully!";
	session_write_close();
	header("Location: login_manager.php?a=account");
	exit;

} else if(isset($_POST['changeemail'])) {
	start($name, "email");
	$newemail = plain_escape($_POST["newemail"]);

	$query = mysql_query("select * from $table where email='$newemail';");

	if(!check_email_address($newemail)) {
		$_SESSION['error'] = "Invalid e-mail address, please try again.";
		session_write_close();
		header("Location: login_manager.php?a=change&s=email");
		exit;

	} else if(mysql_num_rows($query) != 0) {
		$_SESSION['error'] = "E-mail is already associated with another account, please try again.";
		session_write_close();
		header("Location: login_manager.php?a=change&s=email");
		exit;

	} else {
		mysql_query("update $table set email='$newemail' where username='$name';");
		mysql_query("update $table set validated=0 where username='$name';");
		$_SESSION['error'] = "E-mail updated successfully!";
		$_SESSION['email'] = $newemail;
		unset($_SESSION['verified']);
		session_write_close();
		header("Location: login_manager.php?a=account");
		exit;
	}
}
/*
} else if(isset($_POST['changeusername'])) {
	$newusername = plain_escape($_POST["newusername"]);

	mysql_query("select * from users where username='$newusername';");

	if(!validate_username($newusername)) {
		session_write_close();
		header("Location: login_manager.php?a=change?s=$s");
		exit;

	} else if(mysql_num_rows($query)) {
		$_SESSION['error'] = "Username already taken, please try again.";
		session_write_close();
		header("Location: login_manager.php?a=change?s=$s");
		exit;
	}

	mysql_query("update users set username='$newusername' where username='$name';");
	$_SESSION['error'] = "Username updated successfully!";
	session_write_close();
	header("Location: login_manager.php?a=account");
	exit;
} */

?>
