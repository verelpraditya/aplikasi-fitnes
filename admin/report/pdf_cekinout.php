<?php
require_once('../fpdf/fpdf.php');
require_once('../class/classDatabase.php');
require_once('../class/classIndoTime.php');
$myDb = new database();
$myTime = new indoTime();

$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
$pilih = $_POST[pilih];
$cari = $_POST[tcari];
$lebih = $_GET['lebih'];
	
$pdf=new FPDF('P','mm','A4');  
$pdf->AddPage();  
$pdf->setFont('Arial','B',11); 
$pdf->Cell(0,10,'Equila Wellnes Club - Pekalongan',0,0,'C');
$pdf->ln(5);
$pdf->setFont('Arial','B',11);  
$pdf->Cell(0,10,'LAPORAN DATA CEK IN-OUT MEMBER',0,0,'C');
$pdf->ln(5);
$pdf->setFont('Arial','',11); 

if ($bulan <> '') {
	$pdf->Cell(0,10,'Bulan '.$myTime->getBulan($bulan).' '.$tahun,0,0,'C');
}
else {
	$pdf->Cell(0,10,''.$nik,0,0,'C');
}

$pdf->ln(10);  
$pdf->setFont('Arial','',8);  
$pdf->setFillColor(72,72,243);
$pdf->setTextColor(255,255,255);

$pdf->Cell(7,5,'NO',1, 0, 'C', 1);  
$pdf->Cell(17,5,'Tanggal',1,0,'C', 1);  
$pdf->Cell(20,5,'ID Member',1,0,'C',1);  
$pdf->Cell(30,5,'Nama Lengkap',1,0,'C',1);  
$pdf->Cell(25,5,'Jenis Kelamin',1,0,'C',1); 
$pdf->Cell(30,5,'Alamat',1,0,'C',1);  
$pdf->Cell(21,5,'Jam Masuk',1,0,'C',1);  
$pdf->Cell(21,5,'Jam Keluar',1,0,'C',1);  
$pdf->Cell(21,5,'Total Jam',1,0,'C',1); 
$pdf->ln(5);  

$pdf->setFillColor(255,255,255);
$pdf->setTextColor(0,0,0);

$sql = "SELECT * FROM absensi,member WHERE member.id_member=absensi.id_member AND $pilih LIKE '%$cari%' order by absensi.tgl DESC";
$n=1;  
$query = $myDb->select($sql);
while($result=$myDb->getRow($query)) {
	$pdf->Cell(7,5,$n, 1,0,'C');  
	$pdf->Cell(17,5,$myTime->getTglInd($result['tgl']),1,0,'C');  
	$pdf->Cell(20,5,$result['id_member'],1,0,'C');  
	$pdf->Cell(30,5,$result['nama'],1,0,'C');  
	$pdf->Cell(25,5,$result['jenis_kelamin'],1,0,'C');  
	$pdf->Cell(30,5,$result['alamat'],1,0,'C');  
	$pdf->Cell(21,5,$result['jam_masuk'],1,0,'C');
	$pdf->Cell(21,5,$result['jam_pulang'],1,0,'C');
	
		$mjam=$result['jam_masuk'];
		$pjam=$result['jam_pulang'];
		$queryjam = "SELECT timediff('$pjam', '$mjam') as selisih";
		$hasil = mysql_query($queryjam);
		$data = mysql_fetch_array($hasil);
	$pdf->Cell(21,5,$data['selisih'],1,0,'C');	
	$pdf->ln(5);  
	$n++;  
	}
$pdf->Output();

?>