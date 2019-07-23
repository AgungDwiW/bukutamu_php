<?php  
	require "../db/db_con.php";
	$image = base64_decode($_POST['Image']);
	$output = "media/".$_POST['UID'].".jpg";
	// var_dump($_POST['Image']);
	$noimage = "media/noimage.jpg";
	if($_POST['Image']!=""){
		if (file_exists($output))
			unlink($output);	
			
		if(!file_put_contents($output,$image)){
			$output = $noimage;
		}
			
		
	}
	
	$uid = $_POST["UID"];
	// ============================================================================================
	//check tamu
	// ============================================================================================
	$sql = "SELECT * FROM tamu where uid = ". $_POST["UID"];
	$tz_object = new DateTimeZone('Asia/Jakarta');
	$datetime = new DateTime();
    $datetime->setTimezone($tz_object);
    $now = $datetime->format('Y\-m\-d\ h:i:s');
    $now_date = $datetime->format('Y\-m\-d\ ');
	$result_tamu = mysqli_query($conn, $sql);
	$flag_sign = false;
	$id = 0;
	if (mysqli_num_rows($result_tamu) ==0){
		// ============================================================================================
		// Tamu belum terdaftar
		// ============================================================================================
		if (!isset($_POST['subtip']))
		$sql = "INSERT INTO tamu (uid, tipeid, nama_tamu, jenis_kelamin, signed_in,  image,  nohp, terakhir_datang, count_pelanggaran, blok,  terakhir_ind, tipe )
	 		 VALUES (".$_POST['UID'].",'".$_POST['TID']."', '". mysqli_real_escape_string($conn,$_POST['Nama'])."','".
	 		$_POST['Kelamin']."',". true.",'". $output."','".$_POST['NoHP']."','".$now."',0,0, '".$now_date."', ".$_POST['tipe'].")";
	 	else
	 		$sql = "INSERT INTO tamu (uid, tipeid, nama_tamu, jenis_kelamin, signed_in,  image,  nohp, terakhir_datang, count_pelanggaran, blok,  terakhir_ind, tipe )
	 		 VALUES (".$_POST['UID'].",'".$_POST['TID']."', '". mysqli_real_escape_string($conn,$_POST['Nama'])."','".
	 		$_POST['Kelamin']."',". true.",'". $output."','".$_POST['NoHP']."','".$now."',0,0, '".$now_date."', ".$_POST['subtip'].")";
		$result = mysqli_query($conn, $sql);
		$id = mysqli_insert_id($conn);
	// return true;
	}

	else{
		// ============================================================================================
		// Tamu sudah terdaftar
		// ============================================================================================
		while($row = mysqli_fetch_assoc($result_tamu)) {
			$id = $row['id'];
	    	$flag_sign = $row ['signed_in'];
	    	$saved = $row ['saved'];
	    }
	    if (!$saved){
	    	// ============================================================================================
			// hapus data diri tamu
			// ============================================================================================
			$sql = "UPDATE tamu 
			SET signed_in = true,
			terakhir_datang = '".$now."',
			image = '$output'
			WHERE id = ".$id;}
		else{
			// ============================================================================================
			// ganti status tamu menjadi keluar
			// ============================================================================================
			$sql = "UPDATE tamu
			SET signed_in = true,
			saved = '".$_POST['save']."',
			terakhir_datang = '".$now."',
			image = '$output'
			WHERE id = ".$id;
		}
		// echo "$sql";
		$result = mysqli_query($conn, $sql);
		if ($_POST['Ind'] == "Belum induksi")
		{
			$sql = "UPDATE tamu
			SET 
			terakhir_ind = '".$now_date."'
			WHERE id = ".$id;		
			$result = mysqli_query($conn, $sql);
		}

	
	}
	if($flag_sign){
		// ============================================================================================
		// kalau tamu masih dalam kondisi didalam error
		// ============================================================================================
		header('Location: index.php');
	}
	// 
	// ============================================================================================
	// input data kedatangan
	// ============================================================================================
	
	
	$suhu = str_replace(",", ".", $_POST['Suhu']);
	
	$sql = "INSERT INTO kedatangan (tanggal_datang, tanggal_keluar, keperluan, suhu_badan, luka, sakit, signedout, id_tamu, departemen, bertemu)
	 		VALUES ('".$now."','".NULL."', '".mysqli_real_escape_string($conn,$_POST['Keperluan'])."',".$suhu.",". $_POST['Luka'].",'". mysqli_real_escape_string($conn,$_POST['Sakit'])."','". false."',". $id.",'".  $_POST['departemen']."','".mysqli_real_escape_string($conn,$_POST['Bertemu'])."')";
	
	$result = mysqli_query($conn, $sql);
	
	session_start();
	$_SESSION['id']	 = mysqli_insert_id($conn);
	
	header('Location: kartu.php');
?>