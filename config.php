<?php

// Membuat koneksi ke basis data modernture
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'modernture';
$conn = mysqli_connect($host, $user, $pass, $db);

	if(mysqli_connect_errno()){
		echo "Koneksi gagal: " . mysqli_connect_error();
	}
?>