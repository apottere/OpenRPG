<?php 
	include(realpath(dirname(__FILE__) . "/../../resources/config.php"));
	session_name($sess_name); session_start();

	auth_check("user");
	open_html(NULL);
	disp_banner("profile");


$user = $_SESSION['user'];
$email = $_SESSION['email'];
$datetime = date('g\:i\:s a \o\n F j\, Y' , strtotime($_SESSION['datetime']));
$managerdir = "..";

echo "<h1>Welcome to your account management page!</h1>";

if(isset($_SESSION['error'])) {
	echo '<p style="color:RED;">' . $_SESSION['error'] . '</p>';
	unset($_SESSION['error']);
}

if(isset($_SESSION['admin'])) {
	$type = "Admin";
} else {
	$type = "User";
}
echo <<<EOT
<table>
<tr>
	<td><p>Account: </p></td><td><p style="margin-left:7px">$type</p></td>
</tr>
<tr>
	<td><p>D.O.B: </p></td><td><p style="margin-left:7px">$datetime</p></td>
</tr>
<tr>
	<td><p>Username: </p></td><td><p style="margin-left:7px">$user</p></td>
</tr>
<tr>
	<td><p>Password: </p></td><td><p style="margin-left:7px">[Redacted]</p></td><td><a style="margin-left:7px" class="nav" href="change_password.php">change</a></td>
</tr>
<tr>
	<td><p>E-mail: </p></td><td><p style="margin-left:7px">$email</p></td><td><a style="margin-left:7px" class="nav" href="change_email.php">change</a></td>
</tr>
</table>
EOT;

close_html(); session_write_close();
?>
