<?php
require '../../../koneksi/koneksi.php';
require '../../../vendor/autoload.php'; 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

// Ambil data dari form
$kode_unit = $_POST['kode_unit'];
$kode_sop = $_POST['kode_sop'];
$id_auditor = $_POST['id_auditor'];
$tgl_audit = $_POST['tgl_sop'];
$file_tmp = $_FILES['file']['tmp_name'];
$file_name = $_FILES['file']['name'];
$ekstensi_diperbolehkan = array('xls', 'xlsx');
$ekstensi = pathinfo($file_name, PATHINFO_EXTENSION);

// Validasi ekstensi file
if (!in_array($ekstensi, $ekstensi_diperbolehkan)) {
    echo "<script>alert('Format file tidak diizinkan. Hanya file Excel yang diperbolehkan (xls, xlsx).'); window.location.href='../../index4.php?page=audit';</script>";
    exit();
}

// Pindahkan file ke folder yang diinginkan
$move = move_uploaded_file($file_tmp, "../dokumen/hasil_audit/" . $file_name);
if (!$move) {
    echo "<script>alert('Gagal mengunggah file.'); window.location.href='../../index4.php?page=audit';</script>";
    exit();
}

// Fungsi untuk mengubah format tanggal
function ubahTanggal($tanggal) {
    $pisah = explode('/', $tanggal);
    $array = array($pisah[2], $pisah[0], $pisah[1]);
    $satukan = implode('-', $array);
    return $satukan;
}


// Ubah format tanggal ke Y-m-d
$tgl_audit = ubahTanggal($tgl_audit);

try {
    $spreadsheet = IOFactory::load("../dokumen/hasil_audit/".$file_name);
} catch (Exception $e) {
    echo "<script>alert('Terjadi kesalahan dalam membuka file Excel.'); window.location.href='../../index4.php?page=audit';</script>";
    exit();
}
$sheet = $spreadsheet->getActiveSheet();

// Warna kuning dalam format RGB
$yellow_rgb = 'FFFF00';
$validation_errors = [];

// Validasi kolom individual (C, D, E)
$kolom_yang_dicek = ['H', 'I', 'J', 'L', 'M', 'N', 'P','Q','R'];
foreach ($kolom_yang_dicek as $kolom) {
    for ($rowIndex = 6; $rowIndex <= $sheet->getHighestRow(); $rowIndex++) {
        // Periksa sel tunggal
        $cell = $sheet->getCell($kolom . $rowIndex);
        $color = $cell->getStyle()->getFill()->getStartColor()->getRGB();
        if ($color == $yellow_rgb && empty(trim($cell->getValue()))) {
            $validation_errors[] = "Cell {$kolom}{$rowIndex} berwarna kuning dan harus diisi.";
        }

        // Periksa rentang sel yang digabungkan
        foreach ($sheet->getMergeCells() as $mergedRange) {
            list($startCell, $endCell) = explode(':', $mergedRange);
            $startColumn = preg_replace('/[0-9]+/', '', $startCell);
            $endColumn = preg_replace('/[0-9]+/', '', $endCell);
            $startRow = preg_replace('/[A-Z]+/', '', $startCell);
            $endRow = preg_replace('/[A-Z]+/', '', $endCell);
            
            // Pastikan kolom yang sedang diperiksa berada dalam rentang yang sesuai
            if (getColumnIndex($kolom) >= getColumnIndex($startColumn) && getColumnIndex($kolom) <= getColumnIndex($endColumn) &&
                $rowIndex >= $startRow && $rowIndex <= $endRow) {
                $cell = $sheet->getCell($startCell);
                $color = $cell->getStyle()->getFill()->getStartColor()->getRGB();
                if ($color == $yellow_rgb && empty(trim($cell->getValue()))) {
                    $validation_errors[] = "Range {$mergedRange} berwarna kuning dan harus diisi.";
                }
                break; // Hentikan iterasi setelah ditemukan dalam rentang yang sesuai
            }
        }
    }
}

// Tampilkan hasil validasi
if (!empty($validation_errors)) {
    foreach ($validation_errors as $error) {
        echo "<script>alert('{$error}'); window.location.href='../../index4.php?page=audit';</script>";
    }
    exit();
} 

$query_jadwal = "SELECT tanggal_selesai FROM jadwal WHERE kode_jadwal = '$kode_unit'";
$result_jadwal = mysqli_query($connect, $query_jadwal);
$row_jadwal = mysqli_fetch_assoc($result_jadwal);
$tanggal_batas = $row_jadwal['tanggal_selesai'];

if (!$tanggal_batas) {
    echo "<script>alert('Kode unit tidak ditemukan.'); window.location.href='../../index4.php?page=audit';</script>";
    exit();
}

if (strtotime($tgl_audit) > strtotime($tanggal_batas)) {
    echo "<script>alert('Maaf, tanggal pengumpulan sudah lewat.'); window.location.href='../../index4.php?page=audit';</script>";
    exit();
}else{
// Query untuk menyimpan data ke database
$query = "INSERT INTO hasil_audit (kode_jadwal, kode_sop, Auditor, Tanggal, File) 
          VALUES ('$kode_unit', '$kode_sop', '$id_auditor', '$tgl_audit', '$file_name')";
}
if (mysqli_query($connect, $query)) {
    echo "<script>alert('Data berhasil disimpan.'); window.location.href='../../index4.php?page=audit';</script>";
} else {
    echo "<script>alert('Gagal menyimpan data.'); window.location.href='../../index4.php?page=audit';</script>";
}


function getColumnIndex($column) {
    $columnIndex = 0;
    $columnLetters = str_split($column);
    foreach ($columnLetters as $letter) {
        $columnIndex = $columnIndex * 26 + ord($letter) - 64;
    }
    return $columnIndex;
}
?>
