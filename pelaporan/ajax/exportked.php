<?php 
	// echo json_encode($_GET);
	require "check.php";
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
			require '../../vendor/autoload.php';
			
			require "../../db/db_con.php";
			

			//object of the Spreadsheet class to create the excel data
			
			//make object of the Xlsx class to save the excel file
		
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
			    $temp = $row['id_tamu'];
				if ($row['id_tamu']){
					$sql = "SELECT nama_tamu as nama, tipe, uid from tamu where id = ".$row['id_tamu'];
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
				$row['durasi'] = intval($row['durasi'])/60;
				$row['signedout'] = $row['signedout']?"Keluar":"Didalam";

			        array_push($bukutamu, $row);
			    }
			}

			$spreadsheet = new Spreadsheet();

			//add some data in excel cells
			$spreadsheet->setActiveSheetIndex(0)
			 ->setCellValue('A1', 'No')
			 ->setCellValue('B1', 'UID tamu')
			 ->setCellValue('C1', 'Nama tamu')
			 ->setCellValue('D1', 'Tipe tamu')
			 ->setCellValue('E1', 'Tanggal datang')
			 ->setCellValue('F1', 'Tanggal keluar')
			 ->setCellValue('G1', 'Durasi')
			 ->setCellValue('H1', 'Suhu badan')
			 ->setCellValue('I1', 'Luka')
			 ->setCellValue('J1', 'Sakit')
			 ->setCellValue('K1', 'Bertemu dengan')
			 ->setCellValue('L1', 'Departemen')
			 ->setCellValue('M1', 'Keperluan')
			 ->setCellValue('N1', 'Status');

			//set style for A1,B1,C1 cells
					$cell_st =array(
		 'font' =>array('bold' => true),
		 'alignment' =>array('horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER),
		 'borders'=>array('allborders' =>array('style'=> \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM))
		);

			 $cell_st2 = array(
			 	'borders'=>array('allborders' =>array('style'=> \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM))
			);
			$spreadsheet->getActiveSheet()->getStyle('A1:N1')->applyFromArray($cell_st);
			
			//set columns width
			$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(10);
			$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(10);
			$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
			$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(10);
			$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(10);


			$spreadsheet->getActiveSheet()->setTitle('Bukutamu'); //set a title for Worksheet

			$no =2;
			$num = 1;
				if (count($bukutamu) > 0) {
			    foreach ($bukutamu as $row) {
			        	$spreadsheet->setActiveSheetIndex(0)
						 ->setCellValue('A'.$no, $num)
						 ->setCellValue('B'.$no, $row['uid'])
						 ->setCellValue('C'.$no, $row['tamu'])
						 ->setCellValue('D'.$no, $row['tipe'])
						 ->setCellValue('E'.$no, $row['tanggal_datang'])
						 ->setCellValue('F'.$no, $row['tanggal_keluar'])
						 ->setCellValue('G'.$no, $row['durasi'])
						 ->setCellValue('H'.$no, $row['suhu_badan'])
						 ->setCellValue('I'.$no, $row['luka']?"+":"-")
						 ->setCellValue('J'.$no, $row['sakit'])
						 ->setCellValue('K'.$no, $row['bertemu'])
						 ->setCellValue('L'.$no, $row['departemen'])
						 ->setCellValue('M'.$no, $row['keperluan'])
						 ->setCellValue('N'.$no, $row['signedout']);
	 				$spreadsheet->getActiveSheet()->getStyle('A'.$no.':N'.$no)->applyFromArray($cell_st2);
	 				$no+=1;
	 				$num+=1;

			    }
			}
			// var_dump($bukutamu);
			$writer = new Xlsx($spreadsheet);
			$fxls ='bukutamu-'.$start.'-'.$end.'.xlsx';
			header('Content-Type: text/csv; charset=utf-8');
			header('Content-Disposition: attachment; filename=bukutamu-'.$start.'-'.$end.'.xlsx');
			$writer->save('php://output', $spreadsheet);
			
		
		
		}
	      
?>

