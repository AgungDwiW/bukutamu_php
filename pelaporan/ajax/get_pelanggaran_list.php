<?php 
	// echo json_encode($_GET);
	require "check.php";
	if (!check_login())
	{
		$return['error'] = "not loged in";
		
		echo json_encode($return);
	}
	else if (!isset($_POST['start'])&&!isset($_POST['end']))
	{
		$return['error'] = "parameter not satisfied";
		echo json_encode($return);
	}	
	else{
			require "../../db/db_con.php";
			$start = $_POST['start'];
			$end = $_POST['end'];
			$sql = "SELECT * from pelaporan where ".
			  "STR_TO_DATE(tanggal_pelanggaran, '%Y-%m-%d') >= STR_TO_DATE('".$start."', '%Y-%m-%d') and STR_TO_DATE(tanggal_pelanggaran, '%Y-%m-%d') <= STR_TO_DATE('".$end."', '%Y-%m-%d') ";
			
			$result = mysqli_query($conn, $sql);
			if ($result && mysqli_num_rows($result) !=0){
			$return=array();
			while($row = mysqli_fetch_assoc($result)) {
				$row['uid'] = $row['id_tamu'];
				if ($row['id_tamu']){
					$sql = "SELECT nama_tamu as nama, tipe, uid from tamu where id = ".$row['id_tamu'];
					$result2 = mysqli_query($conn, $sql);
					while($row2 = mysqli_fetch_assoc($result2)) {
						$row['pelanggar'] = $row2['nama'];
						$row['uid'] = $row2['uid'];
					}
				}

				if ($row['departemen']){
					$sql = "SELECT nama_departemen as nama from departemen where id = ".$row['departemen'];
					$result2 = mysqli_query($conn, $sql);
					while($row2 = mysqli_fetch_assoc($result2)) {
						$row['departemen'] = $row2['nama'];
					}
				}
				if ($row['area']){
					$sql = "SELECT nama_area as nama from area where id = ".$row['area'];
					$result2 = mysqli_query($conn, $sql);
					while($row2 = mysqli_fetch_assoc($result2)) {
						$row['area'] = $row2['nama'];
					}
				}

				array_push($return, $row);
			}
			echo json_encode($return);			
		
		
		}
	}
	      
?>