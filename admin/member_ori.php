<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="style/data.css" type="text/css">

</head>
<body>
<div id="judulHalaman"><strong>Data Member</strong></div>
<table border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td>
    <form id="form1" name="form1" method="post" action="index.php?halaman=member_cari">
      <table cellspacing="1" cellpadding="0">
        <tr>
          <td>Pilih kategori pencarian</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><label>
            <select name="pilih" id="input">              
	      <option value='nama' >Nama Member</option>
	      <option value='id_member' >ID Member</option>
              <option value='jenis_kelamin' >Jenis Kelamin</option>
	      <option value='alamat' >Alamat</option>
	      <option value='no_telepon' >No Telepon</option>
	      <option value='status' >Status Member</option>
            </select>
          </label></td>
          <td>
            <input type="text" name="tcari" id="input" />
            <input type="submit" name="bcari" id="tombol" value="cari" />
          </td>
        </tr>
      </table>
	</form>
    </td>

</form>
 <?php
	$warna1="#c0d3e2";
	$warna2="#cfdde7";
	$warna=$warna1;
 ?> 
      <table cellpadding="0" cellspacing="1">
        <tr>
	  <td id="namaField">No</td>
          <td id="namaField">ID Member</td>
          <td id="namaField">Nama</td>
	  <td id="namaField">Jenis Kelamin</td>
          <td id="namaField">Tempat, Tgl. Lahir</td>
	  <td id="namaField">Alamat</td>
          <td id="namaField">No. Whatsapp</td>
          <td id="namaField">Status</td>
          <td colspan="2" id="namaField">Aksi</td>
         
        <?php 
	$batas   = 1;
	$halaman = $_GET['halaman'];
	if(empty($halaman)){
	$posisi  = 0;
	$halaman = 1;
	}
	else{
	$posisi = ($halaman-1) * $batas;
	}
	$qp_sup=mysql_query("SELECT * FROM member order by id_member DESC LIMIT $posisi,$batas");
	$no=$posisi+1;
		while($row1=mysql_fetch_array($qp_sup)){
			if ($row1['jenis_kelamin']!="Perempuan")
			{
				$warna="#XXFBB9";
			}
			else
			{
				$warna="#dee9f1";
			}
		?>
           <tr bgcolor=<?php echo $warna; ?>>
	 <td><?php echo "$no"; ?></td>
          <td><?php echo "$row1[id_member]"; ?></td>
          <td><?php echo "$row1[nama]"; ?></td>
	  <td><?php echo "$row1[jenis_kelamin]"; ?></td>
    	  <td><?php echo "$row1[tempat_lahir], $row1[tanggal_lahir]"; ?></td>
          <td><?php echo "$row1[alamat]"; ?></td>
	  <td><?php echo "$row1[no_telepon]"; ?></td>
	  <td><?php echo "$row1[status]"; ?></td>
          <td><?php echo "<a href=index.php?halaman=form_ubah_data&kode=member_update&id=$row1[id_member]>"; ?>
          	 <div id="tombol">ubah</div>
			 <?php echo "</a>"; ?>
          </td>
          <td>
          <a href="<?php echo "proses.php?proses=member_delete&id=$row1[id_member]"; ?>" onclick="return confirm('Apakah Anda akan menghapus data member ini ?')">
          <div id="tombol">hapus</div>
		  </a>
          </td>
        </tr>
        <?php $no++; }
echo"</table>";

//penomoran
$tampil2 = mysql_query("SELECT * FROM member");
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
		echo "<p align=left>Total Order : <b>$jmldata</b> order</p>";
		?>
<tr>
    <td style="color:#FFF;border:none;background-color:#333" colspan="8" align="right">Total Member :</td> 	
    </td>	
    <td id="namaField" colspan="4">&nbsp;</td>
	<?php 
	$jmldata = mysql_num_rows($qtmpil_sup);	
				echo "$jmldata[id_member]";
	?>
  </tr>
      </table>

</body>
</html>
