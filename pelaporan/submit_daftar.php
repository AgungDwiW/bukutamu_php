<?php
	require $_SERVER['DOCUMENT_ROOT']."/bukutamu_php"."/db/db_con.php";
	require 'auth/super_middleware.php';
	$user = $_POST['id'];
	$pass = $_POST['password'];
	$algo = "md5";
	$pass =  hash ( $algo , $pass );

	$sql = "INSERT INTO user(user, pass, is_super)
			VALUES(
				'".$user."',
				'".$pass."',
				false
				)
				";
	$result = mysqli_query($conn, $sql);
	echo "$sql";
	// header('Location: listpelaporan.php');
?>