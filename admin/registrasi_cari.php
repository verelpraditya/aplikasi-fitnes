<?php
session_start();
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Neno Fitness Center</title>
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


<div id="judulHalaman"><strong>Hasil Pencarian </strong></div>
<a href="registrasi.php"><div id="tombolAdd">kembali</div></a>
<table border="0" cellspacing="1" cellpadding="0">
            <tr>
            <td id="namaField">No Registrasi</td>
            <td id="namaField">ID Member</td>
            <td id="namaField">Nama Member</td>
            <td id="namaField">Alamat</td>
            <td id="namaField">Jenis Kelamin</td>
            <td id="namaField">No Telepon</td>
            <td id="namaField">Type Member</td>
            <td id="namaField">Tgl. Registrasi</td>
			<td id="namaField">Biaya Registrasi</td>
          </tr>
         <?php 		
	$query=mysql_query("SELECT * FROM registrasi,member WHERE registrasi.id_member=member.id_member and $_POST[pilih] LIKE '%$_POST[tcari]%'");
	$no=1;
	while($row=mysql_fetch_array($query)){
			if ($warna==$warna1){
				$warna=$warna2;
			}
			else{
				$warna=$warna1;
			}
		
		?>
		<?php
		$no=1;
		$tgl_pendaftaran= tanggal($row['tanggal_pendaftaran']);
		$bpen=$row['biaya_pendaftaran'];
		$bmem=$row['biaya_member'];
		$total=$bpen+$bmem; ?>
            <tr bgcolor="<?php echo $warna; ?>">
            <td><?php echo $row['no_registrasi']; ?></td>
            <td><?php echo "$row[id_member]"; ?></td>
            <td><?php echo "$row[nama]"; ?></td>
            <td><?php echo "$row[alamat]"; ?></td>
            <td><?php echo "$row[jenis_kelamin]"; ?></td>
            <td><?php echo "$row[no_telepon]"; ?></td>
            <td><?php echo "$row[nama_golongan]"; ?></td>
            <td><?php echo "$tgl_pendaftaran"; ?></td>
            <td align="right"><?php echo "Rp "; echo digit($total); ?></td>
          </tr>
           <?php $no++; }
	echo"<table>"; 
	//penomoran
	
		$jmldata = mysql_num_rows($query);
		//$jmlhal  = ceil($jmldata/$batas);

		echo "</div>";
		echo "<p align=left>Total Registrasi Cari: <b>$jmldata</b> Member</p>" ;
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
