<?php
if ($_SESSION['level'] == "admin")
	{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Neno Fitness Center</title>
</head>

<body>
<div id="judulHalaman"><strong>Data User</strong></div>

<table border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td id="namaField">username</td>
    <td id="namaField">nama</td>
    <td id="namaField">level</td>
    <td colspan="2" id="namaField">
    <?php echo "<a href=index.php?halaman=form_akun>"; ?>
    <div id="tombol">tambah user</div>
    <?php echo "</a>"; ?>
    </td>
  </tr>
  <?php
  $warna1="#c0d3e2";
	$warna2="#cfdde7";
	$warna=$warna1;
  	$akun="SELECT * FROM account";
	$qakun=mysql_query($akun);
  while($dakun=mysql_fetch_array($qakun))
  {
	  if ($warna==$warna1){
				$warna=$warna2;
			}
			else{
				$warna=$warna1;
			}
	  echo "
  <tr bgcolor=$warna>
    <td>$dakun[username]</td>
    <td>$dakun[nama]</td>
    <td>$dakun[level]</td>
    <td><a href=index.php?halaman=form_ubah_akun&id=$dakun[username]>";?><div id="tombol">ubah</div><?php echo "</a>
	</td>
	<td>";
	?>
	<a href="<?php echo "proses.php?proses=hapus_akun&id=$dakun[username]"; ?>" 
		onclick="return confirm('Apakah Anda akan menghapus data akun ini ?')"><div id="tombol">hapus</div></a>
	<?php 
	echo "
    </td>
  </tr>";
  }
  ?>
</table>
</body>
</html>
<?php
	}
	else
	{
		echo "anda tidak berhak meng-akses halaman ini !";
	}
?>
