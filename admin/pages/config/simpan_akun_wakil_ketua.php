
<?php  
	require '../../../koneksi/koneksi.php';

	

	if (isset($_POST['btn-simpan'])) {
		// Ambil nilai dari form
		$id_user = $_POST['id_user'];
		$username = $_POST['username'];
		$password = $_POST['password']; // Pastikan untuk mengenkripsi password sesuai kebijakan keamanan
	
		// Pisahkan id_user untuk mendapatkan jenis user dan id yang sesuai
		$split_id = explode("_", $id_user);
		$user_type = $split_id[0]; // jenis user: 'wakil_ketua', 'staf', 'auditor'
		$user_id = $split_id[1];   // id user
	
		// Lakukan penyimpanan data ke dalam database
		switch ($user_type) {
			case 'wakil_ketua':
				// Contoh untuk wakil ketua
				$query = "INSERT INTO login_wakil_ketua (id_wakil_ketua, username, password) VALUES ('$user_id', '$username', '$password')";
				break;
			case 'staf':
				// Contoh untuk staf
				$query = "INSERT INTO login_staf (id_staf, username, password) VALUES ('$user_id', '$username', '$password')";
				break;
			case 'auditor':
				// Contoh untuk auditor
				$query = "INSERT INTO login_auditor (id_auditor, username, password) VALUES ('$user_id', '$username', '$password')";
				break;
			default:
				// Default handling jika jenis user tidak dikenali
				echo "<script>alert('Gagal Menambahkan Akun	');</script>";
				echo "<script>window.location.href='../../index.php?page=akun_wakilketua'</script>";
				exit; // Keluar dari script PHP setelah redirect
				break;
		}
	
		try {
			// Execute the query
			$result = mysqli_query($connect, $query);
			if ($result) {
				// Jika berhasil, kembali ke halaman sebelumnya atau tampilkan pesan berhasil
				echo "<script>alert('Data berhasil disimpan');</script>";
				echo "<script>window.location.href='../../index.php?page=akun_wakilketua';</script>";
			} else {
				// Jika gagal, tampilkan pesan gagal
				echo "<script>alert('Gagal menyimpan data');</script>";
				echo "<script>window.location.href='../../index.php?page=akun_wakilketua';</script>";
			}
		} catch (mysqli_sql_exception $e) {
			// Tangkap exception jika terjadi kesalahan SQL
			$error_message = $e->getMessage();
			if (strpos($error_message, "Duplicate entry") !== false) {
				// Jika terjadi duplikasi pada primary key
				echo "<script>alert('Data sudah ada. Silakan coba lagi dengan data yang berbeda');</script>";
				echo "<script>window.location.href='../../index.php?page=akun_wakilketua';</script>";
			} else {
				// Jika ada kesalahan lain
				echo "<script>alert('Terjadi kesalahan: $error_message');</script>";
				echo "<script>window.location.href='../../index.php?page=akun_wakilketua';</script>";
			}
		}
	}
	?>