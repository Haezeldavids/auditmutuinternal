<div class="container" style="height: 100vh; display: flex; justify-content: center; align-items: center; text-align: center;">
    <div class="panel panel-default" style="width: 1500px; height: 600px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);">
        <div class="panel-body" style="display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; height: 100%">
            <img src="/AMI-1/images/logohome1.png" alt="Logo" class="logo" style="width: 600px; height: 225px; display: block; margin: 0 auto;">
            <div class="welcome-message" style="margin-top: 20px; font-size: 36px;">
                <?php
                    // Ganti 'Nama Pengguna' dengan nama pengguna yang sebenarnya jika tersedia
                    $username = $rows['nama_auditor'];
                    $username_uppercase = strtoupper($username);
                    echo "Halo <span style='background-color: #003366; color: white; padding: 1px; border-radius: 1px; font-weight: bold;'>" . htmlspecialchars($username_uppercase) . "</span>,<br>Selamat Datang di Website Audit Mutu Internal UNSRAT!";
                ?>
            </div>
        </div>
    </div>
</div>
