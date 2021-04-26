<?php

class Sample_Model extends Model {
	
	function __construct(){
		parent::__construct();
		$this->tbl = "sample";
		$this->label = ["sample_id","sample_name","sample_description","sample_date"];
	}
	
}