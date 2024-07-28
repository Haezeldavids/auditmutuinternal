<?php 
require '../koneksi/koneksi.php';

if (!isset($_SESSION['username'])) {
    header("location:login.php");
    exit();
}

$username_session = $_SESSION['username'];

// Query to check if the user is an admin
$query_admin = mysqli_query($connect, "SELECT * FROM admin WHERE username='$username_session'");
$is_admin = mysqli_num_rows($query_admin) > 0;

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
              <h3 class="box-title" style="color: white; font-family: verdana;">Data Table Dokumen AMI</h3>
            </div>
            <div class="row">
              <div class="col-xs-4" style="margin: 5px;">
              <?php if ($is_admin): ?>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">
                                    <i class="fa fa-plus"></i> Tambah Data Dokumen AMI
                                </button>
                            <?php endif; ?>
              <!--  <a class="btn btn-success" href="pages/config/export_kamera.php">Export ke Excel <i class="fa fa-file-excel-o"></i></a>               -->
              </div>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="display nowrap table-responsive table-striped"  style="width:100%">
                <thead>
                <tr>
                  <th>No</th>
                  <th>program studi</th>
                  <th>Standar Nasional</th>
                  <th>Kode Standar </th>
                  <th>Nama Standar</th>
                  <th>Koorprodi</th>
                  <th>Auditor</th>
                  <th>File</th>
                  <th>Tanggal Mulai</th>
                  <th>Tanggal Selesai</th>
                  
                  <th><center>Pengaturan Data</center></th>
                
                </tr>
                </thead>
                <tbody>
                  <?php require '../koneksi/koneksi.php';
                    $no_urut = 0;
                    $query = mysqli_query($connect, "SELECT sop.*,unt.*,sn.*,pnjwb.*,ad.* FROM standar_operasional sop INNER JOIN jadwal unt ON sop.kode_unit = unt.kode_jadwal INNER JOIN standar_nasional sn ON sn.kode_sn = sop.kode_sn INNER JOIN staf pnjwb ON sop.id_koorprodi = pnjwb.id INNER JOIN auditor ad ON sop.id_auditor = ad.id_auditor");
                    while ($rows = mysqli_fetch_array($query)) {
                      $no_urut++;
                       
             
                   
                ?>
                  <tr >
                      <td> <?php echo  $no_urut;  ?></td>
                      <td> <?php echo $rows['program_studi']?></td>
                      <td> <?php echo $rows['nama_sn'];?></td>
                      <td> <?php echo $rows['kode_sop']?></td>
                      
                      <td> <?php echo $rows['nama_sop']?></td>
                      <td><?php echo $rows['nama_staf']?></td>
                      <td><?php echo $rows['nama_auditor']?></td>
                      <td><a href="pages/dokumen/<?php echo $rows["file"] ?>" target="_blank"><?php echo $rows["file"] ?></a></td>
                      <td> <?php echo $rows['tgl_mulai'];?></td>
                      <td> <?php echo $rows['tgl_selesai'];?></td>
               
                      
                    
                      <!-- <td>
                        <textarea name="" id="" cols="45" rows="15" style="align-content:left; overflow:auto; width:18px; height:18px">
                          <?php echo $rows['keterangan'];?></textarea> 
                       </td>  -->
                      
                      <td><center>
                             <div class="btn-group"> 
                  <button type="button" class="btn btn-danger">Action</button>
                  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only"></span>
                  </button> 
                   <ul class="dropdown-menu" role="menu"> 
                    <li><a href="#edit_modal_standar_sop" data-toggle='modal' data-id="<?php echo $rows['kode_sop']; ?>" >Edit</a></li>
                    <li><a href="" data-toggle='modal' data-target='#konfirmasi_hapus_standar_sop' data-href="pages/config/delete_standar_sop.php?kode_sop=<?php echo $rows['kode_sop']; ?>"'>Delete</a></li>
                     <li class="divider"></li>
                    <!-- <li><a href="#edit_modal_foto_kamera" data-toggle='modal' data-id="<?php echo $rows['kode_kamera']; ?>" >Info</a></li> --> 
                  </ul>
                </div>

                    </td>

                    
                  </tr> 
                   <?php } ?>
                <!-- </tbody> -->
                <!-- <tfoot>
                <tr>
                  <th>No</th>
                  <th>Kode Standar</th>
                  <th>Nama Standar</th>
                  <th>Tanggal Standar</th>
              
                
                
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
                <h4 class="modal-title">Masukan Data Dokumen AMI</h4>
              </div>
          <div class="modal-body">
            <form action="pages/config/simpan_standar_operasional.php" onsubmit="return validasidata_tambah_sub_standar()" method="POST" enctype="multipart/form-data">
               <div class="row">
                    <div class="col-md-1">
                      
                    </div>
                    <div class="col-md-9">

                          <div class="form-group"> 
                          <label for="kode_unit">Program Studi</label>
                          <select name="kode_unit" id="kode_unit" class="form-control">
                            <option>--Program Studi--</option>
                            <?php  
                              //Mengambil nama jabatan dalam Database
                              $unit_kerja = mysqli_query($connect,"SELECT * from jadwal order by program_studi ASC");
                              while ($rows = mysqli_fetch_array($unit_kerja)) {
                                echo "<option value=\"$rows[kode_jadwal]\" data-kode-sop=\"{$rows['kode_sop']}\">$rows[program_studi]</option>\n";
                              }
                            ?>
                          </select>
                       </div>

                       <div class="form-group"> 
                          <label for="kode_sn">Standar Nasional</label>
                          <select name="kode_sn" id="kode_sn" class="form-control">
                            <option>--Standar Nasional--</option>
                            <?php  
                              //Mengambil nama penanggung jawab dalam Database
                              $standar_nasional = mysqli_query($connect,"SELECT * from standar_nasional order by nama_sn ASC");
                              while ($rows = mysqli_fetch_array($standar_nasional)) {
                                echo "<option value=\"$rows[kode_sn]\">$rows[nama_sn]</option>\n";
                              }
                            ?>
                          </select>
                       </div>




                         <div class="form-group">
                          
                              <label for="kode_sop">Kode Standar Operasional</label>
                              <input type="text" class="form-control" name="kode_sop" id="kode_sop" placeholder="Masukan Kode Standar Operasional" readonly>   
                          </div>
                          <script>
        document.addEventListener('DOMContentLoaded', function() {
            var kodeSnSelect = document.getElementById('kode_unit');
            var kodeSopInput = document.getElementById('kode_sop');

            kodeSnSelect.addEventListener('change', function() {
                var selectedOption = kodeSnSelect.options[kodeSnSelect.selectedIndex];
                var kodeSN = selectedOption.getAttribute('data-kode-sop');
                kodeSopInput.value = kodeSN;
            });
        });
    </script>
                         <div class="form-group">
                          
                              <label for="nama_sop">Nama Standar Operasional</label>
                              <input type="text" required class="form-control" name="nama_sop" id="nama_sop" placeholder="Masukan Nama Standar Operasional">   
                          </div>
                                         
                         <div class="form-group"> 
                          <label for="id_penanggung_jawab">Nama Koorprodi</label>
                          <select name="id_koorprodi" id="id_penanggung_jawab" class="form-control">
                            <option>--Nama Koorprodi--</option>
                            <?php  
                              //Mengambil nama penanggung jawab dalam Database
                              $penanggung_jawab = mysqli_query($connect,"SELECT * from staf order by nama_staf ASC");
                              while ($rows = mysqli_fetch_array($penanggung_jawab)) {
                                echo "<option value=\"$rows[id]\">$rows[nama_staf]</option>\n";
                              }
                            ?>
                          </select>
                       </div>

                       <div class="form-group"> 
                          <label for="id_penanggung_jawab">Nama Auditor</label>
                          <select name="id_auditor" id="id_penanggung_jawab" class="form-control">
                            <option>--Nama Auditor--</option>
                            <?php  
                              //Mengambil nama penanggung jawab dalam Database
                              $penanggung_jawab = mysqli_query($connect,"SELECT * from auditor order by nama_auditor ASC");
                              while ($rows = mysqli_fetch_array($penanggung_jawab)) {
                                echo "<option value=\"$rows[id_auditor]\">$rows[nama_auditor]</option>\n";
                              }
                            ?>
                          </select>
                       </div>

                       <div class="form-group">
                        <label for="file">Dokumen</label>
                        <input type="file" name="file"  id="file" class="form-control btn btn-success" accept=".xls,.xlsx">
                      </div>

                            <div class="form-group">
                                <label for="tgl_mulai"> Tanggal Mulai</label>
                                <div class="row">
                                  <div class="col-md-8">
                                    <div class="input-group date">
                                      <input class="form-control" type="text" name="tgl_mulai" id="tgl_sop" readonly="readonly" placeholder="Tanggal Penetapan Standar">
                                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                  </div>
                                </div>

                                <label for="tgl_selesai"> Tanggal Selesai</label>
                                <div class="row">
                                  <div class="col-md-8">
                                    <div class="input-group date">
                                      <input class="form-control" type="text" name="tgl_selesai" id="tgl_sop" readonly="readonly" placeholder="Tanggal Penetapan Standar">
                                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
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


<div class="modal fade" id="edit_modal_standar_sop" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Dokumen Audit</h4>
            </div>
        <form action="pages/config/edit_standar_sop.php" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
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


</div>

<div class="modal fade" id="konfirmasi_hapus_standar_sop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  
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