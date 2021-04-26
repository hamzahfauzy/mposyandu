<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">M-Posyandu</a>
        </div>
      </div>
    </nav>
<div class="container" style="padding-top:70px;">
    <h2><center>Pesan Dari Pengguna</center></h2>
	<div class="row">
	    <div class="col-sm-12">
	        <?php
	        if($model->length){
	            foreach($model->data as $val){
	                $isi = $last($val['username']);
	                //print_r($isi);
	        ?>
	        <div class="panel panel-default pesan" data-username="<?=$val['username'];?>">
	            <div class="panel-body">
	                <b><?=$val['username'];?></b>
	                <p><?=$isi->isi;?></p>
	                <p>Tanggal : <?=$isi->tanggal;?></p>
	            </div>
	        </div>
	        <?php } }else echo "Tidak Ada Data"; ?>
	    </div>
	    <div class="col-sm-12">
	        <button class="btn btn-danger btn-block" onclick="location='<?=URL;?>'">Kembali</button>
	    </div>
	</div>
</div>
<br>
<br>
<script>
$(".pesan").click(function(){
    username = $(this).data("username");
    location="<?=URL;?>/Chatting/tampil/"+username;
});
setInterval(function(){
    location=location;
},2000);
</script>