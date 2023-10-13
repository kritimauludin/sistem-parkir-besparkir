<?php
$host = "localhost";
$user = "root";
$pass = "";
$db_name = "db_parkir";

$koneksi = mysqli_connect($host, $user, $pass, $db_name);

if(mysqli_connect_errno()){
	echo 'Gagal melakukan koneksi ke database: '.mysqli_connect_error();
}
?>