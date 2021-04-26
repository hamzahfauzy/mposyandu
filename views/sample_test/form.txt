<?php

require("libs/Html.php");

echo Html::formbegin(["method"=>"post"]);
$labels = $model->label;
foreach($labels as $label){
	echo "$label :";
	echo "<br>";
	$type = $model->getFieldType($label);
	if($type['DATA_TYPE'] == "text")
		echo Html::textArea(["name"=>"$label","value"=>@$model->{$label}]);
	else
		echo Html::text(["name"=>"$label","value"=>@$model->{$label}]);
	echo "<br>";
}
echo Html::button(["label"=>"Simpan"]);
echo Html::formend();