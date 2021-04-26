<?php
require("models/Users_Model.php");
class Dashboard extends Controller {
    
    function __construct(){
        parent::__construct();
        Session::init();
        if(!Session::get("username"))
            $this->redirect("Index");
        $this->view->title = "Home - M Posyandu";
    }
    
    function index(){
        $this->view->render("index",1);
    }
    
    function infoimunisasi(){
        $this->view->render("imunisasi",1);
    }
    
    function infoposyandu(){
        $this->view->render("posyandu",1);
    }
    
    function Users(){
        $usermodel = new Users_Model();
        $usermodel->find()->where(["username !"=>"dokter"])->execute();
        $this->view->render("users",1,["model"=>$usermodel]);
	}
    
    function logout(){
        Session::destroy();
        $this->redirect();
    }
    
    
}