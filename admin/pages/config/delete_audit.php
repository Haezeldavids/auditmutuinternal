<?php  

require '../../../koneksi/koneksi.php';
$id_audit = $_GET['id_audit'];

$hapus		= mysqli_query($connect, "SELECT * FROM hasil_audit WHERE id_audit = '$id_audit'");
$rows		= mysqli_fetch_array($hapus);
$a	= $rows['File'];




unlink("../dokumen/hasil_audit".$a);
$delete = mysqli_query($connect, "DELETE FROM hasil_audit WHERE id_audit = '$id_audit'");

if ($delete) {
		echo "<script>alert('data berhasil di hapus');window.location.href='../../index4.php?page=audit'</script>";
	}	



?>