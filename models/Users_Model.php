<?php
require("models/Anak_Model.php");
require("models/Posyandu_Model.php");
class Users_Model extends Model {
	
	static $table = "users";
	static $lbl = ["username","password","nama_lengkap"];
	
	function getAnak(){
	    return $this->hasMany(Anak_Model::class,["username"=>"username"]);
	}
	
	function getLastPosyandu($anakID){
	    return $this->hasOne(Posyandu_Model::class,0,["anakID"=>$anakID],["posyanduID","desc"]);
	}
	
}