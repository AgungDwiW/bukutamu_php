<?php
	require "../db/db_con.php";
	require 'auth/super_middleware.php';
	$tipe = $_POST['tipe'];
	$nomor = $_POST['nomor'];
	$uid = $_POST['uid'];
	

	$sql = "update kartu_tamu
			set
				tipe_kartu = '".$tipe."',
				nomor_kartu = '".$nomor."',
				uid = '".$uid."'
			where
				id = '".$_POST['id']."'

				
				";
	$result = mysqli_query($conn, $sql);
	// echo "$sql";
	header('Location: listkartu.php');
?>