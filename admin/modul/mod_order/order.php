<?php
$aksi="modul/mod_order/aksi_order.php";
switch($_GET[act]){
  // Tampil Order
  default:
    echo "<div class='post_title'><b>Daftar semua pemesanan tiket oleh members.</b></div><br/>
		 <div class='h_line'></div>
          <table cellpadding=6 width=100%>
          <tr style='color:#fff; height:38px;' bgcolor=#000><th>Judul Film</th><th>Jadwal Tayang</th><th>Status</th><th align='center'>Action</th></tr>";

    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);

    $tampil = mysql_query("SELECT * FROM laporan left join movie on laporan.id_movie=movie.id_movie 
													left join jam on laporan.id_jam=jam.id_jam 
														left join users on laporan.username=users.username ORDER BY id_orders DESC LIMIT $posisi,$batas");
  
    while($r=mysql_fetch_array($tampil)){
      $tanggal=tgl_indo($r[tanggal_tayang]);
	  if(($no % 2)==0){
		$warna="#ffffff";
	  }else{
		$warna="#ffffff";
	  }
      echo "<tr bgcolor=$warna>
                <td>$r[judul]</td>
                <td>$tanggal, $r[jam] WIB</td>
                <td><a title='$r[nama_lengkap], Bangku No $r[bangku]' href='#'>$r[status_pesanan]</a></td>
				<td><center><input type=button value='Detail' onclick=\"window.location.href='?module=order&act=detailorder&id=$r[id_orders]';\">";
					echo "<input style='width:80px;' type=button value='Cetak' onclick=\"window.location.href='print.php?id=$r[id_orders]';\">";
				echo "</center></td></tr>";
      $no++;
    }
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM laporan"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "</table>";
    echo "<br/>Halaman: $linkHalaman<br>";

    break;
  
    
  case "detailorder":
$query = mysql_query("SELECT * FROM laporan left join movie on laporan.id_movie=movie.id_movie
													 left join jam on laporan.id_jam=jam.id_jam 
														left join studio on movie.id_studio=studio.id_studio 
															left join users on laporan.username=users.username
																where laporan.id_orders=$_GET[id]");
$r=mysql_fetch_array($query);

$harga = format_rupiah($r[harga_tiket]);
$tanggal = tgl_indo($r[tanggal_tayang]);
$total = $r[harga_tiket] * $r[jumlah_tiket];
$total_rp= format_rupiah($total);

echo "<div class='post_title'><b>Detail Pemesanan Tiket untuk Film : $r[judul].</b></div><br/>";
echo "<table style='margin-bottom:7%;' width='100%'><br/>
          <tr><td width='15%'>Nama Pemesan</td>     	<td> : &nbsp;<input type=text name='judul' value='$r[nama_lengkap]' size=49 class='input3' readonly='on'></td></tr>
		  <tr><td>Email</td>     	<td> : &nbsp;<input type=text name='judul' value='$r[email]' size=49 class='input3' readonly='on'></td></tr>
		  <tr><td>No Telp</td>     	<td> : &nbsp;<input type=text name='judul' value='$r[no_telp]' size=49 class='input3' readonly='on'></td></tr>
		  <tr><td>Alamat<br/><br/><br/></td>     	<td> : &nbsp;<textarea style='width:93%; height:50px;' class='input3' readonly='on'>$r[alamat_lengkap]</textarea><br/><br/><br/></td></tr>
													 
			
		  <tr><td>Judul Film</td>     	<td> : &nbsp;<input type=text name='judul' value='$r[judul]' size=59 class='input2' readonly='on'></td></tr>
		  <tr><td>Nama Studio</td>   	<td> : &nbsp;<input type=text name='studio' value='$r[nama_studio]' size=59 class='input2' readonly='on'></td></tr>
		  <tr><td>Tanggal Tayang</td>   <td> : &nbsp;<input type=text name='tanggal' value='$tanggal' size=59 class='input2' readonly='on'></td></tr>
		  <tr><td>Jam</td>     			<td> : &nbsp;<input type=text name='tanggal' value='$r[jam]' size=59 class='input2' readonly='on'></td></tr>
		  <tr><td>Harga Tiket</td>   	<td> : &nbsp;<input type=text name='harga' value='Rp $harga' size=20 class='input2' readonly='on'> / Tiket</td></tr>
		  <tr><td>Status Pesanan</td>   	<td> : &nbsp;<input type=text name='jumlah_tiket' size=20 value='$r[status_pesanan]' class='input2' readonly='on'></td></tr>
		  
	  </table>
	  <center><input style='width:200px; padding:8px;' type=button value='Hapus' onclick=\"window.location.href='$aksi?module=order&act=hapus&id=$r[id_orders]';\"></br></br></br></center>";
    break;  
}
?>
