<?php
session_start();
include "../../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];


if ($module=='jam' AND $act=='hapus'){
  mysql_query("DELETE FROM jam WHERE id_jam='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

elseif ($module=='jam' AND $act=='input'){
  mysql_query("INSERT INTO jam (jam) VALUES('$_POST[jam]')");
  header('location:../../media.php?module='.$module);
}

elseif ($module=='jam' AND $act=='update'){
  mysql_query("UPDATE jam SET jam = '$_POST[jam]' WHERE id_jam = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
?>
