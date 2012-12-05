<?php 

	// Init page.
	include(realpath(dirname(__FILE__) . "/../../resources/config.php"));
	include($modules['auth']);
	include($modules['friends']);
	include($modules['character']);
	session_name($sess_name); session_start();

	// Authenticate.
	auth_check("admin");

	// Check POST data.
	if(isset($_POST['search'])) {
		
		// Get search data and redirect.
		$pattern = plain_escape($_POST['searchstring']);
		header("Location: users.php?p=$pattern");
		session_write_close();
		exit;

	} else if(isset($_POST['confirmdelete'])) {
		
		// Confirm and delete user from DB.
		M_Friends::remove_all($_POST['name']);
		M_Character::delete_all($_POST['name']);
		M_Login::delete_user($_POST['name']);

	} else if(isset($_POST['toggle'])) {
		
		// Toggle admin value for user.
		M_Login::toggle_admin($_POST['name'], $_POST['adminval']);
	}

	// Get page variables.
	$template['links'] = get_links();
	$template['confirm'] = get_confirm();
	$template['users'] = get_user_list();

	// Open HTML and display banner.
	open_html(NULL);
	disp_banner("admin");

	// Display page.
	include($pages['admin'] . "/users.php");

	// Close HTML tags.
	close_html();


// FUNCTIONS:

// Gets the optional confirm delete dialogue.
function get_confirm() {

	$return = "";
	if(isset($_POST['delete'])) {
		$username = plain_escape($_POST['name']);
		$return .= "<div style=\"text-align: center;\">";
		$return .= "<h1>Confirm account deletion!</h1>";
		$return .= "<p style=\"color: red;\">Delete \"$username\" permanently?</p>";
		$return .= "<form method=\"POST\"><input type=\"submit\" name=\"confirmdelete\" value=\"Yes\" />";
		$return .= "<input type=\"hidden\" name=\"name\" value=\"$username\" />";
		$return .= "<input type=\"submit\" value=\"No\" />";
		$return .= "</form></div>";
	}
	
	return $return;

}


// Gets the links to display.
function get_links() {
	$letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$letter_links = "<p><a class=\"small\" href=\"users.php\">All</a> ";
	$len = strlen($letters);
	for($i = 0; $i < $len; $i++) {
		$l = $letters[$i];
		$letter_links .= "<a class=\"small\" href=\"users.php?p=^$l\">$l</a> ";
	}
	$letter_links .= "</p>";

	return $letter_links;
}


// Get the list of users for this page.
function get_user_list() {

	$ret_users = "";

	if(isset($_GET['p'])) {
		$pattern = plain_escape($_GET['p']);
	} else {
		header("Location: users.php?p=");
		session_write_close();
		exit;
	}

	$res = M_Login::get_users($pattern);
	$users = $res->value;

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
				$verified = "Y";
			} else {
				$verified = "N";
			}

			$ret_users .= <<<EOT

			<tr>
				<td><p>$name</p></td>
				<td><p>$email</p></td>
				<td><form class="centerv" method="POST">
					<input class="centerv" type="submit" name="toggle" value="$admin" />
					<input class="centerv "type="hidden" name="adminval" value="$adminval" />
					<input class="centerv" type="hidden" name="name" value="$name" />
				</form></td>
				<td><p>$dob</p></td>
				<td><p>$id</p></td>
				<td><p>$verified</p></td>
				<td><form class="centerv" method="POST">
					<input type="hidden" name="name" value="$name" />
					<input class="centerv" type="submit" name="delete" value="Delete" />
				</form></td>
			</tr>

EOT;

		}

	} else {
		$ret_users .= "<tr><p style=\"color: red;\">No usernames found matching \"$pattern\".</p></tr>";
	}

	return $ret_users;
}

?>
