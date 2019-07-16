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
			$sql = "SELECT * from pengampunan where ".
			  "STR_TO_DATE(tanggal_pengampunan, '%Y-%m-%d') >= STR_TO_DATE('".$start."', '%Y-%m-%d') and STR_TO_DATE(tanggal_pengampunan, '%Y-%m-%d') <= STR_TO_DATE('".$end."', '%Y-%m-%d') ";
			
			$result = mysqli_query($conn, $sql);
			if ($result && mysqli_num_rows($result) !=0){
			$return=array();
			while($row = mysqli_fetch_assoc($result)) {
				if ($row['id_tamu']){
					$sql = "SELECT nama_tamu as nama, uid from tamu where id = ".$row['id_tamu'];
					$result2 = mysqli_query($conn, $sql);
					while($row2 = mysqli_fetch_assoc($result2)) {
						$row['nama_tamu'] = $row2['nama'];
						$row['uid_tamu'] = $row2['uid'];
					}
				}
				if ($row['id_karyawan']){
					$sql = "SELECT nama as nama, nik from karyawan where id = ".$row['id_karyawan'];
					$result2 = mysqli_query($conn, $sql);
					while($row2 = mysqli_fetch_assoc($result2)) {
						$row['nama_karyawan'] = $row2['nama'];
						$row['nik'] = $row2['nik'];
					}
				}

				
				

				array_push($return, $row);
			}
			echo json_encode($return);			
		
		
		}
	}
	      
?>