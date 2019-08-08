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
			require "export_csv_lib.php";

			//object of the Spreadsheet class to create the excel data
			
			//make object of the Xlsx class to save the excel file
		
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
			
			$temp = array();
			array_push($temp, 'No');
			array_push($temp, 'Nama tamu');
			array_push($temp, 'Tipe tamu');
			array_push($temp, 'Tanggal datang');
			array_push($temp, 'Tanggal keluar');
			array_push($temp, 'Durasi (jam)');
			array_push($temp, 'Suhu badan');
			array_push($temp, 'Luka');
			array_push($temp, 'Sakit');
			array_push($temp, 'Departemen');
			array_push($temp, 'Bertemu dengan');
			array_push($temp, 'Keperluan');
			array_push($temp, 'Status');

			$bukutamu =  array();
			array_push($bukutamu, $temp);
			$no = 1;
			$result = mysqli_query($conn, $sql);
			if ($result && mysqli_num_rows($result) !=0){
				$return=array();
				while($row = mysqli_fetch_assoc($result)) {
					$temp_arr = array();
					
				    $temp = $row['id_tamu'];
					if ($row['id_tamu']){
						$sql = "SELECT nama_tamu as nama from tamu where id = ".$row['id_tamu'];
						$result2 = mysqli_query($conn, $sql);
						while($row2 = mysqli_fetch_assoc($result2)) {
							
							$sql = "SELECT tipe from tipe_tamu where id = ".$row['id_tipe'];;
							$result3 = mysqli_query($conn, $sql);
							while($row3 = mysqli_fetch_assoc($result3)) {
								$row['tipe'] = $row3['tipe'];
							}
							$row['tamu'] = $row2['nama'];

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
					 $row['durasi'] = number_format((float)$row['durasi'], 2, '.', '');
					$row['signedout'] = $row['signedout']?"Keluar":"Didalam";
					array_push($temp_arr, $no);
					$no+=1;
					array_push($temp_arr, $row['tamu']);
					array_push($temp_arr, $row['tipe']);
					array_push($temp_arr, $row['tanggal_datang']);
					array_push($temp_arr, $row['tanggal_keluar']);
					array_push($temp_arr, $row['durasi']);
					array_push($temp_arr, $row['suhu_badan']);
					array_push($temp_arr, $row['luka']?"+":"-");
					array_push($temp_arr, $row['sakit']?"+":"-");
					array_push($temp_arr, $row['bertemu']);
					array_push($temp_arr, $row['departemen']);
					array_push($temp_arr, $row['keperluan']);
			        array_push($temp_arr, $row['signedout']);
			        array_push($bukutamu, $temp_arr);
			    }
			}
			// var_dump($bukutamu);
			

			send_file('bukutamu-'.$start.'-'.$end.'_shift-'.$flag.'.xlsx');
			echo  array2csv($bukutamu);

			die();

		
		}
	      
?>

