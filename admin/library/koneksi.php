<?php

function koneksiDB($host="localhost", $user="stra9813_admin", $pass="filipi 4 6")
{
   $koneksi =    @mysql_pconnect($host,$user,$pass) or
            die ("Terjadi Kesalahan: " . mysql_error());
   if ($koneksi){
      return $koneksi;   
   }
}
$conn=koneksiDB();
mysql_select_db("stra9813_neno",$conn);

?> 
