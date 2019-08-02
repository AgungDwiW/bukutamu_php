<?php 
	 /*
	 get tamu's data using visitor card's nrf  id
	 */
	require "check.php";
	if (!check_login())
	{
		$return['error'] = "not loged in";
		
		echo json_encode($return);
	}
	elseif (!isset($_GET['uid'])) {
		$return['error'] = "uid not set";
		echo json_encode($return);
	}
	else{
		$uid = $_GET['uid'];
		require "../../db/db_con.php";
		$sql = "SELECT id_tamu FROM kartu_tamu where uid = '".$uid."'";
		
		$result = mysqli_query($conn, $sql);
		if ($result && mysqli_num_rows($result) !=0){
			$row = mysqli_fetch_assoc($result);
			$return['row'] = $row;
			$id_tamu = $row['id_tamu'];
		}
		if (!isset($id_tamu)){
			$return['error'] = "not found";;
			echo json_encode($return);			

		}
		else{
			$sql = "SELECT * FROM tamu where id = ".$id_tamu."";
			$result = mysqli_query($conn, $sql);
			if ($result && mysqli_num_rows($result) !=0){
				while($row = mysqli_fetch_assoc($result)) {
					$sql = "SELECT * FROM kedatangan where id_tamu = ".$row['id']." ORDER BY tanggal_datang desc LIMIT 1";
					$result2 = mysqli_query($conn, $sql);
					// echo $sql;
					$temp2 = "";
					if (mysqli_num_rows($result2) !=0){
						$temp2 = array();
						while($row2 = mysqli_fetch_assoc($result2)) {
							$sql = "SELECT * FROM tipe_tamu where id = ".$row2['id_tipe']."";
							$result = mysqli_query($conn, $sql);
							if ($result && mysqli_num_rows($result) !=0){
								while($row3 = mysqli_fetch_assoc($result)) {
									$kategori = $row3['tipe'];
								}
							}
							$temp3 = $kategori;							
							$temp2[$row2['id']] = $row2['tanggal_datang'];
							$tipe = $row2['id_tipe'];
						}
					}
					

					$return_arr[] = array(
						"nama" => $row['nama_tamu'],
						"id" => $row['id'],
	                    "hp" => $row['nohp'],
	                    "kategori" => $temp3,
	                    "kedatangan" => $temp2,
	                    "counter" => $row['count_pelanggaran'],
	                    "tipe"=> $tipe
	                	);
				}
				echo json_encode($return_arr);
			}
			
		}
		
	}
	      
?>