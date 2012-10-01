<?php
	header("Refresh: 5; url=/");
	unset($_SESSION['logged_in']);
	session_unset();
	session_write_close();
	echo <<<EOT
	<br /><br /><br />
	<div align="center">
	<h1>You have been logged out successfully.</h1>
	<p>Return to the <a href="/">homepage</a>, or be redirected automatically in 5 seconds...</p>
	</div>
EOT;
?>
