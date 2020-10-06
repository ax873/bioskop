<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "db_bioskop";

mysql_connect($server,$username,$password) or die ("Gagal");
mysql_select_db($database) or die ("Database tidak ditemukan");

function ubah($angka){
	if ($angka == 1){ return $hasil = 'A'; }
	elseif($angka == 2) { return $hasil = 'B'; }
	elseif($angka == 3) { return $hasil = 'C'; }
	elseif($angka == 4) { return $hasil = 'D'; }
	elseif($angka == 5) { return $hasil = 'E'; }
	elseif($angka == 6) { return $hasil = 'F'; }
	elseif($angka == 7) { return $hasil = 'G'; }
	elseif($angka == 8) { return $hasil = 'H'; }
	elseif($angka == 9) { return $hasil = 'I'; }
	elseif($angka == 10) { return $hasil = 'J'; }
	elseif($angka == 11) { return $hasil = 'K'; }
	elseif($angka == 12) { return $hasil = 'L'; }
	elseif($angka == 13) { return $hasil = 'M'; }
	elseif($angka == 14) { return $hasil = 'N'; }
	elseif($angka == 15) { return $hasil = 'O'; }
	elseif($angka == 16) { return $hasil = 'P'; }
	elseif($angka == 17) { return $hasil = 'Q'; }
	elseif($angka == 18) { return $hasil = 'R'; }
	elseif($angka == 19) { return $hasil = 'S'; }
	elseif($angka == 20) { return $hasil = 'T'; }
	elseif($angka == 21) { return $hasil = 'U'; }
	elseif($angka == 22) { return $hasil = 'V'; }
	elseif($angka == 23) { return $hasil = 'W'; }
	elseif($angka == 24) { return $hasil = 'X'; }
	elseif($angka == 25) { return $hasil = 'Y'; }
	elseif($angka == 26) { return $hasil = 'Z'; }
}

?>