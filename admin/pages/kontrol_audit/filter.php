<?php
require '../../../koneksi/koneksi.php';

// Terima nilai filter dari form
$filter_program_studi = isset($_GET['periode']) ? $_GET['periode'] : '';

// Query SQL untuk filter
$sql = "SELECT jadwal.program_studi, jadwal.tahun_pengukuran, COUNT(auditor.id_auditor) AS jumlah_auditor, jadwal.kode_jadwal
        FROM jadwal
        LEFT JOIN auditor ON jadwal.id_auditor = auditor.id_auditor
        LEFT JOIN dokumen ON dokumen.kode_unit = jadwal.kode_jadwal";

if (!empty($filter_program_studi)) {
    $sql .= " WHERE jadwal.program_studi LIKE '%$filter_program_studi%'";
}

$sql .= " GROUP BY jadwal.program_studi, jadwal.tahun_pengukuran";

// Eksekusi query
$query = mysqli_query($connect, $sql);

// Simpan filter ke session atau query string (misalnya query string)
$filter_query_string = urlencode("filter_program_studi=$filter_program_studi");

// Redirect kembali ke halaman index.php?page=kontrol_audit dengan filter yang telah diterapkan
header("Location: index.php?page=kontrol_audit&$filter_query_string");
exit();
?>
