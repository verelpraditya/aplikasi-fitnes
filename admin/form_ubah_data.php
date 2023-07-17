<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/development-bundle/demos/demos.css">
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/development-bundle/themes/ui-lightness/jquery.ui.all.css">
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/validationEngine/css/validationEngine.jquery.css" type="text/css"/>
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/validationEngine/css/template.css" type="text/css"/>
	<script src="JQuery-UI-1.8.17.custom/validationEngine/js/jquery-1.4.4.min.js" type="text/javascript"></script>
    <script src="JQuery-UI-1.8.17.custom/validationEngine/js/jquery.validationEngine-id.js" type="text/javascript" charset="utf-8"></script>
	<script src="JQuery-UI-1.8.17.custom/validationEngine/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
    </script> 
    <script>
            jQuery(document).ready( function() {
                // binds form submission and fields to the validation engine
                jQuery("#formID").validationEngine();
            }); 
</script> 
  	<script src="JQuery-UI-1.8.17.custom/development-bundle/jquery-1.7.1.js"></script>
	<script src="JQuery-UI-1.8.17.custom/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="JQuery-UI-1.8.17.custom/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="JQuery-UI-1.8.17.custom/development-bundle/ui/datepicker.js"></script>
    <script src="JQuery-UI-1.8.17.custom/development-bundle/ui/i18n/datepicker-id.js"></script>
	<script>
	$(function() {
		$( "#datepicker" ).datepicker();
	});
	$(function() {
		$( "#datepicker1" ).datepicker();
	});
	</script>
