<?php
require	'../koneksi/koneksi.php';
?>
<style>
    #example1 {
    border-collapse: collapse; 
    border: 1px solid #003366; 
}


#example1 th, #example1 td {
    border: 1px solid #003366; 
}


#example1 thead th {
    background-color: #003366; 
    color: #fff; 
}


#example1 tbody tr:hover {
    background-color: #f0f0f0; 
}


#example1 {
    border: 2px solid #003366; 
}

</style>
<section class="content">
      <div class="row">
        <div class="col-xs-12">

        <div class="box">
            <div class="box-header" style="background-color: #003D6B;">
              <h3 style="color: white; font-family: verdana;" class="box-title">Data Table Kontrol Audit</h3>
            </div>
 <center>
    <?php
$username = $_SESSION['username'];  
$query = "
SELECT 
    CASE 
        WHEN EXISTS (SELECT 1 FROM admin WHERE username = '$username') THEN 'admin'
        WHEN EXISTS (SELECT 1 FROM login_wakil_ketua WHERE username = '$username') THEN 'wakil_ketua'
        ELSE 'unknown'
    END AS role
";
$result = mysqli_query($connect, $query);
$role = mysqli_fetch_assoc($result)['role'];
if ($role == 'admin') {
    $action = 'index.php'; 
    $action1 = 'index.php?page=kontrol_audit';
} else {
    $action = 'index2.php';
    $action1 = 'index2.php?page=kontrol_audit'; 
}

    ?>
            <form action="<?= $action ?>" method="get" style="margin-top: 20px;">
    <input type="hidden" name="page" value="kontrol_audit">
    <select name="filter_program_studi" id="" class="form-control" style="width: 180px;">
        <option value="">--pilih periode--</option>
        <?php
        $t = mysqli_query($connect,"SELECT * FROM jadwal ORDER BY tahun_pengukuran");
        foreach($t as $r){
            echo "<option value=\"$r[tahun_pengukuran]\">$r[tahun_pengukuran]</option>";
        }
        ?>
        <!-- Tambahkan opsi-opsi lainnya sesuai kebutuhan -->
    </select>
    <a href="<?= $action1 ?>" class="btn btn-warning" style="margin: 10px;">Back Filter</a>
    <button type="submit" class="btn btn-primary">Filter</button>
</form>
</center>
    
<div class="box-body table-responsive">
              <table id="example1" class="display nowrap table-bordered table-responsive table-striped"  style="width:100%;">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Program Studi</th>
                    <th>Periode</th>
                    <th>Nama Auditor</th>
                    <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                        $no=1;
                      
                        $filter_program_studi = isset($_GET['filter_program_studi']) ? $_GET['filter_program_studi'] : '';
                        if(isset($_GET['filter_program_studi'])){
                        $query = mysqli_query($connect,"SELECT jadwal.program_studi,jadwal.kode_jadwal,auditor.nama_auditor, jadwal.tahun_pengukuran, COUNT(auditor.id_auditor) AS jumlah_auditor
                                         FROM jadwal
                                         LEFT JOIN auditor ON jadwal.id_auditor = auditor.id_auditor
                                         LEFT JOIN dokumen ON dokumen.kode_unit = jadwal.kode_jadwal
                                         LEFT JOIN hasil_audit ON hasil_audit.kode_jadwal = jadwal.kode_jadwal
                                         WHERE jadwal.tahun_pengukuran = '$filter_program_studi'
                                         GROUP BY jadwal.program_studi, jadwal.tahun_pengukuran");
                        }
                        else{
                            $query = mysqli_query($connect,"SELECT jadwal.program_studi,jadwal.kode_jadwal,auditor.nama_auditor, jadwal.tahun_pengukuran, COUNT(auditor.id_auditor) AS jumlah_auditor
                            FROM jadwal
                            LEFT JOIN auditor ON jadwal.id_auditor = auditor.id_auditor
                            LEFT JOIN hasil_audit ON hasil_audit.kode_jadwal = jadwal.kode_jadwal
                            LEFT JOIN dokumen ON dokumen.kode_unit = jadwal.kode_jadwal
                            GROUP BY jadwal.program_studi, jadwal.tahun_pengukuran");
                        }
                        foreach($query as $row):
                            
                            $query_check_audit = mysqli_query($connect, "SELECT COUNT(hasil_audit.id_audit) AS jumlah
                            FROM hasil_audit
                            WHERE hasil_audit.kode_jadwal = '" . $row['kode_jadwal'] . "'");
$result_check_audit = mysqli_fetch_assoc($query_check_audit);
$jumlah_dokumen_audit = $result_check_audit['jumlah'];
$status_audit_text = ($jumlah_dokumen_audit > 0) ? "Selesai" : "Belum selesai";
$status_audit_class = ($jumlah_dokumen_audit > 0) ? "label label-success" : "label label-danger";

// Check status for koorprodi
$query_check_dokumen = mysqli_query($connect, "SELECT COUNT(dokumen.id_dokumen) AS jumlah_ko
                              FROM dokumen
                              WHERE dokumen.kode_unit = '" . $row['kode_jadwal'] . "'");
$result_check_dokumen = mysqli_fetch_assoc($query_check_dokumen);
$jumlah_dokumen_koorprodi = $result_check_dokumen['jumlah_ko'];
$status_koorprodi_text = ($jumlah_dokumen_koorprodi > 0) ? "Selesai" : "Belum selesai";
$status_koorprodi_class = ($jumlah_dokumen_koorprodi > 0) ? "label label-success" : "label label-danger";
            
            
            
                        ?>
                    <tr>
                        
                    <td><?= $no++ ?></td>
                    <td><?= $row['program_studi'] ?></td>
                    <td><?= $row['tahun_pengukuran'] ?></td>
                    <td><?= $row['nama_auditor'] ?></td>

                    
                    <td><div style="display: flex;">Auditor : <div class="<?= $status_audit_class ?>"><?= $status_audit_text ?></div></div> <div style="display: flex; margin-top: 10px;">Koorprodi : <span class="<?= $status_koorprodi_class ?>"><?= $status_koorprodi_text ?></span></div></td>
                    
                </tr>
                <?php endforeach; ?> 
            </tbody>
              </table>
            </div>
        </div>
        </div>
        </div>
      </div>
    </section>
            
            