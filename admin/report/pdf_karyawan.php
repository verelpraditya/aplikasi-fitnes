<?php
require_once('../fpdf/fpdf.php');
require_once('../class/classDatabase.php');
require_once('../class/classIndoTime.php');
require_once('../function.php');
$myDb = new database();
$myTime = new indoTime();

$bulan = $_GET['bulan'];
$tahun = $_GET['tahun'];
$totMasuk = $_GET['totMasuk'];
$totCuti = $_GET['totCuti'];
$totIjin = $_GET['totIjin'];
$totAlpa = $_GET['totAlpa'];
	
$pdf=new FPDF('P','mm','A4');  
$pdf->AddPage();  
$pdf->setFont('Arial','',11); 
$pdf->Cell(0,10,'SIAWEB - Absent Application',0,0,'C');
$pdf->ln(5);
$pdf->setFont('Arial','B',11);  
$pdf->Cell(0,10,'LAPORAN DATA ABSENSI SELURUH KARYAWAN',0,0,'C');
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
$pdf->Cell(15,5,'Masuk',1,0,'C',1);  
$pdf->Cell(15,5,'Cuti',1,0,'C',1);  
$pdf->Cell(15,5,'Ijin',1,0,'C',1);  
$pdf->Cell(15,5,'Alpha',1,0,'C',1);  
$pdf->ln(5);  

$pdf->setFillColor(255,255,255);
$pdf->setTextColor(0,0,0);

$sql = "SELECT a.nik AS nik_a, COUNT(a.jam_masuk) AS masuk, k.nama, j.ket_jabatan FROM absensi a LEFT OUTER JOIN karyawan k ON a.nik=k.nik LEFT OUTER JOIN jabatan j ON k.kd_jabatan=j.kd_jabatan LEFT OUTER JOIN cuti c ON a.nik=c.nik LEFT OUTER JOIN ijin i ON a.nik=i.nik WHERE MONTH(a.tgl)='$bulan' AND YEAR(a.tgl)='$tahun' GROUP BY a.nik ORDER BY a.nik";		

$n=1;  
$totCuti = 0;
$totIjin = 0;
$totMasuk = 0;
$totAlpa = 0;
$query = $myDb->select($sql);
while($result=$myDb->getRow($query)) {
	$pdf->Cell(7,5,$n, 1,0,'C');  
	$pdf->Cell(17,5,$result['nik_a'],1,0,'C');  
	$pdf->Cell(60,5,$result['nama'],1,0,'C');  
	$pdf->Cell(45,5,$result['ket_jabatan'],1,0,'C');  
	$pdf->Cell(15,5,$result['masuk'],1,0,'C');  

	$totMasuk += $result['masuk'];
	
	# Cuti
	$nik = $result['nik_a'];
	$qry = $myDb->select("SELECT tgl_mulai, tgl_selesai FROM cuti WHERE nik='$nik'");
	$nCuti = 0;
	while ($res = $myDb->getRow($qry)) {
		$mulai = $res['tgl_mulai'];
		$selesai = $res['tgl_selesai'];
		$d_m = $myTime->getTglD($mulai);
		$m_m = $myTime->getBulanM($mulai);
		$y_m = $myTime->getThY($mulai);

		$d_s = $myTime->getTglD($selesai);
		$m_s = $myTime->getBulanM($selesai);
		$y_s = $myTime->getThY($selesai);

		if ($m_m <> $bulan) {
			$d_m = 1;					
		}
		if ($m_s <> $bulan) {
			$d_s = lastDate($m_m, $y_m);
			$m_s = $bulan;
		}
		
		$tgl_mulai = $y_m.'-'.$m_m.'-'.$d_m;
		$tgl_selesai = $y_s.'-'.$m_s.'-'.$d_s;
		$r=0;
		$r = $myDb->selectOne("SELECT DATEDIFF('$tgl_selesai', '$tgl_mulai')+1"); 
		for ($i=$d_m; $i<=$d_s; $i++) {
			if (date("D",mktime (0,0,0,$bulan,$i,$tahun)) == "Sun")
				$r--;					
			else {
				$qlibur = $myDb->select("SELECT DAY(tgl) AS hari FROM libur WHERE MONTH(tgl)='$bulan'");
				while($rlibur = $myDb->getRow($qlibur)) {
					if ($rlibur['hari']==$i)
						$r--;
				}
			}
		}
		$nCuti += $r;
	}
	$totCuti += $nCuti; 
	$pdf->Cell(15,5,$nCuti,1,0,'C'); 

	# Ijin
	$qry = $myDb->select("SELECT tgl_mulai, tgl_selesai FROM ijin WHERE nik='$nik'");				
	$nIjin = 0;
	while ($res = $myDb->getRow($qry)) {
		$mulai = $res['tgl_mulai'];
		$selesai = $res['tgl_selesai'];
		$d_m = $myTime->getTglD($mulai);
		$m_m = $myTime->getBulanM($mulai);
		$y_m = $myTime->getThY($mulai);

		$d_s = $myTime->getTglD($selesai);
		$m_s = $myTime->getBulanM($selesai);
		$y_s = $myTime->getThY($selesai);

		if ($m_m <> $bulan) {
			$d_m = 1;					
		}
		if ($m_s <> $bulan) {
			$d_s = lastDate($m_m, $y_m);
			$m_s = $bulan;
		}
		
		$tgl_mulai = $y_m.'-'.$m_m.'-'.$d_m;
		$tgl_selesai = $y_s.'-'.$m_s.'-'.$d_s;

		$r = $myDb->selectOne("SELECT DATEDIFF('$tgl_selesai', '$tgl_mulai')+1"); 
		for ($i=$d_m; $i<=$d_s; $i++) {
			if (date("D",mktime (0,0,0,$bulan,$i,$tahun)) == "Sun")
				$r--;					
			else {
				$qlibur = $myDb->select("SELECT DAY(tgl) AS hari FROM libur WHERE MONTH(tgl)='$bulan'");
				while($rlibur = $myDb->getRow($qlibur)) {
					if ($rlibur['hari']==$i)
						$r--;
				}
			}
		}
		$nIjin += $r;
	}
	$totIjin += $nIjin;
	$pdf->Cell(15,5,$nIjin,1,0,'C'); 

	# Alpha
	$nHari=0;
	$nLibur=0;
	for ($i=1; $i<=lastDate($bulan, $tahun); $i++) {
		if (date("D",mktime (0,0,0,$bulan,$i,$tahun)) == "Sun")
				$nLibur++;
		else {
			$qlibur = $myDb->select("SELECT DAY(tgl) AS hari FROM libur WHERE MONTH(tgl)='$bulan'");
			while($rlibur = $myDb->getRow($qlibur)) {
				if ($rlibur['hari']==$i)
					$nLibur++;
			}
		}
		$nHari++;
	}
	$nAktif = $nLibur+$result['masuk']+$nCuti+$nIjin;
	$nAlpa = $nHari-$nAktif;
	$totAlpa += $nAlpa;
	$pdf->Cell(15,5,$nAlpa,1,0,'C'); 
	$no++;
	$pdf->ln(5); 
}


# Total
$pdf->setFillColor(250,226,153);
$pdf->setFont('Arial','B',8);  
$pdf->Cell(129,5,'Total',1,0,'C',1);  
$pdf->setFont('Arial','',8);  
$pdf->Cell(15,5,$totMasuk,1,0,'C',1);  
$pdf->Cell(15,5,$totCuti,1,0,'C',1);
$pdf->Cell(15,5,$totIjin,1,0,'C',1);  
$pdf->Cell(15,5,$totAlpa,1,0,'C',1);

$pdf->Output();
?>