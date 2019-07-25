<?php
	require "../db/db_con.php";
	require 'auth/super_middleware.php';
	$id = $_GET['id'];
	if (!isset($id)){
		header('Location: listpelaporan.php');	
	}
	$sql = "DELETE FROM tipe_tamu WHERE id = ".$id;
	$result2 = mysqli_query($conn, $sql);
	header('Location: listtipetamu.php');	
?>