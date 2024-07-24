<?php 
    require '../koneksi/koneksi.php';
// mencari kode barang dengan nilai paling besar
$query = "SELECT max(kode_jadwal) as maxKode FROM jadwal";
$hasil = mysqli_query($connect,$query);
$data = mysqli_fetch_array($hasil);
$jdw = $data['maxKode'];

// mengambil angka atau bilangan dalam kode anggota terbesar,
// dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
// misal 'BRG001', akan diambil '001'
// setelah substring bilangan diambil lantas dicasting menjadi integer
$noUrut = (int) substr($jdw, 3, 3);

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$noUrut++;

// membentuk kode anggota baru
// perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
// misal sprintf("%03s", 12); maka akan dihasilkan '012'
// atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
$char = "JDW";
$kd_jdw= $char . sprintf("%03s", $noUrut);
// echo $kodeBarang;


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

     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          
          <!-- /.box --> 

          <div class="box">
            <div class="box-header" style="background-color: #003D6B;">
              <h3 class="box-title" style="font-family: verdana; color: white;">Data Table Jadwal Audit</h3>
            </div>
            <?php
             $username = $_SESSION['username'];  
            $query12 = "
            SELECT 
                CASE 
                    WHEN EXISTS (SELECT 1 FROM admin WHERE username = '$username') THEN 'admin'
                    ELSE 'unknown'
                END AS role
        ";
        $result = mysqli_query($connect, $query12);
        $role = mysqli_fetch_assoc($result)['role'];
        if ($role === 'admin'):
          ?>
            <div class="row">
              <div class="col-xs-4" style="margin : 5px;">
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">

                <i class="fa fa-plus"> </i> Tambah Data Jadwal Audit

              </button>  
              <!--  <a class="btn btn-success" href="pages/config/export_kamera.php">Export ke Excel <i class="fa fa-file-excel-o"></i></a>               -->
              </div>
              
            </div>
            <?php endif; ?>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="display nowrap table-responsive table-striped"  style="width:100%">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Kode Jadwal</th>
                  <th>Nama Standar Nasional</th>
                  <th>Auditor</th>
                  <th>Program Studi</th>
                  <th>Periode</th>
                  <th>Tanggal Mulai</th>
                  <th>Tanggal Selesai</th>
                  
                  
                  <?php
             $username = $_SESSION['username'];  
            $query12 = "
            SELECT 
                CASE 
                    WHEN EXISTS (SELECT 1 FROM admin WHERE username = '$username') THEN 'admin'
                    ELSE 'unknown'
                END AS role
        ";
        $result = mysqli_query($connect, $query12);
        $role = mysqli_fetch_assoc($result)['role'];
        if ($role === 'admin'):
          ?>
                  <th><center>Pengaturan Data</center></th>
                <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                  <?php require '../koneksi/koneksi.php';
                    $no_urut = 0;
                    $query = mysqli_query($connect, "SELECT adt.*,jdw.*,sn.* FROM jadwal jdw INNER JOIN auditor adt ON adt.id_auditor = jdw.id_auditor INNER JOIN standar_nasional sn ON sn.kode_sn = jdw.kode_sn");
                    while ($rows = mysqli_fetch_array($query)) {
                      $no_urut++;
                       
             
                   
                ?>
                  <tr >
                      <td> <?php echo  $no_urut;  ?></td>
                      <td><?php echo $rows['kode_jadwal']?></td>
                      <td> <?php echo $rows['nama_sn']?></td>
                      <td> <?php echo $rows['nama_auditor'];?></td>
                      <td> <?php echo $rows['program_studi'];?></td>
                      <td> <?php echo $rows['tahun_pengukuran']?></td>
                      <td> <?php echo $rows['tanggal_mulai']?></td>
                       <td> <?php echo $rows['tanggal_selesai']?></td>
                       <?php
             $username = $_SESSION['username'];  
            $query12 = "
            SELECT 
                CASE 
                    WHEN EXISTS (SELECT 1 FROM admin WHERE username = '$username') THEN 'admin'
                    ELSE 'unknown'
                END AS role
        ";
        $result = mysqli_query($connect, $query12);
        $role = mysqli_fetch_assoc($result)['role'];
        if ($role === 'admin'):
          ?>
                      <td><center>
                             <div class="btn-group">
                  <button type="button" class="btn btn-danger">Action</button>
                  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#edit_modal_jadwal" data-toggle='modal' data-id="<?php echo $rows['kode_jadwal']; ?>" >Edit</a></li>
                    <li><a href="" data-toggle='modal' data-target='#konfirmasi_hapus_jadwal' data-href="pages/config/delete_jadwal.php?kode_jadwal=<?php echo $rows['kode_jadwal']; ?>"'>Delete</a></li>
                   
                  </ul>
                </div>

                    </td>
                    <?php endif; ?>

                    
                  </tr>
                   <?php } ?>
                </tbody>
                <!-- <tfoot>
                <tr>
                  
                  <th>No</th>
                  <th>Nama</th>
            
          
           
                  <th>Foto</th>
                  
                  
              
                
                
                </tr>
                </tfoot> -->
              </table>
            </div>
          </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
       <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data Jadwal Audit</h4>
              </div>
          <div class="modal-body">
            <form action="pages/config/simpan_jadwal_audit.php" onsubmit="return validasidata_jadwal_audit()" method="POST" enctype="multipart/form-data">
               <div class="row">
                    <div class="col-md-1">
                      
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                          
                              <label for="kode_jadwal">Kode Jadwal</label>
                              <input type="text" class="form-control" name="kode_jadwal" id="kode_jadwal" placeholder="Masukan Kode Jadwal" value="<?php echo $kd_jdw;?>"readonly>   
                          </div>

                         
   
                      <div class="form-group"> 
                          <!-- <label for="kode_sop">Standar Operasional</label> -->
                          <input type="hidden" class="form-control" id="kode_sop" placeholder="Kode sop" name="kode_sop">
                       </div>

                       <div class="form-group"> 
                          <label for="id_auditor">Standar Nasional</label>
                          <select name="sn" id="sn" class="form-control">
                            <option>--Standar Nasional--</option>
                            <?php  
                              //Mengambil nama penanggung jawab dalam Database
                              $auditor = mysqli_query($connect,"SELECT * from standar_nasional order by kode_sn  ASC");
                              while ($rows = mysqli_fetch_array($auditor)) {
                                echo "<option value=\"$rows[kode_sn]\">$rows[nama_sn]</option>\n";
                              }
                            ?>
                          </select>
                       </div>
                       <script>

      
                      

        fetch('pages/jadwal/generate_code.php')
            .then(response => response.text())
            .then(data => {
                document.getElementById('kode_sop').value = data;
            });
    </script>
                       <div class="form-group"> 
                          <label for="id_auditor">Auditor</label>
                          <select name="id_auditor" id="id_auditor" class="form-control">
                            <option>--Auditor--</option>
                            <?php  
                              //Mengambil nama penanggung jawab dalam Database
                              $auditor = mysqli_query($connect,"SELECT * from auditor order by nama_auditor ASC");
                              while ($rows = mysqli_fetch_array($auditor)) {
                                echo "<option value=\"$rows[id_auditor]\">$rows[nama_auditor]</option>\n";
                              }
                            ?>
                          </select>
                       </div>

                       <div class="form-group"> 
                          <label for="id_auditor">Program Studi</label>
                          <select name="program_studi" id="id_auditor" class="form-control">
                            <option>--Program Studi--</option>
                            <?php  
                              //Mengambil nama penanggung jawab dalam Database
                              $auditor = mysqli_query($connect,"SELECT * from unit_kerja order by nama_unit ASC");
                              while ($rows = mysqli_fetch_array($auditor)) {
                                echo "<option value=\"$rows[nama_unit]\">$rows[nama_unit]</option>\n";
                              }
                            ?>
                          </select>
                       </div>
                      
                    
                        
                         
                          
                          <div class="form-group">
                            <label for="tahun_pengukuran">Periode</label>
                            <input type="text" class="form-control" name="tahun_pengukuran" id="tahun_pengukuran" placeholder="Masukan Tahun Pengukuran Mutu">
                          </div>

                      <div class="form-group">
                          <label for="tanggal_mulai"> Tanggal Mulai</label>
                          <div class="row">
                            <div class="col-md-8">
                              <div class="input-group date">
                                <input class="form-control" type="text" name="tanggal_mulai" id="tanggal_mulai" readonly="readonly" placeholder="Tanggal Mulai">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                              </div>
                            </div>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="tanggal_selesai"> Tanggal Selesai</label>
                          <div class="row">
                            <div class="col-md-8">
                              <div class="input-group date">
                                <input class="form-control" type="text" name="tanggal_selesai" id="tanggal_selesai" readonly="readonly" placeholder="Tanggal Selesai">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                              </div>
                            </div>
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


<div class="modal fade" id="edit_modal_jadwal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Jadwal</h4>
            </div>
        <form action="pages/config/jadwal_edit.php" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="hasil-data">
              
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



<div class="modal fade" id="konfirmasi_hapus_jadwal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  
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
