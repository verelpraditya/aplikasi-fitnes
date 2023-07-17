<?php
session_start();
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
if (isset($_POST['run'])and($_POST['run']=="form2"))
{
	$bcode=$_POST['barcode'];	
	$cekmember="SELECT * FROM member WHERE id_member='$bcode'";
	$qcekmember=mysql_query($cekmember);
	$dcekmember=mysql_fetch_array($qcekmember);
	$status=$dcekmember['status'];
	if ($status=='tidak aktif')
	{
		echo "
			<script type=text/javascript>";
			echo "alert('Qty yang diambil melebihi stok')";
			echo "</script>";
	}else{
	}
}		
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Member Check In-Out</title>
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
<a href="index.php?halaman=instruktur"><div id="keluar">close</div></a>
<div class="header"><h1>Member Check In-Out</h1></div>

<div class="halaman">
  <div>
    <div class="batas_isi">
      <div class="isi">
        <table width="1155" border="0" cellpadding="0" cellspacing="1">
          <tr>
	  <form id="formID" name="formabsen" method="post" action="action.php?act=absen" onSubmit="return validate(this, Array('NIK'));">
        	<input name="run" type="hidden" value="form2" />
        	<table border="0" cellspacing="1" cellpadding="0">
	 	</tr>
		<tr>
                <td width="229" id="noborder"><div align="center"><span class="style2">ID Member</span> </div></td>
                </tr>
          	<tr>
		<tr>
		<td id="noborder">
		<input type="text" name="barcode" id="idbarcode" size=25 maxlength=25 tabindex=2 value=""></td>
		</tr>
        </table>
    	
                </form></td>
            </tr>
        </table>
      </div>
    </div>
  </div>
</div>
</div>
</body>
</html>

