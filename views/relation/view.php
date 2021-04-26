<?php

require("libs/Html.php");

echo "<h2>View Relation Page</h2>";

$labels = $model->label;
foreach($labels as $label){
	echo "$label : ".$model->{$label}."<br>";
}