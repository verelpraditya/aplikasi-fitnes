<?php
require_once "library/koneksi.php";
//fungsi pindah halaman
function lompat_ke($page)
{
   if (!headers_sent()){
      header("Location:$page");
      exit();
   }else{
      echo "<meta http-equiv=refresh content=0;URL=$page>";
      exit();
   }
}
//fungsi jam

//fungsi tanggal bhs indonesia
function tanggal(){
	$hari=$day=date(l);
	$tanggal=date(d);
	$bulan=$bl=$month=date(m);
	$tahun=date(Y);
	$jam=date(H);
	$menit=date(i);
	$detik=date(s);

	switch($hari)
	{
		case"Sunday":$hari="Minggu"; break;
		case"Monday":$hari="Senin"; break;
		case"Tuesday":$hari="Selasa"; break;
		case"Wednesday":$hari="Rabu"; break;
		case"Thursday":$hari="Kamis"; break;
		case"Friday":$hari="Jumat"; break;
		case"Saturday":$hari="Sabtu"; break;
	}

	switch($bulan)
	{
		case"1":$bulan="Januari"; break;
		case"2":$bulan="Februari"; break;
		case"3":$bulan="Maret"; break;
		case"4":$bulan="April"; break;
		case"5":$bulan="Mei"; break;
		case"6":$bulan="Juni"; break;
		case"7":$bulan="Juli"; break;
		case"8":$bulan="Agustus"; break;
		case"9":$bulan="September"; break;
		case"10":$bulan="Oktober"; break;
		case"11":$bulan="November"; break;
		case"12":$bulan="Desember"; break;
	}

	$tglLengkap="$hari, $tanggal $bulan $tahun";
	return $tglLengkap;
}
//fungsi penambahan otomatis
//this function created by Putu Hendra Eka Parman
function penambahan($teks1, $teks2)
{
	$id=0;
	$query=mysql_query($teks1);
	$qry=mysql_query($teks2);
	$inc=mysql_fetch_array($qry);
	$nrow=mysql_num_rows($query);

	if ($nrow==0){
		$id=1;	
	}else{
		$inc['inc']=$inc['inc']+1;
		$id=$inc['inc'];
		
	}
	return $id;
}
//this function created by Putu Hendra Eka Parman
//fungsi format angka
function digit($data){
		$input=$data;
		$panjang=strlen($input);
if ($panjang==0)
{
	return $input;	
}
elseif ($panjang < 4)
{
	return $input;
}
else
{
		$n=$panjang-1;
		$point=1;
		$j=1;
		$teks=array();
	for ($i=$n;$i>0;$i--)
	{
		if($point==3)
		{
			$teks["$j"]=substr($input,$i,3);
			$point=0;
			$j++;
			$g=$i;
		}
		$point++;
	}
	$input= substr($input,0,$g);
	for ($k=$j;$k>0;$k--)
	{
		if ($k==1){
			$input=$input. $teks["$k"];
		}else{
			$input=$input. $teks["$k"].".";
		}
	}
	return $input;
}
}
//this function created by Putu Hendra Eka Parman
function ambil_data($DML)
{
	$query=mysql_query($DML);
	$dataArray=mysql_fetch_array($query);
	return $dataArray;
}
//this function created by Putu Hendra Eka Parman
function pencarian($tabel,$field,$cari)
{
	$sql="SELECT * FROM $tabel WHERE $field LIKE '%$cari%'";
	$query=mysql_query($sql);
	return $query;
}
//this function created by Putu Hendra Eka Parman
function hitungDenda($thKembali, $blnKembali, $tglKembali, $thNow, $blnNow, $tglNow){
	if ($thKembali==$thNow) 
	{
		if ($blnKembali==$blnNow) {
			if ($tglKembali==$tglNow) {
				$denda=0;
			}else{
				if ($tglKembali > $tglNow) {
					$denda=0;
				}else{
					$n=$tglNow-$tglKembali;
					$denda=1000*$n;
				}
			}
		}else{
			if ($blnKembali > $blnNow) {
				$denda=0;
			}else{
				$n=$blnNow-$blnKembali;
				$denda=5000*$n;
			}
		}
	}
	else
	{
		if ($thKembali > $thNow){
			$denda=0;
		}else{
			$n=$thNow-$thKembali;
			$denda=10000*$n;
		}
	}
	return $denda;
}
//this function created by Putu Hendra Eka Parman
function pecah_tgl($kalender)
{
  $n=strlen($kalender);
  $i=0;
  while (($kalender["$i"]!="/")and($i<=$n))
  {
    if ($kalender["$i"]!="/")
	{
      $bln=$bln.$kalender["$i"];
	}
    $i++;
  }
  $tbln=$bln;
 $j=$i+1;
  while (($kalender["$j"]!="/")and($j<=$n))
  {
    if ($kalender["$j"]!="/")
	{
      $tgl=$tgl.$kalender["$j"];
	}
    $j++;
  }
  $ttgl=$tgl;
  $k=$j+1;
  while ($k<=$n) 
  {
    $thn=$thn.$kalender["$k"];
    $k++;
  }
  $tthn=$thn;
  $arrKalender=array();
  $arrKalender[0]=$tbln;
  $arrKalender[1]=$ttgl;
  $arrKalender[2]=$thn;

  return $arrKalender;
}

//fungsi tampil created by Hendra McHen
	function tampil($sql,$title,$field,$menu)
	{
		//awal tabel
		echo "<table>";
		//baris judul kolom
		echo "<tr id=judul>";
		echo "<td>No</td>";
		foreach($title as $value)
		{
			echo "<td>$value</td>";
		}
		//jika variabel menu tidak kosong maka tampilkan kolom Menu
		if (!empty($menu))
		{
			echo "<td colspan=2>Menu</td>";
		}
		echo "</tr>";
		//proses ke mysql
		$no=1;
		$query=mysql_query($sql);
		while($data=mysql_fetch_array($query))
		{
			//baris data atau record pada tabel di basis data
			echo "<tr>";
			echo "<td>$no</td>";
				foreach($field as $nilai)
				{
					echo "<td>".$data["$nilai"]."</td>";
				}
				//jika variabel menu tidak kosong maka tampilkan kolom Menu
				if (!empty($menu))
				{
					foreach($menu as $list)
					{
						echo "<td>$list</td>";
					}
				}
			echo "</tr>";
			$no++;
		}
		//akhir tabel
		echo "</table>";
	}
?> 
