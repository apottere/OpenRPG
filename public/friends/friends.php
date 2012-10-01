<?php 
	include("../page_defaults.php");
	session_name($sess_name); session_start();

	auth_check();
	open_html(NULL);
	disp_banner("friends", $links_loc, $alias);
?>
<h3>Friends page:</h3>
<p>Forever alone.</p>
<?php close_html() ?>
