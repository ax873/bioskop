<?php
class Paging
{
function cariPosisi($batas)
{
	if (empty($_GET[halaman])){
		$posisi = 0;
		$_GET[halaman]=1;}
	else {
		$posisi = ($_GET[halaman]-1) * $batas;
	}
return $posisi;
}
function jumlahHalaman($jmldata, $batas)
{
	$jmlhalaman = ceil($jmldata/$batas);
	return $jmlhalaman;
}
function navHalaman($halaman_aktif, $jmlhalaman)
{
	$link = "";
	if ($halaman_aktif > 1){
		$link .="<a href=$file?halaman=1><< First </a> | ";
	}
	if (($halaman_aktif-1) > 0){
		$previous =$halaman_aktif-1;
		$link .="<a href=$file?halaman=$previous>< Previous </a> | ";
	}
	for ($i=1; $i<=$jmlhalaman; $i++)
	{
		if ($i  == $halaman_aktif)
		{
			$link .= "<b>$i</b> |";
		}
		else 
		{
			$link .= "<a href=$file?halaman=$i>$i</a> |";
		}
	$link .= " ";	
	}
	
	if ($halaman_aktif < $jmlhalaman)
	{
		$next=$halaman_aktif+1;
		$link .= "<a href=$file?halaman=$next>Next ></a>";
	}
	if (($halaman_aktif != $jmlhalaman) && ($jmlhalaman !=0))
	{
		$link .= "<a href=$file?halaman=$jmlhalaman>Last >></a>";
	}
	return $link;
	}
}
?>