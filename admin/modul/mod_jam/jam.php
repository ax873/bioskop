<?php
$aksi="modul/mod_jam/aksi_jam.php";
switch($_GET[act]){
  // Tampil Kategori
  default:
    echo "<div class='post_title'><b>Manajemen jam Pemutaran Film.</b></div><br/>
          <input type=button value='Tambah Jam' 
          onclick=\"window.location.href='?module=jam&act=tambahjam';\">
          <table width=100% cellpadding=6>
          <tr style='color:#fff; height:35px;' bgcolor=#000><th width='30px;'>No</th><th>Jam</th><th align='center' width='90px;'>Action</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM jam ORDER BY id_jam DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
	if(($no % 2)==0){
			$warna="#ffffff";
		  }
		  else{
			$warna="#fff";
		  }
       echo "<tr bgcolor=$warna><td>$no</td>
             <td>$r[jam]</td>
             <td><a href=?module=jam&act=editjam&id=$r[id_jam]>Edit</a> | 
	               <a href=$aksi?module=jam&act=hapus&id=$r[id_jam]>Hapus</a>
             </td></tr>";
      $no++;
    }
    echo "</table>";
    break;
  

  case "tambahjam":
    echo "<div class='post_title'><b>Tambah Jam Pemutaran Film.</b></div><br/>
          <form method=POST action='$aksi?module=jam&act=input'>
          <table width='100%'>
          <tr><td width='100px;'>Jam Tayang</td><td> : <input type=text name='jam' style='width:300px;'></td></tr>
          <tr><td colspan=2><br/><br/><input type=submit name=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
   
  case "editjam":
    $edit=mysql_query("SELECT * FROM jam WHERE id_jam='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<div class='post_title'><b>Edit Jam Pemutaran Film.</b></div><br/>
          <form method=POST action=$aksi?module=jam&act=update>
          <input type=hidden name=id value='$r[id_jam]'>
          <table>
          <tr><td width='100px;'>Jam Tayang</td><td> : <input type=text name='jam' value='$r[jam]' width='100px;'></td></tr>
          <tr><td colspan=2><br/><br/><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
?>
