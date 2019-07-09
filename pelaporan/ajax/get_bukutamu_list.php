<?php 
	// echo json_encode($_GET);
	require "../auth/check.php";
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
			require $_SERVER['DOCUMENT_ROOT']."/bukutamu_php"."/db/db_con.php";
			$start = $_POST['start'];
			$end = $_POST['end'];
			// $return ['1'] = "SELECT * from kedatangan where";
			// $return ['2'] =  "STR_TO_DATE(tanggal_datang) > STR_TO_DATE('".$start.") and STR_TO_DATE(tanggal_datang) > STR_TO_DATE(".$end.") ";
			// $return['3'] = "SELECT * from kedatangan where ".
			//   "STR_TO_DATE(tanggal_datang, '%Y-%m-%d') > STR_TO_DATE('".$start."', '%Y-%m-%d') and STR_TO_DATE(tanggal_datang, '%Y-%m-%d') < STR_TO_DATE('".$end."', '%Y-%m-%d') ";
			$sql = "SELECT * from kedatangan where ".
			  "STR_TO_DATE(tanggal_datang, '%Y-%m-%d') >= STR_TO_DATE('".$start."', '%Y-%m-%d') and STR_TO_DATE(tanggal_datang, '%Y-%m-%d') <= STR_TO_DATE('".$end."', '%Y-%m-%d') ";
			
			$result = mysqli_query($conn, $sql);
			if ($result && mysqli_num_rows($result) !=0){
			$return=array();
			while($row = mysqli_fetch_assoc($result)) {
				$row['uid'] = $row['tamu'];
				if ($row['tamu']){
					$sql = "SELECT nama_tamu as nama, tipe from tamu where uid = ".$row['tamu'];
					$result2 = mysqli_query($conn, $sql);
					while($row2 = mysqli_fetch_assoc($result2)) {
						$row['tamu'] = $row2['nama'];
						$sql = "SELECT tipe from tipe_tamu where id = ".$row2['tipe'];
						// echo "$sql";
						// var_dump($row2);
						$result3 = mysqli_query($conn, $sql);
						while($row3 = mysqli_fetch_assoc($result3)) {
							$row['tipe'] = $row3['tipe'];
						}
					}
				}

				if ($row['departemen']){
					$sql = "SELECT nama_departemen as nama from departemen where id = ".$row['departemen'];
					$result2 = mysqli_query($conn, $sql);
					while($row2 = mysqli_fetch_assoc($result2)) {
						$row['departemen'] = $row2['nama'];
					}
				}
				$row['durasi'] = intval($row['durasi'])/60;
				$row['status'] = $row['signedout']?"Keluar":"Didalam";
				array_push($return, $row);
			}
			echo json_encode($return);			
		
		
		}
	}
	      
?>