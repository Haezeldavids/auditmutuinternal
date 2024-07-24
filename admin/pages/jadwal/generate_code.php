<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ami";

// Membuat koneksi ke database
$connect = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($connect->connect_error) {
    die("Koneksi Gagal: " . $connect->connect_error);
}

// Fungsi untuk menghasilkan kode baru
function generateKode($lastKode) {
    if ($lastKode) {
        // Extract bagian nomor dari kode terakhir
        $parts = explode('.', $lastKode);
        $number = intval($parts[2]) + 1; // Increment bagian nomor
        return sprintf("S.03.%02d", $number); // Format kode baru
    } else {
        // Jika tidak ada kode sebelumnya, mulai dari yang pertama
        return "S.03.01";
    }
}

// Mendapatkan kode terakhir dari database
$sql = "SELECT kode_sop FROM jadwal ORDER BY kode_jadwal DESC LIMIT 1";
$result = mysqli_query($connect,$sql);
$lastKode = $result->num_rows > 0 ? $result->fetch_assoc()['kode_sop'] : null;

// Menghasilkan kode baru
$newKode = generateKode($lastKode);

echo $newKode;

$connect->close();
?>
