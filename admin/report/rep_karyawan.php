<?php
switch($_GET['act']) {
default :
	if (!empty($_POST['batas'])) {
		$mySes->unreg('batas');
		$mySes->reg('batas', $_POST['batas']);	
	}
	if ($mySes->checkSes('batas'))
		$batas = $mySes->read('batas');
	else
		$batas = 50;
	$posisi = $page->cariPosisi($batas); 
	$myDb->select("SELECT a.*, k.* FROM absensi a LEFT OUTER JOIN karyawan k ON a.nik=k.nik");
	$jmlData = $myDb->rowCount;	
	$jmlHalaman = $page->jmlHalaman($jmlData, $batas);
	$linkHalaman = $page->navHalaman($_GET['page'], $jmlHalaman); 
	label('Laporan Absensi Keseluruhan Karyawan Per Bulan');
	message(); 
	$sql = "";
	if ($mySes->checkSes('bulan_cari_rep_semua')) {
		$bulan = $mySes->read('bulan_cari_rep_semua');
		$tahun = $mySes->read('tahun_cari_rep_semua');
		$sql = "SELECT a.nik AS nik_a, COUNT(a.jam_masuk) AS masuk, k.nama, j.ket_jabatan FROM absensi a LEFT OUTER JOIN karyawan k ON a.nik=k.nik LEFT OUTER JOIN jabatan j ON k.kd_jabatan=j.kd_jabatan LEFT OUTER JOIN cuti c ON a.nik=c.nik LEFT OUTER JOIN ijin i ON a.nik=i.nik WHERE MONTH(a.tgl)='$bulan' AND YEAR(a.tgl)='$tahun' GROUP BY a.nik ORDER BY a.nik LIMIT $posisi, $batas";		
		# Komponen Cetak Laporan
		$print = true;
		$tglLaporan = $tgl;
	}
	else {
		$sql = "";
	} ?>

	<table id="detail" width="100%">
		<form method="post" action="action.php?module=rep-karyawan&act=display" name="formCari">
	    <tr>
			<td style="color:#cc0000;border:1px solid #ddd;" width="10%"><b>Bulan:</b><br><?php
				$myCombo->comboMonth('1', '12', 'bulan_cari', date('n')); ?>
			</td> 
			<td style="color:#cc0000;border:1px solid #ddd;" width="10%"><b>Tahun:</b><br><?php
				$myCombo->comboRange(date(Y)-5, date('Y'), 'tahun_cari', date('Y')); ?>
			</td> 
			<td style="border:1px solid #ddd;"><br>
				<input type="submit" value="Tampilkan">
			</td>
		</tr>
		</form>
	</table> <?php
	
	$query=$myDb->select($sql); 
	$jum = $myDb->rowCount;
	labelKecil('SIAWEB - Absent Application<br><b>Laporan Data Absensi Seluruh Karyawan</b>');
	if ($bulan <> '') {
		labelKecil('Bulan '.$myTime->getBulan($bulan).' '.$tahun);
	} ?>
	
    <table id="display" width="100%" cellpadding="0" cellspacing="0">				
		<tr>			
			<th width="3%">No</th><th width="7%">NIK</th><th>Nama Lengkap</th><th width="18%">Jabatan</th><th width="10%">Masuk</th><th width="10%">Cuti</th><th width="10%">Ijin</th><th width="10%">Alpha</th>
		</tr>
		<?php
		$no=$posisi+1;
		$id=1;
		$totCuti = 0;
		$totIjin = 0;
		$totMasuk = 0;
		$totAlpa = 0;
	    while ($result=$myDb->getRow($query)) { ?>
			<tr>			
			<td><?php echo($no); ?></td>
			<td><?php echo($result['nik_a']); ?></td>
			<td><?php echo($result['nama']); ?></td>
			<td><?php echo($result['ket_jabatan']); ?></td>
			<td><?php echo($result['masuk']); $totMasuk += $result['masuk']; ?></td>
			<td><?php
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
				echo($nCuti); ?>
			</td>

			<td><?php
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
				echo($nIjin); ?>
			</td>	
			
			<td><?php
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
				echo($nAlpa);
			?>
			</td>

			</tr> 
			<?php
		    $no++;
			$id++;
		} 
		
		if ($mySes->checkSes('totMasuk') == false) {
			$mySes->reg('totMasuk', $totMasuk);
			$mySes->reg('totCuti', $totCuti); 
			$mySes->reg('totIjin', $totIjin);
			$mySes->reg('totAlpa', $totAlpa); 
		}
		$totMasukSesi = $mySes->read('totMasuk'); 
		$totCutiSesi = $mySes->read('totCuti');
		$totIjinSesi = $mySes->read('totIjin');
		$totAlpaSesi = $mySes->read('totAlpa');?>
		<tr>
			<td colspan="4" style="background-color:#FAE299; text-align:right;padding-right:5px;"><b>Total: </b></td>
			<td style="background-color:#FAE299; text-align:center"><?php echo($totMasukSesi.' hari'); ?></td>
			<td style="background-color:#FAE299; text-align:center"><?php echo($totCutiSesi.' hari'); ?></td>
			<td style="background-color:#FAE299; text-align:center"><?php echo($totIjinSesi.' hari'); ?></td>
			<td style="background-color:#FAE299; text-align:center"><?php echo($totAlpaSesi.' hari'); ?></td>
		</tr>
		<input type="hidden" name="rowCount" value="<?php echo($jum); ?>">
		<input type="hidden" name="boxchecked" value="0">
		<input type="hidden" name="state" value="0">
		<form method="post" action="index.php?module=rep-karyawan"><?php 
	include('tableFooter.php'); 
	if ($print == true) { ?>
		<tr>
		<td align="left" style="padding:10px;" width="10%"> 
			<input class="button1" type="button" value="Cetak Laporan" onClick="javascript: location.href='report/pdf_karyawan.php?bulan=<?php echo($bulan.'&tahun='.$tahun.'&totMasuk='.$totMasukSesi.'&totCuti='.$totCutiSesi.'&totIjinSesi='.$totIjinSesi.'&totAlpa='.$totAlpaSesi); ?>'">
		</td>
		</tr><?php
	}
break;
}
?>