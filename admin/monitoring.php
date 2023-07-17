<?php
session_start();
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
require_once "library/fungsi_indotgl.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Fitnes Center</title>
<link rel="stylesheet" href="style/data.css" type="text/css">
<link rel="stylesheet" href="style/style_index.css" type="text/css"  />
<link rel="stylesheet" href="style/menu.css" type="text/css"  />
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
	require_once "menu.php";
	?>
	</div>
  	</div>
	<div class="halaman">
  	<div class="tengah">
	<div class="batas_isi">
    	<div class="isi">


<div id="judulHalaman"><strong>Monitoring Global</strong></div>
	<td><?php echo "<a href=cekin_out.php>"; ?>
		<div id="tombolAdd2" >Check In-Out Member</div>
		<?php echo "</a>"; ?> 
	</td>
	<td><?php echo "<a href=mtrans_member.php>"; ?>
		<div id="tombolAdd2">Transaksi Member</div>
		<?php echo "</a>"; ?> 
    </td>
    <td><?php echo "<a href=mtrans_nonmember.php>"; ?>
		<div id="tombolAdd2">Transaksi NonMember</div>
		<?php echo "</a>"; ?>
    </td>
  </div>
 <div class="BatasBawah"></div>
</div>
</body>
</html>
