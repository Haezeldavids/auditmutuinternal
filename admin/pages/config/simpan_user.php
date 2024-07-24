<?php
require '../koneksi/koneksi.php';
;

if(isset($_POST['btn-simpan'])){
  $nip = $_POST['nip'];
  $nama = $_POST['nama'];
  $email = $_POST['email'];
  $no_telp = $_POST['no_telp'];
  $jabatan = $_POST['jabatan'];

  echo "NIP: $nip<br>";
  echo "Nama: $nama<br>";
  echo "Email: $email<br>";
  echo "No Telp: $no_telp<br>";
  echo "Jabatan: $jabatan<br>";

  if($jabatan == 'Wakil Ketua'){
    $query = "INSERT INTO wakil_ketua (nip_wakil_ketua, nama_wakil_ketua, email_wakil_ketua, no_telp_wakil_ketua, jabatan_wakil_ketua) VALUES ('$nip', '$nama', '$email', '$no_telp', '$jabatan')";
  } elseif($jabatan == 'Staf') {
    $query = "INSERT INTO staf (nik_staf, nama_staf, email, no_hp) VALUES ('$nip', '$nama', '$email', '$no_telp')";
  } elseif($jabatan == 'Auditor') {
    $query = "INSERT INTO auditor (nip, nama_auditor, email_auditor, no_telp_auditor) VALUES ('$nip', '$nama', '$email', '$no_telp')";
  }

  if(mysqli_query($connect, $query)){
    echo "<script>alert('Data berhasil disimpan'); window.location.href='../../index.php?page=data_wakil_ketua';</script>";
  } else {
    echo "<script>alert('Data gagal disimpan'); window.location.href='../../index.php?page=data_wakil_ketua';</script>";
  }
} else {
  echo "Form tidak disubmit dengan benar.";
}
?>
