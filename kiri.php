<?php
if ($_GET[module]=='home'){
  $p      = new Paging;
  $batas  = 2;
  $posisi = $p->cariPosisi($batas);

	$query = mysql_query("SELECT * FROM movie left join kategori on movie.id_kategori=kategori.id_kategori ORDER BY id_movie DESC LIMIT $posisi,$batas");
	$ada = mysql_num_rows($query);
  	$cnt = 0;
	while ($r=mysql_fetch_array($query)){
		$harga = format_rupiah($r[harga_tiket]);
		$tanggal = tgl_indo($r[tanggal_tayang]);
		$total = $r[harga_tiket] * $r[jumlah_tiket];
		$total_rp= format_rupiah($total);

			$isi_berita =(strip_tags($r[detail])); 
			$isi = substr($isi_berita,0,150); 
			$isi = substr($isi_berita,0,strrpos($isi," ")); 

		echo "<div class='post_title'><b><a href='lihat-detail-$r[id_movie].html'>$r[judul]</a></b></div>";
			  	if ($r[gambar]==''){
					echo "<td align=center valign=top><br /><a href='lihat-detail-$r[id_movie].html'>
						  <img style='float:left' title='$r[judul]' class='movie' src='foto_berita/movie.jpg' width='137' height='175px'/></a></td>";
				}else{
					echo "<td align=center valign=top><br /><a href='lihat-detail-$r[id_movie].html'>
						  <img style='float:left' title='$r[judul]' class='movie' src='foto_berita/$r[gambar]' width='137' height='175px'/></a></td>";
				}
				echo "<table>
		          <tr><td width='90px'><b>Jenis Film</b></td>  <td>:</td> <td> <a style='color:red' href='detail-kategori-$r[id_kategori].html'>$r[nama_kategori]</a></td></tr>
				  <tr><td valign=top><b>Produser</b></td> <td>:</td>  	 <td style='color:red'> $r[produser]</td></tr>  
				  <tr><td valign=top><b>Produksi</b></td> <td>:</td>  	 <td style='color:red'> $r[produksi]</td></tr>  
				  <tr><td valign=top><b>Home Page</b></td> <td>:</td>  	 <td style='color:red'> $r[home_page]</td></tr>  
				  <tr><td><b>Durasi</b></td> <td>:</td>  	 <td style='color:red'> $r[durasi] Menit</td></tr>  
				  <tr><td valign=top><b>Sinopsis</b></td> <td>:</td>  	 <td style='color:red'> $isi... <a href='lihat-detail-$r[id_movie].html'> [Selengkapnya]</a></td></tr>  
			  	</table>
			  	<div style='clear:both'></div>";
	}
	  
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM movie where status='now'"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<br/>Halaman : $linkHalaman<br />";	  
}

elseif ($_GET[module]=='gantipassword'){
	if (isset($_POST[pass])){
		$e=mysql_fetch_array(mysql_query("SELECT * FROM users WHERE username='$_SESSION[namauser]'"));

		$lama = md5($_POST[a]);
		if ($lama != $e[password]){
			echo "<script>window.alert('Maaf, Inputan Password Lama anda Salah.');
        			window.location=('ganti-password.html')</script>";
		}elseif ($_POST[b] != $_POST[c]){
			echo "<script>window.alert('Maaf, Password Baru dan Konf Password Tidak Sama.');
        			window.location=('ganti-password.html')</script>";
		}else{
			$passwords = md5($_POST[b]);
			mysql_query("UPDATE users SET password='$passwords' where username = '$_SESSION[namauser]'");
			echo "<script>window.alert('Sukses, Ganti Password...');
        			window.location=('ganti-password.html')</script>";
		}

	}
	    echo "<div class='post_title'><b>Edit User.</b></div><br/>
			 <div class='h_line'></div>
	          <form  style='margin-bottom:30%' method=POST action=''>
	          <table width='100%'>
	          <tr><td>Password Lama</td>     <td> : <input type=text name='a'> *) </td></tr>
			  <tr><td>Password Baru</td>     <td> : <input type=text name='b'> *) </td></tr>
			  <tr><td>Konf. Password</td>     <td> : <input type=text name='c'> *) </td></tr>
	          <tr><td colspan=2><br><br><input type=submit value='Ganti Password' name='pass'>
	                            <input type=button value=Batal onclick=self.history.back()></td></tr>
	          </table></form>";  
}

