<?php
session_start();
if($_SESSION[leveluser]==''){
		echo "<script>window.alert('Untuk mengakses, Anda harus Login Sebagai Admin');
        window.location=('../login.html')</script>";
}
?>