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


<div id="judulHalaman"><strong>Data Registrasi Member</strong></div>
<table border="0" cellspacing="1" cellpadding="0">
<?php echo "<a href=form_member.php>"; ?>
<div id="tombolAdd">Tambah Data</div>
  <tr>
    <td>
    <form id="form1" name="form1" method="post" action="registrasi_cari.php">
      <table cellspacing="1" cellpadding="0">
        <tr>
          <td id="noborder">Pilih kategori pencarian</td>
          <td id="noborder">&nbsp;</td>
        </tr>
           <td id="noborder"><label>
            <select name="pilih" id="input" >
              <option value="no_registrasi" >No Registrasi</option>
	      <option value="nama" >Nama</option>
	      <option value="jenis_kelamin" >Jenis Kelamin</option>	
              <option value="tanggal_pendaftaran">Tgl. Registrasi</option>
            </select>
          </label></td>
          <td id="noborder">
            <input type="text" name="tcari" id="input" />
			<a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tcari);return false;" ><img src="style/calender/calender.jpeg" alt="" name="popcal" width="34" height="29" border="0" align="absmiddle" id="popcal" /></a>				
            <input type="submit" name="bcari" id="tombol" value="cari data" />
	   </td>
	</tr>
   	  </table>
     </form>
    </td>
	<iframe width=174 height=189 name="gToday:normal:style/calender/normal.js" id="gToday:normal:style/calender/normal.js" src="style/calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>
</form>
<?php
	$warna1="#c0d3e2";
	$warna2="#cfdde7";
	$warna=$warna1;
 ?>
<table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td id="noborder"><table cellpadding="0" cellspacing="1">
          <tr>
            <td id="namaField">No Registrasi</td>
            <td id="namaField">ID Member</td>
            <td id="namaField">Nama Member</td>
            <td id="namaField">Alamat</td>
            <td id="namaField">Jenis Kelamin</td>
            <td id="namaField">No. Whatsapp</td>
            <td id="namaField">Type Member</td>
            <td id="namaField">Tgl. Registrasi</td>
	   <td id="namaField">Biaya Registrasi</td>
            </tr>
          <?php 
	$batas   = 30;
	$halaman = $_GET['halaman'];
	if(empty($halaman)){
	$posisi  = 0;
	$halaman = 1;
	}
	else{
	$posisi = ($halaman-1) * $batas;
	}		  		
$query=mysql_query("SELECT * FROM registrasi,member WHERE registrasi.id_member=member.id_member ORDER BY no_registrasi DESC LIMIT $posisi,$batas");
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
	$tgl_pendaftaran= tgl_indo($row['tanggal_pendaftaran']);
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
            <td align="right"><?php echo "Rp "; echo digit($row['biaya_pendaftaran']); ?></td>
	    </tr>
          <?php $no++; }
	echo"</table>";

	//penomoran
	$tampil2 = mysql_query("SELECT * FROM registrasi,member WHERE registrasi.id_member=member.id_member");
		$jmldata = mysql_num_rows($tampil2);
		$jmlhal  = ceil($jmldata/$batas);

		echo "<div class=paging>";
		// Link ke halaman sebelumnya (previous)
		if($halaman > 1){
			$prev=$halaman-1;
			echo "<span class=prevnext><a href=$_SERVER[PHP_SELF]?halaman=$prev>« Prev</a></span> ";
		}
		else{ 
			echo "<span class=disabled>« Prev</span> ";
		}

		// Tampilkan link halaman 1,2,3 ...
		for($i=1;$i<=$jmlhal;$i++)
		if ($i != $halaman){
			echo " <a href=$_SERVER[PHP_SELF]?halaman=$i>$i</a> ";
		}
		else{
			echo " <span class=current>$i</span> ";
		}

		// Link kehalaman berikutnya (Next)
		if($halaman < $jmlhal){
			$next=$halaman+1;
			echo "<span class=prevnext><a href=$_SERVER[PHP_SELF]?halaman=$next>Next »</a></span>";
		}
		else{ 
			echo "<span class=disabled>Next »</span>";
		}
		echo "</div>";
		echo "<p align=left>Total Registrasi : <b>$jmldata</b> Member</p>";
		?>
        </table></td>        
      	</tr>
	</table>
	</div>
    </div>
    </div>  
  </div>
 <div class="BatasBawah"></div>
</div>
</body>
</html>
