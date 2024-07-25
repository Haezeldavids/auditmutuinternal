<?php
require '../koneksi/koneksi.php';
if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit();
}

$username_session = $_SESSION['username'];

// Query to check if the user is an admin
$query_admin = mysqli_query($connect, "SELECT * FROM login_auditor WHERE username='$username_session'");
$is_auditor = mysqli_num_rows($query_admin) > 0;

?>

<style>
  #example1 {
    border-collapse: collapse; /* Menggabungkan border tabel dan sel */
    border: 1px solid #003366; /* Border luar tabel */
}

/* Border pada sel tabel */
#example1 th, #example1 td {
    border: 1px solid #003366; /* Border sel tabel */
}

/* Warna latar belakang header tabel */
#example1 thead th {
    background-color: #003366; /* Warna latar belakang header tabel */
    color: #fff; /* Warna teks header tabel */
}

/* Warna latar belakang baris tabel saat di-hover */
#example1 tbody tr:hover {
    background-color: #f0f0f0; /* Warna latar belakang saat hover */
}

/* Mengatur border di seluruh tabel */
#example1 {
    border: 2px solid #4DB6AC; /* Border luar tabel */
}
</style>
     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <!-- /.box -->

          <div class="box">
            <div class="box-header" style="background-color: #003D6B;">
              <h3 class="box-title" style="color: white; font-family: verdana;">Data Table Audit</h3>
            </div>
            <div class="row">
              <div class="col-xs-4" style="margin: 5px;">
              <?php $current_page = isset($_GET['page']) ? $_GET['page'] : '';if ($is_auditor && $current_page != 'hasil_audit'): ?>
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">

                <i class="fa fa-plus"> </i> Tambah Data Audit

              </button>
              <?php endif;?>
              </div>

            </div>
            <center>
              <?php
$username = $_SESSION['username'];
$query = "
SELECT
    CASE
        WHEN EXISTS (SELECT 1 FROM admin WHERE username = '$username') THEN 'admin'
        WHEN EXISTS (SELECT 1 FROM login_wakil_ketua WHERE username = '$username') THEN 'LPM'
        WHEN EXISTS (SELECT 1 FROM login_staf WHERE username = '$username') THEN 'koorprodi'
        WHEN EXISTS (SELECT 1 FROM login_auditor WHERE username = '$username') THEN 'auditor'
        ELSE 'unknown'
    END AS role
";
$result = mysqli_query($connect, $query);
$role = mysqli_fetch_assoc($result)['role'];
// Tetapkan nilai action berdasarkan peran pengguna
if ($role == 'admin') {
    $action = 'index.php';
    $action1 = 'index.php?page=hasil_audit'; // Aksi untuk admin
} elseif ($role == 'LPM') {
    $action = 'index2.php';
    $action1 = 'index2.php?page=hasil_audit'; // Aksi untuk user
} elseif ($role == 'koorprodi') {
    $action = 'index3.php';
    $action1 = 'index3.php?page=hasil_audit'; // Aksi untuk editor
} elseif ($role == 'auditor') {
    $action = 'index4.php';
    $action1 = 'index4.php?page=hasil_audit'; // Aksi untuk viewer
}

?>
    <!-- <?php
$username = $_SESSION['username'];
$query = "
    SELECT
        CASE
            WHEN EXISTS (SELECT 1 FROM admin WHERE username = '$username') THEN 'admin'
            WHEN EXISTS (SELECT 1 FROM login_wakil_ketua WHERE username = '$username') THEN 'wakil_ketua'
            ELSE 'unknown'
        END AS role
";
// $result = mysqli_query($connect, $query);
// $role = mysqli_fetch_assoc($result)['role'];
//     if($role == "admin" || $role == "wakil_ketua"){
?> -->
<h3>Pilih periode untuk melihat hasil audit</h3>

<form action="<?=$action?>" method="get" style="margin-top: 20px;">
    <input type="hidden" name="page" value="hasil_audit">
    <select name="filter_program_studi" id="filter_program_studi" class="form-control" style="width: 180px;" onchange="this.form.submit()">
        <option value="">--pilih periode--</option>
        <?php
