
<?php 





?>

<img src="<?php echo $row['picture']; ?>" alt="Profile Picture" width="275" height="300"><a style="margin-left:7px" class="nav" href="change_pic.php">change</a></td>


<h1><?php echo $user; ?>'s Profile</h1>
<p class="error"><?php echo $error?></p>
<table>
<tr>
	<td><p>Account: </p></td><td><p style="margin-left:7px"><?php echo $type; ?></p></td><td> 
<form method="POST" action="profile_look.php">
<table class="noborder">
	<tr>
		<td><p>Look At User's Profile: </p></td>
		<td><input type="text" name="user" /></td>
		<td><input type="submit" name="LookUp" value="Search" /></td>
		
	</tr>
	</table>
</form>



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

<tr>
	<td><p>Bio: </p></td><td><p style="margin-left:7px"><?php echo $row['bio']; ?></p></td><td><a style="margin-left:7px" class="nav" href="change_bio.php">change</a></td>
</tr>

<tr>
	<td><p>Gender: </p></td><td><p style="margin-left:7px"><?php echo $row['gender']; ?></p></td><td><a style="margin-left:7px" class="nav" href="change_gender.php">change</a></td>
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
	<td><p>EXP: </p></td><td><p style="margin-left:7px"><?php echo $row['exp']; ?></p></td>
</tr>

<tr>
	<td><p>Melee: </p></td><td><p style="margin-left:7px"><?php echo $row['melee']; ?></p></td>
</tr>

<tr>
	<td><p>Range: </p></td><td><p style="margin-left:7px"><?php echo $row['range']; ?></p></td>
</tr>

<tr>
	<td><p>Magic: </p></td><td><p style="margin-left:7px"><?php echo $row['magic']; ?></p></td>
</tr>

<tr>
	<td><p>My Stuff: </p></td><td><p style="margin-left:7px"><?php echo $row['html']; ?></p></td><td><a style="margin-left:7px" class="nav" href="change_stuff.php">change</a></td>

</tr>


</table>
