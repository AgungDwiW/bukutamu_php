<?php  
	require "../db/db_con.php";
	$sql = "UPDATE kedatangan SET id_keplek = '".$_POST['id_kartu']."' WHERE id = ".$_POST['id'];
	$result = mysqli_query($conn, $sql);
	$sql = "UPDATE kartu_tamu SET id_tamu = ".$_POST['id_tamu']." where id = ".$_POST['id_kartu'];
	$result = mysqli_query($conn, $sql);
	header('Location: ../index.php');
?>