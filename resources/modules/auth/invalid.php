<?php
function invalid() {
	header("Refresh: 3; url=/");
	echo <<<EOT
	<br /><br /><br />
	<div align="center">
	<h1>Invalid option!</h1>
	<p><a href="/">Return</a> to the homepage, or be redirected automatically in 3 seconds...</p>
	</div>
EOT;
}
?>
