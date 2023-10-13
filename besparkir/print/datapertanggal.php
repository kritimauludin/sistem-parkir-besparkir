<?php
//koneksi ke database
define('DB_SERVER','localhost');
define('DB_USER','root');
define('DB_PASS' ,'');
define('DB_NAME', 'db_parkir');
$connect = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
//Memanggil file FPDF dari file yang anda download tadi
require('fpdf.php');
include '../konek.php';
$tanggal_awal = $_GET['tanggal_awal'];

$pdf = new FPDF("P","cm","A5");

$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',11);
$pdf->image('../asset/img/logo.png',5.5,2,3.4,3.5);
$pdf->ln(4);
$pdf->SetFont('Times','B',20);
$pdf->Cell(10.5,2,"tanggal_awal Parkir Anda",0,0.3,'C');
$pdf->ln(0.2);
//Tidak berpengaruh dengan database hanya sebagai keterangan pada tabel nantinya
//Panggil tblcomplaints dari database cms
$query=mysqli_query($connect,"SELECT * FROM tb_daftar_parkir
	WHERE tanggal between'$tanggal_awal' ");
while($lihat=mysqli_fetch_array($query)){
//Queri tabel yang ingin ditampilkan
 $pdf->SetFont('Times', 'B', 42);
 $pdf->Cell(10.5, 1, $lihat['kode'], 0, 0.3,'C');
 $pdf->ln(0.5);
  $pdf->SetFont('Times', 'B', 20);
 $pdf->Cell(10.5, 0.8, $lihat['total'], 0, 0.4,'C');
 $pdf->ln(1);

 }
$pdf->SetFont('Times','',10);
$pdf->Cell(19.5,3.5,"Tanggal : ".date("d/m/Y"),0,0,'C');
$pdf->ln(0);
$pdf->SetFont('Arial','',10);
$pdf->ln(1);
$pdf->Output("Karcisparkir.pdf","I");

?>