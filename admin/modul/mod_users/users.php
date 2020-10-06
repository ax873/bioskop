<?php
  $aksi="modul/mod_users/aksi_users.php";
switch($_GET[act]){
  // Tampil User
  default:
    if ($_SESSION[leveluser]=='admin'){
      $tampil = mysql_query("SELECT * FROM users ORDER BY username");
      echo "<div class='post_title'><b>Manajemen User.</b></div><br/>";
    }
    else{
      $tampil=mysql_query("SELECT * FROM users 
                           WHERE username='$_SESSION[namauser]'");
      echo "<h2>User</h2>";
    }
    
    echo "<table width=100% cellpadding='7'>
          <tr style='color:#fff; height:35px;' bgcolor=#000><th>No</th><th>Username</th><th>Nama Lengkap</th><th>No.Telp/HP</th><th>Level</th><th align='center'>Action</th></tr>"; 
    $no=1;
	
    while ($r=mysql_fetch_array($tampil)){
	if(($no % 2)==0){
    $warna="#ffffff";
  }
  // Apabila sisa baginya ganjil, maka warnanya kuning (#FFFF00). 
  else{
    $warna="#fff";
  }
       if ($r[level] == 'admin'){
	   echo "<tr bgcolor=#E1E1E1 style='color:blue;'>";
	   }else{
	   echo "<tr bgcolor=$warna>";
	   }
			echo " <td>$no</td>
             <td>$r[username]</td>
             <td><a title='$r[email]' href=mailto:$r[email]>$r[nama_lengkap]</a></td>
		         <td>$r[no_telp]</td>
				 <td>$r[level]</td>
             <td><a href=?module=user&act=edituser&id=$r[username]>Edit</a></td></tr>";
      $no++;
    }
    echo "</table>";
    break;
    
  case "edituser":
    $edit=mysql_query("SELECT * FROM users WHERE username='$_GET[id]'");
    $r=mysql_fetch_array($edit);
    echo "<div class='post_title'><b>Edit User.</b></div><br/>
		 <div class='h_line'></div>
          <form method=POST action=$aksi?module=user&act=update>
          <input type=hidden name=id value='$r[username]'>
          <table width='100%'>
          <tr><td>Username</td>     <td> : <input type=text name='username' value='$r[username]' disabled> **)</td></tr>
          <tr><td>Password</td>     <td> : <input type=text name='password'> *) </td></tr>
          <tr><td>Nama Lengkap</td> <td> : <input type=text name='nama_lengkap' size=30  value='$r[nama_lengkap]'></td></tr>
          <tr><td>E-mail</td>       <td> : <input type=text name='email' size=30 value='$r[email]'></td></tr>
          <tr><td>No.Telp/HP</td>   <td> : <input type=text name='no_telp' size=30 value='$r[no_telp]'></td></tr>
          <tr><td width='100px;'>Alamat Lengkap</td><td> : <textarea name='alamat_lengkap' style='width: 480px; height: 70px;'>$r[alamat_lengkap]</textarea></td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";     
  
    break;  
}

?>
