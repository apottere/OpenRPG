<?php
	header("Refresh: 3; url=login_manager.php?a=login");
	unset($_SESSION['logged_in']);
	session_unset();
	session_write_close();
	echo <<<EOT
	<br /><br /><br />
	<div align="center">
	<h1>You have been logged out successfully.</h1>
	<p>Return to <a href="login_manager.php?a=login">login</a>, or be redirected automatically in 3 seconds...</p>
	</div>
EOT;
?>
