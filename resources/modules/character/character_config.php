<?php
/*
	This is a list of default values, DO NOT EDIT THIS LIST.
	If you want to change a value, copy the value you want to
	change to a new php file, and record the location in the 
	variable below.  Any variables defined there will override 
	their counterparts here.
*/

$local_character_config = "local_character_config.php";

/* DO NOT EDIT BELOW THIS LINE */
################################################################################
/* VARIABLES: */

$char_conf = array(
	"chardir" => realpath(dirname(__FILE__)),
	"db_loc" => "localhost",
	"db_user" => "openrpg",
	"db_name" => "openrpg",
	"db_pass" => "",
	"table" => "openrpg.character",
);

if(file_exists(realpath(dirname(__FILE__)) . "/" . $local_character_config)) {
	include($local_character_config);
}

include("M_Character.php");
include("O_Character.php");
include("Character.php");

################################################################################
/* FUNCTIONS: */

?>
