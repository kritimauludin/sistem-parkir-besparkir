<?php
require "fpdf.php";
$db = new PDO('mysql:host=localhost;dbname=db_parkir','root','');
	class myPDF extends FPDF{
		function header(){
			$this->SetFont('Arial','B',16);
			$this->Image('../asset/img/logo.png',65,12,13,13);
			$this->SetFont('Arial','B',22);
			$this->Cell(190,15,'Parkir Online',0,0,'C');
			$this->Ln();
			$this->SetFont('Times','',12);
			$this->Cell(190,5,'Jl. Letjen Ibrahim Adjie no. 178 Kota Bogor',0,0,'C');
			$this->Ln();
			$this->SetFont('Arial','B',10);
			$this->Cell(62,10,"Tanggal : ".date("l/ d F Y"),0,0,'C');
			$this->ln(1);
			$this->ln();
			}
		function headerTable(){
			$this->SetFont('Times','B',12);
			$this->Cell(75,10,'Tanggal',1,0,'C');
			$this->Cell(58,10,'Jenis',1,0,'C');
			$this->Cell(55,10,'Total',1,0,'C');
			$this->Ln();

		}
		function viewTable($db){
			$this->SetFont('Times','B',12);
			$a=0;
			$stmt = $db->query('SELECT * FROM tb_daftar_parkir where total order by tanggal asc');
			while($data = $stmt->fetch(PDO::FETCH_OBJ)){
			$this->Cell(75,10,$data->tanggal,1,0,'C');
			$this->Cell(58,10,$data->jenis,1,0,'L');
			$this->Cell(55,10,'Rp. '.$data->total.',-',1,0,'L');
			$this->Ln();
			$a++;
			$jmlh[$a] = $data->total;
			}
			$this->Cell(133,10,' 	Total Pemasukan :',1,0,'C');
			$this->Cell(55,10,'Rp. '.array_sum($jmlh).',-',1,0,'L');
			$this->Ln();
		}
}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','A4',0);
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->Output();


?>