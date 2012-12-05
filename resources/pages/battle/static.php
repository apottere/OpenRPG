<h3>Your battle page</h3>

<p class="error"><?php echo $template['error']; ?></p>

<table class="infocenter">

<tr>
<td class="infocenterpanelcontainer">

	<table class="infocenterpanel">
	<tr>
		<td>
			<p><a class="infocenter
				<?php if($template['page'] == "battles") { echo " selected"; } ?>
			" href="static.php?p=battles">Battles (<?php
				echo count($template['accepted']);
			?>)</a></p>
		</td>
	</tr>
	<tr>
		<td>
			<p><a class="infocenter
				<?php if($template['page'] == "pending") { echo " selected"; } ?>
			" href="static.php?p=pending">Pending (<?php
				echo count($template['pending']);
			?>)</a></p>

		</td>
	</tr>
	<tr>
		<td>
			<p><a class="infocenter
				<?php if($template['page'] == "sent") { echo " selected"; } ?>
			" href="static.php?p=sent">Sent (<?php
				echo count($template['sent']);
			?>)</a></p>
		</td>
	</tr>
	</table>

</td>	
<td style="vertical-align: top;">

<table class="info">
<?php

	if($template['page'] == "battles") {

		echo <<<EOT
			<tr>
				<th><p>Username</p></th>
				<th><p>Fight</p></p></th>
				<th><p>Your Move</p></p></th>
				<th><p>Their Move</p></p></th>
				<th><p>Duration</p></p></th>
			</tr>
EOT;

		// Get all friends from array.
		$list = $template['accepted'];
		$list_len = count($list);

		if($list_len > 0) {
			for($i = 0; $i < $list_len; $i++) {
				$friend = $list[$i];
				$name = $friend[0];
				$datetime = date('g\:i a\,  n\/j\/Y' , strtotime($friend[1]));
				if($friend[2]) {
					$ym = "Moved";
				} else {
					$ym = "Pending";
				}

				if($friend[3]) {
					$tm = "Moved";
				} else {
					$tm = "Pending";
				}

				echo <<<EOT
				<tr>
					<td><p><a class="friends" href="$alias/profile/profile_look.php?user=$name">$name</a></p></td>
					<td><p><a class="friends" href="$alias/battle/battle.php?o=$name">[continue]</a></p></td>
					<td><p>$ym</p></td>
					<td><p>$tm</p></td>
					<td><p>$datetime</p></td>
				</tr>
EOT;
			}

		} else {
			echo "<tr><td colspan=\"4\"><p>No active battles.</p></td>";
		}


	} else if($template['page'] == "sent") {

		echo <<<EOT
			<tr>
				<th><p>Username</p></th>
				<th><p>Time Sent</p></p></th>
			</tr>
EOT;
	
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
			echo "<tr><td colspan=\"2\"><p>No sent battle requests.</p></td></tr>";
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
				echo <<<EOT
				<tr>
					<td><p><a class="friends" href="$alias/profile/profile_look.php?user=$user">$user</a></p></td>
					<td><form class="centerh" action="battle_action.php" method="POST">
						<input class="centerh" type="submit" name="accept" value="Confirm" />
						<input class="centerh" type="submit" name="deny" value="Deny" />
						<input class="centerh" type="hidden" name="username" value=$user />
					</form></td></tr>
EOT;
			}

		} else {
			echo "<tr><td colspan=\"2\"><p>No pending battle requests.</p></td>";
		}

	}
	

?>
</table>

</td>
</tr>
</table>
