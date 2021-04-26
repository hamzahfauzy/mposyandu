<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">M-Posyandu</a>
        </div>
    </div>
</nav>
<div class="container" style="padding-top:70px;">
    <h2><center>Data Pengguna</center></h2>
	<div class="row">
	    <div class="col-sm-12">
	        <?php 
	        
	        if($model->length){
	        foreach($model->data as $val){
	        ?>
	        <div class="panel panel-primary">
	            <div class="panel-body">
	                Nama Pengguna : <b><?=$val['username'];?></b><br>
	            </div>
	        </div>
	        <?php }}else{ ?>
	        <div class="panel panel-primary">
	            <div class="panel-body">
	                Data Tidak Ada!<br>
	            </div>
	        </div>
	        <?php } ?>
	        <button class="btn btn-danger btn-block" onclick="location='<?=URL;?>'">Kembali</button>
	    </div>
	</div>
</div>
<br>
<br>