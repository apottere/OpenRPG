<?php
/*
	This is a list of default values, DO NOT EDIT THIS LIST.
	If you want to change a value, copy the value you want to
	change to a new php file, and record the location in the 
	variable below.  Any variables defined there will override 
	their counterparts here.
*/

$local_friends_config = "local_friends_config.php";

/* DO NOT EDIT BELOW THIS LINE */
################################################################################
/* VARIABLES: */

$friends_conf = array(
	"friendsdir" => realpath(dirname(__FILE__)),
	"db_loc" => "localhost",
	"db_user" => "openrpg",
	"db_name" => "openrpg",
	"db_pass" => "",
	"table" => "friends",
);

if(file_exists(realpath(dirname(__FILE__)) . "/" . $local_friends_config)) {
	include($local_friends_config);
}

include("M_Friends.php");
include("O_Friends.php");
include("Friend.php");

################################################################################
/* FUNCTIONS: */

?>
