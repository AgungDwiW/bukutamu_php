<?php 
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
		$sql = "SELECT * FROM tamu where uid = ".$uid."";
		$result = mysqli_query($conn, $sql);
		if ($result && mysqli_num_rows($result) !=0){
			while($row = mysqli_fetch_assoc($result)) {
				$sql = "SELECT * FROM kedatangan where tamu = ".$uid."";
				$result2 = mysqli_query($conn, $sql);
				// echo $sql;
				$temp2 = "";
				if (mysqli_num_rows($result2) !=0){
					$temp2 = array();
					while($row2 = mysqli_fetch_assoc($result2)) {
						$temp2[$row2['id']] = $row2['tanggal_datang'];
						
					}
				}
				$return_arr[] = array("nama" => $row['nama_tamu'],
                    "hp" => $row['nohp'],
                    "perusahaan" => $row['perusahaan'],
                    "tipeid" => $row['tipeid'],
                    'saved' => $row['saved'],
                    "kedatangan" => $temp2,
                    "counter" => $row['count_pelanggaran']
                	);
			}
			echo json_encode($return_arr);
		}
		else{
			$return['error'] = "not found";;
			echo json_encode($return);			
		}
		
	}
	      
?>