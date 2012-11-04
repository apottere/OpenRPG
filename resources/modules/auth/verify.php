<?php
function verify() {

	if(isset($_POST['verify'])) {
		global $auth_conf;

		mysql_connect($auth_conf['db_loc'], $auth_conf['db_user']);
		mysql_select_db($auth_conf['db_name']);

		$table = $auth_conf['table'];
		$user = $_SESSION['user']->name;
		$id = plain_escape($_POST['id']);

		$salt = mysql_fetch_array(mysql_query("select id from $table where username='$user';"))[0];
		$salt = substr($salt, 0, 10);

		if($id != $salt) {
			$_SESSION['error'] = "Incorrect code, please try again.";
			return "error";

		} else {
			mysql_query("update $table set verified=1 where username='$user';");
			$_SESSION['user']->verified = 1;
			return "success";
		}

	} else {

		$error="";
		if(isset($_SESSION['error'])) {
			$error = '<p style="color:RED;">' . $_SESSION['error'] . "</p>";
			unset($_SESSION['error']);
			session_write_close();
		}

		echo <<<EOT
		<div style="text-align: center;">
		<br /><br /><br />
		<h1>
			Your e-mail address has not been verified yet.
		</h1>
		<p>You should have recieved an e-mail with a verification code.  Insert the code below, or request another e-mail.</p>
		$error
		<br />
		<table class="noborder" align="center">
		<form method="post">
		<tr>
			<td><p>Code: <input type="text" name="id" /></p></td>
		</tr>
		<tr>
			<td>
				<input type="submit" name="verify" value="Verify" />
				<input type="submit" name="requestemail" value="New E-mail" />
				<input type="submit" name="cancelverify" value="Cancel" />
			</td>
		</tr>

			
		</form>
		</table>
		</div>

EOT;
	}
}
?>
