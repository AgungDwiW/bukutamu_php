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
				 $sql = "SELECT tipe FROM tipe_tamu where id = ".$row['tipe_kartu'];
                                            $result2 = mysqli_query($conn, $sql);
				 if ($result2 &&(mysqli_num_rows($result2) !=0)){
	                while($row2 = mysqli_fetch_assoc($result2)) {
	                    $row['tipe_kartu'] = $row2['tipe'];}}
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