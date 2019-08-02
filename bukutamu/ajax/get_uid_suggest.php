<?php 
	if (!isset($_POST['uid'])) {
		$return['error'] = "parameteer not satified";
		echo json_encode($return);
	}
	else{
		require "../../db/db_con.php";
		$sql = "SELECT * FROM uid_tamu where uid like '".$_POST['uid']."%'";
		$result = mysqli_query($conn, $sql);
		$return = array();
		if ($result && mysqli_num_rows($result) !=0){
			while($row = mysqli_fetch_assoc($result)) {
				array_push($return, $row);
			}
			echo json_encode($return);
		}
		else{
			$return['sql'] = $sql;
			$return['error'] = "not found";;
			echo json_encode($return);			
		}
		
	}
	      
?>