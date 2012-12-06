<?php
	$battle = $template['battle'];

	if($_SESSION['user']->name == $battle->p1) {
		$inverted = 0;
	} else {
		$inverted = 1;
	}

?>

<br />
<p class="error"><?php echo $template['error']; ?></p>

<table class="battlecontainer">
<tr>
	<th colspan="2" style="padding-bottom: 30px;">
		<p>Battling against: <?php echo $template['op']; ?></p>
	</th>
</tr>
<tr>
	<td>
		<table class="battle" style="background-color: 
												<?php
													echo choose_color(1, $inverted);
												?>
												;">
		<tr>
			<th colspan="2"> 
				<p>
					<?php
						$p1 = $battle->p1;
						$p1lvl = $battle->p1lvl;
						echo $p1 . " (lvl " . $p1lvl . ")";
					?>
				</p>
			</th>
		</tr>	
		<tr>
			<td>
				<p>
					Magic power:
				</p>
			</td>
			<td>
				<p>
					<?php
						echo $battle->p1mc;
					?>
				</p>
			</td>
		</tr>
		<tr>
			<td>
				<p>
					Ranged power:
				</p>
			</td>
			<td>
				<p>
					<?php
						echo $battle->p1rg;
					?>
				</p>
			</td>
		</tr>
		<tr>
			<td>
				<p>
					Melee power:
				</p>
			</td>
			<td>
				<p>
					<?php
						echo $battle->p1ml;
					?>
				</p>
			</td>
		</tr>
		<tr>
			<td>
				<p>
					HP:
						<?php
							$hp = $battle->p1hp;
							$mhp = $battle->p1maxhp;
							$prct = round(($hp/(float)$mhp)*100, 1);
							echo $hp . "/" . $mhp;
							echo " (" . $prct . "%)";
						?>
				</p>
			</td>
			<td>
				<?php healthbar($prct); ?>
			</td>
		</tr>


		</table>
	</td>
	<td>
		<table class="battle" style="background-color: 
												<?php
													echo choose_color(2, $inverted);
												?>
												;">
		<tr>
			<th colspan="2"> 
				<p>
					<?php
						$p2 = $battle->p2;
						$p2lvl = $battle->p2lvl;
						echo $p2 . " (lvl " . $p2lvl . ")";
					?>
				</p>
			</th>
		</tr>	
		<tr>
			<td>
				<p>
					Magic power:
				</p>
			</td>
			<td>
				<p>
					<?php
						echo $battle->p2mc;
					?>
				</p>
			</td>
		</tr>
		<tr>
			<td>
				<p>
					Ranged power:
				</p>
			</td>
			<td>
				<p>
					<?php
						echo $battle->p2rg;
					?>
				</p>
			</td>
		</tr>
		<tr>
			<td>
				<p>
					Melee power:
				</p>
			</td>
			<td>
				<p>
					<?php
						echo $battle->p2ml;
					?>
				</p>
			</td>
		</tr>
		<tr>
			<td>
				<p>
					HP:
						<?php
							$hp = $battle->p2hp;
							$mhp = $battle->p2maxhp;
							$prct = round(($hp/(float)$mhp)*100, 1);
							echo $hp . "/" . $mhp;
							echo " (" . $prct . "%)";
						?>
				</p>
			</td>
			<td>
				<?php healthbar($prct); ?>
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="2">
		<table class="buttons">
			<tr>
				<?php
					if($inverted) {
						display_buttons($battle->p1, $battle->p2turn, $inverted);
					} else {
						display_buttons($battle->p2, $battle->p1turn, $inverted);
					}
				?>
			</tr>
		</table>
	</td>
</tr>
<tr style="height: 300px !important;">
	<td colspan="5" style="hight: 300px !important; text-align:center;">
		<textarea id="DIV1" disabled="disabled" style="bottom: 500px; padding:0px; width: 100%; height: 100%; margin:0px;"><?php echo $battle->log; ?></textarea>
	</td>
</tr>
</table>


