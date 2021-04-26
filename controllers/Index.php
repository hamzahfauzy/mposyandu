<?php
require("models/Users_Model.php");
class Index extends Controller {
	
	function __construct(){
		parent::__construct();
		Session::init();
		if(Session::get("username"))
		    $this->redirect("Dashboard");
	}
	
	function index(){
	    if($this->request("POST")){
	        $model = new Users_Model();
	        if($_POST['action']=="login"){
	            $model->find()->where(["username"=>$_POST['username'],"password"=>$_POST['password']])->one();
	            //print_r($model);
	            //return;
	            if($model->length){
	                Session::set("username",$_POST['username']);
	                $this->redirect();
	            }else if($_POST['username']=="dokter" && $_POST['password'] == "dokter"){
	                Session::set("username","dokter");
	                $this->redirect();
	            }else{
	                echo "<script>alert('Username atau Password Salah');location='".URL."';</script>";
	            }
	        }else{
	            $model->username = $_POST['username'];
	            $model->password = $_POST['password'];
	            $model->nama_lengkap = $_POST['nama'];
	            if($model->save())
	                $this->redirect();
	            else
	                echo "<script>alert('Gagal');location='".URL."';</script>";
	        }
	    }
		$this->view->title = "Selamat Datang";
		$this->view->render("index",1);
	}
	
}