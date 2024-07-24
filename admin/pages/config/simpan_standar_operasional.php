<?php
require '../../../koneksi/koneksi.php';

$kode_unit = $_POST['kode_unit'];
$kode_sn = $_POST['kode_sn'];
$kode_sop = $_POST['kode_sop'];
$nama_sop = $_POST['nama_sop'];
$id_koorprodi = $_POST['id_koorprodi'];
$id_auditor = $_POST['id_auditor'];
$tanggal_mulai		= $_POST['tgl_mulai'];
		$tanggal_selesai		= $_POST['tgl_selesai'];
	
		
		function ubahTanggal($tanggal_mulai){
 		$pisah = explode('/',$tanggal_mulai);
 		$array = array($pisah[2],$pisah[0],$pisah[1]);
 		$satukan = implode('-',$array);
 		return $satukan;
}
		
function ubahTanggalselesai($tanggal_selesai){
 		$pisah = explode('/',$tanggal_selesai);
 		$array = array($pisah[2],$pisah[0],$pisah[1]);
 		$satukan = implode('-',$array);
 		return $satukan;
}
		$tgl_adt = ubahTanggal($tanggal_mulai);
		$tgl_sls = ubahTanggalselesai($tanggal_selesai);

// Sanitize file name function
function sanitizeFileName($fileName) {
    // Remove any character that isn't alphanumeric, a dot, a dash, or an underscore
    return preg_replace('/[^a-zA-Z0-9\.\-_]/', '_', $fileName);
}

// Handle file upload
if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Sanitize the nama_sop to create a valid file name
    $sanitizedFileName = sanitizeFileName($nama_sop) . '.' . $fileExtension;
    
    // Specify directory for file upload
    $uploadFileDir = '../dokumen/';
    $dest_path = $uploadFileDir . $sanitizedFileName;
    
    // Move the file to the upload directory
    if(move_uploaded_file($fileTmpPath, $dest_path)) {
        $message = 'File is successfully uploaded.';
    } else {
        $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
        die($message);
    }
} else {
    $message = 'No file uploaded or there was an upload error.';
    die($message);
}

$cek = mysqli_query($connect, "SELECT * FROM standar_operasional WHERE kode_sop ='$kode_sop'");
if(mysqli_num_rows($cek) == 0) {
    $query = mysqli_query($connect, "INSERT INTO standar_operasional VALUES ('$kode_unit','$kode_sn','$kode_sop','$nama_sop','$id_koorprodi','$id_auditor', '$sanitizedFileName' ,'$tgl_adt','$tgl_sls')");

    echo "<script>alert('Data Dokumen Audit Berhasil Disimpan')</script>";
    echo "<meta http-equiv='refresh' content='1 url=../../index.php?page=standar_operasional'>";
} else {
    echo "<script>alert('Data Dokumen Audit Sudah Ada')</script>";
    echo "<meta http-equiv='refresh' content='1 url=../../index.php?page=standar_operasional'>";
}
?>
