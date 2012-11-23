<?php

// User class for login module, defines what a "user" is made up of.
class User
{

	public $name;
	public $email;
	public $admin;
	public $dob;
	public $id;
	public $verified;
	public $login_hash;

	function __construct($row){
		$this->name = $row[0];
		$this->email = $row[2];
		$this->admin = $row[3];
		$this->dob = $row[4];
		$this->id = $row[5];
		$this->verified = $row[6];
		$this->login_hash = $row[7];

	}

}
?>
