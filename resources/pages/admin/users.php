<table style="width: 100%; margin-bottom: 20px;">
<tr>
<td>
	<?php echo $template['links']; ?>
</td>
<td style="text-align: right;">
	<form method="POST">
		<input type="text" name="searchstring" />
		<input type="submit" name="search" value="Search" />
	</form>
</td>
</tr>
</table>

<?php echo $template['confirm']; ?>

<table class="info2">
<tr>
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

