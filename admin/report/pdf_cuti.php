<?php
require_once('../fpdf/fpdf.php');
require_once('../class/classDatabase.php');
require_once('../class/classIndoTime.php');
require_once('../function.php');
$myDb = new database();
$myTime = new indoTime();

$bulan = $_GET['bulan'];
$tahun = $_GET['tahun'];
	
$pdf=new FPDF('P','mm','A4');  
$pdf->AddPage();  
$pdf->setFont('Arial','',11); 
$pdf->Cell(0,10,'SIAWEB - Absent Application',0,0,'C');
$pdf->ln(5);
$pdf->setFont('Arial','B',11);  
$pdf->Cell(0,10,'LAPORAN DATA ABSENSI CUTI',0,0,'C');
$pdf->ln(5);
$pdf->setFont('Arial','',11); 
$pdf->Cell(0,10,'Bulan '.$myTime->getBulan($bulan).' '.$tahun,0,0,'C');


$pdf->ln(10);  
$pdf->setFont('Arial','',8);  
$pdf->setFillColor(72,72,243);
$pdf->setTextColor(255,255,255);

$pdf->Cell(7,5,'NO',1, 0, 'C', 1);  
$pdf->Cell(17,5,'NIK',1,0,'C',1);  
$pdf->Cell(60,5,'Nama Lengkap',1,0,'C',1);  
$pdf->Cell(45,5,'Jabatan',1,0,'C',1);  
$pdf->Cell(30,5,'Tanggal Mulai',1,0,'C',1);  
$pdf->Cell(30,5,'Tanggal Selesai',1,0,'C',1);  
$pdf->ln(5);  

$pdf->setFillColor(255,255,255);
$pdf->setTextColor(0,0,0);

$sql = "SELECT c.*, c.nik AS nik_c, k.*, j.* FROM cuti c LEFT OUTER JOIN karyawan k ON c.nik=k.nik LEFT OUTER JOIN jabatan j ON k.kd_jabatan=j.kd_jabatan WHERE ((MONTH(tgl_mulai)='$bulan' OR MONTH(tgl_selesai)='$bulan') AND (YEAR(tgl_mulai)='$tahun' OR YEAR(tgl_selesai)='$tahun')) ORDER BY c.nik";		


$n=1;  
$query = $myDb->select($sql);
while($result=$myDb->getRow($query)) {
	$pdf->Cell(7,5,$n, 1,0,'C');  
	$pdf->Cell(17,5,$result['nik_c'],1,0,'C');  
	$pdf->Cell(60,5,$result['nama'],1,0,'C');  
	$pdf->Cell(45,5,$result['ket_jabatan'],1,0,'C'); 
	$pdf->Cell(30,5,$myTime->getTglInd($result['tgl_mulai']),1,0,'C'); 
	$pdf->Cell(30,5,$myTime->getTglInd($result['tgl_selesai']),1,0,'C'); 

	$pdf->ln(5);  
	$n++;  
}

$pdf->Output();
?>