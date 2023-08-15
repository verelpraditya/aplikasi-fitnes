<?php
require '../whatsapp.php';
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
include_once "class/classIndoTime.php";
$proses=$_POST['proses'];
$hapus=$_GET['proses'];
$url="";
$myTime = new indoTime();
//fungsi insert
	function insert($nama_tabel,$values)
	{
		$sql="INSERT INTO ".$nama_tabel." VALUES(".$values.")";
		mysql_query($sql);	
	}
//fungsi update
	function update($nama_tabel,$values,$kondisi)
	{
		$sql="UPDATE ".$nama_tabel." SET ".$values." WHERE ".$kondisi;
		mysql_query($sql);
	}
//fungsi delete
	function delete($nama_tabel,$kondisi)
	{
		$sql="DELETE FROM ".$nama_tabel." WHERE ".$kondisi;
		mysql_query($sql);
	}
//pilih fungsi
	switch($proses){
		//pemilihan fungsi insert
		case "akun_insert":
		{
			$nama_tabel="account";
			$username=md5($_POST["username"]);
			$password=md5($_POST["password"]);
			$values="'$username', '$password', '$_POST[nama]', '$_POST[level]'";
			$hal="user";
			insert($nama_tabel,$values);
			break;
		}
		case "ins_insert":
			{	
				$lokasi_file=$_FILES[gambar][tmp_name];
				$nama_file=$_FILES[gambar][name];
				move_uploaded_file($lokasi_file,"image_ins/$nama_file");		
				$nama_tabel="instruktur";
				$values="'$_POST[id_ins]','$_POST[nama_ins]','$_POST[alamat]','$_POST[tmplahir]','$_POST[tgl_lahir]','$_POST[jenis_kelamin]','$_POST[tlpn]','$_POST[status]','$nama_file'";
				$hal="instruktur";
				insert($nama_tabel,$values);
				break;
			}
		case "class_insert":
			{	
				$tgl = date('Y-m-d');
				$class = $_POST["jenis_class"];
				$jam = $myTime->getJamNow();
				$inputString = $_POST["inputString"];				
				$query = "SELECT id_member,nama,alamat,jenis_kelamin FROM member WHERE id_member='$inputString' ";
				$result = mysql_query($query) or die ("gagal");
				$data = mysql_fetch_array($result);
				$id = $data["id_member"];
				$nama= $data["nama"];
				$jeniskel= $data["jenis_kelamin"];
				$alamat= $data["alamat"];	
				$query = "INSERT INTO class (id_class,nama_class,id_member,nama,jeniskel,alamat,tanggal,jam_masuk) VALUES ('','$class','$id','$nama','$jeniskel','$alamat','$tgl','$jam')";
				mysql_query($query);				
				lompat_ke("class_member.php");
				break;
			}
		case "member_insert":
			{
				//$memKode=$_POST['memid'];
				$memID=str_ireplace(" ",_,$_POST['memid']);
				$nama_tabel="member";
		$values="'','$memID', '$_POST[nama]', '$_POST[tmplahir]','$_POST[tgl_lahir]','$_POST[alamat]','$_POST[tlpn]','$_POST[hp]'";
				$hal="member";
				insert($nama_tabel,$values);
				break;
			}
		case "nonmember_insert":
			{
				$jenis = "trsU.0";
				$query = "SELECT max(no_transaksi) as maxID FROM umum WHERE no_transaksi LIKE '$jenis%'";
				$hasil = mysql_query($query);
				$data  = mysql_fetch_array($hasil);
				$idMax = $data['maxID'];
				$noUrut = (int) substr($idMax, 5, 4);
				$noUrut++;
				$newID = $jenis . sprintf("%03s", $noUrut);
				$tgl = date('Y-m-d');
				$nama_tabel="umum";
				$values="'$newID', '$_POST[no_iden]', '$_POST[nama]', '$_POST[jenis_kel]', '$_POST[tmplahir]', '$_POST[tgl_lahir]', '$_POST[alamat]', '$_POST[pekerja]', '$_POST[tlpn]', '$tgl', '$_POST[biaya]'";
				insert($nama_tabel,$values);
				lompat_ke("nonmember.php");
				break;
				
			}
		case "gol_insert":
			{
				//$pelID=str_ireplace(" ",_,$_POST['pelanggan_id']);
				$nama_tabel="golongan";
				$values="'$_POST[id_gol]','$_POST[nama_gol]','$_POST[biaya]', '$_POST[kuota]', '$_POST[expired]'";
				$hal="golongan";
				insert($nama_tabel,$values);
				break;
			}
		case "guest_insert":
			{
				$tgl = date('Y-m-d');
				$jam = $myTime->getJamNow();
				$nama_tabel="guest";
				$values="'$_POST[guest__inc]','$_POST[nama]','$_POST[room]','$_POST[alamat]','$_POST[hp]','$tgl','$jam'";
				insert($nama_tabel,$values);
				lompat_ke("guest.php");
				break;
			}
		case "pembayaran_insert":
			{
			$pemb="INSERT INTO pembayaran(`no_transaksi`, `no_registrasi`, `id_member`, `id_golongan`, `tanggal_pendaftaran`, `tanggal_pembayaran`, `tanggal_jatuh_tempo`, `biaya`) VALUES ('$_POST[no_trans]', '$_POST[no_regist]', '$_POST[id_mem]', '$_POST[id_gol]', '$_POST[tgl_pend]', '$_POST[tgl_trans]', '$_POST[tgl_tempo]', '$_POST[biaya_pem]')";
			mysql_query($pemb);
				
			$hal="pembayaran";
			break;	
			}
		//insert beli
		
		case "registrasi_insert":
		{			
			$jenis = "TRS-0";
			$query = "SELECT max(no_transaksi) as maxID FROM pembayaran WHERE no_transaksi LIKE '$jenis%'";
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
			$barcode = 'https://barcodeapi.org/api/qr/' . $id_member;

			// Untuk menentukan Expired
			$expired = $_POST['expired'];
			$tgl_reg = $_POST['tgl_reg'];
			$tgl_expired = date('Y-m-d', strtotime($tgl_reg . ' + '.$expired. ' days'));
			
			$bpen=$_POST['biaya_adm'];
			$bmem=$_POST['biaya_mem'];
			$total=$bpen+$bmem; 
			$lokasi_file=$_FILES[gambar][tmp_name];
			if(empty($lokasi_file)){
			notifRegister($_POST['no_tlpn'], $_POST['nama_mem'], $_POST['kuota'], $tgl_expired, $barcode);
			$reg="INSERT INTO registrasi(`no_registrasi`, `id_member`,`nama_member`, `nama_golongan`, `tanggal_pendaftaran`, `biaya_pendaftaran`,`biaya_member`) VALUES ('$_POST[no_reg]','$id_member','$_POST[nama_mem]','$_POST[id_golongan]','$_POST[tgl_reg]', '$_POST[biaya_adm]', '$_POST[biaya_mem]')";
			mysql_query($reg);
			$mem="INSERT INTO member(`id_member`, `nama`, `alamat`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `no_telepon`, `status`, `tgl_tempo`, `kuota`, `gambar`) VALUES ('$id_member', '$_POST[nama_mem]', '$_POST[alamat_mem]', '$_POST[tmp_mem]', '$_POST[tgl_mem]', '$_POST[jenis_kelamin]', '$_POST[no_tlpn]', 'aktif', '$tgl_expired', '$_POST[kuota]', 'member_default.jpg')";
			mysql_query($mem);
			$pem="INSERT INTO pembayaran(`no_transaksi`, `id_member`, `nama`, `nama_golongan`, `tanggal_pembayaran`, `tanggal_jatuh_tempo`, `total_bayar`) VALUES ('$newID', '$id_member', '$_POST[nama_mem]', '$_POST[id_golongan]', '$_POST[tgl_reg]', '$tgl_expired', '$total')";
			mysql_query($pem);	
			lompat_ke("pembayaran.php");
			break;	
			}else{
			notifRegister($_POST['no_tlpn'], $_POST['nama_mem'], $_POST['kuota'], $tgl_expired, $barcode);
			$lokasi_file=$_FILES[gambar][tmp_name];
			$nama_file=$_FILES[gambar][name];
			move_uploaded_file($lokasi_file,"image_mem/$nama_file");
			$reg="INSERT INTO registrasi(`no_registrasi`, `id_member`,`nama_member`, `nama_golongan`, `tanggal_pendaftaran`, `biaya_pendaftaran`,`biaya_member`) VALUES ('$_POST[no_reg]','$id_member','$_POST[nama_mem]','$_POST[id_golongan]','$_POST[tgl_reg]', '$_POST[biaya_adm]', '$_POST[biaya_mem]')";
			mysql_query($reg);
			$mem="INSERT INTO member(`id_member`, `nama`, `alamat`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `no_telepon`, `status`, `tgl_tempo`, `kuota`, `gambar`) VALUES ('$id_member', '$_POST[nama_mem]', '$_POST[alamat_mem]', '$_POST[tmp_mem]', '$_POST[tgl_mem]', '$_POST[jenis_kelamin]', '$_POST[no_tlpn]', 'aktif', '$tgl_expired', '$_POST[kuota]', '$nama_file')";
			mysql_query($mem);
			$pem="INSERT INTO pembayaran(`no_transaksi`, `id_member`, `nama`, `nama_golongan`, `tanggal_pembayaran`, `tanggal_jatuh_tempo`, `total_bayar`) VALUES ('$newID', '$id_member', '$_POST[nama_mem]', '$_POST[id_golongan]', '$_POST[tgl_reg]', '$tgl_expired', '$total')";
			mysql_query($pem);	
			lompat_ke("pembayaran.php");
			break;
			}
		}
		case "bayar_insert":
		{			
			$jenis = "TRS-0";
			$query = "SELECT max(no_transaksi) as maxID FROM pembayaran WHERE no_transaksi LIKE '$jenis%'";
			$hasil = mysql_query($query);
			$data  = mysql_fetch_array($hasil);
			$idMax = $data['maxID'];
			$noUrut = (int) substr($idMax, 4, 4);
			$noUrut++;
			$newID = $jenis . sprintf("%03s", $noUrut);
			$pilih=$_POST['pilih_jenis'];	
			$cekgol="SELECT * FROM golongan WHERE id_golongan='$pilih'";
			$qcekgol=mysql_query($cekgol);
			$dcekgol=mysql_fetch_array($qcekgol);
			$pem="INSERT INTO pembayaran(`no_transaksi`, `id_member`, `nama`, `nama_golongan`, `tanggal_pembayaran`, `tanggal_jatuh_tempo`, `total_bayar`) VALUES ('$newID', '$_POST[id_mem]', '$_POST[nama_member]', '$dcekgol[nama_golongan]', '$_POST[tgl_reg]', '$_POST[tgl_tempo]', '$dcekgol[biaya]')";
			mysql_query($pem);
			$sql="UPDATE member SET tgl_tempo='$_POST[tgl_tempo]', status='aktif' WHERE id_member='$_POST[id_mem]'";
			mysql_query($sql);
			lompat_ke("pembayaran.php");
			break;		
		}
		//akhir pemilihan fungsi insert
		
		case "update_ins":
			{
			$lokasi_file=$_FILES[gambar][tmp_name];
			if(empty($lokasi_file))
			{
			$sql="UPDATE instruktur SET nama_instruktur='$_POST[nama_ins]',tempat_lahir='$_POST[tmplahir]',tanggal_lahir='$_POST[tgl_lahir]', alamat_instruktur='$_POST[alamat]',no_telepon='$_POST[tlpn]', status_instruktur='$_POST[status]' WHERE id_instruktur='$_POST[id_inst]'";
			mysql_query($sql);
			$hal="instruktur";
			break;
			}else{
			$lokasi_file=$_FILES[gambar][tmp_name];
			$nama_file=$_FILES[gambar][name];
			move_uploaded_file($lokasi_file,"image_ins/$nama_file");
			$sql="UPDATE instruktur SET nama_instruktur='$_POST[nama_ins]', tempat_lahir='$_POST[tmplahir]',tanggal_lahir='$_POST[tgl_lahir]',alamat_instruktur='$_POST[alamat]',no_telepon='$_POST[tlpn]', status_instruktur='$_POST[status]',gambar='$nama_file' WHERE id_instruktur='$_POST[id_inst]'";
			mysql_query($sql);
			$hal="instruktur";
			break;
				}
			}	
		case "gol_update":
			{
				$nama_tabel="golongan";
				$values="nama_golongan='$_POST[nama_gol]', biaya='$_POST[biaya]', kuota='$_POST[kuota]', expired='$_POST[expired]'";
				$kondisi="id_golongan='$_POST[id_gol]'";				
				$hal="golongan";
				update($nama_tabel,$values,$kondisi);
				break;
			}
		case "member_update":
			{
				$lokasi_file=$_FILES[gambar][tmp_name];
				if(empty($lokasi_file))
				{
				$sql="UPDATE member SET nama='$_POST[nama_mem]', tempat_lahir='$_POST[tmplahir]', tanggal_lahir='$_POST[tgl_lahir]', alamat='$_POST[alamat]', no_telepon='$_POST[tlpn]' WHERE id_member='$_POST[idmem]'";
				mysql_query($sql);				
				lompat_ke("member.php");			
				break;
			}else{
				$lokasi_file=$_FILES[gambar][tmp_name];
				$nama_file=$_FILES[gambar][name];
				move_uploaded_file($lokasi_file,"image_mem/$nama_file");
				$sql="UPDATE member SET nama='$_POST[nama_mem]', tempat_lahir='$_POST[tmplahir]', tanggal_lahir='$_POST[tgl_lahir]', alamat='$_POST[alamat]', no_telepon='$_POST[tlpn]', gambar='$nama_file'  WHERE id_member='$_POST[idmem]'";
				mysql_query($sql);				
				lompat_ke("member.php");			
				break;
				}
			}
		
		case "ubah_akun":
		{
			$sql="UPDATE account SET password='$_POST[password]', nama='$_POST[nama]', level='$_POST[level]' WHERE username='$_POST[username]'";
			mysql_query($sql);
			$hal="user";
			break;
		}
		case "guest_update":
			{
			$sql="UPDATE guest SET nama='$_POST[nama]', room='$_POST[room]', alamat='$_POST[alamat]', telepon='$_POST[hp]' WHERE inc='$_POST[inc]'";
			mysql_query($sql);
			lompat_ke("guest.php");
			break;
			}
	}//end switch
	
switch($hapus){
	//pemilihan fungsi delete
	case "delete_ins":
			{
				$id="$_GET[id]";				
				$nama_tabel="instruktur";
				$kondisi="id_instruktur='$id'";
				$hal="instruktur";
				delete($nama_tabel,$kondisi);
				break;
			}
	case "gol_delete":
			{
				$nama_tabel="golongan";
				$kondisi="id_golongan='$_GET[id]'";
				$hal="golongan";
				delete($nama_tabel,$kondisi);
				break;
			}
	case "member_delete":
			{				
				$nama_tabel="member";
				$kondisi="id_member='$_GET[id]'";				
				delete($nama_tabel,$kondisi);
				lompat_ke("member.php");
				break;
			}
	
	case "hapus_akun":
	{
		$sql="DELETE FROM account WHERE username='$_GET[id]'";
		mysql_query($sql);
		$hal="user";
		break;
	}
}
	if ($url=="transaksi")
	{
		lompat_ke($hal);
	}
	else
	{
		lompat_ke("index.php?halaman=".$hal);
	}
?>
