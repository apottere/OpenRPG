<table style="width: 100%; padding-bottom:0px;">
<tr>
	<td style="text-align: left;">
		<h3><?php echo $template['user'] ?>'s Friends List</h3>
	</td>

	<td style="text-align: right;">
		<form action="friends_action.php" method="POST">
			<input type="text" name="name" />
			<input type="submit" name="add" value="Add Friend"/>
		</form>
	</td>
</tr>
</table>

<p class="error"><?php echo $template['error']; ?></p>

<table class="infocenter">

<tr>
<td class="infocenterpanelcontainer">

	<table class="infocenterpanel">
	<tr>
		<td>
			<p><a class="infocenter
				<?php if($template['page'] == "friends") { echo " selected"; } ?>
			" href="friends.php?p=friends">Friends (<?php
				echo count($template['accepted']);
			?>)</a></p>
		</td>
	</tr>
	<tr>
		<td>
			<p><a class="infocenter
				<?php if($template['page'] == "pending") { echo " selected"; } ?>
			" href="friends.php?p=pending">Pending (<?php
				echo count($template['pending']);
			?>)</a></p>

		</td>
	</tr>
	<tr>
		<td>
			<p><a class="infocenter
				<?php if($template['page'] == "sent") { echo " selected"; } ?>
			" href="friends.php?p=sent">Sent (<?php
				echo count($template['sent']);
			?>)</a></p>
		</td>
	</tr>
	</table>

</td>	
<td style="vertical-align: top;">

<table class="info">
<?php

	if($template['page'] == "friends") {

		echo <<<EOT

		<tr>
			<th><p>Friend</p></th>
			<th><p>Date</p></th>
			<th><p>Profile</p></th>
			<th><p>Remove</p></th>
		</tr>
EOT;

		// Get all friends from array.
		$list = $template['accepted'];
		$list_len = count($list);

		if($list_len > 0) {
			for($i = 0; $i < $list_len; $i++) {
				$friend = $list[$i][0];
				$name = $friend;
				$datetime = date('g\:i a\,  n\/j\/Y' , strtotime($friend[1]));
				echo <<<EOT
				<tr>
					<td><p>$friend</p></td>
					<td><p>$datetime</p></td>
					<td><p><a href="$alias/profile/profile_look.php?user=$name">veiw profile</a></p></td>
					<td>
						<form class="centerv" method="POST" action="friends_action.php">
							<input class="centerv" type="submit" name="remove" value="Remove" />
							<input class="centerv" type="hidden" name="username" value=$friend />
						</form>
					</td>
				</tr>
EOT;
			}

		} else {
			echo "<tr><td><p>None</p></td>";
			echo "<td><p>N/A</p></td>";
			echo "<td><p>N/A</p></td>";
			echo "<td><p>N/A</p></td></tr>";
		}


	} else if($template['page'] == "sent") {

		echo <<<EOT
			<tr>
				<th><p>Name</p></th>
				<th><p>Sent</p></p></th>
			</tr>
EOT;
	
		$list = $template['sent'];
		$list_len = count($list);
		if($list_len > 0) {
			for($i = 0; $i < $list_len; $i++) {
				$friend = $list[$i];
				$datetime = date('g\:i a\,  n\/j\/Y' , strtotime($friend[1]));
				echo "<tr><td><p>" . $friend[0] . "</p></td>";
				echo "<td><p>$datetime</p></td></tr>";
			}

		} else {
			echo "<tr><td><p>None</p></td>";
			echo "<td><p>N/A</p></td></tr>";
		}

	} else if($template['page'] == "pending") {

		echo <<<EOT
			<tr>
				<th><p>Name</p></th>
				<th><p>Action</p></th>
			</tr>
EOT;

		$list = $template['pending'];
		$list_len = count($list);
		if($list_len > 0) {
		for($i = 0; $i < $list_len; $i++) {
				$user = $list[$i];
				echo "<tr><td><p>" . $user . "</p></td>";
				echo <<<EOT
					<td><form class="centerh" action="friends_action.php" method="POST">
						<input class="centerh" type="submit" name="confirmFriend" value="Confirm" />
						<input class="centerh" type="submit" name="denyFriend" value="Deny" />
						<input class="centerh" type="hidden" name="username" value=$user />
					</form></td></tr>
EOT;
			}

		} else {
			echo "<tr><td><p>None</p></td>";
			echo "<td><p>N/A</p></td></tr>";
		}

	}
	

?>
</table>

</td>
</tr>
</table>

<?php /*
				<tr>
					<th colspan="2"><p>Pending</p></th>
				</tr>
				<tr>
					<th><p>Name</p></th>
					<th><p>Action</p></th>
				</tr>
				<?php
					$list = $template['pending'];
					$list_len = count($list);
					if($list_len > 0) {
					for($i = 0; $i < $list_len; $i++) {
							$user = $list[$i];
							echo "<tr><td><p>" . $user . "</p></td>";
							echo <<<EOT
								<td><form action="friends_action.php" method="POST">
									<input type="submit" name="confirmFriend" value="Confirm" />
									<input type="submit" name="denyFriend" value="Deny" />
									<input type="hidden" name="username" value=$user />
								</form></td></tr>
EOT;
						}
					} else {
						echo "<tr><td><p>None</p></td>";
						echo "<td><p>None</p></td></tr>";
					}
				?>
				<tr><td><br /></td><td><br /></td></tr>
			</table>
		</td>
		<td>
			<table class="infocenterborder" style="">
				<tr>
					<th colspan="2"><p>Sent</p></th>
				</tr>
				<tr>
					<th><p>Name</p></th>
					<th><p>Date</p></p></th>
				</tr>
				<?php
					$list = $template['sent'];
					$list_len = count($list);
					if($list_len > 0) {
						for($i = 0; $i < $list_len; $i++) {
							$friend = $list[$i];
							$datetime = date('g\:i a\,  n\/j\/Y' , strtotime($friend[1]));
							echo "<tr><td><p>" . $friend[0] . "</p></td>";
							echo "<td><p>$datetime</p></td></tr>";
						}
					} else {
						echo "<tr><td><p>None</p></td>";
						echo "<td><p>None</p></td></tr>";
					}
				?>
				<tr><td><br /></td><td><br /></td></tr>
			</table>
		</td>
	</tr>
</table>

<br />

*/ ?>
