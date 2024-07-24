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
          <h3 class="box-title" style="color: white; font-family: verdana;">Data Akun User</h3>
        </div>
        <div class="row">
          <div class="col-xs-4" style="margin: 5px;">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#akun_wakilketua">
              <i class="fa fa-plus"> </i>Olah Akun User
            </button>

          </div>

        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table id="example1" class="display nowrap table-responsive table-striped" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Password</th>




                <th>
                  <center>Pengaturan Data</center>
                </th>

              </tr>
            </thead>
            <tbody>
              <?php require '../koneksi/koneksi.php';
              $no_urut = 0;
              // $query = mysqli_query($connect, "SELECT * FROM login_wakil_ketua");
              // $query = mysqli_query($connect, "SELECT lwk.*,wkt.* FROM login_wakil_ketua lwk INNER JOIN wakil_ketua wkt ON wkt.id_wakil_ketua=lwk.id_wakil_ketua");
              // $query = mysqli_query($connect, "SELECT lwk.*,wkt.* FROM login_staf lstf INNER JOIN staf stf ON stf.id=lstf.id");
              // $query = mysqli_query($connect, "SELECT lwk.*,wkt.* FROM login_auditor latr INNER JOIN auditor atr ON atr.id_auditor=latr.id_auditor");
              $query = mysqli_query($connect, "
                    (
                        SELECT lwk.*, lwk.id_wakil_ketua AS id, wkt.nama_wakil_ketua AS nama , 'login_wakil_ketua' AS source
                        FROM login_wakil_ketua lwk
                        INNER JOIN wakil_ketua wkt ON wkt.id_wakil_ketua = lwk.id_wakil_ketua
                    )
                    UNION
                    (
                        SELECT lstf.*, lstf.id_staf AS id, stf.nama_staf AS nama, 'login_staf' AS source
                        FROM login_staf lstf
                        INNER JOIN staf stf ON stf.id = lstf.id_staf
                    )
                    UNION
                    (
                        SELECT latr.*, latr.id_auditor AS id, atr.nama_auditor AS nama, 'login_auditor' AS source
                        FROM login_auditor latr
                        INNER JOIN auditor atr ON atr.id_auditor = latr.id_auditor
                    );
                ");

              while ($rows = mysqli_fetch_array($query)) {
                $no_urut++;



              ?>
                <tr>
                  <td> <?php echo  $no_urut;  ?></td>
                  <td> <?php echo $rows['nama'] ?></td>
                  <td> <?php echo $rows['username']; ?></td>
                  <td> <?php echo $rows['password']; ?></td>







                  <td>
                    <center>
                      <div class="btn-group">
                        <button type="button" class="btn btn-danger">Action</button>
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                          <span class="caret"></span>
                          <span class="sr-only"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#edit_modal_wakil_ketua<?php echo $rows['source'] . $rows['id'] ?>" data-toggle='modal' data-id="<?php echo $rows['id']; ?>">Edit</a></li>
                          <li><a href="" data-toggle='modal' data-target='#konfirmasi_hapus_wakil_ketua' data-href="pages/config/delete_wakil_ketua.php?id_wakil_ketua=<?php echo $rows['id_wakil_ketua']; ?>"'>Delete</a></li>
                   
                  </ul>
                </div>

                    </td>

                    
                  </tr>

                  <div class="modal fade" id="edit_modal_wakil_ketua<?php echo $rows['source'] . $rows['id'] ?>" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Akun</h4>
            </div>
        <form method="POST" accept-charset="utf-8" enctype="multipart/form-data">
        <div class="modal-body">
            <div class="hasil-data">
              <input type="hidden" name="id" value="<?= $rows['id']?>">
              <input type="hidden" name="source" value="<?= $rows['source']; ?>">
              <div class="form-group">
                <label for="">Nama</label>
                <input type="text" name="nama" class="form-control" value="<?= $rows['nama'] ?>" readonly>
              </div>

              <div class="form-group">
                <label for="">Username</label>
                <input type="text" name="username" class="form-control" value="<?= $rows['username']?>">
              </div>

              <div class="form-group">
                <label for="">Password</label>
                <input type="text" name="pw" class="form-control" value="<?= $rows['password']?>">
              </div>

              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                <button type="submit" name="up" class="btn btn-success">UPDATE</button>
            </div>
          </div>  
        </form> 
        <?php
        if(isset($_POST['up'])){
$id=$_POST['id'];
$username = $_POST['username'];
$pw = $_POST['pw'];
$source = $_POST['source'];
$connect->begin_transaction();
                           try {
                               if ($source == 'login_wakil_ketua') {
                                   $update = $connect->prepare("UPDATE login_wakil_ketua SET username=?, password=? WHERE id_wakil_ketua=?");
                                   $update->bind_param("sss",$username, $pw, $id);
                               } elseif ($source == 'login_staf') {
                                   $update = $connect->prepare("UPDATE login_staf SET username=?, password=? WHERE id_staf=?");
                                   $update->bind_param("sss",$username, $pw, $id);
                               } elseif ($source == 'login_auditor') {
                                   $update = $connect->prepare("UPDATE login_auditor SET username=?, password=? WHERE id_auditor=?");
                                   $update->bind_param("ssi",$username, $pw, $id);
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
                           echo "<script>alert('Berhasil');document.location='index.php?page=akun_wakilketua';</script>";
                          }
        ?>
        </div>
      
    </div>
  
</div>
                   <?php } ?>
                </tbody>
                <!-- <tfoot>
                <tr>
                  
                  <th>No</th>
                  <th>Nama</th>
                  <th>Username</th>
                  <th>Password</th>
                  
          
           
             
                  
                  
              
                
                
                </tr>
                </tfoot> -->
              </table>
            </div>
          </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
       <div class="modal fade" id="akun_wakilketua">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data User</h4>
              </div>
          <div class="modal-body">
            <form action="pages/config/simpan_akun_wakil_ketua.php" onsubmit="" method="POST" enctype="multipart/form-data">
               <div class="row">
                    <div class="col-md-1">
                      
                    </div>
                    <div class="col-md-9">
                        
                          <div class="form-group"> 
                          
                          <label for="id_user">User</label>
<select name="id_user" id="id_user" class="form-control">
  <option value="">--Pilih User--</option>
    <optgroup label="Wakil Ketua">
        <?php
        // Mengambil data wakil ketua dari database
        $query_wakil_ketua = mysqli_query($connect, "SELECT * FROM wakil_ketua ORDER BY nip_wakil_ketua ASC");
        while ($row = mysqli_fetch_array($query_wakil_ketua)) {
            echo "<option value='wakil_ketua_$row[id_wakil_ketua]' data-kode-user=\"{$row['nip_wakil_ketua']}\">$row[nama_wakil_ketua]</option>";
        }
        ?>
    </optgroup>
    <optgroup label="Staf">
        <?php
        // Mengambil data staf dari database
        $query_staf = mysqli_query($connect, "SELECT * FROM staf ORDER BY nik_staf ASC");
        while ($row = mysqli_fetch_array($query_staf)) {
            echo "<option value='staf_$row[id]' data-kode-user=\"{$row['nik_staf']}\">$row[nama_staf]</option>";
        }
        ?>
    </optgroup> 
    <optgroup label="Auditor">
        <?php
        // Mengambil data auditor dari database
        $query_auditor = mysqli_query($connect, "SELECT * FROM auditor ORDER BY nip ASC");
        while ($row = mysqli_fetch_array($query_auditor)) {
            echo "<option value='auditor_$row[id_auditor]' data-kode-user=\"{$row['nip']}\">$row[nama_auditor]</option>";
        }
        ?>
    </optgroup>
</select>

                            <!-- <option disabled>--Wakil Ketua--</option> -->
                            <!-- <?php
                            //Mengambil nama jabatan dalam Database
                            $wakil_ketua = mysqli_query($connect, "SELECT * from wakil_ketua order by nama_wakil_ketua ASC");
                            while ($rows = mysqli_fetch_array($wakil_ketua)) {
                              echo "<option value=\"$rows[id_wakil_ketua]\">$rows[nama_wakil_ketua]</option>\n";
                            }
                            ?> -->
                          </select>
                       </div>
                      
                    
                        
                          
                          <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Masukan Username">
                          </div>
                          <script>
        document.addEventListener('DOMContentLoaded', function() {
            var kodeSnSelect = document.getElementById('id_user');
            var kodeSopInput = document.getElementById('username');

            kodeSnSelect.addEventListener('change', function() {
                var selectedOption = kodeSnSelect.options[kodeSnSelect.selectedIndex];
                var kodeSN = selectedOption.getAttribute('data-kode-user');
                kodeSopInput.value = kodeSN;
            });
        });
    </script>

                          <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" name="password" id="password" placeholder="Masukan Password">
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



         







<div class="modal fade" id="konfirmasi_hapus_wakil_ketua" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
  
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