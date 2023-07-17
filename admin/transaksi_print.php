<?php
session_start();
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
<title>Transaksi Rinci</title>
<link rel="stylesheet" href="style/style_index.css" type="text/css">
<style type="text/css">
#noBorder
{
	border:none;	
}
table
{
	margin:5px 9px;
}
td
{
	padding:5px 9px;
	border:1px solid #c0d3e2;
}
#namaField{
	color:#FFF;
	background-color:#333;
	text-align:center;
	padding-top:7px;
	border:none;
}
</style>
</head>
<script language="Javascript1.2">
  window.print();
</script>
<body>
<?php
	$param="SELECT * FROM pembayaran WHERE no_transaksi='$_GET[id]'";
	$qparam=mysql_query($param);
	$dparam=mysql_fetch_array($qparam);
?>
<table width="608" border="0" cellpadding="0" cellspacing="1">
  <tr>
    <td colspan="7" id="noBorder"><div align="center">
      <p><strong><u>NOTA TRANSAKSI </u></strong></p>
    </div></td>
  </tr>
  <tr>
    <td width="127" id="noBorder">No.Transaksi</td>
    <td width="23" id="noBorder">:</td>
    <td width="99" id="noBorder"><?php echo $dparam['no_transaksi']; ?></td>
    <td width="76" id="noBorder">&nbsp;</td>
    <td width="155" id="noBorder">ID Member</td>
    <td width="23" id="noBorder">:</td>
    <td width="97" id="noBorder"><?php echo $dparam['id_member']; ?></td>
  </tr>
  <tr>
    <td id="noBorder">Nama Member</td>
    <td id="noBorder">:</td>
    <td id="noBorder"><?php echo $dparam['nama']; ?></td>
    <td id="noBorder">&nbsp;</td>
    <td id="noBorder">Jenis Member</td>
    <td id="noBorder">:</td>
    <td id="noBorder"><?php echo $dparam['nama_golongan']; ?></td>
  </tr>
  <tr>
    <td id="noBorder"><u></u></td>
    <td id="noBorder"><u></u></td>
    <td id="noBorder"><u></u></td>
    <td id="noBorder"><u></u></td>
    <td id="noBorder"><u></u></td>
    <td id="noBorder"><u></u></td>
    <td id="noBorder"><u></u></td>
  </tr>
</table>
<table width="606" cellpadding="0" cellspacing="0">
  <tr>
  	<td width="74" id="noBorder"><div align="center"><u>No</u></div></td>
    <td width="197" id="noBorder"><div align="center"><u>Tanggal Transaksi</u></div></td>
    <td width="138" id="noBorder"><div align="center"><u>Jumlah Bayar</u></div></td>
  </tr>
	 
<?php
  	$sql="SELECT * FROM pembayaran WHERE no_transaksi='$_GET[id]' ORDER BY no_transaksi ASC";
	$query=mysql_query($sql);
	$no=1;
	while($data=mysql_fetch_array($query))
	{
		if ($warna==$warna1){
				$warna=$warna2;
			}
			else{
				$warna=$warna1;
			}
	$tgl_trans= tgl_indo($data['tanggal_pembayaran']);
  ?>
  <tr>
  	<td id="noBorder"><div align="center"><?php echo $no; ?></div></td>
    <td id="noBorder"><div align="center"><?php echo $tgl_trans; ?></div></td>
    <td align="center" id="noBorder"><div align="center"><?php echo digit($data['total_bayar']); ?></div></td>
  </tr>
  <?php $no++; } ?>
</table>
<p>&nbsp;</p>
<table width="608" border="0">
  <tr>
    <td width="253" id="noBorder"><div align="center">Penerima</div></td>
    <td width="339" id="noBorder"><div align="center">Neno Fitness Center </div></td>
  </tr>
  <tr>
    <td id="noBorder"> <p>&nbsp;</p>
    <p align="center">&nbsp;</p>
    <p align="center">(___________________) </p></td>
    <td id="noBorder"><p>&nbsp;</p>
      <p align="center">&nbsp;</p>
      <p align="center">(______________________)</p></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>

