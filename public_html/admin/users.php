<?php 
	include(realpath(dirname(__FILE__) . "/../../resources/config.php"));
	include($modules['auth']);
	session_name($sess_name); session_start();

	auth_check("admin");

	open_html(NULL);
	disp_banner("admin");
	
	if(isset($_GET['p'])) {
		$pattern = $_GET['p'];
	} else {
		$pattern = NULL;
	}

	$letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$letter_links = "<p><a href=\"users.php\">All</a> ";
	$len = strlen($letters);
	for($i = 0; $i < $len; $i++) {
		$l = $letters[$i];
		$letter_links .= "<a class=\"small\" href=\"users.php?p=^$l\">$l</a> ";
	}
	$letter_links .= "</p>";

	$users = Manager::get_users($pattern);

?>
<h3>Here are all the users on the site.</h3>

<?php echo $letter_links; ?>

<table class="smallborder">
<tr class="smallborder">
	<th><p>Username</p></th>
	<th><p>Email</p></th>
	<th><p>Type</p></th>
	<th><p>D.O.B</p></th>
	<th><p>ID</p></th>
	<th><p>Verified</p></th>
</tr>
<?php 

$len = count($users);
if($len > 0) {
	for($i = 0; $i < $len; $i++) {
		
		$name = $users[$i][0];
		$email = $users[$i][1];
		if($users[$i][2]) {
			$admin = "Admin";
		} else {
			$admin = "User";
		}
		$dob = $users[$i][3];
		$id = $users[$i][4];
		if($users[$i][5]) {
			$verified = "True";
		} else {
			$verified = "False";
		}

		echo <<<EOT

		<tr>
			<td><p>$name</p></td>
			<td><p>$email</p></td>
			<td><p>$admin</p></td>
			<td><p>$dob</p></td>
			<td><p>$id</p></td>
			<td><p>$verified</p></td>
		</tr>

EOT;

	}
} else {
	echo "<tr><td><p>No usernames found matching \"$pattern\".</p></td></tr>";
}
?>
</table>

<?php close_html() ?>
