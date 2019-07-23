<?php 
	require "../db/db_con.php";
	$uid = $_POST['UID'];
	$next = $_GET['next'];

	/*=====================
	id_tamu associated with visitor card
    =======================*/
	$sql = "select id_tamu from kartu_tamu where uid= ". $uid;
	$result = mysqli_query($conn, $sql);
	if ($result && mysqli_num_rows($result) !=0){
		while($row = mysqli_fetch_assoc($result)) {
	    	$id_tamu = $row['id_tamu'];
	   }
	}
	/*=====================
	id_tamu associated with visitor's id card
    =======================*/
	if (!isset($id_tamu)){
		$sql = "select id_tamu from uid_tamu where uid= ". $uid;
		
		$result = mysqli_query($conn, $sql);
		if ($result && mysqli_num_rows($result) !=0){
			while($row = mysqli_fetch_assoc($result)) {
		    	$id_tamu = $row['id_tamu'];
		   }
		}
	}
	else{
		/*=====================
		tamu's data is not found, error!
	    =======================*/
		header('Location: '.$next);	    
	}
	
	
	$tz_object = new DateTimeZone('Asia/Jakarta');
	$datetime = new DateTime();
    $datetime->setTimezone($tz_object);
    $now = $datetime->format('Y\-m\-d\ h:i:s');

    /*=====================
	get tanggal_datang to compute duration
    =======================*/
    $sql = "SELECT tanggal_datang
    		FROM kedatangan 
    		where id_tamu = ". $id_tamu."
    		and signedout = false";
    $result_tamu = mysqli_query($conn, $sql);
    
    if ($result_tamu && mysqli_num_rows($result_tamu) !=0){
		while($row = mysqli_fetch_assoc($result_tamu)) {
	    	$in = $row ['tanggal_datang'];
	   }
	}
	else
		// header('Location: '.$next);	

	$datetime1 = strtotime($in);
	$a=strtotime($in);
	$datetime2 = strtotime($now);

	$secs = $datetime2 - $a;// == <seconds between the two times>
	$min =intval ($secs/60);

	 /*=====================
	updateing the state of data in db
    =======================*/

	$sql = "UPDATE tamu
			SET signed_in = false
			WHERE id = ".$id_tamu;
	$result_tamu = mysqli_query($conn, $sql);
	
    $sql = "UPDATE kedatangan
			SET signedout = true,
				tanggal_keluar ='". $now."',
				durasi =". $min."
			WHERE id_tamu = ".$id_tamu. 
			" AND signedout = false";
	
	$result_tamu = mysqli_query($conn, $sql);

	$sql = "UPDATE kartu_tamu
			SET id_tamu = NULL
			where uid = ".$uid;
	
	$result_tamu = mysqli_query($conn, $sql);
	header('Location: '.$next);	    
 ?>