<?php  
// cek level user apakah admin atau bukan
if ($_SESSION['level'] == "admin")
{ 
	echo"
    <ul id='menu'> 
		<li><a href=guest.php><span>IN-OUT Guest</span></a></li>
	<li><a href=pengunjung.php><span>IN-OUT Member</span></a></li>
	<li><a href=registrasi.php><span>Registrasi</span></a></li> 
	<li><a href=nonmember.php><span>Non Member</span></a></li>
	<li><a href=class_member.php><span>Class Member</span></a></li>
    <li><a href=pembayaran.php>Perpanjangan Member</a></li> 
	<li><a href=member.php><span>Member</span></a></li>  	
	<li><a href=index.php?halaman=instruktur><span>Instruktur</span></a></li>	
	<li><a href=index.php?halaman=golongan><span>Type Member</span></a></li>
	<li><a href=report.php>Report</a></li>      	      	
	<li><a href=monitoring.php>Monitoring</a></li>
	<li><a href=index.php?halaman=user>User</a></li>
    <li><a href=logout.php>Keluar</a></li>
    </ul>";
}
else if ($_SESSION['level'] == "user")
{
	echo "
	<ul id='menu'>
	<li><a href=guest.php><span>IN-OUT Guest</span></a></li>
	<li><a href=pengunjung.php><span>IN-OUT Member</span></a></li>	
	<li><a href=registrasi.php><span>Registrasi</span></a></li> 
	<li><a href=nonmember.php><span>Non Member</span></a></li>
	<li><a href=class_member.php><span>Class Member</span></a></li>
    <li><a href=pembayaran.php>Perpanjangan Member</a></li> 
	<li><a href=member.php><span>Member</span></a></li>  	
	<li><a href=index.php?halaman=instruktur><span>Instruktur</span></a></li>	
	<li><a href=index.php?halaman=golongan><span>Type Member</span></a></li>
	<li><a href=report.php>Report</a></li>       	      	      	      	
    <li><a href=logout.php>Keluar</a></li>
    </ul>";
}else{
	echo "<meta http-equiv='refresh' content='0; url=index.php'>";
}
?>
