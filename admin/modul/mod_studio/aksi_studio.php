<?php
session_start();
include "../../../config/koneksi.php";


$module=$_GET[module];
$act=$_GET[act];


if ($module=='studio' AND $act=='hapus'){
  mysql_query("DELETE FROM studio WHERE id_studio='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

elseif ($module=='studio' AND $act=='input'){
  mysql_query("INSERT INTO studio (nama_studio, alamat_studio, no_telpon, kursi) VALUES('$_POST[studio]','$_POST[alamat_studio]','$_POST[no_telpon]','$_POST[kursi]')");
  header('location:../../media.php?module='.$module);
}

elseif ($module=='studio' AND $act=='update'){
  mysql_query("UPDATE studio SET nama_studio = '$_POST[studio]', 
  								 alamat_studio = '$_POST[alamat_studio]',
  								 no_telpon = '$_POST[no_telpon]',
								 kursi = '$_POST[kursi]'  WHERE id_studio = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
?>
