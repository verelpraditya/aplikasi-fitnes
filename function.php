<?php
function message() {
	$mySes = new session();
	if ($mySes->checkSes('errNIK')) { ?>
		<script language="javascript">
			messageBox('NIK', 'ID Member Anda Sudah Tidak Aktif / Tidak terdaftar, Silahkan hubungi Admin', 2);
		</script>
		<?php
		$mySes->unreg('errNIK');
	}
	if ($mySes->checkSes('errStatus')) { ?>
		<script language="javascript">
			messageBox('NIK', 'Anda sudah absen masuk dan pulang hari ini', 2);
		</script>
		<?php
		$mySes->unreg('errStatus');
	}
}
?>
