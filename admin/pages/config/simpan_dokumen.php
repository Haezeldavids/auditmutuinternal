<?php
require '../../../koneksi/koneksi.php';
require '../../../vendor/autoload.php'; 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

// Ambil data dari form
$kode_unit = $_POST['kode_unit'];
$kode_sop = $_POST['kode_sop'];
$nama_dokumen = $_POST['nama_dokumen'];
$tgl_dokumen = $_POST['tgl_dokumen'];
$dokumen = $_FILES['dokumen']['tmp_name'];
$n_dokumen = $_FILES['dokumen']['name'];
$ekstensi_diperbolehkan = array('xls', 'xlsx');
$ekstensi = strtolower(pathinfo($n_dokumen, PATHINFO_EXTENSION));

// Periksa format file yang diunggah
if (!in_array($ekstensi, $ekstensi_diperbolehkan)) {
    echo "<script>alert('Format file tidak diizinkan. Hanya file Excel yang diperbolehkan (xls, xlsx).'); window.location.href='../../index3.php?page=dokumen';</script>";
    exit();
}

// Pindahkan file yang diunggah ke folder tujuan
$move = move_uploaded_file($dokumen, "../dokumen/".$n_dokumen);
if (!$move) {
    echo "<script>alert('Terjadi kesalahan dalam mengunggah file.'); window.location.href='../../index3.php?page=dokumen';</script>";
    exit();
}

// Fungsi untuk mengubah format tanggal
function ubahTanggal($tgl_dokumen) {
    $pisah = explode('/', $tgl_dokumen);
    $array = array($pisah[2], $pisah[0], $pisah[1]);
    $satukan = implode('-', $array);
    return $satukan;
}

$tgl_dkmn = ubahTanggal($tgl_dokumen);

// Buka file Excel menggunakan PhpSpreadsheet
try {
    $spreadsheet = IOFactory::load("../dokumen/".$n_dokumen);
} catch (Exception $e) {
    echo "<script>alert('Terjadi kesalahan dalam membuka file Excel.'); window.location.href='../../index3.php?page=dokumen';</script>";
    exit();
}
$sheet = $spreadsheet->getActiveSheet();

// Warna kuning dalam format RGB
$yellow_rgb = 'FFFF00';
$validation_errors = [];

// Validasi kolom individual (C, D, E)
$kolom_yang_dicek = ['C', 'D', 'E'];
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
        echo "<script>alert('{$error}'); window.location.href='../../index3.php?page=dokumen';</script>";
    }
    exit();
} 

// Ambil tanggal batas dari database
$query_jadwal = "SELECT tanggal_selesai FROM jadwal WHERE kode_jadwal = ?";
$stmt_jadwal = $connect->prepare($query_jadwal);
$stmt_jadwal->bind_param('s', $kode_unit);
$stmt_jadwal->execute();
$result_jadwal = $stmt_jadwal->get_result();
$row_jadwal = $result_jadwal->fetch_assoc();
$tanggal_batas = $row_jadwal['tanggal_selesai'];

if (!$tanggal_batas) {
    echo "<script>alert('Kode unit tidak ditemukan.'); window.location.href='../../index3.php?page=audit';</script>";
    exit();
}

// Periksa apakah tanggal pengumpulan sudah lewat
if (strtotime($tgl_dkmn) > strtotime($tanggal_batas)) {
    echo "<script>alert('Maaf, tanggal pengumpulan sudah lewat.'); window.location.href='../../index3.php?page=dokumen';</script>";
    exit();
} else {
    // Masukkan detail dokumen ke database
    $query = "INSERT INTO dokumen (kode_unit, kode_sop, nama_dokumen, dokumen, tgl_dokumen) VALUES (?, ?, ?, ?, ?)";
    $stmt = $connect->prepare($query);
    $stmt->bind_param('sssss', $kode_unit, $kode_sop, $nama_dokumen, $n_dokumen, $tgl_dkmn);
    if ($stmt->execute()) {
        header('Location: ../../index3.php?page=dokumen');
        exit();
    } else {
        echo "<script>alert('Terjadi kesalahan dalam menyimpan data dokumen.'); window.location.href='../../index3.php?page=dokumen';</script>";
    }
}

// Fungsi untuk mendapatkan indeks kolom dari huruf kolom Excel
function getColumnIndex($column) {
    $columnIndex = 0;
    $columnLetters = str_split($column);
    foreach ($columnLetters as $letter) {
        $columnIndex = $columnIndex * 26 + ord($letter) - 64;
    }
    return $columnIndex;
}
?>
