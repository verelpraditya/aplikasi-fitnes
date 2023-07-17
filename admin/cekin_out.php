<?php
session_start();
if(empty($_SESSION[level])){
echo "<meta http-equiv='refresh' content='0; url=index.php'>";
}
else{
require_once "class/classCombo.php";
require_once "class/classSession.php";
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
require_once "library/fungsi_indotgl.php";
$mySes		= new session();
$myCombo	= new combo();
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

<div id="judulHalaman"><strong>Data Check In-Out Member</strong></div>
<table border="0" cellspacing="1" cellpadding="0">
    <tr>
    <td >
    <form id="form1" name="form1" method="post" action="cekin_out_cari.php">
      <table cellspacing="1" cellpadding="0">
        <tr>
          <td id="noborder">Pilih kategori pencarian</td>
          <td id="noborder">&nbsp;</td>
        </tr>
        <tr>
		
          <td id="noborder"><label>
            <select name="pilih" id="input">
              <option value='nama' >Nama Member</option>
              <option value='jenis_kelamin' >Jenis Kelamin</option>
              <option value='alamat' >Alamat</option>
              <option value='no_telepon' >No. Whatsapp</option>
			  <option value='tgl' >Tanggal</option>
            </select>
          </label></td>
          <td id="noborder">
            <input type="text" name="tcari" id="input" />
			<a href="javascript:void(0)" onClick="if(self.gfPop)gfPop.fPopCalendar(document.form1.tcari);return false;" ><img src="style/calender/calender.jpeg" alt="" name="popcal" width="34" height="29" border="0" align="absmiddle" id="popcal" /></a>				
            <input type="submit" name="bcari" id="tombol" value="Cari Data" />
			<?php echo "<a href=report/pdf_cekinout.php"; ?>
          	 <div id="tombol">Cetak</div>
			 <?php echo "</a>"; ?>		
			</td>
        </tr>
      </table>
    </form></td>
	<iframe width=174 height=189 name="gToday:normal:style/calender/normal.js" id="gToday:normal:style/calender/normal.js" src="style/calender/ipopeng.htm" scrolling="no" frameborder="0" style="visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;">
</iframe>
 <td>
    <form id="form2" name="form2" method="post" action="cekinout_tcari.php">
      <table >
        <tr>
          <td id="noborder"><b>Bulan &amp; Tahun</b></td>
          <td id="noborder">&nbsp;</td>
        </tr>
        <td height="42"  id="noborder"><p>
            <p>
              <?php
				$myCombo->comboMonth('1', '12', 'bulan', date('n')); echo('&nbsp;');
				$myCombo->comboRange(date(Y)-6, date('Y'), 'tahun', date('Y')); 
				?>
          </p></td>
          <td id="noborder">
            <input type="submit" name="tampil" id="tombol" value="Tampil" />
			<?php 
				$bulan = $mySes->read('bulan');
				$tahun=$_GET['tahun'];
				echo "<a href=report/pdf_cekinout.php"; ?>
          	 <div id="tombol">Cetak</div>
			 <?php echo "</a>"; ?>	
          </td>
       </table>
 </form>
 </td>
  </tr>
</table>
 <?php
	$warna1="#c0d3e2";
	$warna2="#cfdde7";
	$warna=$warna1;
 ?> 
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
	$batas   = 30;
	$halaman = $_GET['halaman'];
	if(empty($halaman)){
	$posisi  = 0;
	$halaman = 1;
	}
	else{
	$posisi = ($halaman-1) * $batas;
	}
	$qp_sup=mysql_query("SELECT * FROM member,absensi Where member.id_member=absensi.id_member  order by absensi.tgl DESC LIMIT $posisi,$batas");
	$no=$posisi+1;
		while($row1=mysql_fetch_array($qp_sup)){
			if ($row1['status']!="tidak aktif")
			{
				$warna="#dee9f1";
			}
			else
			{
				$warna="#F99";
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
	echo"</table>";

	//penomoran
	$tampil2 = mysql_query("SELECT * FROM member,absensi WHERE member.id_member=absensi.id_member");
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
		echo "<p align=left>Total Record : <b>$jmldata</b> Record</p>";
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
