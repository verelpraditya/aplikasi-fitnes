<script language="javascript">
function setBR_focus(){
		document.forms[0].id.focus();
		//setTimeout("setBR_focus()", 1000);
	}
function waktu() {     
    var tanggal = new Date();    
    setTimeout("waktu()",1000);    
    document.getElementById("txtClock").innerHTML = tanggal.getHours()+":"+tanggal.getMinutes()+":"+tanggal.getSeconds();
}
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<form method="post" action="action.php" name="formAbsen" onSubmit="return validate(this, Array('ID'));">

<?php if (isset($_GET['error'])): ?>
<script>
  Swal.fire({
    icon: "error",
    title: "Gagal!",
    text: "<?php echo $_GET['error']; ?>"
  });
</script>
<?php endif; ?>
<TABLE WIDTH=1000 BORDER=0 CELLPADDING=0 CELLSPACING=0>
	<tr>
		<td rowspan="5">
			<img src="images/header_01.gif" width="21" height="99" alt=""></td>
		<td rowspan="2">
			<img src="images/header_02.gif" width="167" height="46" alt=""></td>
		<td rowspan="5">
			<img src="images/header_03.gif" width="20" height="99" alt=""></td>
		<td rowspan="5">
			<img src="images/header_04.gif" width="435" height="99" alt=""></td>
		<td>
			<img src="images/header_05.gif" width="338" height="13" alt=""></td>
		<td rowspan="5">
			<img src="images/header_06.gif" width="19" height="99" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="13" alt=""></td>
	</tr>
	<tr>
		<td  rowspan="3" ROWSPAN="2" id="txtClock"  align="center" style="font-family: tahoma; background-color:#ffffff; font-weight:bold; font-size:34px;color: #000"></TD>
		<td>
			<img src="images/spacer.gif" width="1" height="33" alt=""></td>
	</tr>
	
	<tr>
		<td background="images/header_08.gif">
		<input id="id" name="id" class="inputbox" type="text" size="21" >
		</td>
		<td>
			<img src="images/spacer.gif" width="1" height="23" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="images/header_09.gif" width="167" height="30" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="15" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="images/header_10.gif" width="338" height="15" alt=""></td>
		<td>
			<img src="images/spacer.gif" width="1" height="15" alt=""></td>
	</tr>
</table>
</form>
<script type="text/javascript">
	setBR_focus();
	
</script>
