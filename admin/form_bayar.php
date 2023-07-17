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
$mem= $_GET['id'];
$query2 = "SELECT DISTINCT(id_golongan) FROM golongan";
$hasil2 = mysql_query($query2);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Neno Fitness Center</title>
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
<a href="member.php"><div id="keluar">close</div></a>
<div class="header"><h1>Pembayaran Member</h1></div>
<div class="halaman">
  <div class="tengah">
    <div class="batas_isi">
      <div class="isi">
        
            <td><form id="formID" name="form" method="post" action="proses.php">
               <input type="hidden" name="proses" id="" value="bayar_insert" />
                
                <table width="100%" border="0">
		 <tr>
		 <td>       
                   <table border="0" cellpadding="0" cellspacing="1">
                      <h3> Data Member</h3>
                      <tr>
                        <td id="noborder">ID Member</td>
                        <td id="noborder">:</td>
                        <td id="noborder">
				<?php
				$pesan="SELECT * FROM member WHERE id_member='$mem'";
				$query=mysql_query($pesan);
				$data=mysql_fetch_array($query);
				echo $data['id_member'];
				?>
				<input name=id_mem type=hidden id=input size=30 maxlength=70 value="<?php echo $data['id_member'];?>" />
			</td>
                      </tr>
                      <tr>
                        <td id="noborder">Nama Member</td>
                        <td id="noborder">:</td>
                        <td id="noborder">			
			<?php echo $data['nama'];?>
			<input name=nama_member type=hidden id=input size=30 maxlength=70 value="<?php echo $data['nama'];?>" />
			</td>
                      </tr>
                      <tr>
                        <td id="noborder">Alamat</td>
                        <td id="noborder">:</td>
                        <td id="noborder">
                          <?php echo $data['alamat'];?>
                        </td>
                      </tr>
                      <tr>
                        <td id="noborder">Jenis Kelamin</td>
                        <td id="noborder">:</td>
                        <td id="noborder"><label>
                          <?php echo $data['jenis_kelamin'];?>
                        </label></td>
                      </tr>
                      <tr>
		      <td id="noborder">No. Whatsapp</td>
                      <td id="noborder">:</td>
                      <td id="noborder">
		      	<?php echo $data['no_telepon'];?>
		      </td>
		      </tr>
		    </table> 
		<table border="0" cellspacing="1" cellpadding="0">
                        <h3>Type Member</h3>
                        <tr>
            		<td id="noborder">Type member</td>
			<td id="noborder">:</td>
		        <td id="noborder">
              		<select name="pilih_jenis" id="input">
              		<?php
			  	$stok="SELECT * FROM golongan ORDER BY id_golongan ASC";
				$qstok=mysql_query($stok);
				while($dstok=mysql_fetch_array($qstok))
				{
					
			echo "<option value='".$dstok[0]."'>kategori ".$dstok[1]." Biaya ".digit($dstok[2])." </option>";
				}
			  ?>
              		</select>
            		</td>
			</tr>
		      <tr>
                          <td id="noborder">Expire</td>
                          <td id="noborder">:</td>
                          <td id="noborder"><input type="text" name="tgl_tempo" id="datepicker1" class="validate[required]"/>
		      </td>
                      </tr>
			<tr>
                          <td id="noborder">Tgl Transaksi</td>
                          <td id="noborder">:</td>
                          <td id="noborder">
			<input type="text" name="tgl_reg" id="datepicker" size="17" value="<?php echo date(Y)."-".date(m)."-".date(d);?>" />
		      </td>
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
