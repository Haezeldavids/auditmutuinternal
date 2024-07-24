<div class="container" style=" display: flex; justify-content: center; align-items: center; text-align: center;">
    <div class="panel panel-default" style="width: 1500px; margin-top: 20px;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);">
        <div class="panel-body" style="display: flex; flex-direction: column; justify-content: center; margin-top: 30px; align-items: center; text-align: center; height: 100%">
        <img src="/AMI-1/images/logohome1.png" alt="Logo" class="logo" style="width: 600px; height: 225px; display: block; margin: 0px auto 0px;">

            <div class="welcome-message" style="margin-top: 20px; font-size: 36px;">
                <?php
                    // Ganti 'Nama Pengguna' dengan nama pengguna yang sebenarnya jika tersedia
                    $username = $rows['nama_wakil_ketua'];
                    $username_uppercase = strtoupper($username);
                    echo "Halo <span style='background-color: #003366; color: white; padding: 1px; border-radius: 1px; font-weight: bold;'>" . htmlspecialchars($username_uppercase) . "</span>,
                    <br>Selamat Datang di Website Audit Mutu Internal UNSRAT!";
                ?>
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<?php
$sql = "
SELECT j.tahun_pengukuran, COUNT(ha.id_audit) as jumlah_auditor
FROM hasil_audit ha
JOIN jadwal j ON ha.kode_jadwal = j.kode_jadwal
GROUP BY j.tahun_pengukuran
";
$result = mysqli_query($connect, $sql);

$data = [];
if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
}

$query1 = "
SELECT j.tahun_pengukuran, COUNT(*) as total_koorprodi
FROM dokumen d
JOIN jadwal j ON d.kode_unit = j.kode_jadwal
GROUP BY j.tahun_pengukuran
";
$result = mysqli_query($connect, $query1);

$dataKoorprodi = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dataKoorprodi[] = $row;
    }
}


?>

<div class="card">
    <hr>
<h4 class="alert alert-danger">Data Pengumpulan Koorprodi</h4>
<canvas id="koorprodiChart" width="400" height="80" style="width: 10px;"></canvas>

<script>
    // Data dari PHP
    const koorprodiData = <?php echo json_encode($dataKoorprodi); ?>;
    
    // Mendapatkan labels (tahun_pengukuran) dan data (total_koorprodi)
    const periodLabels = koorprodiData.map(item => item.tahun_pengukuran);
    const koorprodiCount = koorprodiData.map(item => item.total_koorprodi);

    // Mengambil elemen canvas dan menginisialisasi chart
    const ctx1 = document.getElementById('koorprodiChart').getContext('2d');
    const myKoorprodiChart = new Chart(ctx1, {
        type: 'line',
        data: {
            labels: periodLabels,
            datasets: [{
                label: 'Jumlah Koorprodi yang Mengumpulkan',
                data: koorprodiCount,
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 2, 
            fill: true, 
            tension: 0.1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>

<hr><h4 class="alert alert-info">Data Pengumpulan Koorprodi</h4>


 <canvas id="auditorChart" width="400" height="80"></canvas>

<script>
    // Data dari PHP
    const data = <?php echo json_encode($data); ?>;
    
    // Mendapatkan labels (periode) dan data (jumlah auditor)
    const labels = data.map(item => item.tahun_pengukuran);
    const jumlahAuditor = data.map(item => item.jumlah_auditor);

    // Mengambil elemen canvas dan menginisialisasi chart
    const ctx = document.getElementById('auditorChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Auditor yang Mengumpulkan',
                data: jumlahAuditor,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2, 
            fill: true, 
            tension: 0.1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>

</div>
            </div>
        </div>
    </div>
</div>
