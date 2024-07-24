<?php  

require '../../../koneksi/koneksi.php';




		$kode_sn	= $_POST['kode_sn'];
		$kode_sop	= $_POST['kode_sop'];
		$nama_sop	= $_POST['nama_sop'];
		$tgl_mulai	= $_POST['tgl_mulai'];
		$tgl_selesai = $_POST['tgl_selesai'];

		

		
	

	$query = mysqli_query($connect, "UPDATE standar_operasional SET kode_sn='$kode_sn',kode_sop='$kode_sop',nama_sop='$nama_sop',tgl_mulai='$tgl_mulai',tgl_selesai='$tgl_selesai' WHERE kode_sop='$kode_sop'");
	
// var_dump($query);
// print_r($query);

	header('Location:../../index.php?page=standar_operasional');

?>