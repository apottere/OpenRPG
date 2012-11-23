<?php 

	// Init page.
	include(realpath(dirname(__FILE__) . "/../../resources/config.php"));
	include($modules['auth']);
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
?>


<?php 

	$user = $_POST['user'];
	mysql_connect($auth_conf['db_loc'], $auth_conf['db_user'], $auth_conf['db_pass']);
        mysql_select_db($auth_conf['db_name']);

        $query = mysql_query("select * from `character` where `username`='$user';");
	$row = mysql_fetch_array( $query );

?>

<img src="<?php echo $row['picture']; ?>" alt="Profile Picture" width="275" height="300">


<h1><?php echo $user; ?>'s Profile</h1>
<p class="error"><?php echo $error?></p>
<table>
<tr>
	


</tr>
<tr>
	<td><p>Username: </p></td><td><p style="margin-left:7px"><?php echo $user; ?></p></td>

<td> 
<form method="POST" action="profile_look.php">
<table class="noborder">
	<tr>
		<td><p style="margin-right:7px"<p>Look At User's Profile: </p></td>
		<td><input type="text" name="user" /></td>
		<td><input type="submit" name="LookUp" value="Search" /></td>
		
	</tr>
	</table>
</form>
</td>

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
	// Close html block and end session.
	close_html();
	session_write_close();

?>
