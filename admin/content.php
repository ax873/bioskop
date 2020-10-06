<?php
include "../config/koneksi.php";
include "../config/library.php";
include "../config/fungsi_indotgl.php";
include "../config/class_paging.php";
include "../config/fungsi_rupiah.php";
include "../config/session_admin.php";

if ($_GET[module]=='home'){
  include "modul/mod_movie/movie.php";
}

elseif ($_GET[module]=='user'){
  include "modul/mod_users/users.php";
}
elseif ($_GET[module]=='rekening'){
  include "modul/mod_rekening/rekening.php";
}

elseif ($_GET[module]=='kategori'){
  include "modul/mod_kategori/kategori.php";
}

elseif ($_GET[module]=='jam'){
  include "modul/mod_jam/jam.php";
}

elseif ($_GET[module]=='studio'){
  include "modul/mod_studio/studio.php";
}

elseif ($_GET[module]=='hubungi'){
  include "modul/mod_hubungi/hubungi.php";
}

elseif ($_GET[module]=='konfirmasi'){
  include "modul/mod_konfirmasi/konfirmasi.php";
}

elseif ($_GET[module]=='movie'){
  include "modul/mod_movie/movie.php";
}

elseif ($_GET[module]=='order'){
  include "modul/mod_order/order.php";
}

elseif ($_GET[module]=='help'){
  include "modul/mod_statis/statis.php";
}

elseif ($_GET[module]=='about'){
  include "modul/mod_statis/statis.php";
}

else{
  echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
}
?>