elseif ($_GET[module]=='kelolaprofile'){
	if (isset($_POST[update])){
		    mysql_query("UPDATE users SET nama_lengkap   = '$_POST[nama_lengkap]',
		                                  email          = '$_POST[email]',
		                                  no_telp        = '$_POST[no_telp]',  
		                                  alamat_lengkap = '$_POST[alamat_lengkap]'
		                           WHERE  username     = '$_POST[id]'");

		  echo "<script>window.alert('Sukses Update Data Profile.');
        			window.location=('kelola-profile.html')</script>";
	}

    $edit=mysql_query("SELECT * FROM users WHERE username='$_SESSION[namauser]'");
    $r=mysql_fetch_array($edit);
    echo "<div class='post_title'><b>Edit Data Anda</b></div><br/>
		 <div class='h_line'></div>
          <form style='margin-bottom:20%' method=POST action=''>
          <input type=hidden name=id value='$r[username]'>
          <table width='100%'>
          <tr><td width='120px'>Username</td>     <td> : <input type=text name='username' value='$r[username]' disabled> **)</td></tr>
          <tr><td>Nama Lengkap</td> <td> : <input type=text name='nama_lengkap' size=30  value='$r[nama_lengkap]'></td></tr>
          <tr><td>E-mail</td>       <td> : <input type=text name='email' size=30 value='$r[email]'></td></tr>
          <tr><td>No.Telp/HP</td>   <td> : <input type=text name='no_telp' size=30 value='$r[no_telp]'></td></tr>
          <tr><td width='100px;'>Alamat Lengkap</td><td> : <textarea name='alamat_lengkap' style='width: 450px; height: 70px;'>$r[alamat_lengkap]</textarea></td></tr>
          <tr><td colspan=2><input type=submit value=Update name='update'>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";  
}

elseif ($_GET[module]=='about'){
  $sql=mysql_query("SELECT * FROM statis WHERE halaman='about'");
  $r=mysql_fetch_array($sql);
    echo "<div class='post_title'>$r[judul]</div>
          <div class='text_area'>".nl2br($r[detail])."</div>";      
}

elseif ($_GET[module]=='help'){
  $sql=mysql_query("SELECT * FROM statis WHERE halaman='help'");
  $r=mysql_fetch_array($sql);
    echo "<div class='post_title'>$r[judul]</div>
          <div class='text_area'>".nl2br($r[detail])."</div>";      
}

elseif ($_GET[module]=='theater'){
  echo "<div class='post_title'>Lokasi Detail Theater</div><br>
  		<table cellpadding=5 border=1 width=100%>
  			<tr bgcolor=#fff>
  			<th>No</th>
  			<th>Nama Studio</th>
  			<th>No Telpon</th>
  			<th>Alamat Lengkap</th>
  			</tr>";
  $sql=mysql_query("SELECT * FROM studio ORDER BY id_studio");
  $no = 1;
  while ($r = mysql_fetch_array($sql)){
  		echo "<tr>
  				  <td>$no</td>
  				  <td>$r[nama_studio]</td>
  				  <td>$r[no_telpon]</td>
  				  <td>$r[alamat_studio]</td>
  			  </tr>";
  		$no++;
  }
  echo "</tr></table><br>";
}

elseif ($_GET[module]=='now'){
echo "<div class='post_title'><b>List atau Daftar Film yang akan di Putar.</b></div><br/>";
  $col = 2;
  $p      = new Paging;
  $batas  = 6;
  $posisi = $p->cariPosisi($batas);
$query = mysql_query("SELECT * FROM movie where status='now' ORDER BY id_movie DESC LIMIT $posisi,$batas");
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
	echo "<center><td align=center valign=top><span style='color:red'>$r[judul]</span><br/>
					<video style='background:#000' width='294' height='140px' controls>
						<source src='trailer/$r[trailer]' type='video/mp4'>
						Your browser does not support the video tag.
					</video>";
						if ($_SESSION[leveluser]=='members'){ 
							echo "<input style='width:100px;' type=button value='Pesan Tiket' onclick=\"window.location.href='pesan-tiket-$r[id_movie].html';\">";
						}
							echo "<input style='width:100px;' type=button value='Lihat Detail' onclick=\"window.location.href='lihat-detail-$r[id_movie].html';\"><hr>
			</td></center>";
}
	  echo "</tr></table>";
	  
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM movie where status='now'"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<br/>Halaman : $linkHalaman<br />";	  
}
}

elseif ($_GET[module]=='comingsoon'){
echo "<div class='post_title'><b>List atau Daftar Film yang akan Release.</b></div><br/>";
  $col = 2;
  $p      = new Paging;
  $batas  = 6;
  $posisi = $p->cariPosisi($batas);
$query = mysql_query("SELECT * FROM movie where status='coming_soon' ORDER BY id_movie DESC LIMIT $posisi,$batas");
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
	echo "<center><td align=center valign=top><span style='color:red'>$r[judul]</span><br/>
					<video style='background:#000' width='294' height='140px' controls>
						<source src='trailer/$r[trailer]' type='video/mp4'>
						Your browser does not support the video tag.
					</video>";
						if ($_SESSION[leveluser]=='members'){ 
							echo "<input style='width:100px;' type=button value='Pesan Tiket' onclick=\"window.location.href='pesan-tiket-$r[id_movie].html';\">";
						}
							echo "<input style='width:100px;' type=button value='Lihat Detail' onclick=\"window.location.href='lihat-detail-$r[id_movie].html';\"><hr>
			</td></center>";
}
	  echo "</tr></table>";
	  
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM movie where status='coming_soon'"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<br/>Halaman : $linkHalaman<br />";	  
}
}

