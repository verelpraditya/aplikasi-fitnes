<?php
require_once('config.php');
require_once('function.php');
include_once($config_dirAdmin . 'class/classSession.php');
include_once($config_dirAdmin . 'class/classDatabase.php');
include_once($config_dirAdmin . 'class/classIndoTime.php');
$mySes	= new session();
$myDb   = new database();
$myTime   = new indoTime();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link href="<?php echo ($config_dirAdmin); ?>css/cssMain.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" src="<?php echo ($config_dirAdmin); ?>js/jMain.js" type="text/javascript"></script>
	<script language="JavaScript" src="<?php echo ($config_dirAdmin); ?>js/message.js" type="text/javascript"></script>
	<link rel="shortcut icon" href="images/icon.png" />
	<title>Neno Fitness Center</title>
	<script language="javascript" type="text/javascript">
		<!--
		function startTime() {
			var today = new Date();
			var h = today.getHours();
			var m = today.getMinutes();
			var s = today.getSeconds();
			// add a zero in front of numbers<10
			m = checkTime(m);
			s = checkTime(s);
			document.getElementById('txtClock').innerHTML = h + ":" + m + ":" + s;
			t = setTimeout('startTime()', 500);
		}

		function checkTime(i) {
			if (i < 10) {
				i = "0" + i;
			}
			return i;
		}
		//
		-->
	</script>
	<style>
    @keyframes blink {
      0% { color: red; }
      50% { color: transparent; }
      100% { color: red; }
    }
    
    .blinking-text {
      animation: blink 1s infinite;
    }
  </style>
</head>

<body style="width:100%; margin:0;" onLoad="this.formAbsen.id.focus(); startTime();">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td align="center" bgcolor="#0065CB"><?php include('header.php'); ?></td>
		</tr>
		<tr>
			<td valign="top" align="center">
				<table width="90%" border="0" cellpadding="0" cellspacing="0">
					<tr valign="top">
						<td width="35%" align="center" class="left">
							<?php include("left.php"); ?>
						</td>
						<td width="65%" align="left" class="right">
							<?php include("right.php"); ?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>

</html>