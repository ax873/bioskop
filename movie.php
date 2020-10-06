<?php
$col = 9;
$query = mysql_query("SELECT * FROM movie ORDER BY id_movie DESC LIMIT 7");
$ada = mysql_num_rows($query);
if ($ada > 0) {
	  echo "<table style='width:100%; padding-left:10px; padding-right:10px; background:#29abe1; border-bottom:5px solid #000; border-top:5px solid #000'><tr>";
	  $cnt = 0;
  while ($r=mysql_fetch_array($query)){
  		if ($cnt >= $col) {
		  echo "</tr><tr>";
		  $cnt = 0;
		}
		$cnt++;
		
	if ($r[gambar]==''){
		echo "<td align=center valign=top><br /><a href='lihat-detail-$r[id_movie].html'>
			  <img title='$r[judul]' class='movie' src='foto_berita/movie.jpg' width='117' height='175px'/></a></td>";
	}else{
		echo "<td align=center valign=top><br /><a href='lihat-detail-$r[id_movie].html'>
			  <img title='$r[judul]' class='movie' src='foto_berita/$r[gambar]' width='117' height='175px'/></a></td>";
	}
}
	  echo "</tr></table><br />";
}
?>