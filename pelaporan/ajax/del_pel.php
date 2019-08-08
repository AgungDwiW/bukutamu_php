<?php 
	// echo json_encode($_GET);
	require "check.php";
	if (!check_super())
	{
		$return['error'] = "not loged in";
		
		echo json_encode($return);
	}
	else if (!isset($_GET['start'])&&!isset($_GET['end']))
	{
		$return['error'] = "parameter not satisfied";
		echo json_encode($return);
	}	
	else{
		$end = $_GET['end'];
		require "../../db/db_con.php";
		$sql = "DELETE FROM pelaporan  where STR_TO_DATE(tanggal_pelaporan, '%Y-%m-%d') <= STR_TO_DATE(".$end.", '%Y-%m-%d') ";
		$result = mysqli_query($conn, $sql);
		// echo "$sql";
	}
	      
?>

