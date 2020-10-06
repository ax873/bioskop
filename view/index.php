<?php
session_start();
error_reporting(0);
include "config/fungsi_rupiah.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Selamat Datang di Bioskop 21</title>
<link href="view/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="view/js/dropdown.js"></script>
<script type="text/javascript" src="view/js/highslide-with-html.js"></script>
<script type="text/javascript" src="view/js/slideshow.js"></script>
<script type="text/javascript" src="view/js/utilities.js"></script>
</head>
<body>

<div id="container_wrapper">
	<div class="spacer"></div>
<div id="container">	
  <div id="header">
      <div id="inner_header">
			<a href='admin.php'><img src='view/images/header.jpg'></a>
      </div>
  </div>
<div id="top"> 
	<span class="cpojer-links"> 
		<a href="http://localhost/bioskop/">Home</a> 
		<a href="now.html">Now Playing</a> 
		<a href="coming-soon.html">Coming Soon</a> 
		<a href="theater.html">Theater</a> 
		<a href="about.html">About</a> 
		<a href="help.html">Help</a>
		<?php 
			if ($_SESSION[leveluser]=='members'){
				echo "<a style='color:red' href=''>Welcome!! <b>$_SESSION[namalengkap]</b></a>";
			}
		?> 
	</span>
</div>
<?php include "movie.php"; ?>

		<div id="left_column">
			<div class="text_area" align="justify">	
			<?php include "kiri.php"; ?>
			</div>
		</div>

    	<div id="right_column">
			<?php include "sidebar_kiri.php"; ?>
		</div>

	<div style='color:#fff;' id="footer">
	Copyright (c) 2015 - Develop By Jessica
    </div>
        
</div>
<div class="spacer"></div>
</div>
</body>
</html>