<?php 
	include(realpath(dirname(__FILE__) . "/../resources/config.php"));
	session_name($sess_name); session_start();

	auth_check("user");
	open_html(NULL);
	disp_banner("home");
?>
<h3>This is the home page!</h3>
<p>Here's the ORPG.  Tada.</p>
<?php close_html(); session_write_close(); ?>
