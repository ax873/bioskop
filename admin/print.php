<?php 
error_reporting(0);
  session_start();
  ?>
<head>
<title>Print - Bioskop 21</title>
</head>
<style>
.input1 {
	height: 20px;
	font-size: 12px;
	padding-left: 5px;
	margin: 5px 0px 0px 5px;
	width: 97%;
	border: none;
	color: red;
}
table {
	border: 1px solid #cecece;
}
td {
	border: 1px solid #cecece;
}
</style>
<body onload="window.print()">
<?php 
  include "../config/koneksi.php";
  include "../config/fungsi_indotgl.php";
  include "../config/class_paging.php";
  include "../config/library.php";
  include "../config/fungsi_rupiah.php";

$query = mysql_query("SELECT z.*, a.*, b.*, c.*, d.nama_lengkap, d.no_telp as notelp 
												FROM laporan z left join movie a on z.id_movie=a.id_movie
													 left join jam b on z.id_jam=b.id_jam 
														left join studio c on a.id_studio=c.id_studio 
															left join users d on z.username=d.username
																where z.id_orders=$_GET[id]");
$r=mysql_fetch_array($query);
$harga = format_rupiah($r[harga_tiket]);
$tanggal = tgl_indo($r[tanggal_tayang]);
$total = $r[harga_tiket] * $r[jumlah_tiket];
$total_rp= format_rupiah($total);

echo "<center><h2>TIKET MASUK BIOSKOP 21 <br> 
	  <b style='text-transform:uppercase;'>$r[nama_studio]</b></h2></center><hr/>";			
echo "<table width='100%'><br/>
          <tr><td width='120px'>Nama Pemesan</td>     	<td> : &nbsp;$r[nama_lengkap]</td></tr>
		  <tr><td>No Telp</td>     	<td> : &nbsp;$r[notelp]</td></tr>
		  <tr><td>Judul Film</td>     	<td> : &nbsp;$r[judul]</td></tr>
		  <tr><td>Tanggal Tayang</td>   <td> : &nbsp;$tanggal, $r[jam]</td></tr>
		  <tr><td>Harga Tiket</td>   	<td> : &nbsp;Rp $harga / Tiket</td></tr>
		  <tr><td>Kursi</td>   	<td> : &nbsp;No. $r[bangku]</td></tr>
	  </table><hr>
	  <center>Selamat Menikmati Film Kesayangan anda..<br>
	  		  Bioskop 21</center>";		

?>