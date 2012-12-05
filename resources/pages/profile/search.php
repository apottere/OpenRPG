<table style="width: 100%">
<tr>
	<td>
		<h2 style="display: table-cell;">Search Profiles</h2>
	</td>
</tr>
<tr>

	<td>
		<p><?php echo $template['letter_links']; ?></p>
	</td>

	<td style="text-align:right;">
		<form method="POST" action="profile_look.php">
			<input type="text" name="user" />
			<input type="submit" name="LookUp" value="Search Profiles" />
		</form>
	</td>

</tr>
</table>

<p>Your search for "<?php echo $template['p']; ?>" returned <?php echo count($template['userlist']); ?> results.</p>
<table class="info2">


<?php
	echo <<<EOT
		<tr>
			<th><p>Username</p></td>
			<th><p>Level</p></td>
			<th><p>Stats (hp/mp --- melee/magic/range)</p></td>
		</tr>



EOT;


	$list = $template['userlist'];
	$list_len = count($list);

	for($i = 0; $i < $list_len; $i++) {

		$f = $list[$i];

		$name = $f->name;
		$char = M_Character::get_char_obj($name)->value;
		$lvl = $char->level;
		$hp = $char->hp;
		$mp = $char->mp;
		$melee = $char->melee;
		$magic = $char->magic;
		$range = $char->ranged;

		echo <<<EOT
			<tr>
				<td><p><a class="friends" href="$alias/profile/profile_look.php?user=$name">$name</a></p></td>
				<td><p>$lvl</p></td>
				<td><p>$hp / $mp --- $melee / $magic / $range</p></td>

			</tr>

EOT;

	}
?>

</table>

