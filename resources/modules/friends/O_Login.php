<?php

// Return struct for friends module, contains a code and value.
class O_Friends
{

	public $code;
	public $value;

	function __construct($code, $value){
		$this->code = $code;
		$this->value = $value;
	}

}
?>
