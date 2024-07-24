<?php  

$nama = $_POST['nama'];
$username = $_POST['username'];
$pw = $_POST['pw'];
$connect->begin_transaction();
                           try {
                               if ($source == 'login_wakil_ketua') {
                                   $update = $connect->prepare("UPDATE wakil_ketua SET nip_wakil_ketua=?, nama_wakil_ketua=?, email_wakil_ketua=?, no_telp_wakil_ketua=? WHERE nip_wakil_ketua=?");
                                   $update->bind_param("isssi",$nip1, $name, $email, $nomor_hp, $original_nip);
                               } elseif ($source == 'staf') {
                                   $update = $connect->prepare("UPDATE staf SET nik_staf=?, nama_staf=?, email=?, no_hp=? WHERE nik_staf=?");
                                   $update->bind_param("isssi",$nip1, $name, $email, $nomor_hp, $original_nip);
                               } elseif ($source == 'auditor') {
                                   $update = $connect->prepare("UPDATE auditor SET nip=?, nama_auditor=?, email_auditor=?, no_telp_auditor=? WHERE nip=?");
                                   $update->bind_param("isssi",$nip1, $name, $email, $nomor_hp, $original_nip);
                               }
                               if ($update->execute()) {
                                   $connect->commit();
                                   echo "Update berhasil";
                               } else {
                                   throw new Exception("Error updating record: " . $update->error);
                               }
                           } catch (Exception $e) {
                               $connect->rollback();
                               echo "Update gagal: " . $e->getMessage();
                           }
                           echo "<script>alert('Berhasil');document.location='index.php?page=data_wakil_ketua';</script>";
                       

	header('Location:../../index.php?page=data_wakil_ketua');

?>