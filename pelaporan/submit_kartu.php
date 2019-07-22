<?php
	require "../db/db_con.php";
	require 'auth/super_middleware.php';
	$tipe = $_POST['tipe'];
	$nomor = $_POST['nomor'];
	$uid = $_POST['uid'];
	

	$sql = "INSERT INTO kartu_tamu(tipe_kartu, nomor_kartu, uid)
			VALUES(
				'".$tipe."',
				'".$nomor."',
				'".$uid."'
				)
				";
	$result = mysqli_query($conn, $sql);
	// echo "$sql";
	header('Location: daftarkartu.php');
?>