elseif ($_GET[module]=='detailkategori'){
echo "<div class='post_title'><b>List atau Daftar Film yang akan Release.</b></div><br/>";
  $col = 2;
  $p      = new Paging;
  $batas  = 6;
  $posisi = $p->cariPosisi($batas);
$query = mysql_query("SELECT * FROM movie where id_kategori=$_GET[id] ORDER BY id_movie DESC LIMIT $posisi,$batas");
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
	echo "<center><td align=center valign=top><video width='294' controls>
						<source src='trailer/$r[trailer]' type='video/mp4'>
						Your browser does not support the video tag.
					</video>
					<input style='width:100px;' type=button value='Lihat Detail' onclick=\"window.location.href='lihat-detail-$r[id_movie].html';\">
			</td></center>";
}
	  echo "</tr></table>";
	  
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM movie where id_kategori=$_GET[id]"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<br/>Halaman : $linkHalaman<br />";	  
  }
  else{
    echo "<p style='margin-bottom:65%; margin-top:15%;'align=center>Belum ada Film pada kategori ini.</p>";
  }
}

elseif ($_GET[module]=='detailfilm'){
$query = mysql_query("SELECT * FROM movie left join kategori on movie.id_kategori=kategori.id_kategori where id_movie=$_GET[id]");
$r=mysql_fetch_array($query);
$harga = format_rupiah($r[harga_tiket]);
$tanggal = tgl_indo($r[tanggal_tayang]);
$total = $r[harga_tiket] * $r[jumlah_tiket];
$total_rp= format_rupiah($total);

echo "<div class='post_title'><b>Film $r[judul]</b></div><br/>
					<video style='margin-left:10px;' width='582' controls>
						<source src='trailer/$r[trailer]' type='video/mp4'>
						Your browser does not support the video tag.
					</video><br/>";

echo "<table width='100%'><br/>
          <tr><td width='20%'><b>Judul Film</b></td> <td>:</td><td style='color:red'> $r[judul]</td></tr>
		  <tr><td><b>Kategori Film</b></td>  <td>:</td>  			 <td> <a style='color:blue' href='detail-kategori-$r[id_kategori].html'>$r[nama_kategori]</a></td></tr>
		  <tr><td><b>Tanggal Tayang</b></td> <td>:</td>  	 <td style='color:blue'> $tanggal</td></tr>  
		  <tr><td><b>Harga Tiket</b></td> <td>:</td>  	 <td style='color:blue'> Rp $harga</td></tr>  
		  		  <tr><td valign=top><b>Produser</b></td> <td>:</td>  	 <td style='color:red'> $r[produser]</td></tr>  
				  <tr><td valign=top><b>Produksi</b></td> <td>:</td>  	 <td style='color:red'> $r[produksi]</td></tr>  
				  <tr><td valign=top><b>Home Page</b></td> <td>:</td>  	 <td style='color:red'> $r[home_page]</td></tr>  
				  <tr><td><b>Durasi</b></td> <td>:</td>  	 <td style='color:red'> $r[durasi] Menit</td></tr>  
		  <tr><td valign=top><b>Sinopsis</b></td>  <td>:</td>  			 <td> $r[detail]<br/><br/></td></tr>
	  </table>";
	if ($_SESSION[leveluser]=='members'){ 
		echo "<input style='width:100px;' type=button value='Pesan Tiket' onclick=\"window.location.href='pesan-tiket-$r[id_movie].html';\">";
	}	
}

// Modul daftar Customer
elseif ($_GET[module]=='daftar'){
echo "<div class='post_title'><b>Form Registrasi Customers.</b></div>
			 <div class='h_line'></div>

		  <p>Silahkan Mengisi Formulir pendaftaran Berikut dengan data yang sebenarnya karena data-data yang anda isikan akan berguna unutk melakukan proses pemesanan Tiket. Terima kasih,..</p>
          <form method=POST name='formku' onSubmit='return valid()' action='aksi_daftar.php'>
          <table style='border:none;' width='100%'><br/>
          <tr><td>Username</td>     	<td> : &nbsp;<input type=text name='username' size=25 class='input'></td></tr>
          <tr><td>Password</td>     	<td> : &nbsp;<input type='password' name='password' size=25 class='input'></td></tr>
          <tr><td>Nama Lengkap</td> 	<td> : &nbsp;<input type=text name='nama_lengkap' size=55 class='input'></td></tr>  
		  <tr><td>E-mail</td>       	<td> : &nbsp;<input type=text name='email' size=55 class='input'></td></tr>
          <tr><td>No.Telp/HP</td>   	<td> : &nbsp;<input type=text name='no_telp' size=35 class='input'></td></tr>
          <tr><td>Alamat Lengkap</td> 	<td> <span style='color:#fff;'>:</span> &nbsp;<textarea name='alamat_lengkap' style='width: 93%; height: 70px;' class='input'></textarea></td></tr> 

          <tr><td></td><td style='float:right;'><input type=submit value='Mendaftar' class='submit'>
          <input type=button value=Batal onclick=self.history.back() class='submit'><br/><br/><br/></td>
          </table></pad></form><br/>";
}

// Modul profil
elseif ($_GET[module]=='profilkami'){
   $sql=mysql_query("SELECT * FROM statis WHERE halaman='profil'");
  echo "<table><tr>";
  $r=mysql_fetch_array($sql);
    echo "
				<div class='post_title'>$r[judul]</div>
				<div class='text_area'>$r[detail]</div>";
	echo "</tr></table><br />";
}














