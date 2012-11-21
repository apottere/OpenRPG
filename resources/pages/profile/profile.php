<h1>Welcome to your account management page!</h1>
<p class="error"><?php echo $error?></p>
<table>
<tr>
	<td><p>Account: </p></td><td><p style="margin-left:7px"><?php echo $type; ?></p></td>
</tr>
<tr>
	<td><p>D.O.B: </p></td><td><p style="margin-left:7px"><?php echo $datetime; ?></p></td>
</tr>
<tr>
	<td><p>Username: </p></td><td><p style="margin-left:7px"><?php echo $user; ?></p></td>
</tr>
<tr>
	<td><p>Password: </p></td><td><p style="margin-left:7px">[Redacted]</p></td><td><a style="margin-left:7px" class="nav" href="change_password.php">change</a></td>
</tr>
<tr>
	<td><p>E-mail: </p></td><td><p style="margin-left:7px"><?php echo $email; ?></p></td><td><a style="margin-left:7px" class="nav" href="change_email.php">change</a></td>
</tr>
</table>
