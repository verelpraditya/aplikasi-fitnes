<?php
session_start();
require_once "class/classCombo.php";
require_once "class/classSession.php";
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
require_once "library/fungsi_indotgl.php";
$mySes		= new session();
$myCombo	= new combo();
if (!isset($_POST['proses']))
{
	$qp_sup=mysql_query("SELECT * FROM pembayaran order by no_transaksi DESC LIMIT 10");
	$sum1="SELECT SUM(total_bayar) AS total FROM pembayaran";
	//$tampil="SELECT * FROM hutang ORDER BY beli_id DESC";
	//$sum1="SELECT SUM(sisa_bayar) AS total FROM hutang";
}
else
{
	$bulan=$_POST['bulan'];
	$tahun=$_POST['tahun'];
	$qp_sup=mysql_query("SELECT * FROM pembayaran WHERE MONTH(tgl)='$bulan' AND YEAR(tgl)='$tahun' order by no_transaksi DESC LIMIT $posisi,$batas");
	$sum1="SELECT SUM(total_bayar) AS total FROM pembayaran";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ONe Gym Center</title>
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

<div id="judulHalaman"><strong>Transaksi Member</strong></div>
<table border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td>
    <form id="form1" name="form1" method="post" action="mtrans_membercari.php">
      <table cellspacing="1" cellpadding="0">
        <tr>
          <td id="noborder">Pilih kategori pencarian</td>
          <td id="noborder">&nbsp;</td>
        </tr>
        <tr>
          <td id="noborder"><label>
            <select name="pilih" id="input"> 
	      <option value='no_transaksi' >No Transaksi</option>             
	      <option value='nama' >Nama Member</option>
	      <option value='id_member' >ID Member</option>
              <option value='nama_golongan' >Jenis member</option>
	      <option value='tanggal_pembayaran' >Tgl. Transaksi</option>
	      <option value='tanggal_jatuh_tempo' >Tgl. Jatuh tempo</option>
            </select>
          </label></td>
          <td id="noborder">
            <input type="text" name="tcari" id="input" />
            <input type="submit" name="bcari" id="tombol" value="cari" />
          </td>
        </tr>
     	</table>
 </form>
 </td>
 <td>
    <form id="form2" name="form2" method="post" action="index.php?halaman=hutang">
    <input name="proses" type="hidden" value="form2" />
      <table width="270" cellspacing="1" cellpadding="0">
        <tr>
          <td>Pilih Keterangan</td>
        </tr>
        <tr>
          <td>
          	<select name="MONTH(tgl)" id="input">
          	  <option selected="selected">januari</option>
          	  <option>februari</option>
          	  <option>maret</option>
          	</select>
          	<label>
          	  <input type="submit" name="ok" id="tombol" value="ok" />
       	    </label></td>
        </tr>
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
          <td id="namaField">No.Transaksi</td>
          <td id="namaField">ID Member</td>
	  <td id="namaField">Nama member</td>
          <td id="namaField">Jenis Member</td>
	  <td id="namaField">Tgl. Pembayaran</td>
          <td id="namaField">Total Bayar</td>      
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
	$hasil=mysql_query($qp_sup);
	//$sum1="SELECT SUM(total_bayar) AS total FROM pembayaran";
	//$qp_sup=mysql_query("SELECT * FROM pembayaran order by no_transaksi DESC LIMIT $posisi,$batas");
	$no=$posisi+1;
		while($row1=mysql_fetch_array($hasil)){
			if ($warna==$warna1){
				$warna=$warna2;
			}
			else{
				$warna=$warna1;
			}
		?>
		<?php 
	 	$tgl_pem= tgl_indo($row1['tanggal_pembayaran']);
		$tgl_jth= tgl_indo($row1['tanggal_jatuh_tempo']);
		?>
        <tr bgcolor=<?php echo $warna; ?>>
		<td><?php echo "$no"; ?></td>
        <td><?php echo "$row1[no_transaksi]"; ?></td>
        <td><?php echo "$row1[id_member]"; ?></td>
		<td><?php echo "$row1[nama]"; ?></td>
    	<td><?php echo "$row1[nama_golongan]"; ?></td>
        <td><?php echo "$tgl_pem"; ?></td>
		<td><?php echo "Rp "; echo digit($row1['total_bayar']); ?></td>
		</tr>	
			
		<?php $no++; }
		?>
		<tr>
		<td style="color:#FFF;border:none;background-color:#333" colspan="6" align="right">Total Seluruh Transaksi Member :</td>
		<td style="color:#FFF;border:none;background-color:#333" align="right">
		
		</td>
		</tr>
		<?php
		echo"</table>";
	
	//penomoran
	$tampil2 = mysql_query("SELECT * FROM pembayaran");
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
		echo "<p align=left>Total Record : <b>$jmldata</b> transaksi</p>";
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

