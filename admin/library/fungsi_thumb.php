<?php
function thumb($fupload_name,$direktori){
  // File gambar yang di upload
  $file_upload = $direktori . $fupload_name;

  // Simpan gambar dalam ukuran sebenarnya
  $nama_gbr_asli = $_FILES['fupload']['tmp_name'];
  move_uploaded_file($nama_gbr_asli, $file_upload);

  // Dapatkan identitas file asli dari file jpg yang di upload
  $gbr_asli = imagecreatefromjpeg($file_upload);
  $lebar    = imageSX($gbr_asli);
  $tinggi   = imageSY($gbr_asli);

  // Simpan dalam versi yang diinginkan 150 pixel (thumbnailnya)
  $thu_lebar  = 150;
  $thu_tinggi = ($thu_lebar/$lebar)*$tinggi;

  // Fungsi untuk mengubah ukuran gambar (resample)
  $gbr_thumb = imagecreatetruecolor($thu_lebar,$thu_tinggi);
  imagecopyresampled($gbr_thumb, $gbr_asli, 0, 0, 0, 0, $thu_lebar, $thu_tinggi, $lebar, $tinggi);

  // Simpan gambar yang versi thumbnailnya
  imagejpeg($gbr_thumb,$direktori . "kecil_" . $fupload_name);

  // Hapus gambar yang ada di memori
  imagedestroy($gbr_asli);
  imagedestroy($gbr_thumb);
}
?>
