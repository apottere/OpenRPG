<?php 

	// Init page.
	include(realpath(dirname(__FILE__) . "/../../resources/config.php"));
	include($modules['auth']);
	include($modules['character']);
	include($modules['friends']);
	session_name($sess_name); session_start();

	// Authenticate.
	auth_check("user");

	// Open html block and banner.
	open_html(NULL);
	disp_banner("profile");


	// Set error if exists.
	$error = "";
	if(isset($_SESSION['error'])) {
		$error = $_SESSION['error'];
		unset($_SESSION['error']);
	}

	// Set user type.
	if($_SESSION['user']->admin) {
		$type = "Admin";
	} else {
		$type = "User";
	}


	// Added for url referencing (friends list compatibility).
	if(isset($_POST['LookUp'])) {
		$user = plain_escape($_POST['user']);
		header("Location: profile_look.php?user=$user");
		close_html();
		session_write_close();
		exit;
	}
	
	if( (!isset($_GET['user'])) || 
				($_GET['user'] == "" ||
				$_GET['user'] == NULL)) {

		if(isset($_GET['user']) && $_GET['user'] == "") {
			header("Location: profile_look.php?search=");
			close_html();
			session_write_close();
			exit;
		}
		

		if(isset($_GET['search'])) {

			$p = $_GET['search'];
			$template['p'] = plain_escape($p);
			
			$letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			$letter_links = "<p><a class=\"small\" href=\"$alias/profile/profile_look.php?search=\">All</a> ";
			$len = strlen($letters);
			for($i = 0; $i < $len; $i++) {
				$l = $letters[$i];
				$letter_links .= "<a class=\"small\" href=\"$alias/profile/profile_look.php?search=^$l\">$l</a> ";
			}
			$letter_links .= "</p>";

			$template['letter_links'] = $letter_links;
			$template['userlist'] = M_Login::get_users($p)->value;

			include($pages['profile'] . "/search.php");

			close_html();
			session_write_close();
			exit;

		} else {
			header("Location: profile.php");
			close_html();
			session_write_close();
			exit;
		}
	}




	$user = plain_escape($_GET['user']);
	$res = M_Login::check_unique($user);
	if($res->code == "error") {
		
		$_SESSION['error'] = $res->value;
		header("Location: profile_look.php?search=$user");
		close_html();
		session_write_close();
		exit;


	} else {

		$user = $res->value;
		
		if($user == $_SESSION['user']->name) {

			header("Location: profile.php");
			close_html();
			session_write_close();
			exit;

		}

		$row = M_Character::get_character($user);
	
?>
<table style="width: 100%">
<tr>
<td>
	<h1 style="display: table-cell"><?php echo $user; ?>'s Profile</h1>
</td>
<td>

<?php
	$res = M_Friends::check_friends($_SESSION['user']->name, $user);

	if($res->code == "success") {

		if($res->value == 1) {
			echo "<p>(Already friends)</p>";

		} else {
			echo "<p>(Request pending)</p>";
		
		}

	} else {

?>

	<form action="<?php echo $alias; ?>/friends/friends_action.php" method="POST">
		<input type="hidden" name="name" value="<?php echo $user; ?>" />
		<input type="submit" name="add" value="Add Friend"/>
	</form>

<?php
	}
?>

</td>
<td style="text-align:right;">
	<form method="POST" action="profile_look.php">
		<input type="text" name="user" />
		<input type="submit" name="LookUp" value="Search Profiles" />
	</form>
</td>
</tr>
</table>
<p class="error"><?php echo $error?></p>

<img src="<?php echo $row['picture']; ?>" alt="Profile Picture" width="275" height="300">

<br />

<table>
<tr>
	<td><p>Username: </p></td><td><p style="margin-left:7px"><?php echo $user; ?></p></td>

</tr>

<tr>
	<td><p>Bio: </p></td><td><p style="margin-left:7px"><?php echo $row['bio']; ?></p>
</tr>

<tr>
	<td><p>Gender: </p></td><td><p style="margin-left:7px"><?php echo $row['gender']; ?></p>
</tr>

<tr>
	<td><p>Level: </p></td><td><p style="margin-left:7px"><?php echo $row['level']; ?></p></td>
</tr>

<tr>
	<td><p>HP: </p></td><td><p style="margin-left:7px"><?php echo $row['hp']; ?></p></td>
</tr>

<tr>
	<td><p>MP: </p></td><td><p style="margin-left:7px"><?php echo $row['mp']; ?></p></td>
</tr>
<tr>
	<td><p>My Stuff: </p></td><td><p style="margin-left:7px"><?php echo $row['html']; ?></p>

</tr>


</table>
	

<?php
	}
	// Close html block and end session.
	close_html();
	session_write_close();

?>
