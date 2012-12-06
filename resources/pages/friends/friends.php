<table style="width: 100%; padding-bottom:0px;">
<tr>
	<td style="text-align: left;">
		<h3><?php echo $template['user'] ?>'s Friends List</h3>
	</td>

	<td style="text-align: right;">
		<form action="friends_action.php" method="POST">
			<input type="text" name="name" />
			<input type="submit" name="add" value="Add Friend"/>
			<input type="submit" name="search" value="Search"/>
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
			" href="friends.php?p=friends">Friends 
												<?php
													if(count($template['accepted']) > 0) {
														echo "(" . count($template['accepted']) . ")";
													}
												?>
			</a></p>
		</td>
	</tr>
	<tr>
		<td>
			<p><a class="infocenter
				<?php if($template['page'] == "pending") { echo " selected"; } ?>
			" href="friends.php?p=pending">Pending 
												<?php
													if(count($template['pending']) > 0) {
														echo "(" . count($template['pending']) . ")";
													}
												?>
			</a></p>
		</td>
	</tr>
	<tr>
		<td>
			<p><a class="infocenter
				<?php if($template['page'] == "sent") { echo " selected"; } ?>
			" href="friends.php?p=sent">Sent 
												<?php
													if(count($template['sent']) > 0) {
														echo "(" . count($template['sent']) . ")";
													}
												?>
			</a></p>
		</td>
	</tr>
	</table>

</td>	
<td style="vertical-align: top;">

<table class="info">
<?php

	if($template['page'] == "friends") {


		// Get all friends from array.
		$list = $template['accepted'];
		$list_len = count($list);

		if($list_len > 0) {
			for($i = 0; $i < $list_len; $i++) {
				$friend = $list[$i];
				$name = $friend[0];
				$datetime = date('g\:i a\,  n\/j\/Y' , strtotime($friend[1]));
				echo <<<EOT
				<tr>
					<td><p><a class="friends" href="$alias/profile/profile_look.php?user=$name">$name</a></p></td>
					<td><p><a class="friends" href="$alias/battle/battle.php?o=$name">[battle]</a></p></td>
					<td><p>$datetime</p></td>
					<td>
						<form class="centerv" method="POST" action="friends_action.php">
							<input class="centerv" type="submit" name="remove" value="Remove" />
							<input class="centerv" type="hidden" name="username" value=$name />
						</form>
					</td>
				</tr>
EOT;
			}

		} else {
			echo "<tr><td colspan=\"4\"><p>Forever alone.</p></td>";
//			echo "<td><p>N/A</p></td></tr>";
		}


	} else if($template['page'] == "sent") {

/*		echo <<<EOT
			<tr>
				<th><p>Name</p></th>
				<th><p>Sent</p></p></th>
			</tr>
EOT; */
	
		$list = $template['sent'];
		$list_len = count($list);
		if($list_len > 0) {
			for($i = 0; $i < $list_len; $i++) {
				$friend = $list[$i];
				$datetime = date('g\:i a\,  n\/j\/Y' , strtotime($friend[1]));
				echo "<tr><td><p><a class=\"friends\" href=\"$alias/profile/profile_look.php?user=" . $friend[0] . "\">". $friend[0] . "</a></p></td>";
				echo "<td><p>$datetime</p></td></tr>";
			}

		} else {
			echo "<tr><td colspan=\"2\"><p>None</p></td></tr>";
		}

	} else if($template['page'] == "pending") {

/*		echo <<<EOT
			<tr>
				<th><p>Name</p></th>
				<th><p>Action</p></th>
			</tr>
EOT; */

		$list = $template['pending'];
		$list_len = count($list);
		if($list_len > 0) {
		for($i = 0; $i < $list_len; $i++) {
				$user = $list[$i];
				echo <<<EOT
				<tr>
					<td><p><a class="friends" href="$alias/profile/profile_look.php?user=$user">$user</a></p></td>
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
