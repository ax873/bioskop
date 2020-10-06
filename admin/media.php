<?php
session_start();
error_reporting(0);
include "../config/session_admin.php";
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrator - Bioskop 21</title>
<link href="../view/admin.css" rel="stylesheet" type="text/css" />
<script src="../view/js/calendar/datetimepicker.js" type="text/javascript"></script>
<script src="tiny_mce/tiny_mce.js" type="text/javascript"></script>
<script src="tiny_mce/tiny_gugun.js" type="text/javascript"></script>
</head>
<body>

<div id="container_wrapper">
	<div class="spacer"></div>
	<div id="container">
  <div id="header">
      <div id="inner_header">
			<img style='width:100%' src='../view/images/header.jpg'>
      </div>
  </div>
    <div id="top"> 
		<span class="cpojer-links"> 
					<a href=?module=about>Manage About</a>
					<a href=?module=help>Kelola Help</a> 	
					<a href=?module=user>Manage Members</a>
					<a href=../logout.php>Logout</a>
		</span>
	</div>
  
		<div id="left_column">
			<div class="text_area" align="justify">	
	<?php echo "<br/>"; include "content.php"; ?>
			</div>
		</div>
    
    	<div id="right_column">
		  <ul class="menu">
                <?php echo "<br/><br/><div style='width:239px;' class='subtitle'></b> Menu Administrator</div>"; ?><br/>
				<a class='shiny-button' href=?module=jam>Kelola jam</a>
				<a class='shiny-button' href=?module=studio>Kelola Studio</a>
				<a class='shiny-button' href=?module=kategori>Kelola Kategori Film</a>
				<a class='shiny-button' href=?module=movie>Kelola Film</a>
				<a class='shiny-button' href=?module=order>Kelola Pemesanan</a><br><br>
          </ul>
		</div>

	<div id="footer">

    </div>
        
</div>
<div class="spacer"></div>
</div>
</body>
</html>