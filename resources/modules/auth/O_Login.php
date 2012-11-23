<?php

// Return struct for login module, contains a code and value.
class O_Login
{

	public $code;
	public $value;

	function __construct($code, $value){
		$this->code = $code;
		$this->value = $value;
	}

}
?>
