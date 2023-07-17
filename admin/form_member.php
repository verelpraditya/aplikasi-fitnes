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

	$jenis1 = "NenoM0";
			$query1 = "SELECT max(id_member) as maxID FROM member WHERE id_member LIKE '$jenis1%'";
			$hasil1 = mysql_query($query1);
			$data1  = mysql_fetch_array($hasil1);
			$idMax1 = $data1['maxID'];
			$noUrut1 = (int) substr($idMax1, 5, 4);
			$noUrut1++;
			$id_member = $jenis1 . sprintf("%03s", $noUrut1);

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
        <script >
	function goToPage2(){
		PageIndex2=document.form.id_gol.selectedIndex;
		if (document.form.id_gol.options[PageIndex2].value != "none"){
			window.location = document.form.id_gol.options[PageIndex2].value;
		
		}
	}
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
<a href="registrasi.php"><div id="keluar">close</div></a>
<div class="header"><h1>Registrasi Member</h1></div>
<div class="halaman">
  <div class="tengah">
    <div class="batas_isi">
      <div class="isi">
        <table width="1155" border="0" cellpadding="0" cellspacing="1">
          <tr>
            <td><form id="formID" name="form" method="post" action="proses.php" enctype='multipart/form-data'>
               <input type="hidden" name="proses" id="" value="registrasi_insert" />
                <table width="100%" border="0">
                  <tr>
                    <td width="50%" id="noborder" ><table border="0" cellpadding="0" cellspacing="1">
                       <tr>
                        <td id="noborder"><span class="style2">No. Registrasi</span> </td>
                        <td id="noborder">:</td>
                        <td id="noborder"><span class="style4">
                            <input name="no_reg" type="hidden" value="<?php echo $newID; ?>" /><?php echo $newID; ?></span>
                            </td>
                      </tr>
		</table></td>
                    <td width="50%" id="noborder" ><table border="0" align="right" cellpadding="0" cellspacing="1">
                      <tr>
                        <td id="noborder"><span class="style2">Tgl. Registrasi</span></td>
                        <td id="noborder">:</td><td id="noborder"><input type="text" class="validate[required]" name="tgl_reg" id="datepicker" size="17" value="<?php echo date(Y)."-".date(m)."-".date(d);?>"  /></td>
                        <input type="hidden" name="username" id="username" value="<?php echo $_SESSION['username']; ?>" />
                      </tr>
                    </table></td>
                  </tr>
                </table>
                <table width="100%" border="0">
		 <tr>
		 <td><table border="0" cellspacing="0" cellpadding="0">
                        <h3>Type Member</h3>
						<tr>
                        <td id="noborder">ID Member</td>
                        <td id="noborder">:</td>
                        <td id="noborder"><label>
                          <input type="text" name="id_member" id="id_member" size="30" disabled value="<?php echo $id_member; ?>"/>
                        </label></td>
                      </tr>
                        <tr>
                          <td id="noborder">Type Member</td>
                          <td id="noborder">:</td>
                          <td id="noborder">&nbsp;<select name="id_gol" onChange="javascript:goToPage2();">
			<option value="<?=$_SERVER['PHP_SELF'];?>">--Pilih Type Member--</option>
			<?php
			$sqlp = "SELECT * FROM golongan  ORDER BY id_golongan";
			$qryp = mysql_query($sqlp, $conn)
				or die ("SQL ERROR".mysql_error());
				while ($datap = mysql_fetch_array($qryp)){
				//untuk buat nilai terpilih
				if ($datap['nama_golongan'] == $kode) {
					$cek = "selected";
				}
				else {
					$cek = "";
				}
				// kode untuk menampilkan daftar
				echo "<option value='?	
					kode=$datap[nama_golongan]' $cek>
					$datap[nama_golongan]
					</option>";
				}
			?>
			</select>
			<input name="id_golongan" type="hidden" value="<?= $kode;?>">
			</td>
			</tr>
			<?php 

				$query2 = "SELECT * FROM golongan WHERE nama_golongan='$id'";			
			$hasil2 = mysql_query($query2) or die('Query gagal');;
			$baris=mysql_fetch_array($hasil2);
			?>
            </tr>
			<tr>
                <td id="noborder">Biaya Member</td>
                <td id="noborder">:</td>
                <td id="noborder"><input type="text" name="bi_mem" id="input"  size="30" value="<?php echo digit ($baris[biaya]); ?>" />
				<input type="hidden" name="biaya_mem" id="input" readonly value="<?php echo $baris[biaya]; ?>" />
                </td>
            </tr>
			<tr>
			<td id="noborder">Kuota Kunjungan</td>
                        <td id="noborder">:</td>
                        <td id="noborder"><label>
                          <input type="text" name="kuota" id="kuota" readonly size="30" value="<?php echo $baris[kuota]; ?>"/>
                        </label></td>
			</tr>
			<tr>
			<td id="noborder">Expired</td>
                        <td id="noborder">:</td>
                        <td id="noborder"><label>
                          <input type="text" name="expired" id="expired" readonly size="30" value="<?php echo $baris[expired]?>"/> hari
                        </label></td>
			</tr>
		    <!-- <tr>
                <td id="noborder">Expire</td>
                <td id="noborder">:</td>
                <td id="noborder"><input type="text" name="tgl_tempo" size="30"  id="datepicker1" />
				</td>
            </tr> -->
        </table>                
        <table border="0" cellpadding="0" cellspacing="0">                      
                      <h3>Input Data Member</h3>
                      <tr>
                        <td id="noborder">Nama Member</td>
                        <td id="noborder">:</td>
                        <td id="noborder"><label>
                          <input type="text" name="nama_mem" id="input" size="30" class="validate[required]" />
                        </label></td>
                      </tr>
					  <tr>
					  <td id="noborder">Jenis Kelamin</td>
						<td id="noborder">:</td>
						<td id="noborder">
						<input type='radio' name='jenis_kelamin' id='jenis_kelamin' value='Laki-laki'/><b>Laki-laki</b>&nbsp;&nbsp;&nbsp;
						<input type='radio' name='jenis_kelamin' id='jenis_kelamin' value='Perempuan' /><b>Perempuan</b>
					  </td>
					  </tr>
                      <tr>
                        <td id="noborder">Alamat</td>
                        <td id="noborder">:</td>
                        <td id="noborder"><label>
                          <input type="text" name="alamat_mem" id="input" size="30" class="validate[required]" />
                        </label></td>
                      </tr>
                      <tr>
                        <td id="noborder">Tempat Lahir</td>
                        <td id="noborder">:</td>
                        <td id="noborder"><label>
                          <input type="text" name="tmp_mem" id="input" size="30" class="validate[required]" />
                        </label></td>
                      </tr>
                      <tr>
                        <td id="noborder">Tgl. Lahir</td>
                        <td id="noborder">:</td>
                        <td id="noborder"><label>
                          <input type="text" name="tgl_mem" size="30" id="datepicker2" />
                        </label></td>
                      </tr>
                      
                      <tr>
                        <td id="noborder">No. Whatsapp</td>
                        <td id="noborder">:</td>
                        <td id="noborder"><label>
                        <input type="text" name="no_tlpn" size="30" id="input"/>
                        </label></td>
                      </tr>
					  <tr>
                        <td id="noborder">Upload Foto</td>
                        <td id="noborder">:</td>
                        <td id="noborder"><label>
                          <input type="file" name="gambar" size="19"  />
                        </label></td>
                      </tr>
                      
		    </table>                      
            <table border="0" cellspacing="1" cellpadding="0">
                        <h3>Biaya Administrasi</h3>
                        <tr>
                          <td id="noborder">Biaya Administrasi</td>
                          <td id="noborder">:</td>
                          <td id="noborder"><label>
                            <input type="text" name="biaya_adm" id="input" size="25"class="validate[required]" />
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
 <div class="BatasBawah"></div>
</div>
</body>
</html>
