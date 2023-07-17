<table id="table" width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr background="images/head_table.jpg">
	<th>Tanggal</th><th>ID Memebr</th><th>Nama Member</th><th>Jam Masuk</th><th>Jam Keluar</th><th>Total Jam</th>
</tr><?php 
$tgl = date('Y-m-d');
$sql = "SELECT * FROM absensi,member WHERE absensi.id_member=member.id_member AND absensi.tgl='$tgl' ORDER BY absensi.counter DESC";
$query = $myDb->select($sql);
while ($result = $myDb->getRow($query)) { ?>
	<tr>
		<?php
		$mjam=$result['jam_masuk'];
		$pjam=$result['jam_pulang'];
		$queryjam = "SELECT timediff('$pjam', '$mjam') as selisih";
		$hasil = mysql_query($queryjam);
		$data = mysql_fetch_array($hasil);
		?>
		<td><?php echo($myTime->getTglH($result['tgl'])); ?></td>
		<td><?php echo($result['id_member']); ?></td>
		<td><?php echo($result['nama']); ?></td>
		<td><?php echo($mjam); ?></td>
		<td><?php echo($pjam); ?></td>
		<td><?php echo($data['selisih']); ?></td>
	</tr><?php
}
?> 
</table>
