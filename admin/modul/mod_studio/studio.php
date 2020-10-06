<?php
$aksi="modul/mod_studio/aksi_studio.php";
switch($_GET[act]){

  default:
    echo "<div class='post_title'><b>Manajemen Studio Pemutaran Film.</b></div><br/>
          <input type=button value='Tambah Studio' 
          onclick=\"window.location.href='?module=studio&act=tambahstudio';\">
          <table width=100% cellpadding=6>
          <tr style='color:#fff; height:35px;' bgcolor=#000>
            <th width='30px;'>No</th>
            <th>Nama Studio</th>
            <th>Jumlah </th>
            <th>No Telpon</th>
            <th align='center' width='80px;'>Action</th>
          </tr>"; 
    $tampil=mysql_query("SELECT * FROM studio ORDER BY id_studio DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
	if(($no % 2)==0){
			$warna="#ffffff";
		  }
		  else{
			$warna="#fff";
		  }
       echo "<tr bgcolor=$warna><td>$no</td>
             <td>$r[nama_studio]</td>
			       <td>$r[kursi] kursi</td>
             <td>$r[no_telpon]</td>
             <td><a href=?module=studio&act=editstudio&id=$r[id_studio]>Edit</a> | 
	               <a href=$aksi?module=studio&act=hapus&id=$r[id_studio]>Hapus</a>
             </td></tr>";
      $no++;
    }
    echo "</table>";
    break;
  
  case "tambahstudio":
    echo "<div class='post_title'><b>Tambah Studio Pemutaran Film.</b></div><br/>
          <form method=POST action='$aksi?module=studio&act=input'>
          <table width='100%'>
          <tr><td width='100px;'>Nama Studio</td><td> : <input type=text name='studio' style='width:300px;'></td></tr>
		      <tr><td width='100px;'>Jumlah Kursi</td><td> : <input type=text name='kursi' style='width:300px;'></td></tr>
          <tr><td width='100px;'>No Telpon</td><td> : <input type=text name='no_telpon' style='width:300px;'></td></tr>
          <tr><td width='100px;'>Alamat Studio</td><td> : <textarea name='alamat_studio' style='width: 480px; height: 70px;'></textarea></td></tr>
          <tr><td colspan=2><br/><br/><input type=submit name=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
  
  case "editstudio":
    $edit=mysql_query("SELECT * FROM studio WHERE id_studio='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<div class='post_title'><b>Edit Studio Pemutaran Film.</b></div><br/>
          <form method=POST action=$aksi?module=studio&act=update>
          <input type=hidden name=id value='$r[id_studio]'>
          <table>
          <tr><td width='100px;'>Nama Studio</td><td> : <input type=text name='studio' value='$r[nama_studio]' width='300px;'></td></tr>
		      <tr><td width='100px;'>Jumlah Kursi</td><td> : <input type=text name='kursi' value='$r[kursi]' width='300px;'></td></tr>
          <tr><td width='100px;'>No Telpon</td><td> : <input type=text name='no_telpon' value='$r[no_telpon]' style='width:300px;'></td></tr>
          <tr><td width='100px;'>Alamat Studio</td><td> : <textarea name='alamat_studio' style='width: 480px; height: 70px;'>$r[alamat_studio]</textarea></td></tr>
          <tr><td colspan=2><br/><br/><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
?>
