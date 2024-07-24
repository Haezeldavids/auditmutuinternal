<?php 
	require	'../../../koneksi/koneksi.php';
	if ($_POST['idx']) {
		$kode_jadwal = $_POST['idx'];
		$query = mysqli_query($connect, "SELECT sop.*,adt.*,jdw.* FROM jadwal jdw INNER JOIN standar_operasional sop ON sop.kode_sop = jdw.kode_sop INNER JOIN auditor adt ON adt.id_auditor = jdw.id_auditor WHERE kode_jadwal = '$kode_jadwal'");
		while ($rows = mysqli_fetch_array($query)) {
 	// var_dump($query);
 ?>

 						 <div class="form-group">
                            <label for="kode_jadwal">Kode Jadwal</label>
                            <input type="text" class="form-control" name="kode_jadwal" id="kode_jadwal" value="<?php echo $rows['kode_jadwal']?>" readonly>
                          </div>

						 <div class="form-group">
                            <label for="nama_sn">Nama Standar Nasional</label>
                            <input type="text" class="form-control" name="nama_sn" id="nama_sn"  value="<?php echo isset($rows['nama_staf']) ? $rows['nama_staf'] : '' ?>">
							
                          </div>
                        
                          <div class="form-group">
                            <label for="nama_auditor">Nama Auditor</label>
                            <input type="text" class="form-control" name="nama_auditor" id="nama_auditor"  value="<?php echo $rows['nama_auditor']?>">
                   		  </div>
                          
                          <div class="form-group">
                            <label for="program_studi">Program Studi</label>
                            <input type="text" class="form-control" name="program_studi" id="program_studi"  value="<?php echo $rows['program_studi']?>">
                          </div>

                          <div class="form-group">
                            <label for="tahun_pengukuran">Periode</label>
                            <input type="text" class="form-control" name="tahun_pengukuran" id="tahun_pengukuran"  value="<?php echo $rows['tahun_pengukuran']?>">
                          </div>  

                          <div class="form-group">
                            <label for="tanggal_mulai">Tanggal Mulai</label>
                            <input type="text" class="form-control" name="tanggal_mulai" id="tanggal_mulai"  value="<?php echo $rows['tanggal_mulai']?>">
                          </div>

						  <div class="form-group">
                            <label for="tanggal_selesai">Tanggal Selesai</label>
                            <input type="text" class="form-control" name="tanggal_selesai" id="tanggal_selesai"  value="<?php echo $rows['tanggal_selesai']?>">
                          </div>
		
		
			
		
 
 <?php }} 

 ?>