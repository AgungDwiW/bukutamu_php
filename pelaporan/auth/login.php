<?php 
	require $_SERVER['DOCUMENT_ROOT']."/bukutamu_php"."/db/db_con.php";
	require "encrypt.php";
	$id = $_POST['id'];
	$pass = $_POST['password'];
	$algo = "md5";
	$pass =  hash ( $algo , $pass );
	$sql = "SELECT * FROM user where user = '". $id . "' and pass = '".$pass."'";
	$result_tamu = mysqli_query($conn, $sql);
	// echo $sql;
	function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
	{
	    $pieces = [];
	    $max = mb_strlen($keyspace, '8bit') - 1;
	    for ($i = 0; $i < $length; ++$i) {
	        $pieces []= $keyspace[random_int(0, $max)];
	    }
	    return implode('', $pieces);
	}
	if (mysqli_num_rows($result_tamu) ==0){
		header('Location: ../index.php?status=1');
	}
	else
	{
		while($row = mysqli_fetch_assoc($result_tamu)) {
			$is_admin = $row['is_super'];
		}
		$rand = random_str(49);
		setcookie("key", $rand, time() + (86400 * 366), "/"); // 86400 = 1 day
		// echo $_SESSION['key'];
		$sql = "INSERT INTO session(session_key,is_super)
				VALUES ('".$rand."', ".$is_admin.")";
		$result_tamu = mysqli_query($conn, $sql);
		// echo $sql;
		// echo $_COOKIE["key"];
		header('Location: ../dashboard.php');	
	}
	

 ?>

