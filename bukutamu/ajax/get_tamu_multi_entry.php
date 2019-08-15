<?php 
	 /*
	 get tamu's data using visitor card's nrf  id
	 */

	if (!isset($_POST['uid'])) {
		$return['error'] = "uid not set";
		echo json_encode($return);
	}
	else{
		$uid = $_POST['uid'];
		require "../../db/db_con.php";
		$sql = "SELECT id_tamu, tipeid FROM uid_tamu where uid = '".$uid."'";
		
		$result = mysqli_query($conn, $sql);
		if ($result && mysqli_num_rows($result) !=0){
			$row = mysqli_fetch_assoc($result);
			$id_tamu = $row['id_tamu'];
			$tid = $row['tipeid'];
		}
		if (!isset($id_tamu)){
			$return['error'] = "not found";;
			echo json_encode($return);			
		}
		else{
			$sql = "SELECT * FROM tamu where id = ".$id_tamu."";
			$result = mysqli_query($conn, $sql);
			if ($result && mysqli_num_rows($result) !=0){
				$row = mysqli_fetch_assoc($result);
				$return_arr[] = array(
					"nama" => $row['nama_tamu'],
					"tid" => $tid,
					"kelamin" => $row['jenis_kelamin'],
					"id" => $id_tamu
                	);
				echo json_encode($return_arr);
			}
			
		}
		
	}
	      
?>