elseif ($_GET[module]=='pesantiket'){
$query = mysql_query("SELECT * FROM movie left join studio on movie.id_studio=studio.id_studio where id_movie='$_GET[id]'");
$r=mysql_fetch_array($query);
$harga = format_rupiah($r[harga_tiket]);
$tanggal = tgl_indo($r[tanggal_tayang]);

echo "<div class='post_title'><b>Pemesanan Tiket untuk Film : $r[judul].</b></div><br/>";
echo "<form method=POST action='cek-pesan-tiket.html' enctype='multipart/form-data'>
          <table style='margin-bottom:45%;' width='100%'>
												<input type=hidden name='id_movie' value='$r[id_movie]'>
		  <tr><td width='120px'>Judul Film</td>     	<td> : &nbsp;<input type=text name='judul' value='$r[judul]' size=49 class='input2' readonly='on'></td></tr>
		  <tr><td>Nama Studio</td>   	<td> : &nbsp;<input type=text name='studio' value='$r[nama_studio]' size=29 class='input2' readonly='on'></td></tr>
		  <tr><td>Tanggal Tayang</td>   	<td> : &nbsp;<input type=text name='tanggal' value='$tanggal' size=29 class='input2' readonly='on'></td></tr>
		  <tr><td>Harga Tiket</td>   	<td> : &nbsp;<input type=text name='harga' value='Rp $harga' size=20 class='input2' readonly='on'> / Tiket</td></tr>
		  <tr><td>Jam</td>     	<td> : &nbsp;";?>
							
			<select style='width:170px; margin-left:-4px;' name='id_jam' ONCHANGE="location = this.options[this.selectedIndex].value;"><?php
				echo "<option value='0' selected>- Pilih Jam Nonton -</option>";
			$tampil=mysql_query("SELECT * FROM jam GROUP BY jam");
			while($r=mysql_fetch_array($tampil)){
				 echo "<option value='movie-$_GET[id]-jam-$r[id_jam].html'>$r[jam]</option>";
			}
		   echo "</select></td></tr>
		  </table></form>";
}

elseif ($_GET[module]=='filterpesantiket'){
$query = mysql_query("SELECT * FROM movie left join studio on movie.id_studio=studio.id_studio where id_movie='$_GET[movie]'");
$r=mysql_fetch_array($query);
$jam = mysql_query("SELECT * FROM jam where id_jam=$_GET[jam]");
$ja=mysql_fetch_array($jam);

$jumlahh = mysql_query("SELECT * FROM laporan where id_jam='$_GET[jam]' AND id_movie='$_GET[movie]'");
$n=mysql_num_rows($jumlahh);

$harga = format_rupiah($r[harga_tiket]);
$tanggal = tgl_indo($r[tanggal_tayang]);

echo "<div class='post_title'><b>Pemesanan Tiket untuk Film : $r[judul].</b></div><br/>";
echo "<form method=POST action='cek-pesan-tiket.html' enctype='multipart/form-data'>
          <table style='margin-bottom:15%;' width='100%'>
													 <input type=hidden name='id_movie' value='$r[id_movie]'>
		  <tr><td width='120px'>Judul Film</td>     	<td> : &nbsp;<input type=text name='judul' value='$r[judul]' size=49 class='input2' readonly='on'></td></tr>
		  <tr><td>Nama Studio</td>   	<td> : &nbsp;<input type=text name='studio' value='$r[nama_studio]' size=29 class='input2' readonly='on'></td></tr>
		  <tr><td>Tanggal Tayang</td>   	<td> : &nbsp;<input type=text name='tanggal' value='$tanggal' size=29 class='input2' readonly='on'></td></tr>
		  <tr><td>Harga Tiket</td>   	<td> : &nbsp;<input type=text name='harga' value='Rp $harga' size=20 class='input2' readonly='on'> / Tiket</td></tr>
		  <tr><td>Jam</td>     	<td> : &nbsp;";?>
							
			<select style='width:170px; margin-left:-4px;' name='id_jam' ONCHANGE="location = this.options[this.selectedIndex].value;"><?php
				echo "<option value='$ja[id_jam]' selected> $ja[jam] </option>";
			$tampil=mysql_query("SELECT * FROM jam GROUP BY jam");
			while($f=mysql_fetch_array($tampil)){
				 echo "<option value='movie-$_GET[movie]-jam-$f[id_jam].html'>$f[jam]</option>";
			}
		   echo "</select></td></tr>
		  <tr><td>No bangku<br/></td>   	<td> : &nbsp;<input type=text name='bangku' value='A1' size=5 class='input2'> Dari $r[tiket] Bangku -- <input type=submit value='Cek dan Lanjut -->>'> <br/></td></tr>
          <tr><td>Sudah di isi</td> <td style='padding-left:14px;'>";
		$tampil = mysql_query("SELECT * FROM laporan where id_movie='$_GET[movie]' AND id_jam='$_GET[jam]' ORDER by bangku");
		while($b=mysql_fetch_array($tampil)){  
			  echo "<span style='margin-right:2px; padding: 0px 7px 0px 7px; background:#fff; border:1px solid #e3e3e3;'>$b[bangku]</span>";
		?>
			 <style>
					.radio<?php echo "$b[bangku]"; ?> {
						background: red !important;
					}
				</style>
		<?php
		}
			 if ($n >= $r[tiket]){
				echo " <span style='color:red'> Semua Tiket Habis. . .</span>";
			  }elseif($n == 0){
				echo "<span style='color:Green'> Semua Tiket masih tersedia untuk di Pesan. . .</span>";
			  }else{
			    echo "<span style='color:blue'> Beberapa Tiket masih tersedia. . .</span>";
			  }
			echo "</td></tr>
			   <tr bgcolor#fff><td></td>
			   		<td>
					   <div style='border:1px solid #aaa; width:410px; padding:20px; background:#fff'>
						   <center>
							   Layar Bioskop 21 <br/>
							   <span style='background:#000; border:1px;'>=================================</span>
						   </center>
						   </br></br>"; 
						   	for ($h=1;$h<=12;$h++){
						   	   $bb = ubah($h);
							   for ($x=1;$x<=16;$x++){
							   			if ($x == 8){
											 echo "<span class='radio$bb$x'>
											 <input name='posisi' type='radio' onclick=\"document.forms[0].bangku.value='$bb$x'\"></span> | &nbsp |";
										}else{
											echo "<span class='radio$bb$x'>
											 <input name='posisi' type='radio' onclick=\"document.forms[0].bangku.value='$bb$x'\"></span>";
										}
								}
							}
							echo "<br/><br/>
							<center>
								<span style='float:left;  border:1px;'>Pintu Masuk <br/> |=============|</span>
								<span style='float:right; border:1px;'>Pintu Masuk </br> |=============|</span>
							</center>
						</div>
					</td>
				</tr></table><br><br>";

			echo "</form>";
}

