<?php 
	// echo json_encode($_GET);
	require "../auth/check.php";
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
		require $_SERVER['DOCUMENT_ROOT']."/bukutamu_php"."/db/db_con.php";
		$sql = "SELECT * FROM pelaporan where pelanggar = ".$uid;
		$result = mysqli_query($conn, $sql);
		$return['sql'] = $sql;
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