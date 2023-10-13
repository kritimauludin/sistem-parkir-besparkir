<?php
include "config/koneksi.php";

	$kode 				= $_POST['kode'];
    $jam_keluar			= date('H:m');
    $bayar				= $_POST['bayar'];
    $total				= $_POST['total'];
    $kembali			= $_POST['kembali'];

$update = mysqli_query($con,"UPDATE tb_daftar_parkir SET status=0,jam_keluar='$jam_keluar',bayar='$bayar',total='$total',kembali='$kembali' WHERE kode='$kode'") or die(mysqli_error());

if ($update) 
{
	header('location:home.php?message=success');
}

?>