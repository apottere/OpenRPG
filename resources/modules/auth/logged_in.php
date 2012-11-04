<?php
function logged_in() {
	global $alias;
	header("Refresh: 3; url=$alias");
	echo <<<EOT
	<br /><br /><br />
	<div align="center">
	<h1>You are already logged in!</h1>
	<p><a href="<?php echo $alias?>">Return</a> to OpenRPG home, or be redirected automatically in 3 seconds...</p>
	</div>
EOT;
}
?>
