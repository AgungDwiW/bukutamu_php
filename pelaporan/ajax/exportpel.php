<?php 
	// echo json_encode($_GET);
	require "../auth/check.php";
	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
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
			require $_SERVER['DOCUMENT_ROOT']."/bukutamu_php".'/vendor/autoload.php';
			

			$start = $_GET['start'];
			$end = $_GET['end'];
			$sql = "SELECT * from pelaporan where ".
			  "STR_TO_DATE(tanggal_pelanggaran, '%Y-%m-%d') >= STR_TO_DATE(".$start.", '%Y-%m-%d') and STR_TO_DATE(tanggal_pelanggaran, '%Y-%m-%d') <= STR_TO_DATE(".$end.", '%Y-%m-%d') ";
			
			$result = mysqli_query($conn, $sql);
			if ($result && mysqli_num_rows($result) !=0){
			$return=array();
			while($row = mysqli_fetch_assoc($result)) {
				$row['uid_pelanggar'] = $row['id_tamu'];
				if ($row['id_tamu']){
					$sql = "SELECT nama_tamu as nama,  uid from tamu where id = ".$row['id_tamu'];
					$result2 = mysqli_query($conn, $sql);
					while($row2 = mysqli_fetch_assoc($result2)) {
						$row['pelanggar'] = $row2['nama'];
						$row['uid_pelanggar'] = $row2['uid'];
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
				array_push($return, $row);
			
		
		}

		$spreadsheet = new Spreadsheet();

		//add some data in excel cells
		$spreadsheet->setActiveSheetIndex(0)
		 ->setCellValue('A1', 'No')
		 ->setCellValue('B1', 'NIK pelapor')
		 ->setCellValue('C1', 'Nama pelapor')
		 ->setCellValue('D1', 'UID pelangar')
		 ->setCellValue('E1', 'Nama pelangar')
		 ->setCellValue('F1', 'Departemen')
		 ->setCellValue('G1', 'Area')
		 ->setCellValue('H1', 'Tanggal pelanggaran')
		 ->setCellValue('I1', 'Tipe aktivitas')
		 ->setCellValue('J1', 'Subkategori')
		 ->setCellValue('K1', '+/-')
		 ->setCellValue('L1', 'Action Plan')
		 ->setCellValue('M1', 'Keterangan');
				$cell_st =[
		 'font' =>['bold' => true],
		 'alignment' =>['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
		 'borders'=>['allborders' =>['style'=> \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM]]
		];

			 $cell_st2 = [
			 	'borders'=>['allborders' =>['style'=> \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM]]
			];
			$spreadsheet->getActiveSheet()->getStyle('A1:M1')->applyFromArray($cell_st);
			
			//set columns width
			$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(10);
			$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(10);
			$spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(30);


			$spreadsheet->getActiveSheet()->setTitle('Bukutamu'); //set a title for Worksheet

		$no =2;
		$num = 1;
		if (count($return) > 0) {
	    foreach ($return as $row) {
	        	$spreadsheet->setActiveSheetIndex(0)
				 ->setCellValue('A'.$no, $num)
				 ->setCellValue('B'.$no, $row['uid_pelapor'])
				 ->setCellValue('C'.$no, $row['nama_pelapor'])
				 ->setCellValue('D'.$no, $row['uid_pelanggar'])
				 ->setCellValue('E'.$no, $row['pelanggar'])
				 ->setCellValue('F'.$no, $row['departemen'])
				 ->setCellValue('G'.$no, $row['area'])
				 ->setCellValue('H'.$no, $row['tanggal_pelanggaran'])
				 ->setCellValue('I'.$no, $row['tipe_12'])
				 ->setCellValue('J'.$no, $row['subkategori'])
				 ->setCellValue('K'.$no, $row['positif'])
				 ->setCellValue('L'.$no, $row['ap'])
				 ->setCellValue('M'.$no, $row['keterangan']);
				$spreadsheet->getActiveSheet()->getStyle('A'.$no.':M'.$no)->applyFromArray($cell_st2);
				$no+=1;
				$num+=1;
	    }
		}
		$writer = new Xlsx($spreadsheet);
		$fxls ='pelaporan-'.$start.'-'.$end.'.xlsx';
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=pelaporan-'.$start.'-'.$end.'.xlsx');
		$writer->save('php://output', $spreadsheet);
		
			
		}
	}
	      
?>