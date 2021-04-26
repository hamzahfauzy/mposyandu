<?php
require("libs/Html.php");
require("libs/ArrayHelper.php");
?>
<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">M-Posyandu</a>
        </div>
      </div>
    </nav>
<div class="container" style="padding-top:70px;">
    <h2><center>Form Jadwal Imunisasi</center></h2>
	<div class="row">
	    <div class="col-sm-12">
	        <label>Pilih Anak :</label>
	        <?php
	        $anak = [0=>"Pilih Anak"];
	        $map = ArrayHelper::map($model->getAnak()->data, ["anakID","nama_anak"]);
	        foreach($map as $key => $val){
	            $anak[$key]=$val;
	        }
	        echo Html::comboBox(["name"=>"nama_anak","id"=>"anak","class"=>"form-control","value"=>$anak]);
	        
	        ?>
	        <div id="hasil"></div>
	        <br><br>
	        <button class="btn btn-danger btn-block" onclick="location='<?=URL;?>'">Kembali</button>
	    </div>
	</div>
</div>
<br>
<br>
<script>
$("#anak").change(function(){
    //alert($(this).val());
    $("#hasil").html("Mencari Data...");
    $.get("<?=URL;?>/Imunisasi/cari/"+$(this).val(),function(response){
        if(response)
            $("#hasil").html(response);
    });
});
</script>