<style type="text/css">
#formID
{
	border:none;
	margin:0px;
	padding:0px;
}
td
{
	padding:5px 9px;
	border:none;
}
#datepicker{
	padding:3px 5px;
	margin:0px 3px;
	border:1px solid #c0d3e2;
	border-radius:3px;
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
</style>
<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";

	echo "
	<form id=formUbahData name=formUbahData method=post action=proses.php enctype='multipart/form-data'>
	<input type=hidden name=proses id=proses value=$_GET[kode] />";
	if($_GET['kode']=="update_ins"){
		$pesan="SELECT * FROM instruktur WHERE id_instruktur ='$_GET[id]'";
		$query=mysql_query($pesan);
		$data=mysql_fetch_array($query);
	echo "	<div id=judulHalaman><strong>Ubah Data Instruktur</strong></div>
        <table border=0 cellspacing=2 cellpadding=0>
          <tr>
            <td>ID Instruktur</td><input name=id_inst type=hidden id=input size=30 maxlength=70  value='".$data[id_instruktur]."' />
            <td>:</td>
            <td><input name=id_ins type=text id=input size=30 maxlength=70 disabled  value='".$data[id_instruktur]."' /></td>
          </tr>
	<tr>
            <td>Nama Instruktur</td>
            <td>:</td>
            <td><label>
              <input name=nama_ins type=text id=input size=30 maxlength=70 value='".$data[nama_instruktur]."' />
            </label></td>
          </tr>	

         <tr>
            <td>Alamat Instruktur</td>
            <td>:</td>
            <td><label>
             <input name=alamat type=text id=input size=30 maxlength=90 value='".$data[alamat_instruktur]."' />
            </label></td>
          </tr>
	<tr>
            <td>Tempat Lahir</td>
            <td>:</td>
            <td><label>
              <input name=tmplahir type=text id=input size=30 maxlength=90 value='".$data[tempat_lahir]."' />
            </label></td>
          </tr>
	<tr>
            <td>Tgl. Lahir</td>
           <td>:</td>
            <td><label>
             <input name=tgl_lahir type=text id=datepicker size=18 maxlength=90 value='".$data[tanggal_lahir]."' />
           </label></td>
          </tr>
	<tr>
            <td>No. Whatsapp</td>
            <td>:</td>
            <td><label>
              <input name=tlpn type=text id=input size=30 maxlength=90 value='".$data[no_telepon]."' />
            </label></td>
          </tr>		
	<tr>
            <td>Foto</td>
            <td>:</td>
            <td><label>
              <img src='image_ins/$data[gambar]'width='100' class='gambar' > 
            </label></td>
          </tr>
	<tr>
            <td>Ubah Foto</td>
            <td>:</td>
            <td><label>
              <input name='gambar' type=file id=input size=20 maxlength=90  />
            </label></td>
          </tr>
	<tr>
            <td>Status</td>
            <td>:</td>
            <td><label>
              &nbsp;<select name=status id=input/>
		<option>aktif</option>
		<option>tidak aktif</option>
		</select>
            </label></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><label>
              <input type=submit name=simpan id=tombol value=Simpan />
            </label></td>
          </tr>
        </table>";	
	}
	elseif($_GET['kode']=="member_update"){
		$pesan="SELECT * FROM member WHERE id_member='$_GET[id]'";
		$query=mysql_query($pesan);
		$data=mysql_fetch_array($query);
	echo "	<div id=judulHalaman><strong>Ubah Data Member</strong></div>
        <table border=0 cellspacing=2 cellpadding=0>
          <tr>
            <td >ID Member<input type=hidden name=idmem id=inc value=$data[id_member] /></td>
            <td>:</td>
            <td><input name=memid type=text id=input size=30 maxlength=70 disabled value='".$data[id_member]."' /></td>
          </tr>
		<tr>
            <td>Nama</td>
            <td>:</td>
            <td><label>
              <input name=nama_mem type=text id=input size=30 maxlength=70 value='".$data[nama]."' />
            </label></td>
        </tr>
		<tr>
            <td>Alamat</td>
            <td>:</td>
            <td><label>
              <input name=alamat type=text id=input size=30 maxlength=90 value='".$data[alamat]."' />
            </label></td>
        </tr>
        <tr>
            <td>Tempat Lahir</td>
            <td>:</td>
            <td><label>
              <input name=tmplahir type=text id=input size=30 maxlength=90 value='".$data[tempat_lahir]."' />
            </label></td>
        </tr>
		<tr>
            <td>Tgl. Lahir</td>
           <td>:</td>
            <td><label>
             <input name=tgl_lahir type=text id=datepicker size=18 maxlength=90 value='".$data[tanggal_lahir]."' />
           </label></td>
        </tr>	
		<tr>
            <td>Telepon</td>
            <td>:</td>
           <td><label>
              <input name=tlpn type=text id=input size=30 maxlength=90 value='".$data[no_telepon]."' />
            </label></td>
        </tr>
		<tr>
            <td>Foto</td>
            <td>:</td>
            <td><label>
              <img src='image_mem/$data[gambar]'width='100' class='gambar' > 
            </label></td>
          </tr>
		<tr>
            <td>Ubah Foto</td>
            <td>:</td>
            <td><label>
              <input name='gambar' type=file id=input  size=20 />
            </label></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><label>
             <input type=submit name=simpan id=tombol value=Simpan />
            </label></td>
        </tr>
        </table>";
	}
	elseif($_GET['kode']=="gol_update"){
		$pesan="SELECT * FROM golongan WHERE id_golongan='$_GET[id]'";
		$query=mysql_query($pesan);
		$data=mysql_fetch_array($query);
	echo "	<div id=judulHalaman><strong>Ubah Jenis Member </strong></div>
        <table border=0 cellspacing=2 cellpadding=0>
          <tr>
            <td >Kode</td><input name=id_gol type=hidden id=input size=30 maxlength=70  value='".$data[id_golongan]."' />
            <td>:</td>
            <td><input name=id_golongan type=text id=input size=30 maxlength=70 disabled value='".$data[id_golongan]."' /></td>
          </tr>
	<tr>
            <td>Jenis Member</td>
            <td>:</td>
            <td><label>
              <input name=nama_gol type=text id=input size=30 maxlength=70 value='".$data[nama_golongan]."' />
            </label></td>
          </tr>
          <tr>
            <td>Biaya</td>
            <td>:</td>
            <td><label>
              <input name=biaya type=text id=input size=30 maxlength=90 value='".$data[biaya]."' />
            </label></td>
          </tr>
          <tr>
            <td>Kuota</td>
            <td>:</td>
            <td><label>
              <input name=kuota type=text id=input size=30 maxlength=90 value='".$data[kuota]."' />
            </label></td>
          </tr>
          <tr>
            <td>Expired</td>
            <td>:</td>
            <td><label>
              <input name=expired type=text id=input size=30 maxlength=90 value='".$data[expired]."' />hari
            </label></td>
          </tr>
	    <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><label>
             <input type=submit name=simpan id=tombol value=Simpan />
            </label></td>
          </tr>
        </table>";	
	}else{  
	$pesan="SELECT * FROM guest WHERE inc='$_GET[id]'";
		$query=mysql_query($pesan);
		$data=mysql_fetch_array($query);
	echo "	<div id=judulHalaman><strong>Ubah Data Pengunjung </strong></div>
        <table border=0 cellspacing=2 cellpadding=0>
          <tr>
            <td >Nama Pengunjung <input type=hidden name=inc id=inc value=$data[inc] /></td>
            <td>:</td>
            <td><input name=nama type=text id=input size=35 maxlength=70 value='".$data[nama]."' /></td>
          </tr>
          <tr>
            <td>Ruang/Room</td>
            <td>:</td>
            <td><label>
              <input name=room type=text id=input size=35 maxlength=70 value='".$data[room]."' />
            </label></td>
          </tr>
		<tr>
          <tr>
            <td>Alamat Pengunjung</td>
            <td>:</td>
            <td><label>
              <input name=alamat type=text id=input size=35 maxlength=100 value='".$data[alamat]."' />
            </label></td>
          </tr>
          <tr>
            <td>No. Hp/BBM</td>
            <td>:</td>
            <td><label>
              <input name=hp type=text id=input size=35 maxlength=70 value='".$data[telepon]."' />
            </label></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><label>
              <input type=submit name=SimpanPel id=tombol value=Simpan />
            </label>
              <label>
                <input type=reset name=BatalPel id=tombol value=Batal />
              </label></td>
          </tr>
        </table>";
	}
	echo "</form>";
?>
