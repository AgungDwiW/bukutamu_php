<?php
	require "../db/db_con.php";
	require 'auth/super_middleware.php';
	$nama = $_POST['nama'];
	$id = $_POST['is_edit'];
	if ($id == -1){
		$sql = "INSERT INTO tipe_tamu(tipe)
				VALUES(
					'".$nama."'
					)
					";
		$result = mysqli_query($conn, $sql);
	}
	else{
		$sql = "UPDATE tipe_tamu
				SET tipe = '".$nama."'
				WHERE id = '".$id."'
				";
		
		$result = mysqli_query($conn, $sql);	
	}
	// echo "$sql";
	header('Location: listtipetamu.php');
?>