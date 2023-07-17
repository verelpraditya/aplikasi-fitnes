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
$query2 = "SELECT DISTINCT(no_registrasi) FROM registrasi";
$hasil2 = mysql_query($query2);

	$jenis = "Pmb.0";
	$query = "SELECT max(no_transaksi) as maxID FROM pembayaran WHERE no_transaksi LIKE '$jenis%'";
	$hasil = mysql_query($query);
	$data  = mysql_fetch_array($hasil);
	$idMax = $data['maxID'];
	$noUrut = (int) substr($idMax, 4, 4);
	$noUrut++;
	$newID = $jenis . sprintf("%03s", $noUrut);
				$no_reg=$_POST['no_reg'];
				$pel1="SELECT * FROM registrasi where no_registrasi='$no_reg' ORDER BY no_registrasi ASC";
				$qpel1=mysql_query($pel1);
				$dtpel1=mysql_fetch_array($qpel1);
				
				
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pembayaran Member</title>
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
	<script type="text/javascript">
	function goToPage2(){
		PageIndex2=document.form.no_reg.selectedIndex;
		if (document.form.no_reg.options[PageIndex2].value != "none"){
			window.location = document.form.no_reg.options[PageIndex2].value;
		
		}
	}

</script>
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
<a href="index.php?halaman=pembayaran"><div id="keluar">close</div></a>
<div class="header"><h1>Pembayaran Member</h1></div>
<div class="halaman">
  <div class="tengah">
    <div class="batas_isi">
      <div class="isi">
        <table width="1155" border="0" cellpadding="0" cellspacing="1">
          <tr>
            <td><form id="formID" name="form" method="post" action="proses.php">
               <input type="hidden" name="proses" id="" value="pembayaran_insert" />
                <table width="100%" border="0">
                  <tr>
                    <td width="50%" id="noborder" ><table border="0" cellpadding="0" cellspacing="1">
                       <tr>
                        <td id="noborder"><span class="style2">No. Transaksi</span> </td>
                        <td id="noborder">:</td>
                        <td id="noborder"><span class="style4">
                            <input name="no_trans" type="hidden" value="<?php echo $newID; ?>" /><?php echo $newID; ?></span>
                            </td>
                      </tr>
			<tr>
			<td id="noborder"><span class="style2">No. Registrasi</td>
			 <td id="noborder">:</td>
			
			<td id="noborder"><select name="no_reg" onChange="javascript:goToPage2();">
			<option value="<?=$_SERVER['PHP_SELF'];?>">--Pilih No Registrasi--</option>
			<?php
			$sqlp = "SELECT * FROM registrasi  ORDER BY no_registrasi";
			$qryp = mysql_query($sqlp, $conn)
				or die ("SQL ERROR".mysql_error());
				while ($datap = mysql_fetch_array($qryp)){
				//untuk buat nilai terpilih
				if ($datap['no_registrasi'] == $kode) {
					$cek = "selected";
				}
				else {
					$cek = "";
				}
				// kode untuk menampilkan daftar
				echo "<option value='?	
					kode=$datap[no_registrasi]' $cek>
					$datap[no_registrasi]
					</option>";
				}
			?>
			</select>
			<input name="no_regist" type="hidden" value="<?= $kode;?>">
			</td>
			</tr>
			<?php 

				$query2 = "SELECT * FROM registrasi WHERE no_registrasi='$id'";
			
			$hasil2 = mysql_query($query2) or die('Query gagal');;
			$baris=mysql_fetch_array($hasil2);
		?>
		</table></td>
                    <td width="50%" id="noborder" ><table border="0" align="right" cellpadding="0" cellspacing="1">
                      <tr>
                        <td id="noborder"><span class="style2">Tgl. Transaksi</span></td>
                        <td id="noborder">:</td><td id="noborder"><input type="text" name="tgl_trans" id="datepicker2" size="17" value="<?php echo date(d)."-".date(m)."-".date(Y);?>" /></td>
                        <input type="hidden" name="username" id="username" value="<?php echo $_SESSION['username']; ?>" />
                      </tr>
                    </table></td>
                  </tr>
                </table>
                <table width="100%" border="0">
                  <tr>
                    <td><table border="0" cellpadding="0" cellspacing="1">
		    
                      <tr>
                        <td id="noborder">ID Member</td>
                        <td id="noborder">:</td>
                        <td id="noborder"><input type="text" name="id_mem" id="input"  value="<?php echo $baris[id_member]; ?>" />
                        </td>
                      </tr>
                      <tr>
                        <td id="noborder">Tanggal Pendaftaran</td>
                        <td id="noborder">:</td>
                        <td id="noborder"><label>
                          <input type="text" name="tgl_pend" id="datepicker"  value="<?php echo $baris[tanggal_pendaftaran]; ?>" />
                        </label></td>
                      </tr>
                      <tr>
                        <td id="noborder">Biaya Pendaftaran</td>
                        <td id="noborder">:</td>
                        <td id="noborder"><label>
                          <input type="text" name="alamat_mem" id="input" value="<?php echo digit($baris['biaya_pendaftaran']); ?>" />
                        </label></td>
                      </tr>
                     <tr>
                          <td id="noborder">Jenis Member</td>
                          <td id="noborder">:</td>
                          <td id="noborder">&nbsp<select name="id_gol" id="select2" for >
                              <option>--Pilih Jenis Golongan Member--</option>
                              <?php
				$pel="SELECT * FROM golongan ORDER BY id_golongan ASC";
				$qpel=mysql_query($pel);
				while ($dtpel=mysql_fetch_array($qpel)){
				echo "<option value='".$dtpel[0]."'>Kategori ".$dtpel[1]." Biaya ".$dtpel[2]." </option>";
				}
				?>
                          </select></td>
                        </tr>
                      <tr>
                        <td id="noborder">Nama Golongan</td>
                        <td id="noborder">:</td>
                        <td id="noborder"><label>
                          <input type="text" name="nama_gol" id="input" />
                        </label></td>
                      </tr>
                      <tr>
                        <td id="noborder">Pembayaran</td>
                        <td id="noborder">:</td>
                        <td id="noborder"><label>
                          <input type="text" name="biaya_pem" id="input" />
                        </label></td>
                      </tr>
		    </table>
			<table border="0" cellspacing="1" cellpadding="0">
                        <h4>__________________________________</h4>
                      <tr>
                        <td id="noborder">Tanggal Jatuh Tempo</td>
                        <td id="noborder">:</td>
                        <td id="noborder"><label>
                          <input type="text" name="tgl_tempo" id="datepicker1" />
                        </label></td>
                        <tr>
                          <td id="noborder">Masa Member</td>
                          <td id="noborder">:</td>
                          <td id="noborder"><label>
                            <input type="text" name="masa_mem" id="input"  />
                          </label></td>
                        </tr>
                      </table>                      
                      <table border="0" cellspacing="1" cellpadding="0">
			<h3></h3>
                        <tr>                       
                          <td id="noborder"><input type="submit" name="simpan" id="tombol" value="simpan" />
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
</div>
</body>
</html>
