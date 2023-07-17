<?php message(); 
?>

<table width="95%" cellpadding="0" cellspacing="0" id="entrian"><?php
	$tgl = date('Y-m-d');
	//$sql = "SELECT a.*, k.* FROM absensi a LEFT OUTER JOIN member k ON a.id_member=k.id_member ORDER BY a.counter DESC LIMIT 0, 5";
	$sql = "SELECT * FROM absensi,member WHERE absensi.id_member=member.id_member AND absensi.tgl='$tgl' ORDER BY absensi.counter DESC LIMIT 3";
	$query = $myDb->select($sql);
	while ($result = $myDb->getRow($query)) { ?>		
		<tr valign="top"><?php
			if ($result['gambar'] != '') { ?>
				<td width="30%"><img height="125" width="120" src="<?php echo($config_dirAdmin.$config_dirFoto.$result['gambar']); ?>"></td><?php
			}
			else {?>
				<td width="25%"><img height="125" width="120" src="images/nofoto.png"></td><?php
			}?>
			<?php
			$tgltem=$result['tgl_tempo'];
			$querytgl = "SELECT datediff('$tgltem', '$tgl') as selisih";
			$hasil = mysql_query($querytgl);
			$data = mysql_fetch_array($hasil);
			?>
			<td align='left' valign="middle" style="padding-left:4px;">
				<table width="100%" cellpadding="0" cellspacing="0" style="font-family:tahoma; font-size:11px;">
					<tr>
						<td width="32%" height="20"><b><strong>ID Member</strong></b></td>
						<td width="68%"> : <b><?php echo($result['id_member']);?></b></td>
					</tr>
					<tr>
						<td width="32%" height="20"><strong>Nama Member</strong></td>
						<td> : <b><?php echo($result['nama']); ?></b></td>
					</tr>
					<tr>
						<td height="20"><strong>Jenis Kelamin</strong></td>
						<td> : <b><?php echo($result['jenis_kelamin']); ?></b></td>
					</tr>
					<tr>
						<td height="20"><strong>Jam Masuk</strong></td>
						<td> : <b><?php echo($result['jam_masuk']); ?></b></td>
					</tr>
					<tr>
						<td height="20"><strong>Jam Keluar</strong></td>
						<td> : <b><?php echo($result['jam_pulang']); ?></b></td>
					</tr>
					<tr>
						<td height="20"><strong>Sisa Kuota</strong></td>
						<td> : <b<?php if ($result['kuota'] == 1) echo ' class="blinking-text"'; ?>><?php echo $result['kuota']; ?> Kali Kunjungan</b></td>
					</tr>
                    <tr>
						<td height="20"><strong>Masa Aktif</strong></td>
						<td> : <b><?php echo($data['selisih']); ?></b> <b>Hari Lagi</b></td>
					</tr>
					<tr>
						<td height="20"><strong>Expire</strong></td>
						<td> : <b><?php echo($myTime->getTgl($result['tgl_tempo'])); ?></b></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" height="15"><div style=";border-bottom:1px solid #ccc;"></div></td>
		</tr><?php		
	}?>
<tr>
</tr>
</table>