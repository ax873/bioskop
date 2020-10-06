<?php
include "../../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

if ($module=='rekening' AND $act=='hapus'){
  mysql_query("DELETE FROM rekening WHERE id_rekening='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

elseif ($module=='rekening' AND $act=='input'){
  mysql_query("INSERT INTO rekening(no_rekening, atas_namaa, nama_bankk) VALUES('$_POST[a]', '$_POST[b]', '$_POST[c]')");
  header('location:../../media.php?module='.$module);
}


?>
