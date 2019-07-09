<?php 
	// echo json_encode($_GET);
	require "../auth/check.php";
	if (!check_login())
	{
		$return['error'] = "not loged in";
		
		echo json_encode($return);
	}
	else{
		$start = $_POST['start'];
		$end = $_POST['end'];
		require $_SERVER['DOCUMENT_ROOT']."/bukutamu_php"."/db/db_con.php";
		$sql = "SELECT * FROM kedatangan where pelanggar = ".$uid;
		$result = mysqli_query($conn, $sql);
		// echo json_encode($return);			
		if ($result && mysqli_num_rows($result) !=0){
			$return=array();
			while($row = mysqli_fetch_assoc($result)) {
				$temp = $row
				array_push($return, $temp);
			}
			// array_push($return, $sql);
			echo json_encode($return);			
		}
		else{
			$return['error'] = "not found";;
			echo json_encode($return);			
		}
		
	}
	      
?>