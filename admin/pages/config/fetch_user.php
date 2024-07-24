<?php
require 'C:\xampp\htdocs\AMI-1\koneksi\koneksi.php';

if (isset($_POST['nip'])) {
  $nip = $_POST['nip'];
  
  // Query untuk mengambil data user berdasarkan NIP
  $query = "
    SELECT nip_wakil_ketua AS NIP, nama_wakil_ketua AS name, email_wakil_ketua AS email, no_telp_wakil_ketua AS nomor_hp, jabatan_wakil_ketua AS role FROM wakil_ketua WHERE nip_wakil_ketua='$nip'
    UNION
    SELECT nik_staf AS NIP, nama_staf AS name, email AS email, no_hp AS nomor_hp, 'Koorprodi' AS role FROM staf WHERE nik_staf='$nip'
    UNION
    SELECT nip AS NIP, nama_auditor AS name, email_auditor AS email, no_telp_auditor AS nomor_hp, 'Auditor' AS role FROM auditor WHERE nip='$nip';
  ";
  $result = mysqli_query($connect, $query);
  $data = mysqli_fetch_array($result);

  echo "
    <div class='form-group'>
      <label for='nip'>NIP</label>
      <input type='text' class='form-control' name='nip' id='nip' value='{$data['NIP']}' >
    </div>
    <div class='form-group'>
      <label for='nama'>Nama</label>
      <input type='text' class='form-control' name='nama' id='nama' value='{$data['name']}'>
    </div>
    <div class='form-group'>
      <label for='email'>Email</label>
      <input type='text' class='form-control' name='email' id='email' value='{$data['email']}'>
    </div>
    <div class='form-group'>
      <label for='no_telp'>Nomor Handphone</label>
      <input type='text' class='form-control' name='no_telp' id='no_telp' value='{$data['nomor_hp']}'>
    </div>
    <div class='form-group'>
      <label for='jabatan'>Role</label>
      <select name='jabatan' class='form-control'>
        <option value='Wakil Ketua' " . ($data['role'] == 'Wakil Ketua' ? 'selected' : '') . ">Wakil Ketua</option>
        <option value='Staf' " . ($data['role'] == 'Staf' ? 'selected' : '') . ">Staf</option>
        <option value='Auditor' " . ($data['role'] == 'Auditor' ? 'selected' : '') . ">Auditor</option>
      </select>
    </div>
  ";
}

?>
