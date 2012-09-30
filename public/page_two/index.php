<?php session_name("orpg"); session_start();
	include("../banner.php");
	auth_check();
	open_html(NULL);
	disp_banner("two");
?>
<h3>Test Page Two</h3>
<p>Here's the second test page.</p>
<?php close_html() ?>
