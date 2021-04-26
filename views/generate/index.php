<?php

require("libs/Html.php");
require("libs/ArrayHelper.php");

?>

<h2>CRUD Generator</h2>

<?php
$map = ArrayHelper::map($dbname->showtable(),["","Tables_in_".DBNAME]);
echo Html::formbegin(["method"=>"post"]);
echo "Select Table : <br>";
echo Html::comboBox([
					"id"=>"tbl",
					"name"=>"table",
					"value"=>$map
					]);
echo "<br>";
echo "Controller Name : <br>";
echo Html::text([
				"id"=>"controllerName",
				"name"=>"controllerName"
				]);
echo "<br>";
echo Html::button(["label"=>"Generate"]);
echo Html::formend();

?>