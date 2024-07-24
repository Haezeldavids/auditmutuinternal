<?php

$server = "localhost";
$user = "root";
$pass = "";
$database = "ami";

$connect = mysqli_connect($server, $user, $pass, $database);
	
	if (!$connect) {
		die("Gagal: " .mysqli_connect_error());
	}

			
?>