elseif ($_GET[module]=='cekpesantiket'){
$queryu = mysql_query("SELECT * FROM movie where id_movie='$_POST[id_movie]'");
$u=mysql_fetch_array($queryu);
$jumlahh = mysql_query("SELECT count(bangku) AS jumlah_tiket FROM laporan where id_jam='$_POST[id_jam]' AND id_movie='$_POST[id_movie]'");
$j=mysql_fetch_array($jumlahh);
$jam = mysql_query("SELECT * FROM jam where id_jam='$_POST[id_jam]'");
$ja=mysql_fetch_array($jam);
$jum = mysql_query("SELECT * FROM laporan where id_jam='$_POST[id_jam]' AND id_movie='$_POST[id_movie]' AND bangku='$_POST[bangku]'");
$bangku=mysql_num_rows($jum);

if (empty($_POST[id_jam])){
  echo "<script>window.alert('Anda Belum meilih Jam.');
				window.location='javascript:history.go(-1)'</script>";
}
elseif ($bangku >= 1){
  echo "<script>window.alert('Tiket untuk kursi no $_POST[bangku] Sudah di pesan orang lain...');
				window.location='javascript:history.go(-1)'</script>";
}
elseif ($j[jumlah_tiket] >= $u[tiket]){
  echo "<script>window.alert('Semua Tiket Untuk film $u[judul], Pada Tanggal $_POST[tanggal], jam $ja[jam] Telah Habis Terjual.');
				window.location='javascript:history.go(-1)'</script>";
}else{

$query = mysql_query("SELECT * FROM movie left join studio on movie.id_studio=studio.id_studio where id_movie='$_POST[id_movie]'");
$r=mysql_fetch_array($query);
$harga = format_rupiah($r[harga_tiket]);
$tanggal = tgl_indo($r[tanggal_tayang]);

echo "<div class='post_title'><b>Pemesanan Tiket untuk Film : $r[judul].</b></div><br/>";
echo "<form method=POST action='aksi-pesan.html' enctype='multipart/form-data'>
          <table style='margin-bottom:15%;' width='100%'><br/>
          <tr><td width='20%'>Nama Pemesan</td>     	<td> : &nbsp;<input type=text name='judul' value='$_SESSION[namalengkap]' size=29 class='input3' readonly='on'></td></tr>
		  <tr><td>Email</td>     	<td> : &nbsp;<input type=text name='judul' value='$_SESSION[email]' size=29 class='input3' readonly='on'></td></tr>
		  <tr><td>No Telp</td>     	<td> : &nbsp;<input type=text name='judul' value='$_SESSION[telp]' size=29 class='input3' readonly='on'></td></tr>
		  <tr><td>Alamat<br/><br/><br/></td>     	<td> : &nbsp;<textarea style='width:93%; height:50px;' class='input3' readonly='on'>$_SESSION[alamat]</textarea><br/><br/><br/></td></tr>
													 
													 <input type=hidden name='id_movie' value='$r[id_movie]'>
		  <tr><td>Judul Film</td>     	<td> : &nbsp;<input type=text name='judul' value='$r[judul]' size=49 class='input2' readonly='on'></td></tr>
		  <tr><td>Nama Studio</td>   	<td> : &nbsp;<input type=text name='studio' value='$r[nama_studio]' size=29 class='input2' readonly='on'></td></tr>
		  <tr><td>Tanggal Tayang</td>   	<td> : &nbsp;<input type=text name='tanggal' value='$tanggal' size=29 class='input2' readonly='on'></td></tr>
		  <tr><td>Harga Tiket</td>   	<td> : &nbsp;<input type=text name='harga' value='Rp $harga' size=20 class='input2' readonly='on'> / Tiket</td></tr>
		  <tr><td>Jam</td>     	<td> : &nbsp;<select style='margin-left:2px; width:200px;' name='id_jam'>
												<option value='$ja[id_jam]' selected>$ja[jam]</option>
											 </select></td></tr>
		  <tr><td>No bangku<br/><br/><br/></td>   	<td> : &nbsp;<input type=text name='bangku' value='$_POST[bangku]' size=5 class='input2' readonly='on'> <span style='color:green'>Tersedia untuk di pesan, . .</span><br/><br/><br/></td></tr>
		  
          <tr><td></td><td style='float:right;'><br/><center><input style='width:160px; padding:6px;' type=submit value='Selesai Pesan Tiket' class='submit'>
														<input style='width:160px; padding:6px;' type=button value='Kembali Cek' onclick=\"window.location.href='javascript:history.go(-1)';\"></center></td>
          </table></form>";
}
}

