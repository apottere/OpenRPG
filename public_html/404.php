<?php 

	// Include default config and needed modules.
	include(realpath(dirname(__FILE__) . "/../resources/config.php"));

	// Get variables.
	global $alias;

	// Open HTML tags.
	open_html(NULL);
?>
<br /><br /><br />
<h1 class="center">404 Bottles of beer on the wall...</h1>
<p class="center">Sorry, you broke it.  Before you return to <a href="<?php echo $alias; ?>/index.php">OpenRPG</a>...</p>
<div align="center">
<iframe align="middle" width="420" height="315" src="http://www.youtube.com/embed/dQw4w9WgXcQ?rel=0&autoplay=1" frameborder="0" allowfullscreen></iframe></iframe>
</div>


<?php
	// Close HTML.
	close_html();
?>
