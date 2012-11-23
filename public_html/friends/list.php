<?php 
	
	// Init page.
	include(realpath(dirname(__FILE__) . "/../../resources/config.php"));
	include($modules['auth']);
	include($modules['friends']);
	session_name($sess_name); session_start();

	// Authenticate.
	auth_check("user");

	$friends = M_Friends::get_list($_SESSION['user']->name);

	// Open HTML and banner.
	open_html(NULL);
	disp_banner("friends");

	echo <<<EOT
	<h3>Friends List</h3>
	<p>$friends</p>


EOT;

	// Close HTML and session.
	close_html();
	session_write_close();

?>
