<?php

require("libs/Html.php");

echo "<h2>Data Relation</h2>";

echo "<a href='".$this->base."/create'>";
echo Html::button(["label"=>"Add New"]);
echo "</a>";

echo Html::tablecrud([
					"border"=>1,
					"label"=> $model->label,
					"value"=> $model->data
				], $this->base, $model);