<?php 
	// echo json_encode($_GET);
	require "check.php";

	if (!check_super())
	{
		$return['error'] = "not loged in";
		
		echo json_encode($return);
	}
	else if (!isset($_GET['start'])&&!isset($_GET['end']))
	{
		$return['error'] = "parameter not satisfied";
		echo json_encode($return);
	}	
	else{
			require "../../db/db_con.php";
			require 'export_csv_lib.php';
			

			$start = $_GET['start'];
			$end = $_GET['end'];
			$flag = $_GET['shift'];
				$start = str_replace("'","",$start);
			$end = str_replace("'","",$end);
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

				$temp = array();
				array_push($temp, 'No');
				array_push($temp, 'NIK pelapor');
				array_push($temp, 'Nama pelapor');
				array_push($temp, 'Nama pelangar');
				array_push($temp, 'Departemen');
				array_push($temp, 'Area');
				array_push($temp, 'Tanggal pelanggaran');
				array_push($temp, 'Tipe aktivitas');
				array_push($temp, 'Subkategori');
				array_push($temp, '+/-');
				array_push($temp, 'Action Plan');
				array_push($temp, 'Keterangan');

				$return=array();
				array_push($return, $temp);
				$num = 1;
				while($row = mysqli_fetch_assoc($result)) {
					$temp = array();
					$row['uid_pelanggar'] = $row['id_tamu'];
					if ($row['id_tamu']){
						$sql = "SELECT nama_tamu as nama from tamu where id = ".$row['id_tamu'];
						$result2 = mysqli_query($conn, $sql);
						while($row2 = mysqli_fetch_assoc($result2)) {
							$row['pelanggar'] = $row2['nama'];
						}
					}
					if($row['id_karyawan']){
						$sql = "SELECT nik from karyawan where id = ".$row['id_karyawan'];
						$result2 = mysqli_query($conn, $sql);
						while($row2 = mysqli_fetch_assoc($result2)) {
							
							$row['uid_pelapor'] = $row2['nik'];
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
					$row['positif'] = $row['positif']?"+":"-";
					
					 array_push($temp, $num);
					 $num+=1;
					 array_push($temp, $row['uid_pelapor']);
					 array_push($temp, $row['nama_pelapor']);
					 array_push($temp, $row['pelanggar']);
					 array_push($temp, $row['departemen']);
					 array_push($temp, $row['area']);
					 array_push($temp, $row['tanggal_pelanggaran']);
					 array_push($temp, $row['tipe_12']);
					 array_push($temp, $row['subkategori']);
					 array_push($temp, $row['positif']);
					 array_push($temp, $row['ap']);
					 array_push($temp, $row['keterangan']);
					 array_push($return, $temp);
				}
				
				send_file('pelaporan-'.$start.'-'.$end.'_shift-'.$flag.'.xlsx');
				echo  array2csv($return);
			}
		}
		
	
	      
?>