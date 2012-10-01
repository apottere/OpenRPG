<?php 
	include("../page_defaults.php");
	session_name($sess_name); session_start();

	auth_check();
	open_html(NULL);
	disp_banner("battle", $links_loc, $alias);
?>
<h3>Battle page:</h3>
<p>Battle royale!</p>
<?php close_html() ?>
