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
	<div id="judulHalaman"><strong>Hasil Pencarian Transaksi</strong></div>
	<a href="mtrans_nonmember.php"><div id="tombolAdd">kembali</div></a>
	<table border="0" cellspacing="1" cellpadding="0">
		<tr>
		<td id="namaField">No</td>
        <td id="namaField">No.Transaksi</td>
        <td id="namaField">No. Identitas</td>
		<td id="namaField">Nama</td>
		<td id="namaField">Jenis Kelamin</td>
        <td id="namaField">Alamat</td>
		<td id="namaField">Tgl. Pembayaran</td>
        <td id="namaField">Total Bayar</td>          
        <?php 
		$cari="SELECT * FROM umum WHERE $_POST[pilih] LIKE '%$_POST[tcari]%' ";
		$qcari=mysql_query($cari);
		$no=1;
		while($row1=mysql_fetch_array($qcari)){
			if ($warna==$warna1){
				$warna=$warna2;
			}
			else{
				$warna=$warna1;
			}
			//select hutang
			$hitung="SELECT * FROM umum WHERE no_transaksi='$row1[no_transaksi]'";
			$qhitung=mysql_query($hitung);
			$data=mysql_fetch_array($qhitung);
			//select hutang_detai
			$total=$total+$data['jumlah_bayar'];
		?>
		<?php 
	 	$tgl_trans= tgl_indo($row1['tgl_transaksi']);
		?>
        <tr bgcolor=<?php echo $warna; ?>>
		<td><?php echo "$no"; ?></td>
        <td><?php echo "$row1[no_transaksi]"; ?></td>
        <td><?php echo "$row1[no_identitas]"; ?></td>
		<td><?php echo "$row1[nama]"; ?></td>
		<td><?php echo "$row1[jenis_kelamin]"; ?></td>
    	<td><?php echo "$row1[alamat]"; ?></td>
        <td><?php echo "$tgl_trans"; ?></td>
		<td><?php echo "Rp "; echo digit($row1['jumlah_bayar']); ?></td>
		</tr>
        <?php $no++; }
		?>
		<tr>
		<td style="color:#FFF;border:none;background-color:#333" colspan="7" align="right">Total Transaksi Cari :</td>
		<td style="color:#FFF;border:none;background-color:#333" align="right">
		<?php 
			echo "Rp ".digit($total);
		?>
		</td>
		</tr>
		<?php
	echo"<table>"; 
	//penomoran
	
		$jmldata = mysql_num_rows($qcari);
		//$jmlhal  = ceil($jmldata/$batas);

		echo "</div>";
		echo "<p align=left>Total transaksi Cari: <b>$jmldata</b> transaksi</p>" ;
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
