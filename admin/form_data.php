<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/development-bundle/demos/demos.css">
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/development-bundle/themes/ui-lightness/jquery.ui.all.css">
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/validationEngine/css/validationEngine.jquery.css" type="text/css"/>
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/validationEngine/css/template.css" type="text/css"/>
	<script src="JQuery-UI-1.8.17.custom/validationEngine/js/jquery-1.4.4.min.js" type="text/javascript"></script>
	<script src="JQuery-UI-1.8.17.custom/validationEngine/js/jquery.validationEngine-id.js" type="text/javascript" charset="utf-8"></script>
	<script src="JQuery-UI-1.8.17.custom/validationEngine/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
    </script> 
	<script src="JQuery-UI-1.8.17.custom/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="JQuery-UI-1.8.17.custom/development-bundle/ui/jquery.ui.widget.js"></script>
   	<script src="JQuery-UI-1.8.17.custom/development-bundle/ui/datepicker.js"></script>
    	<script src="JQuery-UI-1.8.17.custom/development-bundle/ui/i18n/datepicker-id.js"></script>
        <script>
            jQuery(document).ready( function() {
                // binds form submission and fields to the validation engine
                jQuery("#formID").validationEngine();
            });
			///
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
#namaField{
	color:#FFF;
	background-color:#333;
	text-align:center;
	padding-top:7px;
	border:none;
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
	<form id=formID name=formInput method=post action=proses.php enctype='multipart/form-data' >
	  <input type=hidden name=proses id=proses value=$_GET[kode] />";
//form data instruktur
	if ($_GET['kode']=="ins_insert"){
	$jenis = "Ins.0";
	$query = "SELECT max(id_instruktur) as maxID FROM instruktur WHERE id_instruktur LIKE '$jenis%'";
	$hasil = mysql_query($query);
	$data  = mysql_fetch_array($hasil);
	$idMax = $data['maxID'];
	$noUrut = (int) substr($idMax, 4, 4);
	$noUrut++;
	$newID = $jenis . sprintf("%03s", $noUrut);
		//pemanggilan fungsi penambahan
		//$a="SELECT * FROM instruktur";
		//$b="SELECT inc FROM instruktur ORDER BY inc DESC LIMIT 1";
		//$inc=penambahan($a, $b);
	echo "	<div id=judulHalaman><strong>Input Data Instruktur</strong></div>
        <table border=0 cellspacing=2 cellpadding=0>
          <tr>
            <td>ID Instruktur</td>
            <td>:</td>
            <td><input name=id_ins type=text id=input class=validate[required] value='$newID' size=30 maxlength=70 /></td>
          </tr>
	   <tr>
            <td>Nama Instruktur</td>
            <td>:</td>
            <td><label>
              <input name=nama_ins type=text id=input class=validate[required] size=30 maxlength=70 />
            </label></td>
          </tr>
	<tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>
              <input type='radio' name='jenis_kelamin' id='jenis_kelamin' value='Laki-laki'/><b>Laki-laki</b>&nbsp;&nbsp;&nbsp;
                <input type='radio' name='jenis_kelamin' id='jenis_kelamin' value='Perempuan' /><b>Perempuan</b>
	    </td>
          </tr>
 	<tr>
            <td>Alamat Instruktur</td>
            <td>:</td>
            <td><label>
              <input name=alamat type=text id=input class=validate[required] size=30 maxlength=70 />
            </label></td>
          </tr>
	<tr>
            <td>Tempat Lahir</td>
            <td>:</td>
            <td><label>
              <input name=tmplahir type=text id=input class=validate[required] size=30 maxlength=70 />
            </label></td>
          </tr>
	<tr>
            <td>Tgl. Lahir</td>
            <td>:</td>
            <td><label>
            <input name=tgl_lahir type=text id=datepicker size=18  maxlength=70 />
            </label></td>
          </tr>
	
	<tr>
            <td>Telepon</td>
            <td>:</td>
            <td><label>
              <input name=tlpn type=text id=input  size=30 maxlength=70 />
            </label></td>
          </tr>
	<tr>
            <td>Foto</td>
            <td>:</td>
            <td><label>
              <input name='gambar' type=file id=input  size=20 />
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
              <input type=submit name=SimpanBar id=tombol value=Simpan />
            </label>
              <label>
                <input type=reset name=BatalBar id=tombol value=Batal />
              </label></td>
          </tr>
        </table>";
	}
