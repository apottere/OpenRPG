<?php
function create() {
	global $auth_conf;
	if(isset($_POST['create'])) {
		
		$table = $auth_conf['table'];

		mysql_connect($auth_conf['db_loc'], $auth_conf['db_user'], $auth_conf['db_pass']);
		mysql_select_db($auth_conf['db_name']);

		$salt = rand_string(16);
		$name = plain_escape($_POST["username"]);
		$pass = hash_pass(plain_escape($_POST["password"]), $salt);
		$pass2 = hash_pass(plain_escape($_POST["password2"]), $salt);
		$email = plain_escape($_POST['email']);

		$query = mysql_query("select username from $table where username='$name';");
		$query2 = mysql_query("select email from $table where email='$email';");
		$auth = mysql_fetch_array($query);

		if(mysql_num_rows($query) != 0) {
			$_SESSION['error'] = "Username already taken, please try again.";
			return "error";
			
		} else if(!validate_username($name)) {
			$_SESSION['error'] = "Username is invalid, please try again.";
			return "error";

		} else if(mysql_num_rows($query2) != 0) {
			$_SESSION['error'] = "E-mail is already associated with another account, please try again.";
			return "error";

		} else if($pass != $pass2) {
			$_SESSION['error'] = "Passwords did not match, please try again.";
			return "error";

		} else if(!check_email_address($email)) {
			$_SESSION['error'] = "E-mail address is not valid, please try again.";
			return "error";
		
		} else {
			mysql_query("insert into $table (username, passwd, email, admin, created, id, verified) values('$name', '$pass', '$email', 0, now(), '$salt', 0);");
			$_SESSION['error'] = "Account created successfully!";
			return array($name, $email, $salt);
		}

	} else {
		$error = "";
		if(isset($_SESSION['error'])) {
			$error = '<p style="color:RED;">' . $_SESSION['error'] . "</p>";
			unset($_SESSION['error']);
		}

		echo <<<EOT

		<br /><br /><br />
		<div style="text-align: center">
		<h1>
			Create a username here.
		</h1>
		<p>Please enter your e-mail address and your desired username and password.</p>
		$error
		<br />
		<form method="POST" action="login.php?a=create">
			<table class="noborder" align="center">
			<tr>
				<td><p>Username: </p></td>
				<td><input type="text" name="username" /></td>
				<td><p style="margin-left:10px"> -- 4-50 characters, alphanumeric</p></td>
			</tr>
			<tr>
				<td><p>Password: </p></td>
				<td><input type="password" name="password" /></td>
			</tr>
			<tr>
				<td><p>Confirm password: </p></td>
				<td><input type="password" name="password2" /></td>
			</tr>
			<tr>
				<td><p>E-mail: </p></td>
				<td><input type="text" name="email" /></td>
			</tr>
			<tr>
				<td><input type="submit" name="create" value="Create" /></td>
				<td><input type="submit" name="cancelcreate" value="Cancel" /></td>
			</tr>
			</table>
		</form>
		</div>
EOT;
		return;
	}
}
?>
