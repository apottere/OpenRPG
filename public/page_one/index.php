<?php session_name("orpg"); session_start();
	include("../banner.php");
	auth_check();
	open_html(NULL);
	disp_banner("one");
?>
<h3>Test Page One</h3>
<p>Here's the ORPG.  Tada.</p>
<?php close_html() ?>
