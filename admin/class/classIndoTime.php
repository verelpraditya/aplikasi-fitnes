<?php
class indoTime {
	function getTglH($date) {
		$hari= $day=date(l);
		$tgl = substr($date, 8, 2);
		$bulan = $this->getBulan(substr($date, 5, 2));
		$tahun = substr($date, 0, 4);
		switch($hari)
	{
		case"Sunday":$hari="Minggu"; break;
		case"Monday":$hari="Senin"; break;
		case"Tuesday":$hari="Selasa"; break;
		case"Wednesday":$hari="Rabu"; break;
		case"Thursday":$hari="Kamis"; break;
		case"Friday":$hari="Jumat"; break;
		case"Saturday":$hari="Sabtu"; break;
	}
		return $hari.' '.$tgl.' '.$bulan.' '.$tahun;
	}
	function getTgl($date) {
		$tgl = substr($date, 8, 2);
		$bulan = $this->getBulan(substr($date, 5, 2));
		$tahun = substr($date, 0, 4);
		return $hari.' '.$tgl.' '.$bulan.' '.$tahun;
	}
	function getTglD($date) {
		return substr($date, 8, 2);
	}
	function getBulanM($date) {
		return substr($date, 5, 2);
	} 
	function getThY($date) {
		return substr($date, 0, 4);
	}
	function getTglInd($date) {
		$tgl = $this->getTglD($date).'-'.$this->getBulanM($date).'-'.$this->getThY($date);
		return $tgl;
	}
	function getTgl2($date){
		$d = substr($date, 0, 2); 
		$m = substr($date, 3, 2);
		$y = substr($date, 6, 4);
		$tgl = $y.'-'.$m.'-'.$d;
		return $tgl;
	}
	function getBulan($bulan) {
		switch($bulan) {
			case 1: return('Januari'); break;
			case 2: return('Pebruari'); break;
			case 3: return('Maret'); break;
			case 4: return('April'); break;
			case 5: return('Mei'); break;
			case 6: return('Juni'); break;
			case 7: return('Juli'); break;
			case 8: return('Agustus'); break;
			case 9: return('September'); break;
			case 10: return('Oktober'); break;
			case 11: return('Nopember'); break;
			case 12: return('Desember'); break;
		}
	}
	function getHari($nHari) {
		switch($nHari) {
			case 1: return('Senin'); break;
			case 2: return('Selasa'); break;
			case 3: return('Rabu'); break;
			case 4: return('Kamis'); break;
			case 5: return('Jumat'); break;
			case 6: return('Sabtu'); break;
			case 7: return('Minggu'); break;
		}
	}	
	function getHariOptional($date) {
		$x  = mktime(0, 0, 0, $this->getBulanM($date), $this->getTglD($date), $this->getThY($date));
		$dayNumber = date("N", $x);
		$dayName = $this->getHari($dayNumber);
		return $dayName;
	}
	function getHariOptional2($nDay) {
		$x  = mktime(0, 0, 0, date("m"), date("d")+$nDay, date("Y"));
		$dayNumber = date("N", $x);
		$dayName = $this->getHari($dayNumber);
		return $dayName;
	}
	function getThNow() {
		return date('Y');
	}
	function getTglNow1() {
		return date('Ymd');
	}
	function getTglNow2() {
		return $this->getTgl(date('Y m d'));
	}
	function getJamNow() {
		return date('H:i:s');
	}
}
?>