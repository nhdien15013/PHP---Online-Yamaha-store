<?php
	include('connection.php');
	$Kieu_km=mysql_fetch_array(mysql_query("select Ten_sp from sanpham where Ma_sp=3"));
	echo  $Kieu_km['Ten_sp'];
?>