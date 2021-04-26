<?php

class Bootloader {
	
	function __construct(){
		
		//get the url
		$url = isset($_GET['url']) ? $_GET['url'] : null;
		$url = rtrim($url, '/');
		//convert url to array
		$url = explode("/", $url);
		
		//check if url[0] is empty
		if(empty($url[0])){
			require("controllers/Index.php");
			$controller =  new Index();
			$controller->view->controller = "index";
			$controller->index();
			$controller->view->base = URL."/Index";
			//$controller->modelLoad("Index");
			return false;
		}
		
		$file = "controllers/".$url[0].".php";
		if(file_exists($file)){
			require $file;
			//call the controller file from url get
			$controller = new $url[0];
			$controller->view->controller = strtolower($url[0]);
			$controller->view->base = URL."/".$url[0];
			//load model file from url get
			//$controller->modelLoad($url[0]);
			if(isset($url[2])){
				if(method_exists($controller, $url[1])){
					$controller->{$url[1]}($url[2]);
				}else{
					$this->error();
				}
			}else{
				if(isset($url[1])){
					if(method_exists($controller,$url[1])){
						$controller->{$url[1]}();
					}else{
						$this->error();
					}
				}else{
					$controller->index();
				}
			}
		}else{
			$this->error();
		}
		
		
		
	}
	
	function error(){
		require "controllers/Error.php";
		$error = new Error();
		$error->index();
		return false;
	}
	
}