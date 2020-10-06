<?php
session_start();
include "config/koneksi.php";

$username=trim($_POST[username]);
$password=trim($_POST[password]);
$nama_lengkap=trim($_POST[nama_lengkap]);
$alamat_lengkap=trim($_POST[alamat_lengkap]);
$email=trim($_POST[email]);
$no_telp=trim($_POST[no_telp]);
$pass=md5($password);

if (empty($username)){
  echo "Anda belum mengisikan USERNAME<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b>";
}
elseif (empty($password)){
  echo "Anda belum mengisikan PASSWORD<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b>";
}
elseif (empty($nama_lengkap)){
  echo "Anda belum mengisikan NAMA LENGKAP<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b>";
}
elseif (empty($alamat_lengkap)){
  echo "Anda belum mengisikan ALAMAT LENGKAP<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b>";
}
elseif (empty($email)){
  echo "Anda belum mengisikan EMAIL<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b>";
}
elseif (empty($no_telp)){
  echo "Anda belum mengisikan NO. TELP<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b>";
}else{

    $sql = mysql_query("INSERT INTO users(username,
                                 password,
                                 nama_lengkap,
                                 email, 
                                 no_telp,
								 alamat_lengkap) 
	                       VALUES('$username',
                                '$pass',
                                '$nama_lengkap',
                                '$email',
                                '$no_telp',
								'$alamat_lengkap')");

				echo "<script>window.alert('Sukses daftar jadi members, silahkan login!!');
                      window.location=('http://localhost/bioskop/')</script>";
}
?>