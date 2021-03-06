<?php
require("models/Sample_Model.php");
class Sample extends Controller {
	
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		$model = new Sample_Model();
		$model->find()->execute();
		$this->view->render("index",0,["model"=>$model]);
	}
	
	function create(){
		$model = new Sample_Model();
		if($this->request("POST")){
			$model->attr($_POST);
			if($model->save()){
				$this->redirect("Sample/index");
			}
		}
		$this->view->render("create",0,["model"=>$model]);
	}
	
	function edit($id){
		$model = new Sample_Model();
		if($this->request("POST")){
			$model->attr($_POST);
			if($model->save()){
				$this->redirect("Sample/index");
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
		$model = new Sample_Model();
		if(isset($id)){
			$pk = $model->getPK();
			$pk = $pk[0]["Column_name"];
			$model->find()->where([$pk=>$id])->one();
		}
		$this->view->render("view",0,["model"=>$model,"id"=>$id]);
	}
	
	function delete($id){
		
		if(isset($id)){
			$model = new Sample_Model();
			$pk = $model->getPK();
			$pk = $pk[0]["Column_name"];
			if($model->delete()->where([$pk=>$id])->execute()){
				$this->redirect("Sample/index");
			}
		}
	}
	
}