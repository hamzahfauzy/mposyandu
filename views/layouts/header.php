<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
<title><?=$this->title;?></title>
<?php
foreach($this->vendor as $key => $val){
	if($key == "css"){
		foreach($val as $value){
			echo "<link href='$value' type='text/css' rel='stylesheet'>\n";
		}
	}
}
?>
<?php
foreach($this->vendor as $key => $val){
	if($key == "js"){
		foreach($val as $value){
			echo "<script src='$value'></script>\n";
		}
	}
}
?>
</head>
<body>