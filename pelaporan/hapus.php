<?php
	require $_SERVER['DOCUMENT_ROOT']."/bukutamu_php"."/db/db_con.php";
	require 'auth/login_middleware.php';
	$id = $_GET['id'];
	if (!isset($id)){
		header('Location: listpelaporan.php');	
	}
	$sql = "DELETE FROM PELAPORAN WHERE ID = ".$id;
	$result2 = mysqli_query($conn, $sql);
	header('Location: listpelaporan.php');	
?>