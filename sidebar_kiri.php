<?php
if ($_SESSION[leveluser]=='members'){
  echo "<div class='widget_kanan'><div class='subtitle'></b> Menu Members</div></div>
  		<center>
  		Selamat Datang! <br> 
  		<b style='font-size:14px' >$_SESSION[namalengkap]</b><br><br>
  		</center>
  		<a href='laporan-pemesanan.html'><button>Laporan Pemesanan</button></a>
  		<a href='kelola-profile.html'><button>Kelola Profile</button></a>
  		<a href='ganti-password.html'><button>Ganti Password</button></a>
  		<a href='logout.php'><button>Logout</button></a>";

	  echo "<div class='widget_kanan'><div class='subtitle'></b> New Movie Trailer </div></div>";
	  $col = 1;
	$query = mysql_query("SELECT * FROM movie where status='now' ORDER BY id_movie DESC LIMIT 1");
	$ada = mysql_num_rows($query);
	if ($ada > 0) {
		  echo "<table><tr>";
		  $cnt = 0;
	  while ($r=mysql_fetch_array($query)){
	  		if ($cnt >= $col) {
			  echo "</tr><tr>";
			  $cnt = 0;
			}
			$cnt++;
		echo "<td align=center valign=top>
				<center><span style='color:red'>$r[judul]</span><video width='287' controls>
							<source src='../trailer/$r[trailer]' type='video/mp4'>
							Your browser does not support the video tag.
						</video>
					<input style='width:100px;' type=button value='Pesan Tiket' onclick=\"window.location.href='pesan-tiket-$r[id_movie].html';\">
					<input style='width:100px;' type=button value='Lihat Detail' onclick=\"window.location.href='lihat-detail-$r[id_movie].html';\">
				</center>
			  </td>";
	}
		  echo "</tr></table>";
	}
}else{
  echo "<div class='widget_kanan'><div class='subtitle'></b> Login Pemesanan Tiket Online</div></div>
   <center> <table width=92% style='background:#e3e3e3; padding:20px; border:1px solid #cecece;'>
		<form method=POST name='formku' onSubmit='return valid()' action=cek_login.php>
				<td align=center><div align='center'>
					<table width='100%'>
						<tr><td><input type=text name=id_user class=input placeholder='User Id. . .' style='width:93%;'></td></tr>
								<input type=hidden name=level value='members' class=input>
						<tr><td><input type=password name=password placeholder='Password. . .' class=input style='width:93%;'></td></tr>
						<td><center>
							<input style='' type=submit value=Login class=submit> 
							<input style='' type=reset value=Ulangi class=submit> &nbsp;
							<a style='color:blue; text-decoration:underline' href='daftar.html'>Daftar?</a>
							</center></td>
					</table>
				</div></td>
			</table>
		</form>
	</center>";

	  echo "<div class='widget_kanan'><div class='subtitle'></b> New Movie Trailer </div></div>";
	  $col = 1;
	$query = mysql_query("SELECT * FROM movie where status='now' ORDER BY id_movie DESC LIMIT 1");
	$ada = mysql_num_rows($query);
	if ($ada > 0) {
		  echo "<table><tr>";
		  $cnt = 0;
	  while ($r=mysql_fetch_array($query)){
	  		if ($cnt >= $col) {
			  echo "</tr><tr>";
			  $cnt = 0;
			}
			$cnt++;
		echo "<td align=center valign=top>
				<center><span style='color:red'>$r[judul]</span>
						<video style='background:#000' width='294' height='140px' controls>
							<source src='trailer/$r[trailer]' type='video/mp4'>
							Your browser does not support the video tag.
						</video>
					<input style='width:100px;' type=button value='Lihat Detail' onclick=\"window.location.href='lihat-detail-$r[id_movie].html';\">
				</center>
			  </td>";
	}
		  echo "</tr></table>";
	}
}
?>

