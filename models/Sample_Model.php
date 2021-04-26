<?php

require("models/Relation_Model.php");

class Sample_Model extends Model {
	
	static $table = "sample";
	static $lbl = ["sample_id","sample_name","sample_description","sample_date"];
	
	
	function getRelation(){
		return $this->hasMany(Relation_Model::class, ["sample_id"=>"sample_id"]);
	}
	
}