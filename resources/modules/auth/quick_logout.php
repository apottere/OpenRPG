<?php
function quick_logout() {
	unset($_SESSION['user']);
	session_unset();
	session_write_close();
}
?>
