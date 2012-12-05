<?php

// Return struct for character module, contains a code and value.
class O_Character
{

	public $code;
	public $value;

	function __construct($code, $value){
		$this->code = $code;
		$this->value = $value;
	}

}
?>
