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
			$sql = "SELECT * from pelaporan where ".
			  "STR_TO_DATE(tanggal_pelanggaran, '%Y-%m-%d') >= STR_TO_DATE(".$start.", '%Y-%m-%d') and STR_TO_DATE(tanggal_pelanggaran, '%Y-%m-%d') <= STR_TO_DATE(".$end.", '%Y-%m-%d') ";
			
			$result = mysqli_query($conn, $sql);
			if ($result && mysqli_num_rows($result) !=0){
			$return=array();
			while($row = mysqli_fetch_assoc($result)) {
				if ($row['pelanggar']){
					$sql = "SELECT nama_tamu as nama, tipe from tamu where uid = ".$row['pelanggar'];
					$result2 = mysqli_query($conn, $sql);
					while($row2 = mysqli_fetch_assoc($result2)) {
						$row['pelanggar'] = $row2['nama'];
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
				array_push($return, $row);
			
		
		}
		header('Content-Type: text/csv; charset=utf-8');
			header('Content-Disposition: attachment; filename=pelaporan-'.$start.'-'.$end.'.csv');
			$output = fopen('php://output', 'w');
			 fputcsv($output, array('No','Nama pelapor', 'UID pelapor', 'Nama pelanggar', 'Departemen yang bertanggung jawab', 'Tanggal pelanggaran', "Tanggal pelaporan", "Tipe aktivitas 12", "Subkategori", "Positivity", "Area", "Action plan", "Keterangan"));
			if (count($return) > 0) {
			    foreach ($return as $row) {
			        fputcsv($output, $row);
			    }
			}	
		}
	}
	      
?>