<?php
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME', 'db_parkir');
$connect = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
require('print/fpdf.php');
include 'konek.php';
$plat_nomor = $_GET['plat_nomor'];

$pdf = new FPDF("l","cm","karcis");

$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',12);
$pdf->image('asset/img/logo.png',1.5,2,2,2);
$pdf->ln(0);
$pdf->SetFont('Times','B',12);
$pdf->Cell(9,1,"Kode Parkir Anda",0,0.3,'C');
$pdf->ln(0);
$query=mysqli_query($connect,"SELECT * FROM tb_daftar_parkir
	WHERE plat_nomor='$plat_nomor'");
while($lihat=mysqli_fetch_array($query)){
 $pdf->SetFont('Times', 'B', 20);
 $pdf->Cell(9,1, $lihat['kode'], 0, 0.3,'C');
 $pdf->ln(0);
  $pdf->SetFont('Times', 'B', 12);
 $pdf->Cell(9,1, $lihat['plat_nomor'], 0, 0.4,'C');
 $pdf->ln(0);

 }
$pdf->SetFont('Times','',10);
$pdf->Cell(9,1,"Tanggal : ".date("d/m/Y"),0,0,'C');
$pdf->ln(0);
$pdf->SetFont('Arial','',10);
$pdf->ln(0);
$pdf->Output("Karcisparkir.pdf","I");

?>