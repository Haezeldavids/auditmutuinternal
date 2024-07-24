
<?php  
	require '../../../koneksi/koneksi.php';

	

		$kode_jadwal	= $_POST['kode_jadwal'];
		$program	= $_POST['program'];
		$sop=$_POST['sop'];

		
		
		
		$query = mysqli_query($connect, "UPDATE jadwal SET kode_jadwal='$kode_jadwal', program_studi='$program', kode_sop = '$sop' WHERE kode_jadwal='$kode_jadwal'");
	
// var_dump($query);
// print_r($query);

	header('Location:../../index2.php?page=unit_kerja');




?>