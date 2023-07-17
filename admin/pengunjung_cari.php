<?php
session_start();
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
require_once "library/fungsi_indotgl.php";
	$warna1="#c0d3e2";
	$warna2="#cfdde7";
	$warna=$warna1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ONe Gym Transaksi Search</title>
<link rel="stylesheet" href="style/data.css" type="text/css">
<link rel="stylesheet" href="style/style_index.css" type="text/css"/>
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
<div id="judulHalaman"><strong>Hasil Pencarian Guest</strong></div>
<a href="pengunjung.php"><div id="tombolAdd">kembali</div></a>
<table cellpadding="0" cellspacing="1">
        <tr>
	 	  <td id="namaField">No</td>
		  <td id="namaField">Id Member</td>
		  <td id="namaField">Nama Member</td>
		  <td id="namaField">Alamat</td>
		  <td id="namaField">Tgl. Masuk</td>
		  <td id="namaField">Jam Masuk</td>
		  <td id="namaField">Jam Keluar</td>
		 
        <?php 
		$cari="SELECT * FROM absensi,member WHERE absensi.id_member=member.id_member AND $_POST[pilih] LIKE '%$_POST[tcari]%' ";
		$qcari=mysql_query($cari);
		$no=1;
		while($row1=mysql_fetch_array($qcari)){
			if ($warna==$warna1){
				$warna=$warna2;
			}
			else{
				$warna=$warna1;
			}
		?>
		<?php 
		$tgl_lahir= tgl_indo($row1['tgl_lahir']);
		$tgl_masuk= tgl_indo($row1['tgl_masuk']);
		?>
         <tr bgcolor=<?php echo $warna; ?>>
	   	  <td><?php echo "$no"; ?></td>
          <td><?php echo "$row1[id_member]"; ?></td>
		  <td><?php echo "$row1[nama]"; ?></td>
		  <td><?php echo "$row1[alamat]"; ?></td>
          <td><?php echo tgl_indo("$row1[tgl]"); ?></td>
          <td><?php echo "$row1[jam_masuk]"; ?></td>
	  	  <td><?php echo "$row1[jam_pulang]"; ?></td>	
          
	  </tr>
	<?php $no++; }
	echo"</table>";
	//penomoran
	
		$jmldata = mysql_num_rows($qcari);
		//$jmlhal  = ceil($jmldata/$batas);

		echo "</div>";
		echo "<p align=left>Total transaksi: <b>$jmldata</b> Pengunjung</p>" ;
	?>
      </table>
     </div>
    </div>
    </div>  
  </div>
 <div class="BatasBawah"></div>
</div>
</body>
</html>