// $t = mysqli_query($connect,"SELECT * FROM jadwal ORDER BY tahun_pengukuran");
$t = mysqli_query($connect, "SELECT DISTINCT tahun_pengukuran FROM jadwal ORDER BY tahun_pengukuran");
foreach ($t as $r) {
    $selected = (isset($_GET['filter_program_studi']) && $_GET['filter_program_studi'] == $r['tahun_pengukuran']) ? 'selected' : '';
    echo "<option value=\"$r[tahun_pengukuran]\" $selected>$r[tahun_pengukuran]</option>";
}
?>
        <!-- Tambahkan opsi-opsi lainnya sesuai kebutuhan -->
    </select>
    <a href="<?=$action1?>" class="btn btn-warning" style="margin: 10px;">Back Filter</a>
    <button type="submit" class="btn btn-primary">Filter</button>
</form>

<?php if (isset($_GET['filter_program_studi']) && $_GET['filter_program_studi'] != ''): ?>
<center>
    <div class="box-body table-responsive">
        <table id="example1" class="display nowrap table-responsive table-striped"  style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Program Studi</th>
                    <th>Kode Standar</th>
                    <th>Standar Operasional</th>
                    <th>Periode</th>
                    <th>Auditor</th>
                    <th>Tanggal Audit</th>
                    <th>File</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