elseif ($_GET[module]=='aksipesan'){
$query = mysql_query("SELECT * FROM movie where id_movie='$_POST[id_movie]'");
$r=mysql_fetch_array($query);

$queryt = mysql_query("SELECT * FROM jam where id_jam='$_POST[id_jam]'");
$t=mysql_fetch_array($queryt);

$jumlah = mysql_query("SELECT count(bangku) AS jumlah_tiket FROM laporan where id_jam='$_POST[id_jam]' AND id_movie='$_POST[id_movie]'");
$j=mysql_fetch_array($jumlah);

if (empty($_POST[id_jam])){
  echo "<script>window.alert('Anda Belum memilih jam...');
				window.location='javascript:history.go(-1)'</script>";	
}elseif ($j[jumlah_tiket] >= $r[tiket]){
  echo "<script>window.alert('Semua Tiket Untuk film $r[judul], Pada Tanggal $_POST[tanggal], jam $t[jam] Telah Habis Terjual.');
				window.location='javascript:history.go(-1)'</script>";
}else{
$harga = $r[harga_tiket];
		$sql = mysql_query("INSERT INTO laporan (id_movie,
												 id_jam,
												 username,
												 bangku,
												 total_harga) 
										   VALUES('$_POST[id_movie]',
												'$_POST[id_jam]',
												'$_SESSION[namauser]',
												'$_POST[bangku]',
												'$harga')");
  echo "<center style='margin-top:15%; margin-bottom:55%;'><h2>Sukses Memesan 1 Tiket.<br/>
		Anda Ingin Pesan 1 Tiket lagi ??? </h2><br/>
		<input style='width:200px; padding:8px;' type=button value='Iya' onclick=\"window.location.href='pesan-tiket-$_POST[id_movie].html';\">
		<input style='width:200px; padding:8px;' type=button value='Tidak' onclick=\"window.location.href='laporan-pemesanan.html';\"></center>";	
}
}


elseif ($_GET[module]=='laporanpemesanan'){
    echo "<div class='post_title'><b>Daftar pemesanan tiket oleh : $_SESSION[namalengkap] (Members).</b> </div><br/>
		 <div class='h_line'></div>
          <table style='margin-bottom:20px' cellpadding=6 width=100%>
          <tr style='color:#fff; height:38px;' bgcolor=#000><th>Judul Film</th><th>Jadwal Tayang</th><th>Bangku</th><th>Status</th><th align='center'>Action</th></tr>";

    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);

    $tampil = mysql_query("SELECT * FROM laporan left join movie on laporan.id_movie=movie.id_movie 
													left join jam on laporan.id_jam=jam.id_jam where username='$_SESSION[namauser]' ORDER BY id_orders DESC LIMIT $posisi,$batas");
  
    while($r=mysql_fetch_array($tampil)){
      $tanggal=tgl_indo($r[tanggal_tayang]);
	  if(($no % 2)==0){
		$warna="#ffffff";
	  }else{
		$warna="#E1E1E1";
	  }
      echo "<tr bgcolor=$warna>
                <td>$r[judul]</td>
                <td>$tanggal, $r[jam] WIB</td>
				<td>No $r[bangku]</td>
                <td>$r[status_pesanan]</td>
				<td><center><input type=button value='Detail' onclick=\"window.location.href='detail-pemesanan-$r[id_orders].html';\">";
					echo "<a target='_BLANK' href='print.php?id=$r[id_orders]'><input type='button' style='width:80px' value='Cetak'></a>";
				
				echo "</center></td></tr>";
      $no++;
    }
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM laporan where username='$_SESSION[namauser]'"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "</table>";
    echo "<br/>Halaman: $linkHalaman<br>";
	}
	
