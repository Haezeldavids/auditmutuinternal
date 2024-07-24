<?php 
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Query untuk login wakil ketua
$login_wakil_ketua = mysqli_query($connect, "SELECT * FROM login_wakil_ketua WHERE username='$username' AND password='$password'");
$cek_login_wakil_ketua = mysqli_num_rows($login_wakil_ketua);

// Query untuk login ketua
$login_staf = mysqli_query($connect, "SELECT * FROM login_staf WHERE username='$username' AND password='$password'");
$cek_login_staf = mysqli_num_rows($login_staf);

// Query untuk login admin
$login_auditor = mysqli_query($connect, "SELECT * FROM login_auditor WHERE username='$username' AND password='$password'");
$cek_login_auditor = mysqli_num_rows($login_auditor);

if($cek_login_wakil_ketua > 0){
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['status'] = "login_wakil_ketua";
    header("location:../admin/index2.php");
} elseif ($cek_login_staf > 0) {
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['status'] = "login_staf";
    header("location:../admin/index3.php");
} elseif ($cek_login_auditor > 0) {
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['status'] = "login_auditor";
    header("location:../admin/index4.php");
} else {
    echo "<script>alert('Maaf Username atau Password salah')</script>";
    echo "<meta http-equiv='refresh' content='1; url=../admin/login_user.php'>";
}
?>



<!-- <?php 
include 'koneksi.php';
 
$username = $_POST['username'];
$password = $_POST['password'];
 
	$login = mysqli_query($connect, "SELECT * from login_wakil_ketua where username='$username' and password='$password'");
	$cek = mysqli_num_rows($login);
 
		if($cek > 0){
			session_start();
			$_SESSION['username'] = $username;
			$_SESSION['status'] = "login";
			header("location:../admin/index2.php");
		}else{

			echo "<script>alert('Maaf Username atau Password salah')</script>";
			echo "<meta http-equiv='refresh' content='1 url=../admin/login_user.php'>";

}
 
?> -->