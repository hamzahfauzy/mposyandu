<?php

$vendor = require "config/vendor.php";

class View {
	
	function __construct(){
		global $vendor;
		$this->vendor = $vendor;
	}
	
	function render($name, $file = false, $data=false){
		if($data != false)
			extract($data);
		if(file_exists("views/".$this->controller."/$name.php")){
			// change configuration with custom template
			// if file true, just require the following file
			// else require header and footer file for dynamic paging
			if($file != false){
				require "views/layouts/header.php";
				require "views/".$this->controller."/$name.php";
				require "views/layouts/footer.php";
			}else
				require "views/".$this->controller."/$name.php";
		}else
			require("views/error/index.php");
	}
	
}