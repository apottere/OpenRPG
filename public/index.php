<?php 
	include("page_defaults.php");
	session_name($sess_name); session_start();

	auth_check($alias, "user");
	open_html(NULL);
	disp_banner("home", $links_loc, $alias);
?>
<h3>This is the home page!</h3>
<p>Here's the ORPG.  Tada.</p>
<?php close_html(); session_write_close(); ?>
