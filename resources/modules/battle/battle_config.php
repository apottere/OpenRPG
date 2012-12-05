<?php
/*
	This is a list of default values, DO NOT EDIT THIS LIST.
	If you want to change a value, copy the value you want to
	change to a new php file, and record the location in the 
	variable below.  Any variables defined there will override 
	their counterparts here.
*/

$local_battle_config = "local_battle_config.php";

/* DO NOT EDIT BELOW THIS LINE */
################################################################################
/* VARIABLES: */

$battle_conf = array(
	"battledir" => realpath(dirname(__FILE__)),
	"db_loc" => "localhost",
	"db_user" => "openrpg",
	"db_name" => "openrpg",
	"db_pass" => "",
	"table" => "battle",
);

if(file_exists(realpath(dirname(__FILE__)) . "/" . $local_battle_config)) {
	include($local_battle_config);
}

include("M_Battle.php");
include("O_Battle.php");
include("Battle.php");

################################################################################
/* FUNCTIONS: */

?>
