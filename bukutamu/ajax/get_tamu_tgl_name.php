<?php 
	if (!isset($_POST['tgl'])) {
		$return['error'] = "parameteer not satified";
		echo json_encode($return);
	}
	else{
		require "../../db/db_con.php";
		$sql = "SELECT * FROM tamu where tanggal_lahir = '".$_POST['tgl']."' and nama_tamu like '%".$_POST['nama']."%'";
		$result = mysqli_query($conn, $sql);
		$return = array();
		if ($result && mysqli_num_rows($result) !=0){
			while($row = mysqli_fetch_assoc($result)) {
				 $sql = "SELECT tipe FROM tipe_tamu where id = ".$row['tipe'];
                                            $result2 = mysqli_query($conn, $sql);
				 if ($result2 &&(mysqli_num_rows($result2) !=0)){
	                while($row2 = mysqli_fetch_assoc($result2)) {
	                    $row['tipe'] = $row2['tipe'];}}
				array_push($return, $row);
			}
			echo json_encode($return);
		}
		else{
			$return['error'] = "not found";;
			echo json_encode($return);			
		}
		
	}
	      
?>