<?php 

	include(realpath(dirname(__FILE__) . "/../resources/config.php"));
	session_name($sess_name); session_start();
	include("$authdir/manager.php");
?>
