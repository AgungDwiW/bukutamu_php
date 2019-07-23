<?php
	require "../db/db_con.php";
	require 'auth/super_middleware.php';
	$nama = $_POST['nama'];
	$id = $_POST['is_edit'];
	$parent = $_POST['tipe'];
	if ($parent == -1)
		$parent = "NULL";
	if ($id == -1){
		$sql = "INSERT INTO tipe_tamu(tipe, parent)
				VALUES(
					'".$nama."',
					".$parent."
					)
					";
		$result = mysqli_query($conn, $sql);
	}
	else{
		$sql = "UPDATE tipe_tamu
				SET tipe = '".$nama."',
				parent = ".$parent."
				WHERE id = '".$id."'
				";
		
		$result = mysqli_query($conn, $sql);	
	}
	// echo "$sql";
	header('Location: listtipetamu.php');
?>