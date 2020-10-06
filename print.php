<?php 
  session_start();
  error_reporting(0);
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

</style>
<body onload="window.print()">
<?php 
  include "config/koneksi.php";
  include "config/fungsi_indotgl.php";
  include "config/class_paging.php";
  include "config/library.php";
  include "config/fungsi_rupiah.php";
$query = mysql_query("SELECT * FROM laporan left join movie on laporan.id_movie=movie.id_movie
													 left join jam on laporan.id_jam=jam.id_jam 
														left join studio on movie.id_studio=studio.id_studio 
															where laporan.id_orders=$_GET[id]");
$r=mysql_fetch_array($query);

$harga = format_rupiah($r[harga_tiket]);
$tanggal = tgl_indo($r[tanggal_tayang]);
$total = $r[harga_tiket] * $r[jumlah_tiket];
$total_rp= format_rupiah($total);

echo "<center><h2>TIKET MASUK BIOSKOP 21 <br> <b style='text-transform:uppercase;'>$r[nama_studio]</b></h2></center><hr/>";			
echo "<table width='100%'><br/>
          <tr><td width='120px'>Nama Pemesan</td>     	<td> : &nbsp;$_SESSION[namalengkap]</td></tr>
		  <tr><td>No Telp</td>     	<td> : &nbsp;$_SESSION[telp]</td></tr>
		  <tr><td>Judul Film</td>     	<td> : &nbsp;$r[judul]</td></tr>
		  <tr><td>Tanggal Tayang</td>   <td> : &nbsp;$tanggal, $r[jam]</td></tr>
		  <tr><td>Harga Tiket</td>   	<td> : &nbsp;Rp $harga / Tiket</td></tr>
		  <tr><td>Kursi</td>   	<td> : &nbsp;No. $r[bangku]</td></tr>
	  </table><hr>
	  <center>Selamat Menikmati Film Kesayangan anda..<br>
	  		  Bioskop 21</center>";	

?>