<?php
include "../../../koneksi/koneksi.php";

$id_audit = $_POST['id_audit'];
$kode_sop = $_POST['kode_sop'];
$auditor = $_POST['auditor'];
$tanggal = $_POST['tgl_sop'];

$update = mysqli_query($connect,"UPDATE hasil_audit SET kode_sop='$kode_sop',auditor='$auditor',tanggal='$tanggal' WHERE id_audit ='$id_audit'");
echo "<script>alert('Data berhasil di perbarui');document.location='../../index4.php?page=audit'</script>";

?>