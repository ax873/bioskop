<?php
$aksi="modul/mod_konfirmasi/aksi_konfirmasi.php";
switch($_GET[act]){
  // Tampil Konfirmasi
  default:
    echo "<div class='post_title'><b>Manajemen Konfirmasi Pembayaran.</b></div><br/>
		  <table width=100% cellpadding='8'>
          <tr style='color:#fff; height:35px;' bgcolor=#000><th>No</th><th>Id Orders</th><th>Ke Rekening</th><th>Dari Rekening</th><th>Atas Nama</th><th>Dari Bank</th><th>Aksi</th></tr>";

    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);

    $tampil=mysql_query("SELECT * FROM konfirmasi left join rekening on konfirmasi.id_rekening=rekening.id_rekening ORDER BY id_konfirmasi DESC LIMIT $posisi, $batas");

    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      $tgl=tgl_indo($r[tanggal]);
	  if(($no % 2)==0){
			$warna="#ffffff";
		  }
		  // Apabila sisa baginya ganjil, maka warnanya kuning (#FFFF00). 
		  else{
			$warna="#fff";
		  }
      echo "<tr bgcolor=$warna><td>$no</td>";
			if ($r[id_orders]=='All'){
				echo "<td><a title='$r[pesan]' style='color:blue;' href='media.php?module=order'>$r[id_orders]</a></td>";
			}else{
                echo "<td><a title='$r[pesan]' style='color:red;' href='media.php?module=order&act=detailorder&id=$r[id_orders]'>$r[id_orders]</a></td>";
			}
                echo "<td>$r[nama_bankk]</td>
				<td>$r[rek_anda]</td>
                <td>$r[atas_nama]</a></td>
				<td>$r[nama_bank]</a></td>
                <td width='70px;'><a href=$aksi?module=konfirmasi&act=hapus&id=$r[id_konfirmasi]>Hapus</a>
                </td></tr>";
    $no++;
    }
	$jmldata=mysql_num_rows(mysql_query("SELECT * FROM konfirmasi"));
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
    echo "</table></span><br/>Halaman : $linkHalaman";
   

    break;
}
?>
