<?php

class Controller {
	
	function __construct(){
		$this->view = new View();
	}
	
	function modelLoad($name){
		$path = "models/".$name."_Model.php";
		if(file_exists($path)){
			require $path;
			$model = $name."_Model";
			$this->model = new $model;
		}
	}
	
	function redirect($page=false,$msg=false){
		if($msg!=false)
			$msg = "?msg=$msg";
		else
			$msg = "";
		header("location:".URL."/".$page.$msg);
	}
	
	function request($method){
		return ($_SERVER['REQUEST_METHOD'] == $method);
	}
	
	function error(){
		require "controllers/Error.php";
		$error = new Error();
		$error->view->controller = "index";
		$error->index();
		return false;
	}
	
}