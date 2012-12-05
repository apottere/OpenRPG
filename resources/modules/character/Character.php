<?php

// Character class for character module, defines what a "character" is made up of.
class Character
{

	public $username;
	public $bio;
	public $gender;
	public $picture;
	public $level;
	public $xp;
	public $hp;
	public $mp;
	public $melee;
	public $magic;
	public $ranged;
	public $html;

	function __construct($row){
		$this->username = $row[0];
		$this->bio = $row[1];
		$this->gender = $row[2];
		$this->picture = $row[3];
		$this->level = $row[4];
		$this->xp = $row[5];
		$this->hp = $row[6];
		$this->mp = $row[7];
		$this->melee = $row[8];
		$this->magic = $row[9];
		$this->ranged = $row[10];
		$this->html = $row[11];
		

	}

}
?>
