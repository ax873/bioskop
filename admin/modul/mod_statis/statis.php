<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<?php
$aksi="modul/mod_statis/aksi_statis.php";
switch($_GET[act]){
  // Tampil Cara Pembelian
  default:
    $sql  = mysql_query("SELECT * FROM statis WHERE halaman='$_GET[module]'");
    $r    = mysql_fetch_array($sql);

    echo "<div class='post_title'><b>Kelola Halaman $_GET[module].</b></div><br/>
		 <div class='h_line'></div>
          <form method=POST action=$aksi?module=statis&act=update>
          <input type=hidden name=id value=$_GET[module]>
          <table>
		  <tr><td><input type=text name='judul' value='$r[judul]' class=input style='width: 600px'>
         <tr><td><textarea name='isi' id='isi' class=input style='height: 260px; width:600px'>$r[detail]</textarea>
		  <script type='text/javascript'>
							var editor = CKEDITOR.replace('isi');
						</script></td></tr>
         <tr><td><input type=submit value=Update></td></tr>
         </form></table>";
    break;  
}
?>
