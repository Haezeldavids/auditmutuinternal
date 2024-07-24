<?php
require	'../../../koneksi/koneksi.php';

if(isset($_POST['kode_jadwal'])) {
  $kode_jadwal = $_POST['kode_jadwal'];
  
  $query = "SELECT * FROM jadwal WHERE kode_jadwal='$kode_jadwal'";
  $result = mysqli_query($connect, $query);
  $row = mysqli_fetch_array($result);

  // Assuming you have these fields in your jadwal table
  echo '
    <input type="hidden" name="kode_jadwal" value="'.$row['kode_jadwal'].'">
    <div class="form-group">
      <label for="kode_sop">Standar</label>
      <select name="kode_sop" id="kode_sop" class="form-control">
        <option value="'.$row['kode_sop'].'">'.$row['kode_sop'].'</option>';
        $standar_operasional = mysqli_query($connect,"SELECT * from standar_operasional order by kode_sop ASC");
        while ($sop = mysqli_fetch_array($standar_operasional)) {
          echo '<option value="'.$sop['kode_sop'].'">'.$sop['nama_sop'].' || '.$sop['kode_sop'].'</option>';
        }
      echo '</select>
    </div>
    <div class="form-group">
      <label for="id_auditor">Auditor</label>
      <select name="id_auditor" id="id_auditor" class="form-control">
        <option value="'.$row['id_auditor'].'">'.$row['id_auditor'].'</option>';
        $auditor = mysqli_query($connect,"SELECT * from auditor order by nama_auditor ASC");
        while ($adt = mysqli_fetch_array($auditor)) {
          echo '<option value="'.$adt['id_auditor'].'">'.$adt['nama_auditor'].'</option>';
        }
      echo '</select>
    </div>
    <div class="form-group">
      <label for="program_studi">Program Studi</label>
      <input type="text" class="form-control" name="program_studi" id="program_studi" value="'.$row['program_studi'].'">
    </div>
    <div class="form-group">
      <label for="tahun_pengukuran">Tahun Pengukuran Mutu</label>
      <input type="text" class="form-control" name="tahun_pengukuran" id="tahun_pengukuran" value="'.$row['tahun_pengukuran'].'">
    </div>
    <div class="form-group">
      <label for="tanggal_mulai">Tanggal Mulai</label>
      <input type="text" class="form-control" name="tanggal_mulai" id="tanggal_mulai" value="'.$row['tanggal_mulai'].'">
    </div>
    <div class="form-group">
      <label for="tanggal_selesai">Tanggal Selesai</label>
      <input type="text" class="form-control" name="tanggal_selesai" id="tanggal_selesai" value="'.$row['tanggal_selesai'].'">
    </div>
  ';
}
?>