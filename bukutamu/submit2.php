<?php  
	require "../db/db_con.php";
	$sql = "UPDATE kedatangan SET id_keplek = '".$_POST['uid']."' WHERE id = ".$_POST['id'];
	$result = mysqli_query($conn, $sql);
	header('Location: index.php');
?>