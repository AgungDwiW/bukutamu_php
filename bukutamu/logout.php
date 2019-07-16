<?php 
	require "../db/db_con.php";
	$uid = $_POST['UID'];
	$sql = "SELECT saved FROM tamu where uid = ". $_POST["UID"];
	$result_tamu = mysqli_query($conn, $sql);
	$output = "media/".$_POST['UID'].".jpg";
	$noimage = "media/noimage.jpg";
	if (mysqli_num_rows($result_tamu) !=0){
		while($row = mysqli_fetch_assoc($result_tamu)) {
	    	$saved = $row ['saved'];
	   }
	}
	// echo $saved;
	$sql = "SELECT id FROM tamu where uid = ". $_POST["UID"];

	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($result)) {
		
		$id = $row['id'];
		if (!$row['signed_in'])
			header('Location: index.php');
	}
	// echo "$sql";
	if ($saved){
		$sql = "UPDATE tamu
				SET signed_in = false,
				image = '$output'
				WHERE id = ".$id;
		$result_tamu = mysqli_query($conn, $sql);
	}
	else{
		$sql = "UPDATE tamu
				SET signed_in = false,
				nama_tamu = '', 
				nohp = '',  
				jenis_kelamin = '',
				image = '$noimage'
				WHERE id = ".$id;
		// echo $sql;
		$result_tamu = mysqli_query($conn, $sql);	
	}
	$tz_object = new DateTimeZone('Asia/Jakarta');
	$datetime = new DateTime();
    $datetime->setTimezone($tz_object);
    $now = $datetime->format('Y\-m\-d\ h:i:s');

    $sql = "SELECT tanggal_datang 
    		FROM kedatangan 
    		where id_tamu = ". $id."
    		and signedout = false";
    // echo $sql;
    $result_tamu = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result_tamu) !=0){
		while($row = mysqli_fetch_assoc($result_tamu)) {
	    	$in = $row ['tanggal_datang'];
	   }
	}
	else
		// echo "$sql";
		// header('Location: index.php');	
	$datetime1 = strtotime($in);
	$datetime2 = strtotime($now);

	$secs = $datetime2 - $datetime1;// == <seconds between the two times>
	$min =intval ($secs/60);



    $sql = "UPDATE kedatangan
			SET signedout = true,
				tanggal_keluar ='". $now."',
				durasi =". $min."
			WHERE id_tamu = ".$id. 
			" AND signedout = false";
	// echo $sql;
	$result_tamu = mysqli_query($conn, $sql);

	header('Location: index.php');
 ?>