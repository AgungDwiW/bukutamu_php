<?php
	require "../db/db_con.php";
	require 'auth/super_middleware.php';
	$user = $_POST['id'];
	$pass = $_POST['password'];
	$algo = "md5";
	$pass =  hash ( $algo , $pass );
	$super = $_POST['super'];
	$sql = "SELECT * from user where user = ".$user;
	$result = mysqli_query($conn, $sql);
	if (!$result )
	{
		// echo "$sql";
		header('Location: daftaradmin.php?error=1');
	}
	$sql = "INSERT INTO user(user, pass, is_super,is_superman)
			VALUES(
				'".$user."',
				'".$pass."',
				'".$super."', 0
				)
				";
	$result = mysqli_query($conn, $sql);
	echo "$sql";
	header('Location: listadmin.php');
?>