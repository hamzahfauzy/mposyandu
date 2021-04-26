<form method="post">
<label>Nama Lengkap:</label>
<input type="text" name="nama_anak" class="form-control">
<label>Tempat Lahir:</label>
<input type="text" name="tempat_lahir" class="form-control">
<label>Tanggal Lahir:</label>
<input type="date" value="<?=date('Y-m-d');?>" name="tanggal_lahir" class="form-control">
<button class="btn btn-success btn-block">Simpan</button>
<button type="button" class="btn btn-danger btn-block" onclick="history.go(-1)">Kembali</button>
</form>