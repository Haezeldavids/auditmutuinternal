<?php
require '../../../koneksi/koneksi.php';

if (isset($_GET['nip'])) {
    $nip = mysqli_real_escape_string($connect, $_GET['nip']);

    // Hapus data dari wakil_ketua
    $query_wakil_ketua = "DELETE FROM wakil_ketua WHERE nip_wakil_ketua = '$nip'";
    $result_wakil_ketua = mysqli_query($connect, $query_wakil_ketua);

    // Hapus data dari staf
    $query_staf = "DELETE FROM staf WHERE nik_staf = '$nip'";
    $result_staf = mysqli_query($connect, $query_staf);

    // Hapus data dari auditor
    $query_auditor = "DELETE FROM auditor WHERE nip = '$nip'";
    $result_auditor = mysqli_query($connect, $query_auditor);

    if ($result_wakil_ketua || $result_staf || $result_auditor) {
        echo "<script>alert('Data berhasil dihapus.'); window.location.href='../../index.php?page=data_wakil_ketua';</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan saat menghapus data.'); window.location.href='../../index.php?page=data_wakil_ketua';</script>";
    }
} else {
    echo "<script>alert('Data NIP tidak ditemukan.'); window.location.href='../../index.php?page=data_wakil_ketua';</script>";
}
?>