elseif ($_GET[module]=='detailpemesanan'){
$query = mysql_query("SELECT * FROM laporan left join movie on laporan.id_movie=movie.id_movie
													 left join jam on laporan.id_jam=jam.id_jam 
														left join studio on movie.id_studio=studio.id_studio 
															where laporan.id_orders=$_GET[id]");
$r=mysql_fetch_array($query);

$harga = format_rupiah($r[harga_tiket]);
$tanggal = tgl_indo($r[tanggal_tayang]);
$total = $r[harga_tiket] * $r[jumlah_tiket];
$total_rp= format_rupiah($total);

echo "<div class='post_title'><b>Detail Pemesanan Tiket untuk Film : $r[judul].</b></div><br/>";
echo "<table style='margin-bottom:35%;' width='100%'><br/>
          <tr><td width='20%'>Nama Pemesan</td>     	<td> : &nbsp;<input type=text name='judul' value='$_SESSION[namalengkap]' size=29 class='input3' readonly='on'></td></tr>
		  <tr><td>Email</td>     	<td> : &nbsp;<input type=text name='judul' value='$_SESSION[email]' size=29 class='input3' readonly='on'></td></tr>
		  <tr><td>No Telp</td>     	<td> : &nbsp;<input type=text name='judul' value='$_SESSION[telp]' size=29 class='input3' readonly='on'></td></tr>
		  <tr><td>Alamat<br/><br/><br/></td>     	<td> : &nbsp;<textarea style='width:93%; height:50px;' class='input3' readonly='on'>$_SESSION[alamat]</textarea><br/><br/><br/></td></tr>
													 
			
		  <tr><td>Judul Film</td>     	<td> : &nbsp;<input type=text name='judul' value='$r[judul]' size=49 class='input2' readonly='on'></td></tr>
		  <tr><td>Nama Studio</td>   	<td> : &nbsp;<input type=text name='studio' value='$r[nama_studio]' size=49 class='input2' readonly='on'></td></tr>
		  <tr><td>Tanggal Tayang</td>   <td> : &nbsp;<input type=text name='tanggal' value='$tanggal' size=29 class='input2' readonly='on'></td></tr>
		  <tr><td>Jam</td>     			<td> : &nbsp;<input type=text name='tanggal' value='$r[jam]' size=29 class='input2' readonly='on'></td></tr>
		  <tr><td>Harga Tiket</td>   	<td> : &nbsp;<input type=text name='harga' value='Rp $harga' size=20 class='input2' readonly='on'> / Tiket</td></tr>
          <tr><td>Status Pesanan</td>   	<td> : &nbsp;<input type=text name='jumlah_tiket' size=20 value='$r[status_pesanan]' class='input2' readonly='on'></td></tr>
		  <tr><td colspan='2'><center><br/><br/></br><input style='width:160px; padding:6px;' type=button value='Kembali' onclick=\"window.location.href='javascript:history.go(-1)';\"></center></td></tr>
	  </table>";	
}

elseif ($_GET[module]=='konfirmasisemua'){
 echo "<div class='post_title'><b>Konfirmasi Pemabayaran Untuk Semua Tiket dengan Status Baru</b></div><br/>";
$query = mysql_query("SELECT * FROM laporan left join movie on laporan.id_movie=movie.id_movie
													 left join jam on laporan.id_jam=jam.id_jam 
														left join studio on movie.id_studio=studio.id_studio");
$r=mysql_fetch_array($query);

		$result = mysql_query("SELECT SUM(total_harga) AS total_harga, count(id_orders) AS jumlah, id_orders
				FROM laporan where status_pesanan='Baru' AND username='$_SESSION[namauser]'");
		$t = mysql_fetch_array($result);
		
$harga = format_rupiah($r[harga_tiket]);
$tanggal = tgl_indo($r[tanggal_tayang]);
$total = $t[total_harga];
$total_rp= format_rupiah($total);

 echo " <form action=aksi-konfirmasi.html method=POST name='formku' onSubmit='return valid()'>
        <table  style=' padding: 1em; margin-right=10px'>
        <input type=hidden name=a value='All' size=5 class='input' readonly='on'>
		<tr><td width='140px'>Total Biaya</td><td> <input type=text name=nama value='Rp $total_rp' size=20 class='input' readonly='on'> $t[jumlah] Tiket</td></tr>
        <tr><td>Nama Pemesan</td><td> <input type=text name=b value='$_SESSION[namalengkap]' size=49 class='input' readonly='on'></td></tr>
        <tr><td>Bayar Ke</td><td> <select class='input' name='c'>
					<option value=0 selected>- Pilih (Bank anda Transfer pembayaran) -</option>";
            $tampil=mysql_query("SELECT * FROM rekening ORDER BY id_rekening");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[id_rekening]>$r[nama_bankk] - A/N : $r[atas_namaa]</option>";
            }
    echo "</select></td></tr>			<input type=hidden name='jumlah' value='$t[jumlah]' size=20 class='input'>
		<tr><td>Total Bayar</td><td> <input type=text name=d size=20 class='input'></td></tr>
		<tr><td>No Rek. Anda</td><td> <input type=text name=e size=49 class='input'></td></tr>
		<tr><td>Atas Nama</td><td> <input type=text name=f size=49 class='input'></td></tr>
		<tr><td>Nama Bank</td><td> <input type=text name=g size=49 class='input'></td></tr>
        <tr><td valign=top>Pesan</td><td> <textarea name=h style='width: 105%; height: 60px;' class='input'></textarea></td></tr>
        </td><td colspan=2><input style='margin-top:40px;' type=submit name=submit value='Kirim Konfirmasi' class='submit'><br/><br/><br/></td></tr>
        </table></pad></form>";
}

elseif ($_GET[module]=='konfirmasi'){
 echo "<div class='post_title'><b>Konfirmasi Pemabayaran Untuk No Orders : $_GET[id]</b></div><br/>";
$query = mysql_query("SELECT * FROM laporan left join movie on laporan.id_movie=movie.id_movie
													 left join jam on laporan.id_jam=jam.id_jam 
														left join studio on movie.id_studio=studio.id_studio 
															where laporan.id_orders=$_GET[id]");
$r=mysql_fetch_array($query);

$harga = format_rupiah($r[harga_tiket]);
$tanggal = tgl_indo($r[tanggal_tayang]);
$total = $r[harga_tiket];
$total_rp= format_rupiah($total);

 echo " <form action=aksi-konfirmasi.html method=POST name='formku' onSubmit='return valid()'>
        <table  style=' padding: 1em; margin-right=10px'>
        <tr><td width='140px'>No Order</td><td> <input type=text name=a value='$_GET[id]' size=5 class='input' readonly='on'></td></tr>
		<tr><td width='140px'>Total Biaya</td><td> <input type=text name=nama value='Rp $total_rp' size=20 class='input' readonly='on'></td></tr>
        <tr><td>Nama Pemesan</td><td> <input type=text name=b value='$_SESSION[namalengkap]' size=49 class='input' readonly='on'></td></tr>
        <tr><td>Bayar Ke</td><td> <select class='input' name='c'>
					<option value=0 selected>- Pilih (Bank anda Transfer pembayaran) -</option>";
            $tampil=mysql_query("SELECT * FROM rekening ORDER BY id_rekening");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[id_rekening]>$r[nama_bankk] - A/N : $r[atas_namaa]</option>";
            }
    echo "</select></td></tr>
		<tr><td>Total Bayar</td><td> <input type=text name=d size=20 class='input'></td></tr>
		<tr><td>No Rek. Anda</td><td> <input type=text name=e size=29 class='input'></td></tr>
		<tr><td>Atas Nama</td><td> <input type=text name=f size=29 class='input'></td></tr>
		<tr><td>Nama Bank</td><td> <input type=text name=g size=29 class='input'></td></tr>
        <tr><td valign=top>Pesan</td><td> <textarea name=h style='width: 105%; height: 60px;' class='input'></textarea></td></tr>
        </td><td colspan=2><input style='margin-top:40px;' type=submit name=submit value='Kirim Konfirmasi' class='submit'><br/><br/><br/></td></tr>
        </table></pad></form>";
}

elseif ($_GET[module]=='aksikonfirmasi'){
if (empty($_POST[c])){
	echo "<script>window.alert('Anda belum memilih No rekening');
				window.location='javascript:history.go(-1)'</script>";	
}
elseif (empty($_POST[d])){
	echo "<script>window.alert('Anda belum mengisikan Total Bayar');
				window.location='javascript:history.go(-1)'</script>";	
}
elseif (empty($_POST[e])){
	echo "<script>window.alert('Anda belum mengisikan No Rek Anda');
				window.location='javascript:history.go(-1)'</script>";	
}
elseif (empty($_POST[f])){
	echo "<script>window.alert('Anda belum mengisikan Atas Nama');
				window.location='javascript:history.go(-1)'</script>";	
}
elseif (empty($_POST[g])){
	echo "<script>window.alert('Anda belum mengisikan Nama Bank');
				window.location='javascript:history.go(-1)'</script>";	
}else{
  mysql_query("INSERT INTO konfirmasi(id_orders,
									   id_rekening,
									   nama_pemesan,
									   total_bayar,
									   rek_anda,
									   atas_nama,
									   nama_bank,
									   pesan) 
							VALUES('$_POST[a]',
								   '$_POST[c]',
								   '$_POST[b]',
								   '$_POST[d]',
								   '$_POST[e]',
								   '$_POST[f]',
								   '$_POST[g]',
								   '$_POST[h]')");

	if ($_POST[a]=='All'){
			mysql_query("UPDATE laporan SET status_pesanan = 'Lunas' where status_pesanan = 'Baru'");						   
		echo "<script>window.alert('Terima Kasih Telah Konfirmasi Pembayaran untuk $_POST[jumlah] Tiket..');
					window.location='laporan-pemesanan.html'</script>";	
	}else{								   
			mysql_query("UPDATE laporan SET status_pesanan = 'Lunas' where id_orders='$_POST[a]'");						   
		echo "<script>window.alert('Terima Kasih Telah Konfirmasi Pembayaran..');
					window.location='laporan-pemesanan.html'</script>";	
	}
}
}

elseif ($_GET[module]=='contact'){
  echo "<div class='post_title'><b>Hubungi kami secara online dengan mengisi form dibawah ini :</b></div><br/>
		<form action=aksi-contact.html name='formku' onSubmit='return valid()' method=POST >
        <table width=99% style=' padding: 1em; margin-right=10px'>
        <tr><td>Nama</td><td> <input type=text name=nama value='$_SESSION[namalengkap]' size=68 class='input' readonly='on'></td></tr>
        <tr><td>Email</td><td> <input type=text name=email value='$_SESSION[email]' size=68 class='input' readonly='on'></td></tr>
        <tr><td>Subjek</td><td> <input type=text name=subjek size=68 class='input'></td></tr>
        <tr><td valign=top>Pesan</td><td> <textarea name=pesan style='width: 509px; height: 120px;' class='input'></textarea></td></tr>
        </td><td colspan=2><input type=submit name=submit value=Kirim class='submit'>
		<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/></td></tr>
        </table></pad></form>";
}
?>