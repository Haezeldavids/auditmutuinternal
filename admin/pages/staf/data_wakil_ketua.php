<?php
require '../koneksi/koneksi.php';


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
    border: 2px solid #003366; /* Border luar tabel */
}
</style>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">

      <!-- /.box -->

      <div class="box">
        <div class="box-header" style="background-color: #003D6B;">
          <h3 class="box-title" style="font-family: verdana; color: white;">Data Table User</h3>
        </div>
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
        if ($role === 'admin'):
                ?>
        <div class="row">
          <div class="col-xs-4" style="margin-left: 5px;">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">

              <i class="fa fa-plus"> </i> Tambah Data User

            </button>
          </div>
        </div>
        <?php endif; ?>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table id="example1" class="display nowrap table-responsive table-striped" style="width:100%">
            <thead>
              <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Role</th>
                <?php
                
                if($role === "admin"){

                ?>
                <th>
                  <center>Pengaturan Data</center>
                </th>
                <?php
                }
                ?>
              </tr>
            </thead>
            <tbody> 
              <?php 
           $no_urut = 0;
           $query_all_users = "
               SELECT nip_wakil_ketua AS NIP, nama_wakil_ketua AS name, email_wakil_ketua AS email, no_telp_wakil_ketua AS nomor_hp, jabatan_wakil_ketua AS role, 'wakil_ketua' AS source FROM wakil_ketua
               UNION
               SELECT nik_staf AS NIP, nama_staf AS name, email AS email, no_hp AS nomor_hp, 'Koorprodi' AS role, 'staf' AS source FROM staf
               UNION
               SELECT nip AS NIP, nama_auditor AS name, email_auditor AS email, no_telp_auditor AS nomor_hp, 'Auditor' AS role, 'auditor' AS source FROM auditor;
           ";
           $query = mysqli_query($connect, $query_all_users);
           
           while ($rows = mysqli_fetch_array($query)) {
               $no_urut++;
           ?>
           <tr>
               <td><?php echo $no_urut; ?></td>
               <td><?php echo $rows['NIP']; ?></td> <!-- Menampilkan NIP atau NIK sesuai dengan data asli dari database -->
               <td><?php echo $rows['name']; ?></td>
               <td><?php echo $rows['email']; ?></td>
               <td><?php echo $rows['nomor_hp']; ?></td>
               <td><?php echo $rows['role']; ?></td>
               <?php
               
                if($role == "admin"){

                ?>
               <td>
                   <center>
                       <div class="btn-group">
                           <button type="button" class="btn btn-danger">Action</button>
                           <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                               <span class="caret"></span>
                               <span class="sr-only"></span>
                           </button>
                           <ul class="dropdown-menu" role="menu">
                               <li><a href="#edit_modal<?php echo $no_urut ?>" class="edit_data" data-toggle='modal' data-id="<?php echo $rows['NIP']; ?>">Edit</a></li>
                               <li><a href="#konfirmasi_hapus_wakil_ketua<?php echo $no_urut ?>" data-toggle='modal' data-href="">Delete</a></li>
                           </ul>
                       </div>
                   </center>
               </td>
               <div class="modal fade" id="konfirmasi_hapus_wakil_ketua<?php echo $no_urut ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog" style="margin-top: 15%;">
        <div class="modal-content" style="margin-top: 100px;">
          <div class="modal-header">
            <h4 class="modal-title" style="text-align: center;">Anda yakin akan menghapus data ini ?</h4>
          </div>
          <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
            <a class="btn btn-danger btn-ok" href="pages/config/delete.php?nip=<?php echo $rows['NIP']; ?>">Hapus</a> 
            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
          </div>
        </div>
      </div>
    </div>
               <?php } ?>
           </tr>
           <div class="modal fade" id="edit_modal<?php echo $no_urut ?>" role="dialog">
               <div class="modal-dialog" role="document">
                   <div class="modal-content">
                       <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal">&times;</button>
                           <h4 class="modal-title">Edit User</h4>
                       </div>
                       <form action="" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
                           <div class="modal-body">
                               <div class="hasil-data">
                                   <div class="form-group">
                                       <label for="nip">NIP</label>
                                       <input type="text" class="form-control" name="nip" id="nip" placeholder="Masukan NIP user" value="<?= $rows['NIP']; ?>" >
                                   </div>
           
                                   <div class="form-group">
                                       <label for="name">Nama</label>
                                       <input type="text" class="form-control" name="name" id="name" placeholder="Masukan nama user" value="<?= $rows['name'] ?>">
                                   </div>
           
                                   <div class="form-group">
                                       <label for="email">Email</label>
                                       <input type="email" class="form-control" name="email" id="email" placeholder="Masukan email user" value="<?= $rows['email'] ?>">
                                   </div>
           
                                   <div class="form-group">
                                       <label for="nomor_hp">Nomor Hp</label>
                                       <input type="text" class="form-control" name="nomor_hp" id="nomor_hp" placeholder="Masukan nomor hp user" value="<?= $rows['nomor_hp'] ?>">
                                   </div>
           
                                   <input type="hidden" name="original_nip" value="<?= $rows['NIP']; ?>">
                                   <input type="hidden" name="source" value="<?= $rows['source']; ?>">
                               </div>
                           </div>
                           <div class="modal-footer">
                               <button type="button" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                               <button name="update" class="btn btn-success">UPDATE</button>
                           </div>
                       </form>
                       <?php
                       if (isset($_POST['update'])) {
                           $original_nip = $_POST['original_nip'];
                           $nip1 = $_POST['nip']; // Tetap sebagai string sesuai format yang ditampilkan
                           $name = $_POST['name'];
                           $email = $_POST['email'];
                           $nomor_hp = $_POST['nomor_hp'];
                           $source = $_POST['source'];
           
                           $connect->begin_transaction();
                           try {
                               if ($source == 'wakil_ketua') {
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
                       }
           
                        ?>
                          
                    </div>
                </div>
            </div>
            
        </div>
      </div>
    </div>
    <?php
            }
            $connect->close();
            ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Modal Tambah Data User -->
    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Tambah Data User</h4>
          </div>
          <div class="modal-body">
            <form action="pages/config/simpan_user.php" onsubmit="return validasidata_user()" method="POST" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-9">
                  <div class="form-group">
                    <label for="nip">NIP</label>
                    <input type="text" class="form-control" name="nip" id="nip" placeholder="Masukan NIP user">
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukan nama user">
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Masukan Email">
                  </div>
                  <div class="form-group">
                    <label for="no_telp">Nomor Handphone</label>
                    <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="Masukan No hp">
                  </div>
                  <div class="form-group">
                    <label for="jabatan">Role</label>
                    <select name="jabatan" class="form-control">
                      <option value="Wakil Ketua">LPM</option>
                      <option value="Staf">Koorprodi</option>
                      <option value="Auditor">Auditor</option>
                    </select>
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

    <!-- Modal Edit User -->
   

    <!-- Modal Konfirmasi Hapus -->
   

  </div>
</section>
