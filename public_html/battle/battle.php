<?php 
	include(realpath(dirname(__FILE__) . "/../../resources/config.php"));
	include($modules['auth']);
	session_name($sess_name); session_start();

	auth_check("user");

	open_html(NULL);
	disp_banner("battle");
?>
<h3>Battle page:</h3>
<p>Battle royale!</p>
<?php close_html(); session_write_close(); ?>
