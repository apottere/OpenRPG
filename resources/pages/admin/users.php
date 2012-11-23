<h3>Here are all the users on the site.</h3>

<?php echo $template['links']; ?>
<form method="POST">
	<input type="text" name="searchstring" />
	<input type="submit" name="search" value="Search" />
</form>

<?php echo $template['confirm']; ?>

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

<?php echo $template['users']; ?>

</table>

