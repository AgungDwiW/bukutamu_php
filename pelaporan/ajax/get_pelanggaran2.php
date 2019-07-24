<?php 
	// echo json_encode($_GET);
	require "check.php";
	if (!check_login())
	{
		$return['error'] = "not loged in";
		
		echo json_encode($return);
	}
	elseif (!isset($_GET['uid'])) {
		$return['error'] = "uid not set";
		echo json_encode($return);
	}
	else{
		$uid = $_GET['uid'];
		require "../../db/db_con.php";
		$sql = "SELECT id_tamu as id FROM uid_tamu where uid = ". $uid;
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_assoc($result)) {
			$id = $row['id'];
		}

		$sql = "SELECT * FROM pelaporan where id_tamu = ".$id;
		$result = mysqli_query($conn, $sql);
		// $return['sql'] = $sql;
		// echo json_encode($return);			
		if ($result && mysqli_num_rows($result) !=0){
			$return=array();
			while($row = mysqli_fetch_assoc($result)) {
				$temp ['ap'] = "";
				$temp['t12'] = $row['tipe_12'];
				$temp['sub'] = $row['subkategori'];
				$temp['positif'] = $row['positif'];
				$temp ['tanggal'] = $row['tanggal_pelanggaran'];
				$temp ['keterangan'] = $row['keterangan'];
			
				$temp ['ap'] = $row['ap'];
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