<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
require_once "library/fungsi_indotgl.php";
if (!isset($_POST['proses']) and ($_POST['proses']=="form1"))
	{
		$qtmpil_sup="select * from instruktur order by id_instruktur asc";
	}
	elseif (isset($_POST['proses']) and ($_POST['tcari']==""))
	{
		$qtmpil_sup="select * from instruktur order by id_instruktur asc";
	}
	else
	{
		$qtmpil_sup="SELECT * FROM instruktur WHERE nama_instruktur LIKE '%$_POST[tcari]%'";	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="style/data.css" type="text/css">

</head>
<body>
<div id="judulHalaman"><strong>Data Instruktur</strong></div>
<form id="form1" name="form1" method="post" action="index.php?halaman=instruktur">
<input name="proses" type="hidden" value="form1" />
<table border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td>Pencarian instruktur</td>
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
          <td id="namaField">ID Instruktur</td>
          <td id="namaField">Nama</td>
	  <td id="namaField">Jenis Kelamin</td>	
          <td id="namaField">Tempat, Tgl.Lahir</td>
          <td id="namaField">Alamat</td>
          <td id="namaField">Telepon</td>
          <td id="namaField">Status</td>
          <td colspan="2" id="namaField">
          <?php echo "<a href=index.php?halaman=form_data&kode=ins_insert>"; ?>
            <div id="tombol">Tambah Instruktur</div>
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
		<?php 
		$tgl_lahir= tgl_indo($row1['tanggal_lahir']);
		?>
          <tr bgcolor=<?php echo $warna; ?>>
          <td><?php echo "$row1[id_instruktur]"; ?></td>
          <td><?php echo "$row1[nama_instruktur]"; ?></td>
	  <td><?php echo "$row1[jenis_kelamin]"; ?></td>
    	  <td><?php echo "$row1[tempat_lahir], $tgl_lahir"; ?></td>
          <td><?php echo "$row1[alamat_instruktur]"; ?></td>
	  <td><?php echo "$row1[no_telepon]"; ?></td>
	  <td><?php echo "$row1[status_instruktur]"; ?></td>
          <td><?php echo "<a href=index.php?halaman=form_ubah_data&kode=update_ins&id=$row1[id_instruktur]>"; ?>
          	 <div id="tombol">ubah</div>
			 <?php echo "</a>"; ?>
          </td>
          <td>
          <a href="<?php echo "proses.php?proses=delete_ins&id=$row1[id_instruktur]"; ?>" onclick="return confirm('Apakah Anda akan menghapus data instruktur ini ?')">
          <div id="tombol">hapus</div>
		  </a>
          </td>
        </tr>
        <?php } ?>
      </table>
</body>
</html>
