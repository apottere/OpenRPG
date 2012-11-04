<?php
function login() {

	if(isset($_POST['login'])) {

		global $auth_conf;

		mysql_connect($auth_conf['db_loc'], $auth_conf['db_user'], $auth_conf['db_pass']);
		mysql_select_db($auth_conf['db_name']);
		$table = $auth_conf['table'];

		$name = plain_escape($_POST["username"]);
		$query = mysql_query("select id from $table where username='$name';");
		$salt = mysql_fetch_array($query)[0];
		$pass = hash_pass(plain_escape($_POST["password"]), $salt);
		$query = mysql_query("select * from $table where username='$name' and passwd='$pass';");

		if(mysql_num_rows($query) == 0) {
			$_SESSION['error'] = "Username or password incorrect, please try again.";
			return "error";

		} else {
			$login_hash = sha1(time());
			mysql_query("update users set login_hash='$login_hash' where username='$name';");
			$query = mysql_query("select * from $table where username='$name' and passwd='$pass';");
			$row = mysql_fetch_array($query);
			return new User($row);
		}

	} else {

		$error = "";
		if(isset($_SESSION['error'])) {
			$error = '<p class="error">' . $_SESSION['error'] . "</p>";
			unset($_SESSION['error']);
		}

		echo <<<EOT
		<br /> <br /> <br />
		<h1 align="center">
			This page requires authentication!
		</h1>
		<p align="center">If you have already registered, please log in.  If not, <a href="login.php?a=create">create an account</a> or go back to <a href="/">the homepage</a>.</p>
		$error
		<br />
		<table class="noborder" align="center">
		<form method="POST" action="login.php?a=login">
		<tr>
			<td><p>Username: </p></td><td><input type="text" name="username" /></td>
		</tr>
		<tr>
			<td><p>Password: </p></td><td><input type="password" name="password" /></td>
		</tr>
		<tr>
			<td><input type="submit" name="login" value="Log in" /></td>
			<td><input type="submit" name="cancellogin" value="Cancel" /></td>
		</tr>
		</form>
		</table>

EOT;
		return;
	}
}
?>
