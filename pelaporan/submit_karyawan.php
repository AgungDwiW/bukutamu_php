<?php
	require "../db/db_con.php";
	require 'auth/super_middleware.php';
	$nik = $_POST['id'];
	$nama = $_POST['nama'];
	$sql = "SELECT * from karyawan where nik = ".$nik;
	$result = mysqli_query($conn, $sql);
	if (!$result )
	{
		header('Location: daftarkaryawan.php?error=1');
	}
	$sql = "INSERT INTO karyawan(nik,nama)
			VALUES(
				'".$nik."',
				'".$nama."'
				)";
	$result = mysqli_query($conn, $sql);
	echo "$sql";
	header('Location: daftarkaryawan.php');
?>