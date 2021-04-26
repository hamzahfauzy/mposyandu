<div class="container">
    <h2><center>M-Posyandu</center></h2>
	<div class="row">
	    <div class="col-sm-12">
	        <img class="img img-responsive center-block" src="<?=URL;?>/vendor/images/icon.jpg">
	    </div>
	</div>
	<div class="row">
	    <div class="col-sm-12">
	        <?php
	        $link = @$_GET['action'];
	        if(!isset($link)){
	        ?>
	        <h2 align="center">Login</h2>
	        <form method="post" class="center-block">
	            <input type="hidden" name="action" value="login">
	            Username :<br>
	            <input type="text" name="username" class="form-control">
	            Password :<br>
	            <input type="password" name="password" class="form-control">
	            <button class="btn btn-success btn-block">Login</button>
	            <button class="btn btn-warning btn-block" type="button" onclick="location='<?=URL;?>/?action=daftar'">Daftar</button>
	        </form>
	        <?php }else{ ?>
	        <h2 align="center">Daftar</h2>
	        <form method="post" class="center-block">
	            <input type="hidden" name="action" value="daftar">
	            Nama Lengkap :<br>
	            <input type="text" name="nama" class="form-control">
	            Username :<br>
	            <input type="text" name="username" class="form-control">
	            Password :<br>
	            <input type="password" name="password" class="form-control">
	            <button class="btn btn-success btn-block">Daftar</button>
	            <button class="btn btn-warning btn-block" type="button" onclick="location='<?=URL;?>'">Kembali</button>
	        </form>
	        <?php } ?>
	    </div>
	</div>
</div>
<br>
<br>