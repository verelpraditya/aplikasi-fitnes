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
	$myDb->select("SELECT c.*, k.* FROM cuti c LEFT OUTER JOIN karyawan k ON c.nik=k.nik");
	$jmlData = $myDb->rowCount;	
	$jmlHalaman = $page->jmlHalaman($jmlData, $batas);
	$linkHalaman = $page->navHalaman($_GET['page'], $jmlHalaman); 
	label('Laporan Absensi Cuti');
	message(); 
	if ($mySes->checkSes('bulan_cari_cuti')) {
		$bulan = $mySes->read('bulan_cari_cuti');
		$tahun = $mySes->read('tahun_cari_cuti');
		$sql = "SELECT c.*, c.nik AS nik_c, k.*, j.* FROM cuti c LEFT OUTER JOIN karyawan k ON c.nik=k.nik LEFT OUTER JOIN jabatan j ON k.kd_jabatan=j.kd_jabatan WHERE ((MONTH(tgl_mulai)='$bulan' OR MONTH(tgl_selesai)='$bulan') AND (YEAR(tgl_mulai)='$tahun' OR YEAR(tgl_selesai)='$tahun')) ORDER BY c.nik LIMIT $posisi, $batas";		
		# Komponen Cetak Laporan
		$print = true;
		$tglLaporan = $tgl;
	} 
	else
		$sql = "";?>
	

	<table id="detail" width="100%">
		<form method="post" action="action.php?module=rep-cuti&act=filter" name="formCari">
	    <tr>
			<td style="color:#cc0000;border:1px solid #ddd;" width="10%"><b>Bulan:</b><br><?php
				$myCombo->comboMonth('1', '12', 'bulan_cari_cuti', date('n')); ?>
			</td> 
			<td style="color:#cc0000;border:1px solid #ddd;" width="10%"><b>Tahun:</b><br><?php
				$myCombo->comboRange(date(Y)-5, date('Y'), 'tahun_cari_cuti', date('Y')); ?>
			</td> 
			<td style="border:1px solid #ddd;"><br>
				<input type="submit" value="Tampilkan">
			</td>
		</tr>
		</form>
	</table> <?php
	
	$query=$myDb->select($sql); 
	$jum = $myDb->rowCount;
	labelKecil('SIAWEB - Absent Application<br><b>Laporan Data Absensi Cuti</b>');
	if ($bulan <> '') {
		labelKecil('Bulan '.$myTime->getBulan($bulan).' '.$tahun);
	} ?>

    <table id="display" width="100%" cellpadding="0" cellspacing="0">				
		<tr>			
			<th width="3%">No</th><th width="7%">NIK</th><th>Nama Lengkap</th><th width="18%">Jabatan</th><th width="10%">Tanggal Mulai</th><th width="10%">Tanggal Selesai</th>
		</tr>
		<?php
		$no=$posisi+1;
		$id=1;
	    while ($result=$myDb->getRow($query)) { ?>
			<tr>			
			<td><?php echo($no); ?></td>
			<td><?php echo($result['nik_c']); ?></td>
			<td><?php echo($result['nama']); ?></td>
			<td><?php echo($result['ket_jabatan']); ?></td>
			<td><?php echo($myTime->getTglInd($result['tgl_mulai'])); ?></td>
			<td><?php echo($myTime->getTglInd($result['tgl_selesai'])); ?></td>
			</tr> 
			<?php
		    $no++;
			$id++;
		} ?>
		<input type="hidden" name="rowCount" value="<?php echo($jum); ?>">
		<input type="hidden" name="boxchecked" value="0">
		<input type="hidden" name="state" value="0">
		<form method="post" action="index.php?module=rep-cuti"><?php 
	include('tableFooter.php'); 
	if ($print == true) { ?>
		<tr>
		<td align="left" style="padding:10px;" width="10%"> 
			<input class="button1" type="button" value="Cetak Laporan" onClick="javascript: location.href='report/pdf_cuti.php?bulan=<?php echo($bulan.'&tahun='.$tahun); ?>'">
		</td>
		</tr><?php
	}
break;
}
?>