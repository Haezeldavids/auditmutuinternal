
<?php 
	require	'../../../koneksi/koneksi.php';
	if ($_POST['idx']) {
		$id_dokumen = $_POST['idx'];
		$query = mysqli_query($connect, "SELECT * FROM hasil_audit WHERE id_dokumen = '$id_dokumen'");
		while ($rows = mysqli_fetch_array($query)) {
 	// var_dump($query);
 ?>
    <div class="form-group">
			<label>Id Dokumen</label>
			<input type="text" class="form-control" name="id_dokumen" value="<?php echo $rows['id_audit'];?>" readonly>	
		</div>
<?php }} ?>