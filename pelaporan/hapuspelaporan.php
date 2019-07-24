<?php
	require "../db/db_con.php";
	require 'auth/login_middleware.php';
	$id = $_GET['id'];
	if (!isset($id)){
		header('Location: listpelaporan.php');	
	}
	$sql = "DELETE FROM pelaporan WHERE id = ".$id;
	$result2 = mysqli_query($conn, $sql);
	header('Location: listpelaporan.php');	
?>