<?php
	require "../db/db_con.php";
	require 'auth/super_middleware.php';
	$id = $_POST['id'];
	$nama = $_POST['nama'];
	$jawab = $_POST['tanggung'];
	$email = $_POST['email'];
	

	$sql = "UPDATE DEPARTEMEN
			SET
				nama_departemen = '".$nama."',
				penanggungjawab = '".$jawab."',
				email = '".$email."'
			WHERE
				id = '".$id."'
				";
	$result = mysqli_query($conn, $sql);
	// echo "$sql";
	header('Location: listdepartemen.php');
?>