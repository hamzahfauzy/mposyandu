<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">M-Posyandu</a>
        </div>
      </div>
    </nav>
<div class="container" style="padding-top:70px;">
    <h2><center>Chatting</center></h2>
	<div class="row">
	    <div class="col-sm-12">
	        <div class="tampil" style="height:280px;overflow:auto;"></div>
	    </div>
	    
	    <div class="col-sm-12">
	        <br><br>
	        <form method="post" id="form" action="<?=URL;?>/Chatting/send">
	            <div class="form-group">
	            <textarea class="form-control" name="isi" id="isi" placeholder="Isi Pesan"></textarea>
	            <button class="btn btn-block btn-success">Kirim</button>
	            </div>
	        </form>
	    </div>
	    <div class="col-sm-12">
	        <button class="btn btn-danger btn-block" onclick="location='<?=URL;?>'">Kembali</button>
	    </div>
	</div>
</div>
<br>
<br>
<script>
$("#form").submit(function(){
   data = $(this).serialize();
   data += "&username=<?=$username?>";
   action = $(this).attr("action");
   $.post(action,data,function(response){
       if(response)
           $("#isi").val("");
   });
   return false;
});
last="";
setInterval(function(){
    $.get("<?=URL;?>/Chatting/getPesan/<?=$username;?>",function(response){
        if(response != last){
            $(".tampil").html(response);
            var $t = $('.tampil');
            $t.animate({"scrollTop": $('.tampil')[0].scrollHeight}, "slow");
            last = response;
        }
        
    });
},1000);
</script>