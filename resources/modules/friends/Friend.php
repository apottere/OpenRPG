<?php

// Freind class for friend module, defines what a "friendship" is made up of.
class Friend
{

	public $requester;
	public $requested;
	public $confirmed;

	function __construct($row){
		$this->requester = $row[0];
		$this->requested = $row[1];
		$this->confirmed = $row[2];

	}

}
?>
