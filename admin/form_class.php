<?php
session_start();
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
if(isset($_POST['kode'])){
	$kode = $_POST['kode'];
}else{
	$kode = $_REQUEST['kode'];
}
$id = $_GET["kode"];
$query2 = "SELECT DISTINCT(id_golongan) FROM golongan";
$hasil2 = mysql_query($query2);

	$jenis = "REG-0";
	$query = "SELECT max(no_registrasi) as maxID FROM registrasi WHERE no_registrasi LIKE '$jenis%'";
	$hasil = mysql_query($query);
	$data  = mysql_fetch_array($hasil);
	$idMax = $data['maxID'];
	$noUrut = (int) substr($idMax, 4, 4);
	$noUrut++;
	$newID = $jenis . sprintf("%03s", $noUrut);

	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Registrasi Member</title>
<link rel="stylesheet" href="style/style_form_transaksi.css" type="text/css"  />
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/development-bundle/themes/ui-lightness/jquery.ui.all.css">
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/development-bundle/demos/demos.css">
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/validationEngine/css/validationEngine.jquery.css" type="text/css"/>
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/validationEngine/css/template.css" type="text/css"/>
	<script src="JQuery-UI-1.8.17.custom/validationEngine/js/jquery-1.4.4.min.js" type="text/javascript"></script>
	<script src="JQuery-UI-1.8.17.custom/validationEngine/js/jquery.validationEngine-id.js" type="text/javascript" charset="utf-8"></script>
	<script src="JQuery-UI-1.8.17.custom/validationEngine/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script> 
	<script src="JQuery-UI-1.8.17.custom/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="JQuery-UI-1.8.17.custom/development-bundle/ui/jquery.ui.widget.js"></script>
   	<script src="JQuery-UI-1.8.17.custom/development-bundle/ui/datepicker.js"></script>
    	<script src="JQuery-UI-1.8.17.custom/development-bundle/ui/i18n/datepicker-id.js"></script>
	<script>
	jQuery(document).ready( function() {
                // binds form submission and fields to the validation engine
                jQuery("#formID").validationEngine();

            });
		$(function() {
				$( "#datepicker" ).datepicker();
				});
				$(function() {
					$( "#datepicker1" ).datepicker();
				});
				$(function() {
					$( "#datepicker2" ).datepicker();
				});
	</script>
        
<style type="text/css">
#formID
{
	border:none;
	margin:0px;
	padding:0px;
}
#formID1
{
	border:none;
	margin:0px;
	padding:0px;
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
body {
	color:#315567;
	background-color:#e9e9e9;
	font-size:11px;
	font-family:Verdana, Geneva, sans-serif;
}
#datepicker{
	padding:3px 5px;
	margin:0px 3px;
	border:1px solid #c0d3e2;
	border-radius:3px;
}
#datepicker1{
	padding:3px 5px;
	margin:0px 3px;
	border:1px solid #c0d3e2;
	border-radius:3px;
}
#datepicker2{
	padding:3px 5px;
	margin:0px 3px;
	border:1px solid #c0d3e2;
	border-radius:3px;
}
#noborder
{
	border:none;
}
#Layer1 {
	position:absolute;
	width:200px;
	height:115px;
	z-index:1;
	left: 285px;
	top: 138px;
}
.style2 {
	font-size: 1.5em;
	font-weight: bold;
}
.style4 {font-size: 1.5em}
</style>
</head>

<body>
<div id="page"> 
<a href="class_member.php"><div id="keluar">close</div></a>
<div class="header"><h1>Class Member</h1></div>
<div class="halaman">
  <div class="tengah">
    <div class="batas_isi">
      <div class="isi">
        <table width="1155" border="0" cellpadding="0" cellspacing="1">
            <td><form id="formID" name="form" method="post" action="proses.php" enctype='multipart/form-data'>
              <input type="hidden" name="proses" id="" value="class_insert" />
              <table width="100%" border="0">
                <tr>
                <td><table border="0" cellspacing="0" cellpadding="0">
                  <h3>Input ID Member</h3>
                  <tr>
                    <td id="noborder"><input type="text" name="inputString" size="30"  id="input" class="validate[required]" />
                      </td>
                    </tr>
                  </table>
                  <table border="0" cellpadding="0" cellspacing="0">                      
                    <h3>Pilih Class Yang Di Ikuti </h3>
                    <tr>
                      <td id="noborder"><p>
                        <input type='radio' name='jenis_class' id='jenis_class' value='AEROBIC MIC'/>
                        <b>AEROBIC MIC</b>&nbsp;</p>
                        <p>
                          <input type='radio' name='jenis_class' id='jenis_class' value='BODY PRESS' />
                          <b>BODY PRESS</b></p>
                        <p>
                          <input type='radio' name='jenis_class' id='jenis_class' value="KICK'N PUNCH"/>
                          <b>KICK'N PUNCH</b>&nbsp;</p>
                        <p>
                          <input type='radio' name='jenis_class' id='jenis_class' value='WEIGHT TRAINING'/>
                          <b>WEIGHT TRAINING</b></p>
                        <p>
                          <input type='radio' name='jenis_class' id='jenis_class' value='AZURRA'/>
                          <b>AZURRA</b></p>
                        <p>
                          <input type='radio' name='jenis_class' id='jenis_class' value='Laki-laki'/>
                          <b>LATIN DANCE</b></p></td>
                      <td width="146" id="noborder"><p>
                        <input type='radio' name='jenis_class' id='jenis_class' value='Perempuan' />
                          <b>CORE X</b></p>
                        <p>
                          <input type='radio' name='jenis_class' id='jenis_class' value='Perempuan' />
                          <b>YOGA</b></p>
                        <p>
                          <input type='radio' name='jenis_class' id='jenis_class' value='Perempuan' />
                          <b>HIP HOP</b></p>
                        <p>
                          <input type='radio' name='jenis_class' id='jenis_class' value='Perempuan' />
                          <b>AQUAROBIC</b></p>
                        <p>
                          <input type='radio' name='jenis_class' id='jenis_class' value='Perempuan' />
                          <b>FITT BALL</b></p>
                        <p>
                          <input type='radio' name='jenis_class' id='jenis_class' value='Perempuan' />
                          <b>KIDS EXERCISE</b></p></td>
                      </tr>
                  </table>                      
                  <table border="0" cellspacing="1" cellpadding="0">
                    <h3></h3>
                    <tr>                       
                      <td id="noborder"><input type="submit" name="simpan" id="tombol" value="Simpan" />
                        <input type="reset" name="batal" id="tombol" value="batal" />
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                </table>
            </form></td>
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
