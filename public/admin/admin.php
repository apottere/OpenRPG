<?php 
	include("../page_defaults.php");
	session_name($sess_name); session_start();

	auth_check($alias, "admin");
	open_html(NULL);
	disp_banner("admin", $links_loc, $alias);
?>
<h3>This is the admin page!</h3>
<p>You must be special.  Whoop de doo.</p>
<?php close_html() ?>
