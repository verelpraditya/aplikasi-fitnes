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
	label('Laporan Absensi Global');
	message(); 
	$sql = "";
	$cekTgl = false;
	$cekNIK = false;
	$readonlyNIK = 'readonly';
	if ($mySes->checkSes('bulan_cari_rep_global') && $mySes->checkSes('nik_cari_rep_global')) {	
		$bulan = $mySes->read('bulan_cari_rep_global');
		$tahun = $mySes->read('tahun_cari_rep_global');
		$nik = $mySes->read('nik_cari_rep_global');
		$cekTgl = 'checked';
		$cekNIK = 'checked';
		$readonlyNIK = '';
		$sql = "SELECT a.*, a.nik AS nik_a, k.*, j.* FROM absensi a LEFT OUTER JOIN karyawan k ON a.nik=k.nik LEFT OUTER JOIN jabatan j ON k.kd_jabatan=j.kd_jabatan WHERE MONTH(a.tgl)='$bulan' AND YEAR(a.tgl)='$tahun' AND a.nik = '$nik' ORDER BY a.tgl LIMIT $posisi, $batas";		
		# Komponen Cetak Laporan
		$print = true;
		$tglLaporan = $tgl;
	}
	else if ($mySes->checkSes('bulan_cari_rep_global')) {
		$bulan = $mySes->read('bulan_cari_rep_global');
		$tahun = $mySes->read('tahun_cari_rep_global');
		$cekTgl = 'checked';
		$sql = "SELECT a.*, a.nik AS nik_a, k.*, j.* FROM absensi a LEFT OUTER JOIN karyawan k ON a.nik=k.nik LEFT OUTER JOIN jabatan j ON k.kd_jabatan=j.kd_jabatan WHERE MONTH(a.tgl)='$bulan' AND YEAR(a.tgl)='$tahun' ORDER BY a.tgl LIMIT $posisi, $batas";		
		# Komponen Cetak Laporan
		$print = true;
		$tglLaporan = $tgl;
	}
	else if ($mySes->checkSes('nik_cari_rep_global')) {
		$nik = $mySes->read('nik_cari_rep_global');
		$cekNIK = 'checked';
		$readonlyNIK = '';
		$sql = "SELECT a.*, a.nik AS nik_a, k.*, j.* FROM absensi a LEFT OUTER JOIN karyawan k ON a.nik=k.nik LEFT OUTER JOIN jabatan j ON k.kd_jabatan=j.kd_jabatan WHERE a.nik = '$nik' ORDER BY a.tgl LIMIT $posisi, $batas";		
		# Komponen Cetak Laporan
		$print = true;
		$tglLaporan = $tgl;
	}
	else {
		$sql = "";
	} ?>

	<table id="detail" width="100%" cellpadding="0">
		<form method="post" action="action.php?module=rep-global&act=cari" name="formCari">
	    <tr>
			<td style="color:#cc0000;border:1px solid #ddd;" width="15%"><br>
				<div style="border-bottom:1px solid #ddd;">
					<input <?php echo($cekTgl); ?> type="checkbox" name="filterBulan"> <b>Bulan</b>
				</div><br><?php
				$myCombo->comboMonth('1', '12', 'bulan_cari_rep_global', date('n')); echo('&nbsp;');
				$myCombo->comboRange(date(Y)-5, date('Y'), 'tahun_cari_rep_global', date('Y')); ?>
			</td> 
			<td style="color:#cc0000;border:1px solid #ddd;" width="15%">
				<div style="border-bottom:1px solid #ddd;"><br>
					<input <?php echo($cekNIK); ?> type="checkbox" value="filterNIK" name="filterNIK" onClick="enabledInput(this, this.form.nik_cari_rep_global);"> <b>NIK</b>
				</div><br>
				<input type="text" id="NIK" name="nik_cari_rep_global" <?php echo($readonlyNIK); ?> value="<?php echo($nik); ?>" style="width:95%;"> 
			</td>
			<td style="border:1px solid #ddd;" valign="bottom">
				<input type="submit" value="Tampilkan">
			</td>
		</tr>
		</form>
	</table> <?php
	$query=$myDb->select($sql); 
	$jum = $myDb->rowCount;
	labelKecil('SIAWEB - Absent Application<br><b>Laporan Data Absensi Global</b>'); 
	if ($bulan <> '') {
		labelKecil('Bulan '.$myTime->getBulan($bulan).' '.$tahun);
	} ?>

    <table id="display" width="100%" cellpadding="0" cellspacing="0">				
		<tr>			
			<th width="3%">No</th><th width="7%">Tanggal</th><th width="7%">NIK</th><th>Nama Lengkap</th><th width="18%">Jabatan</th><th width="10%">Jam Masuk</th><th width="10%">Jam Pulang</th><th width="10%">Keterlambatan</th><th width="10%">Kelebihan Jam</th>
		</tr>
		<?php
		$no=$posisi+1;
		$id=1;
		$totKeterlambatan = 0;
		$totKelebihan = 0;

		while ($result=$myDb->getRow($query)) { ?>
			<tr>			
			<td><?php echo($no); ?></td>
			<td><?php echo($myTime->getTglInd($result['tgl'])); ?></td>
			<td><?php echo($result['nik_a']); ?></td>
			<td><?php echo($result['nama']); ?></td>
			<td><?php echo($result['ket_jabatan']); ?></td>
			<td><?php echo(substr($result['jam_masuk'], 0, 5)); ?></td>
			<td><?php echo(substr($result['jam_pulang'], 0, 5)); ?></td>
			<td><?php 
				$tgl = $result['tgl'];
				$resDay = $myDb->getRow($myDb->select("SELECT DATEDIFF('$tgl', CURDATE()) as selisih"));		
				$dayName = $myTime->getHariOptional2($resDay['selisih']);
				$r = $myDb->selectOne("SELECT set_masuk FROM waktu WHERE kd_waktu = '$dayName'");				
				if ($result['jam_masuk'] <> '') {
					$diff = diffTime($r, $result['jam_masuk']);
					echo(detik2jam($diff));
					if ($diff > 0)
						$totKeterlambatan += $diff;

				}?>
			</td>
			<td><?php 				
				$r = $myDb->selectOne("SELECT set_pulang FROM waktu WHERE kd_waktu = '$dayName'");				
				if ($result['jam_pulang'] <> '') {
					$diff = diffTime($r, $result['jam_pulang']);
					echo(detik2jam($diff));
					if ($diff > 0)
						$totKelebihan += $diff;
				}?>
			</td>
			</tr> 
			<?php
			$no++;
			$id++;
		}

		if ($mySes->checkSes('lambat_bulan') == false) {
			$mySes->reg('lambat_bulan', $totKeterlambatan);
			$mySes->reg('lebih_bulan', $totKelebihan); 
		}
		$lambat = $mySes->read('lambat_bulan');
		$lebih = $mySes->read('lebih_bulan'); ?>
		<tr>
			<td colspan="7" style="background-color:#FAE299; text-align:right;padding-right:5px;"><b>Total: </b></td>
			<td style="background-color:#FAE299; text-align:center;"><?php echo(detik2jam($lambat)); ?></td>
			<td style="background-color:#FAE299; text-align:center;"><?php echo(detik2jam($lebih)); ?></td>
		</tr>
		<input type="hidden" name="rowCount" value="<?php echo($jum); ?>">
		<input type="hidden" name="boxchecked" value="0">
		<input type="hidden" name="state" value="0">
		<form method="post" action="index.php?module=rep-global"><?php 
	include('tableFooter.php'); 
	if ($print == true) { ?>
		<tr>
		<td align="left" style="padding:10px;" width="10%"> 
			<input class="button1" type="button" value="Cetak Laporan" onClick="javascript: location.href='report/pdf_global.php?bulan=<?php echo($bulan.'&tahun='.$tahun.'&nik='.$nik.'&lambat='.detik2jam($lambat).'&lebih='.detik2jam($lebih)); ?>'">
		</td>
		</tr><?php
	}
break;
}
?>