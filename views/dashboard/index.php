<div class="container">
    <h2><center>M-Posyandu</center></h2>
	<div class="row">
	    <div class="col-sm-12">
	        <img class="img img-responsive center-block" src="<?=URL;?>/vendor/images/icon.jpg">
	    </div>
	</div>
	<div class="row">
	    <div class="col-sm-12">
	        <h2 align="center">Home</h2>
	        <?php if(Session::get("username") == "dokter" ) { ?>
	        <button class="btn btn-primary btn-block" onclick="location='<?=URL;?>/Dashboard/Users'">Data Pengguna</button>
	        <?php }else{ ?>
	        <button class="btn btn-primary btn-block" onclick="location='<?=URL;?>/Anak'">Data Anak</button>
	        <button class="btn btn-success btn-block" onclick="location='<?=URL;?>/Imunisasi'">Imunisasi</button>
	        <button class="btn btn-warning btn-block" onclick="location='<?=URL;?>/Imunisasi/asupan'">Cek Asupan Gizi</button>
	        <button class="btn btn-primary btn-block" onclick="location='<?=URL;?>/Dashboard/infoimunisasi'">Tentang Imunisasi</button>
	        <button class="btn btn-success btn-block" onclick="location='<?=URL;?>/Dashboard/infoposyandu'">Tentang Posyandu</button>
	        <?php } ?>
	        <button class="btn btn-warning btn-block" onclick="location='<?=URL;?>/Chatting'">Chatting</button>
	        <button class="btn btn-danger btn-block" onclick="location='<?=URL;?>/Dashboard/logout'">Logout</button>
	    </div>
	</div>
</div>
<br>
<br>