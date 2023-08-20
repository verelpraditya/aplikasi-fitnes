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

<div id="judulHalaman"><strong>Data Pengunjung Member</strong></div>
<table border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td>
    <form id="form1" name="form1" method="post" action="pengunjung_cari.php">
      <table cellspacing="1" cellpadding="0">
        <tr>
          <td id="noborder">Pilih kategori pencarian</td>
          <td id="noborder">&nbsp;</td>
        </tr>
        <tr>
          <td id="noborder"><label>
          <select name="pilih" id="input"> 
		  <option value='absensi.id_member' >ID Member</option>
	      <!-- <option value='absensi.tgl' >Tgl Masuk</option>  -->
	      
          </select>
          </label></td>
          <td id="noborder">
            <input type="text" name="tcari" id="input" />
			<!-- <a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.form.tcari);return false;" ><img src="style/calender/calender.jpeg" alt="" name="popcal" width="34" height="29" border="0" align="absmiddle" id="popcal" /></a>				 -->
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
	$batas   = 30;
	$halaman = $_GET['halaman'];
	if(empty($halaman)){
	$posisi  = 0;
	$halaman = 1;
	}
	else{
	$posisi = ($halaman-1) * $batas;
	}
	$qp_sup=mysql_query("SELECT * FROM absensi,member WHERE absensi.id_member=member.id_member AND absensi.pulang = 1 order by absensi.tgl DESC LIMIT $posisi,$batas");
	$no=$posisi+1;
		while($row1=mysql_fetch_array($qp_sup)){
			if ($warna==$warna1){
				$warna=$warna2;
			}
			else{
				$warna=$warna1;
			}
		?>
		<?php 
		$jam_keluar= $row1['jam_masuk'];
		$jam_masuk= $row1['jam_pulang'];
		?>
          <tr bgcolor=<?php echo $warna; ?>>
	   	  <td><?php echo "$no"; ?></td>
          <td><?php echo "$row1[id_member]"; ?></td>
		  <td><?php echo "$row1[nama]"; ?></td>
		  <td><?php echo "$row1[alamat]"; ?></td>
          <td><?php echo tgl_indo("$row1[tgl]"); ?></td>
          <td><?php echo "$row1[jam_masuk]"; ?></td>
	  	  <td>hapus</td>		  
	  </tr>
	<?php $no++; }
	echo"</table>";

	//penomoran
	$tampil2 = mysql_query("SELECT * FROM guest");
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
		echo "<p align=left>Total Record : <b>$jmldata</b> Pengunjung</p>";
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

