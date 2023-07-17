<?php
if ($_SESSION['level'] == "admin")
	{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
td
{
	padding:5px 9px;
	border:none;
}
</style>
</head>

<body>
<?php
	$akun="SELECT * FROM account WHERE username='$_GET[id]'";
	$qakun=mysql_query($akun);
	$dakun=mysql_fetch_array($qakun);
?>
<div id="judulHalaman"><strong>Form ubah akun</strong></div>
<form id="form1" name="form1" method="post" action="proses.php">
<input name="proses" type="hidden" value="ubah_akun" />
<table border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td>username</td>
    <td>:</td>
    <td><input name="username" type="hidden" value="<?php echo $dakun['username']; ?>" />
      <input type="text" disabled="disabled" name="user" id="input" value="<?php echo $dakun['username']; ?>" />
    </td>
  </tr>
  <tr>
    <td>password</td>
    <td>:</td>
    <td><label>
      <input type="text" disabled="disabled" name="password" id="input" value="<?php echo $dakun['password']; ?>" />
    </label></td>
  </tr>
  <tr>
    <td>nama</td>
    <td>:</td>
    <td><label>
      <input type="text" name="nama" id="input" value="<?php echo $dakun['nama']; ?>" />
    </label></td>
  </tr>
  <tr>
    <td>level</td>
    <td>:</td>
    <td><label>
      <select name="level" id="input">
        <option>admin</option>
        <option>user</option>
      </select>
    </label></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>
      <input type="submit" name="simpan" id="tombol" value="simpan" />
      
    </td>
  </tr>
</table>
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
	}
	else
	{
		echo "anda tidak berhak meng-akses halaman ini !";
	}
?>
