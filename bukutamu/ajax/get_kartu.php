<?php 
	if (!isset($_GET['uid'])) {
		$return['error'] = "uid not set";
		echo json_encode($return);
	}
	else{
		$uid = $_GET['uid'];
		require "../../db/db_con.php";
		$sql = "SELECT * FROM kartu_tamu where uid = ".$uid."";
		$result = mysqli_query($conn, $sql);
		if ($result && mysqli_num_rows($result) !=0){
			while($row = mysqli_fetch_assoc($result)) {
				$return = $row;
			}
			echo json_encode($return);
		}
		else{
			$return['error'] = "not found";;
			echo json_encode($return);			
		}
		
	}
	      
?>