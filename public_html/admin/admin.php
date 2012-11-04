<?php 
	include(realpath(dirname(__FILE__) . "/../../resources/config.php"));
	include($modules['auth']);
	session_name($sess_name); session_start();

	auth_check("admin");

	open_html(NULL);
	disp_banner("admin");

?>
<h3>This is the admin page!</h3>
<p>You must be special.  Whoop de doo.</p>
<a href="users.php">List of users.</a>
<?php close_html() ?>
