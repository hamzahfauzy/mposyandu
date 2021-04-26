<?php
require("models/Users_Model.php");
class Anak extends Controller {
    
    function __construct(){
        parent::__construct();
        Session::init();
        if(!Session::get("username"))
            $this->redirect();
        $this->view->title = "Anak - M Posyandu";
    }
    
    function index(){
        $usermodel = new Users_Model();
        $usermodel->find()->where(["username"=>Session::get("username")])->one();
        $this->view->render("index",1,["model"=>$usermodel]);
    }
    
    function create(){
        $anak = new Anak_Model();
        if($this->request("POST")){
            $anak->attr($_POST);
            $anak->username = Session::get("username");
            if($anak->save()){
                $this->redirect("Anak");
            }
        }
        $this->view->render("create",1);
    }
    
    function edit($id){
        $this->view->render("create",1);
    }
    
    function delete($id){
        
    }
}