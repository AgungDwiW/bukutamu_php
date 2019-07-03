<?php
	require $_SERVER['DOCUMENT_ROOT']."/bukutamu_php"."/db/db_con.php";
	require 'auth/super_middleware.php';
	$nama = $_POST['nama'];
	$jawab = $_POST['tanggung'];
	$email = $_POST['email'];
	

	$sql = "INSERT INTO departemen(nama_departemen, penanggungjawab, email)
			VALUES(
				'".$nama."',
				'".$jawab."',
				'".$email."'
				)
				";
	$result = mysqli_query($conn, $sql);
	// echo "$sql";
	header('Location: listpelaporan.php');
?>