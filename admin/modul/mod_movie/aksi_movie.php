<?php
session_start();
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";
include "../../../config/fungsi_indotgl.php";

$module=$_GET[module];
$act=$_GET[act];

$tanggal = tgl_pesan($_POST[tanggal]);
if ($module=='movie' AND $act=='hapus'){
  mysql_query("DELETE FROM movie WHERE id_movie='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

elseif ($module=='movie' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
  
  $lokasi_filee    = $_FILES['trailer']['tmp_name'];
  $tipe_filee      = $_FILES['trailer']['type'];
  $nama_filee      = $_FILES['trailer']['name'];
  $acakk           = rand(1,99);
  $nama_file_unikk = $acakk.$nama_filee;

  if (empty($lokasi_file)){
    mysql_query("INSERT INTO movie(id_kategori,
                                    id_studio,
                                    judul,
                                    detail,
                                    tanggal_tayang,
                                    produser,
                                    produksi,
                                    home_page,
                                    durasi,
                  									status,
                  									tiket,
                  									harga_tiket) 
                            VALUES('$_POST[kategori]',
                                   '$_POST[studio]',
                                   '$_POST[judul]',
                                   '$_POST[sinopsis]',
                                   '$tanggal',
                                   '$_POST[produser]',
                                   '$_POST[produksi]',
                                   '$_POST[home_page]',
                                   '$_POST[durasi]',
                								   '$_POST[status]',
                								   '$_POST[jumlah]',
                								   '$_POST[harga]')");
  }
  else {
    UploadImage($nama_file_unik);
	UploadVideo($nama_file_unikk);
    mysql_query("INSERT INTO movie(id_kategori,
                                    id_studio,
                                    judul,
                                    detail,
                                    tanggal_tayang,
                  									gambar,
                  									trailer,
                                    produser,
                                    produksi,
                                    home_page,
                                    durasi,
                  									status,
                  									tiket,
                  									harga_tiket) 
                            VALUES('$_POST[kategori]',
                                   '$_POST[studio]',
                                   '$_POST[judul]',
                                   '$_POST[sinopsis]',
                                   '$tanggal',
								                   '$nama_file_unik',
                                   '$nama_file_unikk',
                                   '$_POST[produser]',
                                   '$_POST[produksi]',
                                   '$_POST[home_page]',
                                   '$_POST[durasi]',
                								   '$_POST[status]',
                								   '$_POST[jumlah]',
                								   '$_POST[harga]')");
  }
      echo "<script>window.alert('Sukses Menambahkan Fim Baru!!!');
        window.location=('../../media.php?module=movie')</script>";
}

elseif ($module=='movie' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 

  $produk_seo      = seo_title($_POST[nama_produk]);

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE movie SET nama_produk       = '$_POST[judul]',
                                   id_kategori       = '$_POST[kategori]',
                                   harga             = '$_POST[harga]',
                                   stok              = '$_POST[stok]',
                                   deskripsi         = '$_POST[deskripsi]'
                             WHERE id_produk         = '$_POST[id]'");
  }
  else{
    UploadImage($nama_file_unik);
    mysql_query("UPDATE movie SET nama_produk       = '$_POST[judul]',
                                   id_kategori       = '$_POST[kategori]',
                                   harga             = '$_POST[harga]',
                                   stok              = '$_POST[stok]',
                                   deskripsi         = '$_POST[deskripsi]',
                                   gambar            = '$nama_file_unik'   
                             WHERE id_produk         = '$_POST[id]'");
  }
  header('location:../../media.php?module='.$module);
}
?>
