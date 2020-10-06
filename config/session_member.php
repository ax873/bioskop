<?php
session_start();
if($_SESSION[leveluser]==''){
	echo "<script>window.alert('Untuk mengakses, Anda harus Login Sebagai Members');
        window.location=('../home')</script>";
}
?>