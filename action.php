<?php
require_once('config.php');
include_once($config_dirAdmin.'class/classDatabase.php');
include_once($config_dirAdmin.'class/classIndoTime.php');
include_once($config_dirAdmin.'class/classSession.php');

$myDb   = new database();
$myTime = new indoTime();
$mySes  = new session();

$tgl   = date('Y-m-d');
$jam   = $myTime->getJamNow();
$hari  = $myTime->getHari(date("N"));
$bulan = $myTime->getBulan($bulan = $bl = $month = date('m'));

// Proses cek masuk atau keluar	
$cekmem = $myDb->select("SELECT * FROM member ");
$result = $myDb->getRow($cekmem);
if ($result['tgl_tempo'] = $tgl) {
    $sql = "UPDATE member SET status='tidak aktif' WHERE tgl_tempo ='$tgl'";
    $myDb->update($sql);
}

$cekNIK = $myDb->selectOne("SELECT * FROM member WHERE id_member = '$_POST[id]'");

// Cek kuota dan expired Member
$cekmember = $myDb->select("SELECT * FROM member WHERE id_member = '$_POST[id]' AND status='aktif'");
$hasilcekmember = $myDb->getRow($cekmember);
// Cek Berapa Hari lagi expired
$tgltem=$hasilcekmember['tgl_tempo'];
$querytgl = "SELECT datediff('$tgltem', '$tgl') as selisih";
$hasil = mysql_query($querytgl);
$data = mysql_fetch_array($hasil);


// Proses Cekin cekout
// Jika Id Member Ditemukan
if ($cekNIK) {
    $sql    = $myDb->select("SELECT jam_masuk, jam_pulang FROM absensi WHERE id_member = '$_POST[id]' AND tgl='$tgl'");
    $result = $myDb->getRow($sql);
	// Cek kuota Dan Expired
	if ($hasilcekmember['kuota'] == 0) {
		$error = "Kuota telah habis";
		header('location:index.php?error=' . urlencode($error));
		exit;
	// Jika Sudah Expired 
	}elseif ($data['selisih'] <= 0) {
		$error = "Expired";
		header('location:index.php?error=' . urlencode($error));
		exit;
	}else{
		// Jika Member OK
			$sql = $myDb->select("SELECT jam_masuk, jam_pulang FROM absensi WHERE id_member = '$_POST[id]' AND tgl='$tgl'");
			$result = $myDb->getRow($sql);
			if ($result['jam_masuk'] != '' && $result['jam_pulang'] != '') {
				$counter = $myDb->selectOne("SELECT MAX(counter)+1 FROM absensi");				
				$sql = "INSERT INTO absensi(id_member, tgl, kd_waktu, jam_masuk, counter) VALUES('$_POST[id]', '$tgl', '$hari', '$jam', '$counter')";
				$myDb->insert($sql);
				$updatedKuota = $hasilcekmember['kuota'] - 1;
				$sqlUpdateKuota = "UPDATE member SET kuota='$updatedKuota' WHERE id_member='$_POST[id]'";
				$myDb->update($sqlUpdateKuota);				
			}elseif($result['jam_masuk'] != '') {
				$counter = $myDb->selectOne("SELECT MAX(counter)+1 FROM absensi");				
				$sql = "UPDATE absensi SET jam_pulang='$jam', counter='$counter' WHERE id_member = '$_POST[id]' AND tgl = '$tgl'";
				$myDb->update($sql);
			}else {
				$counter = $myDb->selectOne("SELECT MAX(counter)+1 FROM absensi");				
				$sql = "INSERT INTO absensi(id_member, tgl, kd_waktu, jam_masuk, counter) VALUES('$_POST[id]', '$tgl', '$hari', '$jam', '$counter')";
				$myDb->insert($sql);
				$updatedKuota = $hasilcekmember['kuota'] - 1;
				$sqlUpdateKuota = "UPDATE member SET kuota='$updatedKuota' WHERE id_member='$_POST[id]'";
				$myDb->update($sqlUpdateKuota);	
			}
	}
} else {
	// Jika Id Member Tidak Terdaftar
    $error = "ID Member Tidak Ditemukan";
    header('location:index.php?error=' . urlencode($error));
    exit;
}

header('location:index.php');
?>