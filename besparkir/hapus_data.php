<?php
	include "config/koneksi.php";
	$kode = $_GET['id'];
	$query = mysqli_query($con,"DELETE from tb_daftar_parkir where kode = '$kode'") or die ("Menghapus Data GAGAL <meta http-equiv=refresh content=2;url=home.php>");
	echo "Menghapus Data BERHASIL";
	header("location:daftar_kendaraan.php");
?>