<?php

class Model {
	
	public $length;
	public $last_id;
	public $tbl = "";
	public $sql = "";
	public $data = array();
	public $label = array();
	function __construct(){
		$this->db = new Database();
		$this->tbl = isset(static::$table) ? static::$table : "";
		$this->label = isset(static::$lbl) ? static::$lbl : array();
	}
	
	function showtable(){
		$this->query("SHOW TABLES FROM ".$this->db->dbname);
		return $this->data;
	}
	
	function showfield($tbl){
		$this->query("SHOW columns FROM ".$tbl);
		return $this->data;
	}
	
	function query($query,$type=false){
		$q = $this->db->query($query);
		if($q){
			$this->length = @$q->num_rows;
			$this->last_id = @$this->db->insert_id;
			if($this->length){
				if($type!=false)
					$this->data = $q->fetch_assoc();
				else
					$this->data = $q->fetch_all(MYSQLI_ASSOC);
				
				$this->attr($this->data);
			}
		}
		return $q;
	}
	
	function find(){
		$this->sql = "select * from ".$this->tbl." ";
		return $this;
	}
	
	function where($clause){
		$where = "where ";
		$num = count($clause);
		$i=0;
		foreach($clause as $key => $value){
			$where .= $key."='".$value."'";
			if($i<$num-1)
				$where .= " and ";
			$i++;
		}
		$this->sql .= $where;
		return $this;
	}
	
	function orderby($clause){
		$order = "order by $clause[0] $clause[1]";
		$this->sql .= $order;
		return $this;
	}
	
	function execute(){
		$this->query($this->sql);
		return $this;
	}
	
	function one(){
		$this->query($this->sql,1);
		return $this;
	}
	
	function attr($param = array()){
		foreach($param as $key=>$value){
			$this->{$key} = $value;
		}
	}
	
	function getPK(){
		$query = "show index from ".$this->tbl." where Key_name = 'PRIMARY'";
		$this->query($query);
		return $this->data;
	}
	
	function getFieldType($fieldName){
		$query = "SELECT DATA_TYPE FROM information_schema.COLUMNS WHERE TABLE_NAME = '".$this->tbl."' AND COLUMN_NAME = '".$fieldName."'";
		$this->query($query,1);
		return $this->data;
	}
	
	function save(){
		$query = "show index from ".$this->tbl." where Key_name = 'PRIMARY'";
		$this->query($query);
		if($this->length){
			$primary_key = $this->data[0]["Column_name"];
			$this->query("select * from ".$this->tbl." where $primary_key = '".@$this->{$primary_key}."'");
			if($this->length){
				$insert = "update ".$this->tbl." set ";
				$i=0;
				foreach($this->label as $rows){
					if($rows !== $primary_key){
						$insert .= $rows."='".$this->{$rows}."'";
						if($i<count($this->label)-1)
							$insert .= ",";
					}
					$i++;
				}
				
				$insert .= " where $primary_key = '".$this->{$primary_key}."'";
			}else{
				$val="";
				$values="";
				$i=0;
				foreach($this->label as $rows){
					$val .= $rows;
					if(empty($this->{$rows}))
						$values .= "NULL";
					else
						$values .= "'".$this->{$rows}."'";
					if($i<count($this->label)-1){
						$val .= ",";
						$values .= ",";
					}
					$i++;
				}
				$insert = "insert into ".$this->tbl."($val)values($values)";
			}
			if($this->query($insert))
				return true;
			else
				return false;
		}else
			return false;
	}
	
	function delete(){
		$sql = "delete from ".$this->tbl." ";
		$this->sql = $sql;
		return $this;
	}
	
	function hasOne($class, $criteria=false, $custom=false, $order=false){
		$model = new $class;
		$model->find();
		if($criteria && is_array($criteria)){
			foreach($criteria as $key => $value){
				$model->where([$key=>$this->{$value}]);
			}
		}
		if($custom && is_array($custom)){
		    foreach($custom as $key => $value){
				$model->where([$key=>$value]);
			}
		}
		if($order && is_array($order)){
			$model->orderby($order);
		}
		$model->one();
		return $model;
	}
	
	function hasMany($class, $criteria=false, $custom=false, $order=false){
		$model = new $class;
		$model->find();
		if($criteria && is_array($criteria)){
			foreach($criteria as $key => $value){
				$model->where([$key=>$this->{$value}]);
			}
		}
		if($custom && is_array($custom)){
		    foreach($custom as $key => $value){
				$model->where([$key=>$value]);
			}
		}
		if($order && is_array($order)){
			$model->orderby($order);
		}
		$model->execute();
		return $model;
	}
	
	
}