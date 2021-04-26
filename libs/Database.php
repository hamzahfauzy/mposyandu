<?php

class Database extends mysqli {
	
	function __construct(){
		parent::__construct(DBHOST,DBUSER,DBPASSWORD,DBNAME);
		$this->dbname = DBNAME;
	}
	
}