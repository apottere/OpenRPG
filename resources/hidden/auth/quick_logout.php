<?php
	unset($_SESSION['logged_in']);
	session_unset();
	session_write_close();
	header("Location: login_manager.php?a=login");
	exit;
?>
