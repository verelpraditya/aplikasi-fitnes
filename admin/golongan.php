<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
if (!isset($_POST['proses']) and ($_POST['proses']=="form1"))
	{
		$qtmpil_sup="select * from golongan order by id_golongan asc";
	}
	elseif (isset($_POST['proses']) and ($_POST['tcari']==""))
	{
		$qtmpil_sup="select * from golongan order by id_golongan asc";
	}
	else
	{
		$qtmpil_sup="SELECT * FROM golongan WHERE nama_golongan LIKE '%$_POST[tcari]%'";	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Neno Fitness Center</title>
<link rel="stylesheet" href="style/data.css" type="text/css">

</head>
<body>
<div id="judulHalaman"><strong>Data Type Member</strong></div>
<form id="form1" name="form1" method="post" action="index.php?halaman=golongan">
<input name="proses" type="hidden" value="form1" />
<table border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td>Pencarian Type Member</td>
  </tr>
  <tr>
    <td><input name="tcari" id="input" type="text" size="25" /><input name="bcari" id="tombol" type="submit" value="cari" /></td>
  </tr>
</table>

</form>
 <?php
	$warna1="#c0d3e2";
	$warna2="#cfdde7";
	$warna=$warna1;
 ?> 
      <table cellpadding="0" cellspacing="1">
        <tr>
          <td id="namaField">Kode </td>
          <td id="namaField">Type Member</td>
          <td id="namaField">Biaya</td>
          <td colspan="2" id="namaField">
          <?php echo "<a href=index.php?halaman=form_data&kode=gol_insert>"; ?>
            <div id="tombol">Tambah Type Member</div>
          <?php echo "</a>"; ?>
          </td>
        </tr>
        <?php 
		$qp_sup=mysql_query($qtmpil_sup);
		
		while($row1=mysql_fetch_array($qp_sup)){
			if ($warna==$warna1){
				$warna=$warna2;
			}
			else{
				$warna=$warna1;
			}
		?>
           <tr bgcolor=<?php echo $warna; ?>>
          <td><?php echo "$row1[id_golongan]"; ?></td>
          <td><?php echo "$row1[nama_golongan]"; ?></td>
    	  <td align="right"><?php echo "Rp "; echo digit($row1['biaya']); ?></td>
          <td><?php echo "<a href=index.php?halaman=form_ubah_data&kode=gol_update&id=$row1[id_golongan]>"; ?>
          	 <div id="tombol">ubah</div>
			 <?php echo "</a>"; ?>
          </td>
          <td>
          <a href="<?php echo "proses.php?proses=gol_delete&id=$row1[id_golongan]"; ?>" onclick="return confirm('Apakah Anda akan menghapus data golongan ini ?')">
          <div id="tombol">hapus</div>
		  </a>
          </td>
        </tr>
        <?php } ?>
      </table>
</body>
</html>
