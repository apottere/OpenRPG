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
			" href="static.php?p=battles">Battles 
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
			" href="static.php?p=pending">Pending 
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
			" href="static.php?p=sent">Sent 
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
				$seconds = time() - strtotime($friend[1]);
				$minutes = floor($seconds / 60);
				$hours = floor($seconds / 3600);
				$days = floor($seconds / 86400);
				$months = floor($seconds / 2592000);
				$years = floor($seconds / 31104000);

				$seconds = $seconds - 60*$minutes;
				$minutes = $minutes - 60*$hours;
				$hours = $hours - 24*$days;
				$days = $days - 30*$months;
				$months = $months - 12*$years;


				$datetime = $years . "y " . $months . "m " . $days . "d, " . $hours . ":" . $minutes . ":" .$seconds;
				

				if($friend[3]) {
					$ym = "<p style=\"color: green;\">Moved</p>";
				} else {
					$ym = "<p style=\"color: red;\">Pending</p>";
				}

				if($friend[2]) {
					$tm = "<p style=\"color: green;\">Moved</p>";
				} else {
					$tm = "<p style=\"color: red;\">Pending</p>";
				}

				echo <<<EOT
				<tr>
					<td><p><a class="friends" href="$alias/profile/profile_look.php?user=$name">$name</a></p></td>
					<td><p><a class="friends" href="$alias/battle/battle.php?o=$name">[view]</a></p></td>
					<td>$ym</td>
					<td>$tm</td>
					<td><p>$datetime</p></td>
				</tr>
EOT;
			}

		} else {
			echo "<tr><td colspan=\"5\"><p>No active battles.</p></td>";
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
					<td><form class="centerh" action="static_action.php" method="POST">
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
