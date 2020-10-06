<?php
$aksi="modul/mod_rekening/aksi_rekening.php";
switch($_GET[act]){

  default:
    echo "<div class='post_title'><b>Manajemen rekening Perusahaan.</b></div><br/>
          <input type=button value='Tambah Rekening' 
          onclick=\"window.location.href='?module=rekening&act=tambahrekening';\">
          <table width=100% cellpadding=6>
          <tr style='color:#fff; height:35px;' bgcolor=#000><th>No</th><th>No Rekening</th><th>Atas Nama</th><th>nama Bank</th><th>Aksi</th></tr>"; 
    $tampil=mysql_query("SELECT * FROM rekening ORDER BY id_rekening DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
	   if(($no % 2)==0){
			$warna="#ffffff";
		  }
		  else{
			$warna="#fff";
		  }
       echo "<tr bgcolor=$warna><td>$no</td>
             <td>$r[no_rekening]</td>
             <td>$r[atas_namaa]</td>
			 <td>$r[nama_bankk]</td>
             <td width='16%'><a href=$aksi?module=rekening&act=hapus&id=$r[id_rekening]>Hapus</a>
             </td></tr>";
      $no++;
    }
    echo "</table>";
    break;
  
  case "tambahrekening":
    echo "<div class='post_title'><b>Tambah Rekening Perusahaan.</b></div><br/>
          <form method=POST action='$aksi?module=rekening&act=input'>
          <table width='100%'>
          <tr><td>NO Rekening</td><td> : <input type=text name='a' style='width:50%'></td></tr>
          <tr><td>Atas Nama</td><td> : <input type=text name='b' style='width:70%'></td></tr>
		  <tr><td>Nama Bank</td><td> : <input type=text name='c' style='width:70%'></td></tr>
          <tr><td colspan=2><br/><input type=submit name=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
}
?>
