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
	}
}
?>
