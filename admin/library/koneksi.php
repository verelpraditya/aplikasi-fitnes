<?php

function koneksiDB($host="localhost", $user="root", $pass="")
{
   $koneksi =    @mysql_pconnect($host,$user,$pass) or
            die ("Terjadi Kesalahan: " . mysql_error());
   if ($koneksi){
      return $koneksi;   
   }
}
$conn=koneksiDB();
mysql_select_db("db_nenomember",$conn);

?> 
