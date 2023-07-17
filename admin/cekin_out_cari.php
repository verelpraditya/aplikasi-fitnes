<?php
session_start();
if(empty($_SESSION[level])){
echo "<meta http-equiv='refresh' content='0; url=index.php'>";
}
else{
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
<title>Neno Fitness Center</title>
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
	<?php
		$pilih=$_POST['pilih'];
		$cari=$_POST['tcari'];
		?>
	</div>
  	</div>
	<div class="halaman">
  	<div class="tengah">
	<div class="batas_isi">
    	<div class="isi">
<div id="judulHalaman"><strong>Hasil Pencarian Member</strong></div>
<a href="cekin_out.php"><div id="tombolAdd">kembali</div></a>

<?php echo "<a href=report/pdf_cekinout.php?kategori=$pilih&cari=$cari"; ?>
          	 <div id="tombol">Cetak</div>
			 <?php echo "</a>"; ?>		
<table cellpadding="0" cellspacing="1">
      <tr>
	  <td id="namaField">No</td>
	  <td id="namaField">Tanggal</td>
      <td id="namaField">ID Member</td>
      <td id="namaField">Nama</td>
	  <td id="namaField">Jenis Kelamin</td>
	  <td id="namaField">Alamat</td>
      <td id="namaField">No. Whatsapp</td>
      <td id="namaField">Jam Masuk</td>
	  <td id="namaField">Jam Keluar</td>
	  <td id="namaField">Total Jam</td>
         
        <?php 
		$bulan=$_POST['bulan'];
		$tahun=$_POST['tahun'];
		$pilih=$_POST['pilih'];
		$cari=$_POST['tcari'];
		$qtmpil_sup="SELECT * FROM absensi,member WHERE member.id_member=absensi.id_member AND $_POST[pilih] LIKE '%$_POST[tcari]%' ";
		$qcari=mysql_query($qtmpil_sup);
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
		$tgl_cekin= tgl_indo($row1['tgl']);
		$tgl_jth= tgl_indo($row1['tgl_tempo']);
		$mjam=$row1['jam_masuk'];
		$pjam=$row1['jam_pulang'];
		$queryjam = "SELECT timediff('$pjam', '$mjam') as selisih";
		$hasil = mysql_query($queryjam);
		$data = mysql_fetch_array($hasil);
		?>
        <tr bgcolor=<?php echo $warna; ?>>
		<td><?php echo "$no"; ?></td>
		<td><?php echo "$tgl_cekin"; ?></td>
        <td><?php echo "$row1[id_member]"; ?></td>
        <td><?php echo "$row1[nama]"; ?></td>
		<td><?php echo "$row1[jenis_kelamin]"; ?></td>
    	<td><?php echo "$row1[alamat]"; ?></td>
        <td><?php echo "$row1[no_telepon]"; ?></td>
		<td><?php echo "$row1[jam_masuk]"; ?></td>
		<td><?php echo "$row1[jam_pulang]"; ?></td>
		<td><?php echo "$data[selisih]"; ?></td>
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
<?php
}
?>