//form data member
	elseif($_GET['kode']=="member_insert"){
	$jenis = "Mem.Ft.";
	$query = "SELECT max(member_id) as maxID FROM member WHERE member_id LIKE '$jenis%'";
	$hasil = mysql_query($query);
	$data  = mysql_fetch_array($hasil);
	$idMax = $data['maxID'];
	$noUrut = (int) substr($idMax, 7, 3);
	$noUrut++;
	$newID = $jenis . sprintf("%03s", $noUrut);

		
		//pemanggilan fungsi penambahan
		//$a="SELECT * FROM member";
		//$b="SELECT inc FROM member ORDER BY inc DESC LIMIT 1";
		//$inc=penambahan($a, $b);
    echo "    
        <div id=judulHalaman><strong>Input Data Anggota</strong></div>
        <table border=0 cellspacing=2 cellpadding=0>
          <tr>
            <td>ID Anggota</td>
            <td>:</td>
            <td><input name=memid type=text id=input class=validate[required] value='$newID' size=30 maxlength=70 /></td>
          </tr>
	   <tr>
            <td>Nama </td>
            <td>:</td>
            <td><label>
              <input name=nama type=text id=input class=validate[required] size=30 maxlength=70 />
            </label></td>
          </tr>
	<tr>
            <td>Tempat Lahir</td>
            <td>:</td>
            <td><label>
              <input name=tmplahir type=text id=input class=validate[required] size=30 maxlength=70 />
            </label></td>
          </tr>
	<tr>
            <td>Tgl. Lahir</td>
            <td>:</td>
            <td><label>
              &nbsp<input name=tgl_lahir type=text id=datepicker size=18  maxlength=70 />
            </label></td>
          </tr>
	<tr>
            <td>Alamat</td>
            <td>:</td>
            <td><label>
              <input name=alamat type=text id=input  size=30 maxlength=70 />
            </label></td>
          </tr>
	<tr>
            <td>Telepon</td>
            <td>:</td>
            <td><label>
              <input name=tlpn type=text id=input  size=30 maxlength=70 />
            </label></td>
          </tr>
	<tr>
            <td>No.Hp</td>
            <td>:</td>
            <td><label>
              <input name=hp type=text id=input  size=30 maxlength=70 />

            </label></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><label>
              <input type=submit name=SimpanBar id=tombol value=Simpan />
            </label>
              <label>
                <input type=reset name=BatalBar id=tombol value=Batal />

              </label></td>
          </tr>
        </table>";

}
//tambah nonmember
elseif($_GET['kode']=="nonmember_insert"){
				
    echo "    
        <div id=judulHalaman><strong>Input Data NonMember</strong></div>
        <table border=0 cellspacing=2 cellpadding=0>
          <tr>
            <td>No Identitas</td>
            <td>:</td>
            <td><input name=no_iden type=text id=input class=validate[required]  size=30 maxlength=70 /></td>
          </tr>
	   <tr>
            <td>Nama </td>
            <td>:</td>
            <td><label>
              <input name=nama type=text id=input class=validate[required] size=30 maxlength=70 />
            </label></td>
          </tr>
	<tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>
              <input type='radio' name='jenis_kel' id='jenis_kelamin' value='Laki-laki'/><b>Laki-laki</b>&nbsp;&nbsp;&nbsp;
                <input type='radio' name='jenis_kel' id='jenis_kelamin' value='Perempuan' /><b>Perempuan</b>
	    </td>
          </tr>
	<tr>
            <td>Tempat Lahir</td>
            <td>:</td>
            <td><label>
              <input name=tmplahir type=text id=input class=validate[required] size=30 maxlength=70 />
            </label></td>
          </tr>
	<tr>
            <td>Tgl. Lahir</td>
           <td>:</td>
            <td><label>
              <input name=tgl_lahir type=text id=datepicker size=18  maxlength=70 />
           </label></td>
         </tr>
	<tr>
           <td>Alamat</td>
            <td>:</td>
            <td><label>
              <input name=alamat type=text id=input  size=30 maxlength=70 class=validate[required]/>
            </label></td>
          </tr>
	<tr>
            <td>No Telepon/ hp</td>
            <td>:</td>
            <td><label>
              <input name=tlpn type=text id=input  size=30 maxlength=70 />
            </label></td>
          </tr>
	<tr>
            <td>Pekerjaan</td>
            <td>:</td>
            <td><label>
              <input name=pekerja type=text id=input  size=30 maxlength=70 />
            </label></td>
          </tr>
	<tr>
            <td>Biaya</td>
            <td>:</td>
            <td><label>
              <input name=biaya type=text id=input  size=18 maxlength=70 class=validate[required]/>
            </label></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><label>
              <input type=submit name=SimpanBar id=tombol value=Simpan />
            </label>
              <label>
                <input type=reset name=BatalBar id=tombol value=Batal />
              </label></td>
          </tr>
        </table>";
}
//form data golongan
	elseif($_GET['kode']=="gol_insert"){
	$jenis = "NN.0";
	$query = "SELECT max(id_golongan) as maxID FROM golongan WHERE id_golongan LIKE '$jenis%'";
	$hasil = mysql_query($query);
	$data  = mysql_fetch_array($hasil);
	$idMax = $data['maxID'];
	$noUrut = (int) substr($idMax, 4, 3);
	$noUrut++;
	$newID = $jenis . sprintf("%03s", $noUrut);
    echo "    
        <div id=judulHalaman><strong>Seting Jenis Member</strong></div>
        <table border=0 cellspacing=2 cellpadding=0>
          <tr>
            <td>Kode </td>
            <td>:</td>
            <td><input name=id_gol type=text id=input class=validate[required] value='$newID' size=30 maxlength=70 /></td>
         </tr>
	   <tr>
            <td>Jenis Member</td>
            <td>:</td>
            <td><label>
              <input name=nama_gol type=text id=input class=validate[required] size=30 maxlength=70 />
            </label></td>
          </tr>
	  <tr>
            <td>Biaya</td>
            <td>:</td>
            <td><label>
              <input name=biaya type=text id=input class=validate[required] size=30  maxlength=70 />
            </label></td>
          </tr>
          <tr>
          <td>Kuota</td>
          <td>:</td>
          <td><label>
            <input name=kuota type=text id=input class=validate[required] size=30  maxlength=70 />
          </label></td>
        </tr>
    <tr>
        <td>Expired</td>
        <td>:</td>
        <td><label>
          <input name=expired type=text id=input class=validate[required] size=30  maxlength=70 /> Hari
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
	}else{  
//form data pelanggan
	//pemanggilan fungsi penambahan
		$a="SELECT * FROM guest";
		$b="SELECT inc FROM guest ORDER BY inc DESC LIMIT 1";
		$inc=penambahan($a, $b);
	echo "
        <div id=judulHalaman><strong>Input Data Pengunjung</strong></div>
        <table border=0 cellspacing=2 cellpadding=0>
          <tr>
            <td>Nama Pengunjung <input type=hidden name=guest_inc id=guest_inc value=$inc /></td>
            <td>:</td>
            <td><input type=text name=nama id=input class=validate[required]  size=40 /></td>
          </tr>
          <tr>
            <td>Ruang/Room</td>
            <td>:</td>
            <td><label>
              <input name=room type=text id=input class=validate[required] size=40 maxlength=70 />
            </label></td>
          </tr>
          <tr>
            <td>Alamat Pengunjung</td>
            <td>:</td>
            <td><label>
              <input name=alamat type=text id=input class=validate[required] size=40 maxlength=100 />
            </label></td>
          </tr>
          <tr>
            <td>No.Hp/Whatsapp</td>
            <td>:</td>
            <td><label>
              <input name=hp type=text id=input class=validate[required] size=40 maxlength=70 />
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
     echo " </form>";
?>
