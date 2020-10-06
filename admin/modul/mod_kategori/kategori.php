<?php
$aksi="modul/mod_kategori/aksi_kategori.php";
switch($_GET[act]){
  // Tampil Kategori
  default:
    echo "<div class='post_title'><b>Manajemen Kategori Movie.</b></div><br/>
          <input type=button value='Tambah Kategori' 
          onclick=\"window.location.href='?module=kategori&act=tambahkategori';\">
          <table width=100% cellpadding=6>
          <tr style='color:#fff; height:35px;' bgcolor=#000><th>No</th><th>Nama Kategori</th><th align='center' width='90px;'>Action</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM kategori ORDER BY id_kategori DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
	if(($no % 2)==0){
			$warna="#ffffff";
		  }
		  // Apabila sisa baginya ganjil, maka warnanya kuning (#FFFF00). 
		  else{
			$warna="#E1E1E1";
		  }
       echo "<tr bgcolor=$warna><td>$no</td>
             <td>$r[nama_kategori]</td>
             <td><a href=?module=kategori&act=editkategori&id=$r[id_kategori]>Edit</a> | 
	               <a href=$aksi?module=kategori&act=hapus&id=$r[id_kategori]>Hapus</a>
             </td></tr>";
      $no++;
    }
    echo "</table>";
    break;
  
  // Form Tambah Kategori
  case "tambahkategori":
    echo "<div class='post_title'><b>Tambah Kategori Movie.</b></div><br/>
          <form method=POST action='$aksi?module=kategori&act=input'>
          <table>
          <tr><td>Nama Kategori</td><td> : <input type=text name='nama_kategori'></td></tr>
          <tr><td colspan=2><input type=submit name=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
  
  // Form Edit Kategori  
  case "editkategori":
    $edit=mysql_query("SELECT * FROM kategori WHERE id_kategori='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<div class='post_title'><b>Edit Kategori Movie.</b></div><br/>
          <form method=POST action=$aksi?module=kategori&act=update>
          <input type=hidden name=id value='$r[id_kategori]'>
          <table>
          <tr><td>Nama Kategori</td><td> : <input type=text name='nama_kategori' value='$r[nama_kategori]'></td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
?>
