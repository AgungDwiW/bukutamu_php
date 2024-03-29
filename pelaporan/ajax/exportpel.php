<?php 
	// echo json_encode($_GET);
	require "check.php";
	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
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
			require '../../vendor/autoload.php';
			

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

			$sql = "SELECT * from pelaporan where ".
			  "STR_TO_DATE(tanggal_pelaporan, '%Y-%m-%d') >= STR_TO_DATE('".$start."', '%Y-%m-%d') and STR_TO_DATE(tanggal_pelaporan, '%Y-%m-%d') <= STR_TO_DATE('".$end."', '%Y-%m-%d') and DATE_FORMAT(tanggal_pelaporan,'%H:%i:%s')>= STR_TO_DATE('".$start_hour."', '%H:%i:%s') and  DATE_FORMAT(tanggal_pelaporan,'%H:%i:%s') <= STR_TO_DATE('".$end_hour."','%H:%i:%s') ";
			
			$result = mysqli_query($conn, $sql);
			$return=array();
			if ($result && mysqli_num_rows($result) !=0){
			
			while($row = mysqli_fetch_assoc($result)) {
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
				array_push($return, $row);
			
		
		}

	
			
		}
			$spreadsheet = new Spreadsheet();

		//add some data in excel cells
		$spreadsheet->setActiveSheetIndex(0)
		 ->setCellValue('A1', 'No')
		 ->setCellValue('B1', 'NIK pelapor')
		 ->setCellValue('C1', 'Nama pelapor')
		 ->setCellValue('D1', 'Nama pelangar')
		 ->setCellValue('E1', 'Departemen')
		 ->setCellValue('F1', 'Area')
		 ->setCellValue('G1', 'Tanggal pelanggaran')
		 ->setCellValue('H1', 'Tipe aktivitas')
		 ->setCellValue('I1', 'Subkategori')
		 ->setCellValue('J1', '+/-')
		 ->setCellValue('K1', 'Action Plan')
		 ->setCellValue('L1', 'Keterangan');
				$cell_st =array(
		 'font' =>array('bold' => true),
		 'alignment' =>array('horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER),
		 'borders'=>array('allborders' =>array('style'=> \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM))
		);

				$cell_st2 =array(
		 
		 'alignment' =>array('horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER),
		 'borders'=>array('allborders' =>array('style'=> \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM))
		);
			$spreadsheet->getActiveSheet()->getStyle('A1:M1')->applyFromArray($cell_st);
			
			//set columns width
			$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(10);
			$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(20);
			$spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(10);
			$spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(30);
			$spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(30);


			$spreadsheet->getActiveSheet()->setTitle('Bukutamu'); //set a title for Worksheet

		$no =2;
		$num = 1;
		if (count($return) > 0) {
	    foreach ($return as $row) {
	        	$spreadsheet->setActiveSheetIndex(0)
				 ->setCellValue('A'.$no, $num)
				 ->setCellValue('B'.$no, $row['uid_pelapor'])
				 ->setCellValue('C'.$no, $row['nama_pelapor'])
				 ->setCellValue('D'.$no, $row['pelanggar'])
				 ->setCellValue('E'.$no, $row['departemen'])
				 ->setCellValue('F'.$no, $row['area'])
				 ->setCellValue('G'.$no, $row['tanggal_pelanggaran'])
				 ->setCellValue('H'.$no, $row['tipe_12'])
				 ->setCellValue('I'.$no, $row['subkategori'])
				 ->setCellValue('J'.$no, $row['positif'])
				 ->setCellValue('K'.$no, $row['ap'])
				 ->setCellValue('L'.$no, $row['keterangan']);
				$spreadsheet->getActiveSheet()->getStyle('A'.$no.':M'.$no)->applyFromArray($cell_st2);
				$no+=1;
				$num+=1;
	    }
		}

		$writer = new Xlsx($spreadsheet);
		$fxls ='pelaporan-'.$start.'-'.$end.'.xlsx';
		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename=pelaporan-'.$start.'-'.$end.'_shift-'.$flag.'.xlsx');
		$writer->save('php://output', $spreadsheet);
		
	}
	      
?>