require '../koneksi/koneksi.php';
$no_urut = 0;
$filter_program_studi = isset($_GET['filter_program_studi']) ? $_GET['filter_program_studi'] : '';
if ($filter_program_studi != '') {
    $query = mysqli_query($connect, "SELECT
                            ha.id_audit,
                            ha.kode_jadwal,
                            uk.program_studi,
                            uk.tahun_pengukuran,
                            ha.kode_sop,
                            sop.nama_sop,
                            ha.Auditor,
                            ha.Tanggal,
                            ha.File
                        FROM
                            hasil_audit ha
                        JOIN
                            jadwal uk ON ha.kode_jadwal = uk.kode_jadwal
                        JOIN
                            standar_operasional sop ON ha.kode_sop = sop.kode_sop
                        WHERE uk.tahun_pengukuran = '$filter_program_studi'
                        GROUP BY uk.program_studi, uk.tahun_pengukuran");
}

if (!$query) {
    die('Error: ' . mysqli_error($connect));
}

while ($rows = mysqli_fetch_array($query)) {
    $no_urut++;
    ?>
                <tr>
                    <td><?php echo $no_urut; ?></td>
                    <td><?php echo $rows['program_studi']; ?></td>
                    <td><?php echo $rows['kode_sop']; ?></td>
                    <td><?php echo $rows['nama_sop']; ?></td>
                    <td><?php echo $rows['tahun_pengukuran']; ?></td>
                    <td><?php echo $rows['Auditor']; ?></td>
                    <td><?php echo $rows['Tanggal']; ?></td>
                    <td><a href="pages/dokumen/hasil_audit/<?php echo $rows["File"]; ?>" target="_blank"><?php echo $rows["File"]; ?></a></td>
                    <td><center>
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger">Action</button>
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#edit_modal_audit<?=$rows['id_audit']?>" data-toggle='modal' data-id="<?php echo $rows['id_audit']; ?>" >Edit</a></li>
                                <li><a href="" data-toggle='modal' data-target='#konfirmasi_hapus_audit' data-href="pages/config/delete_audit.php?id_audit=<?php echo $rows['id_audit']; ?>">Delete</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <div class="modal fade" id="edit_modal_audit<?=$rows['id_audit']?>" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Edit Audit</h4>
                            </div>
                            <form action="pages/config/hasil_audit_edit.php" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Id Audit</label>
                                        <input type="text" class="form-control" name="id_audit" value="<?php echo $rows['id_audit']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Kode Sop</label>
                                        <input type="text" class="form-control" name="kode_sop" value="<?php echo $rows['kode_sop']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <select name="auditor" id="" class="form-control">
                                            <option value="">--Auditor--</option>
                                            <?php
$select = mysqli_query($connect, "SELECT * FROM auditor ORDER BY nama_auditor");
    foreach ($select as $r) {
        echo "<option value=\"$r[nama_auditor]\">$r[nama_auditor]</option>";
    }
    ?>
                                        </select>
                                        <div class="form-group">
                                            <label for="tgl_sop">Tanggal Audit</label>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-group date">
                                                        <input class="form-control" type="text" name="tgl_sop" id="tgl_sop" readonly="readonly" value="<?=$rows['Tanggal']?>" placeholder="Tanggal Penetapan Standar">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                                        <button type="submit" class="btn btn-success">UPDATE</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
}
?>
            </tbody>
        </table>
    </div>
</center>
<?php endif;?>

            </div>
          </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>




<div class="modal fade" id="konfirmasi_hapus_audit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

        <div class="modal-dialog" style="margin-top: 15%;">
            <div class="modal-content" style="margin-top: 100px;">
              <div class="modal-header">
                  <h4 class="modal-title" style="text-align: center;">Anda yakin akan menghapus data ini ?</h4>
              </div>
                <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                    <a class="btn btn-danger btn-ok"> Hapus</a>
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
                </div>
            </div>
        </div>
    </div>


    </section>


    <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Masukan Data Audit</h4>
              </div>
          <div class="modal-body">
            <form action="pages/config/simpan_hasil_audit.php" onsubmit="return validasidata_tambah_sub_standar()" method="POST" enctype="multipart/form-data">
               <div class="row">

                    <div class="col-md-12">

                          <div class="form-group">
                          <label for="kode_unit">Program Studi</label>
                          <select name="kode_unit" id="kode_unit" class="form-control">
                            <option>--Program Studi--</option>
                            <?php
//Mengambil nama jabatan dalam Database
$unit_kerja = mysqli_query($connect, "SELECT * from jadwal order by program_studi ASC");
while ($rows = mysqli_fetch_array($unit_kerja)) {
    echo "<option value=\"$rows[kode_jadwal]\">$rows[program_studi]</option>\n";
}
?>
                          </select>
                       </div>

                       <div class="form-group">
                          <label for="kode_sop">Standar Operasional</label>
                          <select name="kode_sop" id="kode_sop" class="form-control">
                            <option>--Standar Operasional--</option>
                            <?php

$standar_operasional = mysqli_query($connect, "SELECT * from standar_operasional order by kode_sop ASC");
while ($rows = mysqli_fetch_array($standar_operasional)) {
    echo "<option value=\"$rows[kode_sop]\">$rows[nama_sop]||$rows[kode_sop]</option>\n";
}
?>
                          </select>
                       </div>

                       <div class="form-group">
                          <label for="id_auditor">Auditor</label>
                          <select name="id_auditor" id="id_auditor" class="form-control">
                            <option>--Auditor--</option>
                            <?php
//Mengambil nama penanggung jawab dalam Database
$auditor = mysqli_query($connect, "SELECT * from auditor order by nama_auditor ASC");
while ($rows = mysqli_fetch_array($auditor)) {
    echo "<option value=\"$rows[nama_auditor]\">$rows[nama_auditor]</option>\n";
}
?>
                          </select>
                       </div>


                       <div class="form-group">
                                <label for="tgl_sop">Tanggal Audit</label>
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="input-group date">
                                      <input class="form-control" type="text" name="tgl_sop" id="tgl_sop" readonly="readonly" placeholder="Tanggal Audit">
                                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                  </div>
                                </div>
                            </div>



                       <div class="form-group">
                        <label for="file">Dokumen</label>
                        <input type="file" name="file" id="file" class="form-control btn btn-success" accept=".xls,.xlsx">
                      </div>






                </div>
            </div>
         </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success" name="btn-simpan">Save changes</button>
                    </div>
                </form>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>



        <script>
    document.getElementById('file').addEventListener('change', function() {
      const fileInput = this;
      const filePath = fileInput.value;
      const allowedExtensions = /(\.xls|\.xlsx)$/i;

      if (!allowedExtensions.exec(filePath)) {
        alert('Format file tidak diizinkan. Hanya file Excel yang diperbolehkan (xls, xlsx).');
        fileInput.value = ''; // Clear the input
        return false;
      }
    });
  </script>

  <script>
    $(document).ready(function() {
    $('#edit_modal_audit').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var modal = $(this);

        $.ajax({
            url: 'edit_modal_audit.php',
            type: 'POST',
            data: { id: id },
            success: function(data) {
                modal.find('.hasil-data').html(data);
            }
        });
    });
});

  </script>