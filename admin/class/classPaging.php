<?php
class paging {
	# Fungsi untuk mengecek halaman dan posisi data
	function cariPosisi($batas) {
		if (empty($_GET[page])) {
			$posisi=0;
			$_GET[page]=1;
		}
		else {
			$posisi=($_GET[page]-1)*$batas;
		}
		return $posisi;
	}
	# Fungsi untuk menghitung total halaman
	function jmlHalaman($jmldata, $batas) {
		$jmlhalaman=ceil($jmldata/$batas);
		return $jmlhalaman;
	}
	# Fungsi untuk link halaman 1,2,3 ... Next, Prev, First, Last
	function navHalaman($halaman_aktif, $jmlhalaman, $mod='') {
		$link_halaman = '';
		# Link First dan Previous Umum
		if ($mod == '') {
			if ($halaman_aktif > 1) {				
				$link_halaman .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&page=1><< First</a> | ";
			}
			if (($halaman_aktif-1) > 0) {
				$previous=$halaman_aktif-1;
				$link_halaman .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&page=$previous>< Previous</a> | ";
			}
		}
		# Link First dan Previous Khusus Gallery Foto
		else {
			if ($halaman_aktif > 1) {
				$link_halaman .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&act=detail&page=1><< First</a> | ";
			}
			if (($halaman_aktif-1) > 0) {
				$previous=$halaman_aktif-1;
				$link_halaman .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&act=detail&page=$previous>< Previous</a> | ";
			}
		}
		# Link halaman 1,2,3, ...
		/* Traditional	
		for ($i=1; $i<=$jmlhalaman; $i++) {
			if ($i==$halaman_aktif) {
				$link_halaman .= "<b>$i</b> | ";
			}
			else {
				$link_halaman .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&halaman=$i>$i</a> | ";
			}
			$link_halaman .= " ";
		}*/

		# Link halaman 1,2,3, ... Google Style Umum
		if ($mod == '') {
			$angka = ($halaman_aktif > 3 ? "..." : " ");
			for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++) {
				if ($i < 1)
					continue;
				$angka .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&page=$i>$i</a> ";
			}
			$angka .= " ";
			$angka .= "<b>$halaman_aktif</b>";
			for ($i=$halaman_aktif+1; $i<=($halaman_aktif+3); $i++) {
				if ($i > $jmlhalaman)
					break;
				$angka .= " <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&page=$i>$i</a> ";
			}
			$angka .= " ";
			$angka .= ($halaman_aktif+2 < $jmlhalaman ? "...<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&page=$jmlhalaman>$jmlhalaman</a>" : "");
			$link_halaman .= $angka.' ';
		}
		# Gallery Tok
		else {
			$angka = ($halaman_aktif > 3 ? "..." : " ");
			for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++) {
				if ($i < 1)
					continue;
				$angka .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&act=detail&page=$i>$i</a> ";
			}
			$angka .= " ";
			$angka .= "<b>$halaman_aktif</b>";
			for ($i=$halaman_aktif+1; $i<=($halaman_aktif+3); $i++) {
				if ($i > $jmlhalaman)
					break;
				$angka .= " <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&act=detail&page=$i>$i</a> ";
			}
			$angka .= " ";
			$angka .= ($halaman_aktif+2 < $jmlhalaman ? "...<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&act=detail&page=$jmlhalaman>$jmlhalaman</a>" : "");
			$link_halaman .= $angka.' ';
		}

		# Link Next dan Last Umum
		if ($mod == '') {
			if ($halaman_aktif < $jmlhalaman) {
				$next = $halaman_aktif+1;
				$link_halaman .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&page=$next>Next ></a> ";
			}
			if (($halaman_aktif != $jmlhalaman) && ($jmlhalaman != 0)) {
				$link_halaman .= " | <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&page=$jmlhalaman>Last >></a> ";
			}
		}
		# Galery Tok
		else {
			if ($halaman_aktif < $jmlhalaman) {
				$next = $halaman_aktif+1;
				$link_halaman .= "<a href=$_SERVER[PHP_SELF]?module=$_GET[module]&act=detail&page=$next>Next ></a> ";
			}
			if (($halaman_aktif != $jmlhalaman) && ($jmlhalaman != 0)) {
				$link_halaman .= " | <a href=$_SERVER[PHP_SELF]?module=$_GET[module]&act=detail&page=$jmlhalaman>Last >></a> ";
			}
		}
		return $link_halaman;
	}
}
?>