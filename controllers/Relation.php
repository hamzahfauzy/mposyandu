<?php
require("models/Relation_Model.php");
class Relation extends Controller {
	
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		$model = new Relation_Model();
		$model->find()->execute();
		$this->view->render("index",0,["model"=>$model]);
	}
	
	function create(){
		$model = new Relation_Model();
		if($this->request("POST")){
			$model->attr($_POST);
			if($model->save()){
				$this->redirect("Relation/index");
			}
		}
		$this->view->render("create",0,["model"=>$model]);
	}
	
	function edit($id){
		$model = new Relation_Model();
		if($this->request("POST")){
			$model->attr($_POST);
			if($model->save()){
				$this->redirect("Relation/index");
			}
		}
		if(isset($id)){
			$pk = $model->getPK();
			$pk = $pk[0]["Column_name"];
			$model->find()->where([$pk=>$id])->one();
		}
		$this->view->render("edit",0,["model"=>$model,"id"=>$id]);
	}
	
	function view($id){
		$model = new Relation_Model();
		if(isset($id)){
			$pk = $model->getPK();
			$pk = $pk[0]["Column_name"];
			$model->find()->where([$pk=>$id])->one();
		}
		$this->view->render("view",0,["model"=>$model,"id"=>$id]);
	}
	
	function delete($id){
		
		if(isset($id)){
			$model = new Relation_Model();
			$pk = $model->getPK();
			$pk = $pk[0]["Column_name"];
			if($model->delete()->where([$pk=>$id])->execute()){
				$this->redirect("Relation/index");
			}
		}
	}
	
}