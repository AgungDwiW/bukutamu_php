<?php 
	require $_SERVER['DOCUMENT_ROOT']."/bukutamu_php"."/db/db_con.php";
	$algo = "md5";
	$data = "adminadmin";
	echo hash ( $algo , $data );
 ?>

