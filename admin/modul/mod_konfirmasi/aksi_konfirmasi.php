<?php
include "../../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus Konfirmasi
if ($module=='konfirmasi' AND $act=='hapus'){
  mysql_query("DELETE FROM konfirmasi WHERE id_konfirmasi='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
?>
