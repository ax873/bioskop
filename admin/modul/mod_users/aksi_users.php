<?php
session_start();
include "../../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Input user
if ($module=='user' AND $act=='input'){
  $pass=md5($_POST[password]);
  mysql_query("INSERT INTO users(username,
                                 password,
                                 nama_lengkap,
                                 email, 
                                 no_telp,
                                 alamat_lengkap,
                                 id_session) 
	                       VALUES('$_POST[username]',
                                '$pass',
                                '$_POST[nama_lengkap]',
                                '$_POST[email]',
                                '$_POST[no_telp]',
                                '$_POST[alamat_lengkap]',
                                '$pass')");
  header('location:../../media.php?module='.$module);
}

// Update user
elseif ($module=='user' AND $act=='update'){
  if (empty($_POST[password])) {
    mysql_query("UPDATE users SET nama_lengkap   = '$_POST[nama_lengkap]',
                                  email          = '$_POST[email]',
                                  no_telp        = '$_POST[no_telp]',  
                                  alamat_lengkap = '$_POST[alamat_lengkap]'
                           WHERE  username     = '$_POST[id]'");
  }
  // Apabila password diubah
  else{
    $pass=md5($_POST[password]);
    mysql_query("UPDATE users SET password        = '$pass',
                                 nama_lengkap    = '$_POST[nama_lengkap]',
                                 email           = '$_POST[email]',   
                                 no_telp         = '$_POST[no_telp]',
                                 alamat_lengkap = '$_POST[alamat_lengkap]'  
                           WHERE username      = '$_POST[id]'");
  }
  header('location:../../media.php?module='.$module);
}
?>
