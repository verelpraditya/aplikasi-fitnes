<?php
session_start();
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";

$batas   = 10;
$hal=$_GET['halaman'];
	if (empty($hal)){
		$posisi  = 0;
		$hal = 1;			
		$hal="instruktur";
	}
	 else{
		$posisi = ($hal-1) * $batas;
			}
// cek apakah user yang mengakses halaman ini sudah melalui login atau belum
// logikanya jika user telah login dan sukses, maka SESSION level dan SESSION username ini pasti sudah ada
// jika ada user yang mencoba akses halaman ini tanpa login, maka logikanya kedua SESSION belum ada

if (isset($_SESSION['level']) && isset($_SESSION['username']))
{
// tampilkan menu.
// menu hanya ditampilkan bila halaman ini diakses oleh user yang telah login
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Neno Fitness Center</title>
<link rel="stylesheet" href="style/style_index.css" type="text/css"  />

<style type="text/css">
/*link a*/
a
{
	text-decoration:none;
	color:#09F;
}
a:hover
{
	color:#9C0;
}
/*akhir link a*/
/*judul halaman*/
#judulHalaman
{
	color:#333;
	font-size:18px;
	background-color:#CCC;
	border:1px solid #999;
	padding:7px 14px;
	margin:7px 9px;
	border-radius:5px;
}
/*akhir judul halaman*/
/*style form*/
#input
{
	padding:3px 5px;
	margin:0px 3px;
	border:1px solid #c0d3e2;
	border-radius:3px;
}
#tombol
{
	color:#FFF;
	padding:3px 5px;
	background-color:#09C;
	border:1px solid #069;
	border-radius:3px;
}
#tombol:hover
{
	background-color:#9C0;
	border:1px solid #990;
}
#tombolAdd
{
	color:#FFF;
	margin:7px 9px;
	width:90px;
	padding:5px 7px;
	background-color:#09C;
	border:1px solid #069;
	border-radius:3px;
}
#tombolAdd:hover
{
	background-color:#9C0;
	border:1px solid #990;
}
/*akhir style form*/
/*style tabel*/
table
{
	margin:5px 9px;
}
td
{
	padding:5px 9px;
	border:1px solid #c0d3e2;
}
#namaField{
	color:#FFF;
	background-color:#333;
	text-align:center;
	padding-top:7px;
	border:none;
}
/*akhir style tabel*/
</style>
</head>

<body>
<div id="page">  
  <div class="header"><img src="style/aladin.png" />
  <div id="box">
	<div id="tgl"><?php echo tanggal();?></div>
	<div id="akun"><?php echo $_SESSION['nama']; ?></div>
   </div>
  </div>
  <div id="menu-bg">
  <div id="menu">
<?php  
include "menu.php";
?>
  </div>
  </div>
<div class="halaman">
  <div class="tengah">
	<div class="batas_isi">
    <div class="isi">
   	<?php
		require_once $hal.".php";
	?>
    </div>
    </div>
    </div>  
  </div>
 <div class="BatasBawah"></div>
</div>
</body>
</html>
<?php
}
else
{
	lompat_ke("form_login.php");
}
?>
