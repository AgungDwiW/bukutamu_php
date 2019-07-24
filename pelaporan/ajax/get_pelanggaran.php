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
		


		$sql = "SELECT id_tamu as id FROM kartu_tamu where uid = ". $uid;

		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_assoc($result)) {
			
			$id = $row['id'];
		}

		$sql = "SELECT * FROM pelaporan where id_tamu = ".$id." and tipe_12 = '".$_GET['akt']."' and subkategori = '".$_GET['sub']."' and positif = false";
		$result = mysqli_query($conn, $sql);

		// $return['sql'] = $sql;
		// echo json_encode($return);			
		if ($result && mysqli_num_rows($result) !=0){
			$return=array();
			while($row = mysqli_fetch_assoc($result)) {
				$temp ['ap'] = "";
				$temp ['tanggal'] = $row['tanggal_pelanggaran'];
				$temp ['area'] = $row['area'];

				$sql = "select nama_area as nama from area where id = ".$row['area'];
				$result2 = mysqli_query($conn, $sql);
				while($row2 = mysqli_fetch_assoc($result2)) {
					$temp['area'] = $row2['nama'];
				}

				$temp ['departemen'] = $row['departemen'];
				$sql = "select nama_departemen as nama from departemen where id = ".$row['area'];
				$result2 = mysqli_query($conn, $sql);
				while($row2 = mysqli_fetch_assoc($result2)) {
					$temp['departemen'] = $row2['nama'];
				}


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