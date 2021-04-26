<?php

require("libs/Html.php");

echo "<h2>View Sample Page</h2>";

$labels = $model->label;
foreach($labels as $label){
	echo "$label : ".$model->{$label}."<br>";
}

echo "<h2>Relation</h2>";

//print_r($model->getRelation()->data);
foreach($model->getRelation()->data as $rows){
	echo $rows['relation_name'];
	echo "<br>";
}