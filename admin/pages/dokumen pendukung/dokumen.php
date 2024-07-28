<?php 
    require '../koneksi/koneksi.php';
// mencari kode barang dengan nilai paling besar
// $query = "SELECT max(kode_kamera) as maxKode FROM kamera";
// $hasil = mysqli_query($connect,$query);
// $data = mysqli_fetch_array($hasil);
// $kodeKamera = $data['maxKode'];
// 
// mengambil angka atau bilangan dalam kode anggota terbesar,
// dengan cara mengambil substring mulai dari karakter ke-1 diambil 6 karakter
// misal 'BRG001', akan diambil '001'
// setelah substring bilangan diambil lantas dicasting menjadi integer
// $noUrut = (int) substr($kodeKamera, 3, 3);

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
// $noUrut++;

// membentuk kode anggota baru
// perintah sprintf("%03s", $noUrut); digunakan untuk memformat string sebanyak 3 karakter
// misal sprintf("%03s", 12); maka akan dihasilkan '012'
// atau misal sprintf("%03s", 1); maka akan dihasilkan string '001'
// $char = "KMR";
// $kodeBarang = $char . sprintf("%03s", $noUrut);
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
              <h3 class="box-title" style="color: white; font-family: verdana;">Data Table Dokumen</h3>
            </div>
            <div class="row">
              <div class="col-xs-4" style="margin: 5px;">
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">

                <i class="fa fa-plus"> </i> Tambah Data Dokumen

              </button>  
              <!--  <a class="btn btn-success" href="pages/config/export_kamera.php">Export ke Excel <i class="fa fa-file-excel-o"></i></a>               -->
              </div>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table id="example1" class="display nowrap table-responsive table-striped"  style="width:100%">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Program Studi</th>
                  <th>Nama Standar</th> 
                  <th>Nama Dokumen</th>
                  <th>Dokumen</th>
                  <th>Tanggal</th>
                  
                  <th><center>Pengaturan Data</center></th>
                
                </tr>
                </thead>
                <tbody>
                  <?php require '../koneksi/koneksi.php';
                    $no_urut = 0;
                    $query = mysqli_query($connect, "SELECT sop.*, dk.*, uk.program_studi
                    FROM dokumen dk 
                    INNER JOIN standar_operasional sop ON sop.kode_sop = dk.kode_sop 
                    INNER JOIN jadwal uk ON sop.kode_unit = uk.kode_jadwal
                    ");
                    while ($rows = mysqli_fetch_array($query)) {
                      $no_urut++;
                       
             
                   
                ?>
                  <tr >
                      <td> <?php echo  $no_urut;  ?></td>
                      <td> <?php echo $rows['program_studi'] ?></td>
                      <td> <?php echo $rows['nama_sop'];?></td>
                     
                      <td>
                     
                          <?php echo $rows['nama_dokumen'];?> </td>
                      <td> <?php echo $rows['dokumen']?></td>
                      <td> <?php echo $rows['tgl_dokumen'];?></td>
               
                      
                    
                    
                      
                      <td><center>
                             <div class="btn-group">
                  <button type="button" class="btn btn-danger">Action</button>
                  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only"></span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#edit_modal_dokumen" data-toggle='modal' data-id="<?php echo $rows['id_dokumen']; ?>" >Edit</a></li>
                    <li><a href="" data-toggle='modal' data-target='#konfirmasi_hapus_dokumen' data-href="pages/config/delete_dokumen.php?id_dokumen=<?php echo $rows['id_dokumen']; ?>">Delete</a></li>
                    <!-- <li class="divider"></li>
                    <li><a href="#edit_modal_foto_kamera" data-toggle='modal' data-id="<?php echo $rows['kode_kamera']; ?>" >Info</a></li> -->
                  </ul>
                </div>

                    </td>

                    
                  </tr>
                   <?php } ?>
                </tbody>
                
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
            <form action="pages/config/simpan_dokumen.php" onsubmit="" method="POST" enctype="multipart/form-data">
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
                              
                              $standar_operasional = mysqli_query($connect,"SELECT * from standar_operasional order by kode_sop ASC");
                              while ($rows = mysqli_fetch_array($standar_operasional)) {
                                echo "<option value=\"$rows[kode_sop]\">$rows[nama_sop]||$rows[kode_sop]</option>\n";
                              }
                            ?>
                          </select>
                       </div>




                         <div class="form-group">
                          
                              <label for="nama_dokumen">Nama Dokumen</label>
                              <input type="text" required class="form-control" name="nama_dokumen" id="nama_dokumen" placeholder="Masukan nama dokumen">   
                          </div>

                         
                      <div class="form-group">
                        <label for="dokumen">Dokumen</label>
                        <input type="file" name="dokumen" id="dokumen" class="form-control btn btn-success" accept=".xls,.xlsx">
                      </div>

                       
                                         
                         
                            <div class="form-group">
                                <label for="tgl_dokumen"> Tanggal Upload</label>
                                <div class="row">
                                  <div class="col-md-8">
                                    <div class="input-group date">
                                      <input class="form-control" type="text" name="tgl_dokumen" id="date" readonly="readonly" placeholder="Tanggal Upload">
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


<div class="modal fade" id="edit_modal_dokumen" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Dokumen</h4>
            </div>
        <form action="pages/config/dokumen_edit.php" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
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

<div class="modal fade" id="konfirmasi_hapus_dokumen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  
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
    document.getElementById('dokumen').addEventListener('change', function() {
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