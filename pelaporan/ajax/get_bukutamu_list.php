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
			$flag = $_POST['shift'];

			if ($flag == 1){
				$start_hour = "06:00:01";
				$end_hour = "14:00:00";
			}
			else if ($flag ==2){
				$start_hour = "14:00:01";
				$end_hour = "22:00:00";		
			}
			else if ($flag ==3){
				$start_hour = "22:00:01";
				$end_hour = "06:00:00";		
			}
			else if ($flag ==4){
				$start_hour = "00:00:00";
				$end_hour = "23:59:59";		
			}
			else
			{	
				$return['error'] = "parameter not satisfied";
				echo json_encode($return);
				return false;
			}

			$sql = "SELECT * from kedatangan where ".
			  "STR_TO_DATE(tanggal_datang, '%Y-%m-%d') >= STR_TO_DATE('".$start."', '%Y-%m-%d') and STR_TO_DATE(tanggal_datang, '%Y-%m-%d') <= STR_TO_DATE('".$end."', '%Y-%m-%d') and DATE_FORMAT(tanggal_datang,'%H:%i:%s')>= STR_TO_DATE('".$start_hour."', '%H:%i:%s') and  DATE_FORMAT(tanggal_datang,'%H:%i:%s') <= STR_TO_DATE('".$end_hour."','%H:%i:%s') ";
			
			$result = mysqli_query($conn, $sql);
			if ($result && mysqli_num_rows($result) !=0){
			$return=array();
			$no = 0;
			while($row = mysqli_fetch_assoc($result)) {
				if ($row['id_tamu']){
					$sql = "SELECT nama_tamu as nama from tamu where id = ".$row['id_tamu'];
					$result2 = mysqli_query($conn, $sql);

					if($result2){
					while($row2 = mysqli_fetch_assoc($result2)) {
						$row['tamu'] = $row2['nama'];
						$sql = "SELECT tipe from tipe_tamu where id = ".$row['id_tipe'];
						// echo "$sql";
						// var_dump($row2);
						$result3 = mysqli_query($conn, $sql);
						if ($result3){
						while($row3 = mysqli_fetch_assoc($result3)) {
							$row['tipe'] = $row3['tipe'];
						}}
					}}
				}

				if ($row['departemen']){
					$sql = "SELECT nama_departemen as nama from departemen where id = ".$row['departemen'];
					$result2 = mysqli_query($conn, $sql);
					while($row2 = mysqli_fetch_assoc($result2)) {
						$row['departemen'] = $row2['nama'];
					}
				}
				
				$row['durasi'] = intval($row['durasi'])/60;
				$row['durasi'] = number_format((float)$row['durasi'], 2, '.', '');
				$row['status'] = $row['signedout']?"Keluar":"Didalam";
				
				array_push($return, $row);
			}

		echo json_encode($return);			
		
		}
	}
	      

	

?>