<?php 
	// echo json_encode($_GET);
	require "../auth/check.php";
	if (!check_login())
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
			require $_SERVER['DOCUMENT_ROOT']."/bukutamu_php"."/db/db_con.php";
			$start = $_GET['start'];
			$end = $_GET['end'];
			$sql =  "SELECT * from kedatangan where ".
			  "STR_TO_DATE(tanggal_datang, '%Y-%m-%d') >= STR_TO_DATE(".$start.", '%Y-%m-%d') and STR_TO_DATE(tanggal_datang, '%Y-%m-%d') <= STR_TO_DATE(".$end.", '%Y-%m-%d') ";
			
			 
			$bukutamu =  array();
			$no = 1;
			$result = mysqli_query($conn, $sql);
			if ($result && mysqli_num_rows($result) !=0){
			$return=array();
			while($row = mysqli_fetch_assoc($result)) {
				$row['id'] = $no;
				$no+=1;
			    $temp = $row['tamu'];
				if ($row['tamu']){
					$sql = "SELECT nama_tamu as nama, tipe from tamu where uid = ".$row['tamu'];
					$result2 = mysqli_query($conn, $sql);
					while($row2 = mysqli_fetch_assoc($result2)) {
						
						$sql = "SELECT tipe from tipe_tamu where id = ".$row2['tipe'];
						// echo "$sql";
						// var_dump($row2);
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
				$row['signedout'] = $row['signedout']?"Keluar":"Didalam";

			        array_push($bukutamu, $row);
			    }
			}
			// var_dump($bukutamu);
			 
			header('Content-Type: text/csv; charset=utf-8');
			header('Content-Disposition: attachment; filename=bukutamu-'.$start.'-'.$end.'.csv');
			$output = fopen('php://output', 'w');
			 fputcsv($output, array('No','Nama tamu', 'Tanggal datang', 'Tanggal keluar', 'Durasi', 'Suhu badan', "Luka", "Sakit", "Bertemu dengan", "Keperluan", "Departemen", "Status", "Id keplek", "Tipe tamu"));
			if (count($bukutamu) > 0) {
			    foreach ($bukutamu as $row) {
			        fputcsv($output, $row);
			    }
			}
		
		
		}
	      
?>