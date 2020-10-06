<?php
$aksi="modul/mod_movie/aksi_movie.php";
switch($_GET[act]){
  default:
echo "<div class='post_title'><b>List atau Daftar semua Film.</b> <input style='float:right;' type=button value='Tambah Film Baru' onclick=\"window.location.href='?module=movie&act=tambahmovie';\"></div><br/>";
  $col = 2;
  $p      = new Paging;
  $batas  = 4;
  $posisi = $p->cariPosisi($batas);
$query = mysql_query("SELECT * FROM movie ORDER BY id_movie DESC LIMIT $posisi,$batas");
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
	echo "<center><td align=center valign=top>
					$r[judul] - ($r[tiket] tiket)
					<video style='background:#000' width='294' height='140px' controls>
						<source src='../trailer/$r[trailer]' type='video/mp4'>
						Your browser does not support the video tag.
					</video>
					<a href=?module=movie&act=editmovie&id=$r[id_movie]>Lihat Detail</a> | 
		                <a href=$aksi?module=movie&act=hapus&id=$r[id_movie]>Hapus</a>
			</td></center>";
}
	  echo "</tr></table>";
	  
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM movie"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<br/>Halaman : $linkHalaman<br />";	  
}
    break;
  
  case "tambahmovie":
    echo "<div class='post_title'><b>Tambah Film Terbaru.</b></div><br/>
          <form method=POST action='$aksi?module=movie&act=input' enctype='multipart/form-data'>
          <table>
          <tr><td width=70>Judul Film</td>     <td> : <input type=text name='judul' size=60></td></tr>
          <tr><td>Kategori</td>  <td> : 
          <select name='kategori'>
            <option value=0 selected>- Pilih Kategori FIlm -</option>";
            $tampil=mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[id_kategori]>$r[nama_kategori]</option>";
            }
    echo "</select></td></tr>
		  <tr><td>Studio</td>  <td> : 
          <select name='studio'>
            <option value=0 selected>- Pilih Studio -</option>";
            $tampil=mysql_query("SELECT * FROM studio ORDER BY nama_studio");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[id_studio]>$r[nama_studio]</option>";
            }
    echo "</select></td></tr>
          <tr><td>Harga Tiket</td>     <td> : <input type=text name='harga' size=20></td></tr>
		      <tr><td>Jmlah Tiket</td>     <td> : <input type=text name='jumlah' size=20></td></tr>
          <tr><td>Tgl Tayang</td>     <td> : <input type=text value='$tgl_sekarang2' name='tanggal' size=20></td></tr>
          <tr><td>Produser</td>     <td> : <input type=text name='produser' size=60></td></tr>
          <tr><td>Produksi</td>     <td> : <input type=text name='produksi' size=60></td></tr>
          <tr><td>Home Page</td>     <td> : <input type=text name='home_page' size=60></td></tr>
          <tr><td>Durasi</td>     <td> : <input type=text name='durasi' size=10> Menit</td></tr>
          
          <tr><td>Sinopsis</td>  <td> : <textarea name='sinopsis' style='width: 510px; height: 70px;'></textarea>
		      <tr><td>Trailer</td>     <td> : <input type='file' name='trailer' size=60 style='width:98%'></td></tr>
          <tr><td>Gambar</td>      <td> : <input type=file name='fupload' size=40></td></tr>
		      <tr><td>Status</td>  <td> : 
          <select name='status'>
            <option value=0 selected>- Pilih Status -</option>
            <option value='now'>Now Playing</option>
			<option value='coming_soon'>Coming Soon</option>
           </select></td></tr>
          <tr><td colspan=2><br/><input style='float:right;' type=button value=Batal onclick=self.history.back()>
							<input style='float:right;' type=submit value=Simpan></td></tr>
          </table></form>";
     break;
    
  case "editmovie":
    $edit = mysql_query("SELECT * FROM movie left join kategori on movie.id_kategori=kategori.id_kategori
												left join studio on movie.id_studio=studio.id_studio 
													WHERE id_movie='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<div class='post_title'><b>Lihat Detail Film.</b></div><br/>
          <table>
          <tr><td width120>Judul Film</td>     <td> : <input type=text name='judul' value='$r[judul]' size=60></td></tr>
          <tr><td>Kategori</td>     <td> : <input type=text name='harga' value='$r[nama_kategori]' size=20></td></tr>
		      <tr><td>Studio</td>     <td> : <input type=text name='harga' value='$r[nama_studio]' size=20></td></tr>
          <tr><td>Harga Tiket</td>     <td> : <input type=text name='harga' value='$r[harga_tiket]' size=20></td></tr>
		      <tr><td>Jmlah Tiket</td>     <td> : <input type=text name='jumlah' value='$r[tiket] Tiket' size=20></td></tr>
          <tr><td>Tgl Tayang</td>     <td> : <input type=text value='$r[tanggal_tayang]' name='tanggal' size=20></td></tr>
          <tr><td>Produser</td>     <td> : <input type=text name='judul' value='$r[produser]' size=60></td></tr>
          <tr><td>Produksi</td>     <td> : <input type=text name='judul' value='$r[produksi]' size=60></td></tr>
          <tr><td>Home Page</td>     <td> : <input type=text name='judul' value='$r[home_page]' size=60></td></tr>
          <tr><td>Durasi</td>     <td> : <input type=text name='judul' value='$r[durasi]' size=10> Menit</td></tr>
          <tr><td>Sinopsis</td>  <td> : <textarea name='sinopsis' style='width: 490px; height: 150px;'>$r[detail]</textarea>
		  <tr><td>Status</td>  <td> : <input type=text value='$r[status]' name='tanggal' size=20></td></tr>
		  <tr><td>Cover / Trailer </td>     <td>   <img style='margin-left:11px; margin-right:4px; float:left; width:120px; height:155px;' src='../foto_berita/$r[gambar]'>
											<video width='310' controls>
												<source src='../trailer/$r[trailer]' type='video/mp4'>
												Your browser does not support the video tag.
											</video>
		  </td></tr>
		  
          </table>";
    break;  
}
?>
