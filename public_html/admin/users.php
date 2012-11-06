<?php 
	include(realpath(dirname(__FILE__) . "/../../resources/config.php"));
	include($modules['auth']);
	session_name($sess_name); session_start();

	auth_check("admin");

	if(isset($_POST['search'])) {
		$pattern = plain_escape($_POST['searchstring']);
		header("Location: users.php?p=$pattern");
		session_write_close();
		exit;

		
	} else if(isset($_POST['confirmdelete'])) {
		$name = plain_escape($_POST['name']);
		Manager::delete_user($name);

	} else if(isset($_POST['toggle'])) {
		$adminval= plain_escape($_POST['adminval']);
		$name = plain_escape($_POST['name']);
		Manager::toggle_admin($name, $adminval);
		mysql_error();
	}

function display_confirm() {

	if(isset($_POST['delete'])) {
		$username = plain_escape($_POST['name']);
		echo "<div style=\"text-align: center;\">";
		echo "<h1>Confirm account deletion!</h1>";
		echo "<p style=\"color: red;\">Delete \"$username\" permanently?</p>";
		echo "<form method=\"POST\"><input type=\"submit\" name=\"confirmdelete\" value=\"Yes\" />";
		echo "<input type=\"hidden\" name=\"name\" value=\"$username\" />";
		echo "<input type=\"submit\" value=\"No\" />";
		echo "</form></div>";
	}

}

function echo_links() {
	$letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$letter_links = "<p><a href=\"users.php\">All</a> ";
	$len = strlen($letters);
	for($i = 0; $i < $len; $i++) {
		$l = $letters[$i];
		$letter_links .= "<a class=\"small\" href=\"users.php?p=^$l\">$l</a> ";
	}
	$letter_links .= "</p>";
	echo $letter_links;
}

function echo_users() {

	if(isset($_GET['p'])) {
		$pattern = plain_escape($_GET['p']);
	} else {
		header("Location: users.php?p=");
		exit;
	}
	$users = Manager::get_users($pattern);
	$len = count($users);
	if($len > 0) {
		for($i = 0; $i < $len; $i++) {
			
			$name = $users[$i]->name;
			$email = $users[$i]->email;
			$adminval = $users[$i]->admin;
			if($adminval) {
				$admin = "Admin";
			} else {
				$admin = "User";
			}
			$dob = $users[$i]->dob;
			$id = $users[$i]->id;
			if($users[$i]->verified) {
				$verified = "True";
			} else {
				$verified = "False";
			}

			echo <<<EOT

			<tr>
				<td><p>$name</p></td>
				<td><p>$email</p></td>
				<td><form method="POST">
					<input type="submit" name="toggle" value="$admin"</p>
					<input type="hidden" name="adminval" value="$adminval"</p>
					<input type="hidden" name="name" value="$name"</p>
				</form></td>
				<td><p>$dob</p></td>
				<td><p>$id</p></td>
				<td><p>$verified</p></td>
				<td><form method="POST">
					<input type="hidden" name="name" value="$name" />
					<input type="submit" name="delete" value="Delete" />
				</form></td>
			</tr>

EOT;

		}

	} else {
		echo "<tr><p style=\"color: red;\">No usernames found matching \"$pattern\".</p></tr>";
	}
}
?>

<?php open_html(NULL); disp_banner("admin"); ?>

<h3>Here are all the users on the site.</h3>

<?php echo_links(); ?>
<form method="POST">
	<input type="text" name="searchstring" />
	<input type="submit" name="search" value="Search" />
</form>

<?php display_confirm(); ?>

<table class="smallborder">
<tr class="smallborder">
	<th><p>Username</p></th>
	<th><p>Email</p></th>
	<th><p>Type</p></th>
	<th><p>D.O.B</p></th>
	<th><p>ID</p></th>
	<th><p>Verified</p></th>
	<th><p>Delete</p></th>
</tr>

<?php echo_users(); ?>

</table>

<?php close_html() ?>
