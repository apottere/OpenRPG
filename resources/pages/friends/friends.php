<table class="info">
	<tr>
		<td style="text-align: left;"><h3><?php echo $template['user'] ?>'s Friends List</h3></td>
		<td style="text-align: right;"><form action="friends_action.php" method="POST">
			<input type="text" name="name" />
			<input type="submit" name="add" value="Add Friend"/>
		</form></td>
	</tr>
</table>

<p class="error"><?php echo $template['error']; ?></p>

<br />

<table class="infocenterborder">
	<tr>
		<th><p>Pending</p></th>
		<th><p>Sent</p></th>
	</tr>
	<tr>
		<td>
			<table class="infocenter">
				<tr>
					<th><p>Name</p></th>
					<th><p>Action</p></th>
				</tr>
			</table>
		</td>
		<td>
			<table class="infocenter">
				<tr>
					<th><p>Name</p></th>
					<th><p>Date</p></p></th>
				</tr>
			</table>
		</td>
	</tr>
</table>

<br />

<table class="infocenterborder">
	<tr>
		<th><p>Friend</p></th>
		<th><p>Status</p></th>
		<th><p>Profile</p></th>
		<th><p>Remove</p></th>
	</tr>

<?php
	// Get all friends from array.
	$list_len = count($template['accepted']);

	for($i = 0; $i < $list_len; $i++) {
		$friend = $template['sent'][$i][0];
		echo <<<EOT
		<tr>
			<td><p>$friend</p></td>
			<td><p>Sent</p></td>
			<td><p><a href="$alias/profile/profile_look.php?user=$friend">veiw profile</a></p></td>
		</tr>
EOT;
	}
?>

</table>
