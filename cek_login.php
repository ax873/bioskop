<?php
error_reporting(0);
include "config/koneksi.php";
$pass=md5($_POST[password]);
$level=$_POST[level];
if ($level=='Admin')
{
$login=mysql_query("SELECT * FROM users
			WHERE username='$_POST[id_user]' AND password='$pass' AND level='$level'");
$cocok=mysql_num_rows($login);
$r=mysql_fetch_array($login);

if ($cocok > 0){
	session_start();
	$_SESSION[namauser]     = $r[username];
  	$_SESSION[namalengkap]  = $r[nama_lengkap];
  	$_SESSION[passuser]     = $r[password];
  	$_SESSION[leveluser]    = $r[level];

	header('location:admin/media.php?module=home');
	}
else {
echo "<script>window.alert('Username atau Password anda salah.');
        window.location=('http://localhost/bioskop/')</script>";
}
}

elseif ($level=='members'){
$login=mysql_query("SELECT * FROM users
			WHERE username='$_POST[id_user]' AND password='$pass' AND level='$level'");
$cocok=mysql_num_rows($login);
$r=mysql_fetch_array($login);

	if ($cocok > 0){
		session_start();
		$_SESSION[namauser]     = $r[username];
		$_SESSION[passuser]     = $r[password];
	  	$_SESSION[namalengkap]  = $r[nama_lengkap];
		$_SESSION[email]    	= $r[email];
		$_SESSION[telp]    		= $r[no_telp];
		$_SESSION[alamat]    	= $r[alamat_lengkap];
		$_SESSION[kota]   	 	= $r[kota];
	  	$_SESSION[leveluser]    = $r[level];

		header('location:http://localhost/bioskop/');
	}else {
		echo "<script>window.alert('Username atau Password anda salah.');
		        window.location=('http://localhost/bioskop/')</script>";
	}
}

?>
