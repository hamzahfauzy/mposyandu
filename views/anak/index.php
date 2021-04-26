<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">M-Posyandu</a>
        </div>
      </div>
    </nav>
<div class="container" style="padding-top:70px;">
    <h2><center>Data Anak Anda</center></h2>
	<div class="row">
	    <div class="col-sm-12">
	        <?php 
	        
	        if($model->getAnak()->length){
	        foreach($model->getAnak()->data as $val){
	            $biday = new DateTime($val["tanggal_lahir"]);
            	$today = new DateTime();
            	
            	$diff = $today->diff($biday);
            	$usia="";
            	if($diff->d >= 0)
            	    $usia .= $diff->d . " Hari";
            	if($diff->m > 0)
            	    $usia .= " ".$diff->m . " Bulan";
            	if($diff->y > 0)
            	    $usia .= " ".$diff->y . " Tahun";
            	    
            	if(isset($model->getLastPosyandu($val['anakID'])->tanggal))
            	    $tanggal = $model->getLastPosyandu($val['anakID'])->tanggal;
            	else
            	    $tanggal = "Belum Pernah Posyandu";
	        ?>
	        <div class="panel panel-primary">
	            <div class="panel-body">
	                Nama Anak : <b><?=$val['nama_anak'];?></b><br>
	                Usia : <b><?=$usia;?></b><br>
	                <!-- Terakhir Posyandu : <b><?=$tanggal;?></b><br> -->
	            </div>
	        </div>
	        <?php }}else{ ?>
	        <div class="panel panel-primary">
	            <div class="panel-body">
	                Data Anak Tidak Ada!<br>
	                Silahkan Tambah Data Anak..
	            </div>
	        </div>
	        <?php } ?>
	        <button class="btn btn-success btn-block" onclick="location='<?=URL;?>/Anak/create'">Tambah Data</button>
	        <button class="btn btn-danger btn-block" onclick="location='<?=URL;?>'">Kembali</button>
	    </div>
	</div>
</div>
<br>
<br>