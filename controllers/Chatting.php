<?php
require("models/Chatting_Model.php");
require("models/Users_Model.php");

class Chatting extends Controller {
    
    function __construct(){
        parent::__construct();
        Session::init();
        if(!Session::get("username"))
            $this->redirect("Index");
        $this->view->title = "Chatting - M Posyandu";
    }
    
    function index(){
        
        $uname = Session::get("username");
        if($uname !== "dokter")
            $this->tampil($uname);
        else{
            $model = new Chatting_Model;
            $model->sql = "SELECT * FROM (SELECT DISTINCT pesanID, username, tanggal FROM `pesan` order BY tanggal DESC) as s GROUP by s.username order by tanggal DESC ";
            $model->execute();
            
            $last = function($username){
              $model = new Chatting_Model;
              $model->find()->where(["username"=>$username])->orderby(["tanggal","desc"])->one();
              return $model;
            };
            //print_r($model);
            $re["model"] = $model;
            $re["last"] = $last;
            $this->view->render("index",1,$re);
        }
    }
    
    function tampil($username){
        $this->view->render("view",1,["username"=>$username]);
    }
    
    function getPesan($username){
        $model = new Chatting_Model;
        $model->find()->where(["username"=>$username])->execute();
        if($username == Session::get("username"))
            $u = "Anda";
        else
            $u = $username;
            
        if("dokter" == Session::get("username"))
            $dokter = "Anda";
        else
            $dokter = "Dokter";
        foreach($model->data as $val){
            echo "<div class='container-fluid'>";
            if($val['status'] == 0)
                echo "<div class='btn btn-success pull-left' style='text-align:left;'>
                        <b>$u</b> pada <span>$val[tanggal]</span><br> 
                        <span>".nl2br($val['isi'])."</span>
                     </div>";
            else
                echo "<div class='btn btn-primary pull-right' style='text-align:right;'>
                    <b>$dokter</b> pada <span>$val[tanggal]</span><br>
                    <span>".nl2br($val['isi'])."</span>
                  </div>";
            echo "</div>";
            echo "<p></p>";
        }
    }
    
    function send(){
        if(isset($_POST['isi'])){
            $status = 0;
            $uname = Session::get("username");
            if($uname == "dokter"){
                $uname = $_POST["username"];
                $status = 1;
            }
            $model = new Chatting_Model;
            $model->username = $uname;
            $model->isi = $_POST['isi'];
            $model->status = $status;
            $model->tanggal = date("Y-m-d H:i:s");
            $model->save();
            echo 1;
        }
    }
}