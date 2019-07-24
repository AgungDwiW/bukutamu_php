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
		$sql = "SELECT id_tamu FROM kartu_tamu where uid = '.".$uid."'";
		$result = mysqli_query($conn, $sql);
		if ($result && mysqli_num_rows($result) !=0){
			$row = mysqli_fetch_assoc($result);
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
					$sql = "SELECT * FROM kedatangan where id_tamu = ".$row['id']." ORDER BY tanggal_datang desc LIMIT 3";
					$result2 = mysqli_query($conn, $sql);
					// echo $sql;
					$temp2 = "";
					if (mysqli_num_rows($result2) !=0){
						$temp2 = array();
						while($row2 = mysqli_fetch_assoc($result2)) {
							$temp2[$row2['id']] = $row2['tanggal_datang'];
							
						}
					}
					$sql = "SELECT * FROM tipe_tamu where id = ".$row['tipe']."";
					$result = mysqli_query($conn, $sql);
					if ($result && mysqli_num_rows($result) !=0){
						while($row2 = mysqli_fetch_assoc($result)) {
							$kategori = $row2['tipe'];
						}
					}

					$return_arr[] = array(
						"nama" => $row['nama_tamu'],
						"id" => $row['id'],
	                    "hp" => $row['nohp'],
	                    "kategori" => $kategori,
	                    "kedatangan" => $temp2,
	                    "counter" => $row['count_pelanggaran']
	                	);
				}
				echo json_encode($return_arr);
			}
			
		}
		
	}
	      
?>