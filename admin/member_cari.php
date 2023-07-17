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
<title>Neno Fitness Center Member Search</title>
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
<div id="judulHalaman"><strong>Hasil Pencarian Member</strong></div>
<a href="member.php"><div id="tombolAdd">kembali</div></a>
<table border="0" cellspacing="1" cellpadding="0">
          <tr>
	   <td id="namaField">No</td>
          <td id="namaField">ID Member</td>
          <td id="namaField">Nama</td>
	  <td id="namaField">Jenis Kelamin</td>
          <td id="namaField">Tempat, Tgl. Lahir</td>
	  <td id="namaField">Alamat</td>
          <td id="namaField">No Telepon</td>
          <td id="namaField">Status</td>
	  <td id="namaField">Expire</td>
          <td colspan="2" id="namaField">Aksi</td>
         
        <?php 
		$cari="SELECT * FROM member WHERE $_POST[pilih] LIKE '%$_POST[tcari]%' ";
		$qcari=mysql_query($cari);
		$no=1;
		while($row1=mysql_fetch_array($qcari)){
			if ($row1['status']!="tidak aktif")
			{
				$warna="#dee9f1";
			}
			else
			{
				$warna="#F87217";
			}
		?>
		<?php 
		$tgl_lahir= tgl_indo($row1['tanggal_lahir']);
		$tgl_jth= tgl_indo($row1['tgl_tempo']);
		?>
           <tr bgcolor=<?php echo $warna; ?>>
	  <td><?php echo "$no"; ?></td>
          <td><?php echo "$row1[id_member]"; ?></td>
          <td><?php echo "$row1[nama]"; ?></td>
	  <td><?php echo "$row1[jenis_kelamin]"; ?></td>
    	  <td><?php echo "$row1[tempat_lahir], $tgl_lahir"; ?></td>
          <td><?php echo "$row1[alamat]"; ?></td>
	  <td><?php echo "$row1[no_telepon]"; ?></td>
	  <td><?php echo "$row1[status]"; ?></td>
	  <td><?php echo "$tgl_jth"; ?></td>
          <td><?php echo "<a href=index.php?halaman=form_ubah_data&kode=member_update&id=$row1[id_member]>"; ?>
          <div id="tombol">ubah</div> <?php echo "</a>"; ?>
          </td>
		  </td>
          <td><?php echo "<a href=form_bayar.php?&id=$row1[id_member]>"; ?>
          <div id="tombol">Aktifkan</div><?php echo "</a>"; ?>
          </td>
        </tr>
        <?php $no++; }
	echo"<table>"; 
	//penomoran
	
		$jmldata = mysql_num_rows($qcari);
		//$jmlhal  = ceil($jmldata/$batas);

		echo "</div>";
		echo "<p align=left>Total Member Cari: <b>$jmldata</b> Member</p>" ;
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
