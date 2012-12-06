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
	public $p1maxhp;
	public $p2maxhp;
	public $p1mc;
	public $p2mc;
	public $p1rg;
	public $p2rg;
	public $p1ml;
	public $p2ml;
	public $p1lvl;
	public $p2lvl;
	public $log;

	public function store() {

		$query = 
			"update battle set
			 p1hp='".$this->p1hp."',
			 p2hp='".$this->p2hp."',
			 accepted='".$this->accepted."',
			 date='".$this->date."',
			 p1turn='".$this->p1turn."',
			 p2turn='".$this->p2turn."',
			 p1maxhp='".$this->p1maxhp."',
			 p2maxhp='".$this->p2maxhp."',
			 p1mc='".$this->p1mc."',
			 p2mc='".$this->p2mc."',
			 p1rg='".$this->p1rg."',
			 p2rg='".$this->p2rg."',
			 p1ml='".$this->p1ml."',
			 p2ml='".$this->p2ml."',
			 p1lvl='".$this->p1lvl."',
			 p2lvl='".$this->p2lvl."', 
			 log='".mysql_real_escape_string($this->log)."' 
			 where p1='".$this->p1."'
			 and p2='".$this->p2."';";
		
		mysql_query($query);

	}

}
?>
