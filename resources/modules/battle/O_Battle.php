<?php

// Return struct for battle module, contains a code and value.
class O_Battle
{

	public $code;
	public $value;

	function __construct($code, $value){
		$this->code = $code;
		$this->value = $value;
	}

}
?>
