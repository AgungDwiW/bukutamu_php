<?php
	require "../db/db_con.php";
	require 'auth/super_middleware.php';
	$nama = $_POST['nama'];
	$id = $_POST['is_edit'];
	if ($id == -1){
		$sql = "INSERT INTO area(nama_area)
				VALUES(
					'".$nama."'
					)
					";
		$result = mysqli_query($conn, $sql);
	}
	else{
		$sql = "UPDATE area
				SET nama_area = '".$nama."'
				WHERE id = '".$id."'
				";
		
		$result = mysqli_query($conn, $sql);	
	}
	
	header('Location: listarea.php');
?>