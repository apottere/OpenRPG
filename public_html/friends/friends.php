<?php 
	include(realpath(dirname(__FILE__) . "/../../resources/config.php"));
	include($modules['auth']);
	session_name($sess_name); session_start();

	auth_check("user");

	open_html(NULL);
	disp_banner("friends");

?>
<h3>Friends page:</h3>
<p>Forever alone.</p>
<?php close_html(); session_write_close(); ?>
