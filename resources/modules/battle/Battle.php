<?php

// Battle class for friend module, defines what a "battle" is made up of.
class Battle
{

	public $p1;
	public $p2;
	public $p1hp;
	public $p2hp;
	public $accepted;
	public $date;
	public $p1turn;
	public $p2turn;

	function __construct($row){
		$this->p1 = $row[0];
		$this->p2 = $row[1];
		$this->p1hp = $row[2];
		$this->p2hp = $row[3];
		$this->accepted = $row[4];
		$this->date = $row[5];
		$this->p1turn = $row[6];
		$this->p2turn = $row[7];
	}

}
?>
