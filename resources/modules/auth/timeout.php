<?php
function timeout() {
	global $alias;
	unset($_SESSION['user']);
	session_unset();
	session_write_close();
	echo <<<EOT
	<br /><br /><br />
	<div align="center">
	<h1>You are logged in somewhere else.</h1>
	<p>Return to the <a href="/">homepage</a> or <a href="$alias/login.php?a=login">login</a>.</p>
	</div>
EOT;
}
?>
