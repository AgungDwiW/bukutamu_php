<?php  
	
	require "../../db/db_con.php";
	$key = $_COOKIE["key"];
	$sql = "DELETE FROM session WHERE session_key = '".$key."'";
	// echo $sql;
	$result = mysqli_query($conn, $sql);
	setcookie("key", "", time() - 3600);
	
	header('Location: ../../index.php');
?>