<?php
	unset($_SESSION['logged_in']);
	session_unset();
	session_write_close();
?>
