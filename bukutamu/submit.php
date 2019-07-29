<?php  
	require "../db/db_con.php";

	$uid = $_POST["UID"];


	$tz_object = new DateTimeZone('Asia/Jakarta');
	$datetime = new DateTime();
    $datetime->setTimezone($tz_object);
    $now = $datetime->format('Y\-m\-d\ H:i:s');
    $now_date = $datetime->format('Y\-m\-d\ ');
	
	$sql = "SELECT id_tamu from uid_tamu where uid = '".$uid."'";
	$result = mysqli_query($conn, $sql);
	if (!$result || mysqli_num_rows($result) ==0){
		// =========================================================================
		// Tamu not found in db, add uid to uid tables and add tamu to tamu table
		// ========================================================================
	
		if (isset($_POST['subtip']))
			$tip = $_POST['subtip'];
		else
			$tip = $_POST['tipe'];
		$sql = "INSERT INTO tamu ( nama_tamu, jenis_kelamin, signed_in,  nohp, terakhir_datang, count_pelanggaran, blok,  terakhir_ind, tipe, tanggal_lahir )
	 		 VALUES ('". mysqli_real_escape_string($conn,strtoupper($_POST['Nama']))."','".
	 		$_POST['Kelamin']."',". true.",'".$_POST['NoHP']."','".$now."',0,0, '".$now_date."', ".$tip.",'".$_POST['Tgl']."')";	 	
		$result = mysqli_query($conn, $sql);
		$id_tamu = mysqli_insert_id($conn);

		$sql = "insert into uid_tamu(uid, tipeid, id_tamu) values('".$uid."', '".$_POST['TID']."', ". $id_tamu .")";
		$result = mysqli_query($conn, $sql);
	}
	else{

		$row = mysqli_fetch_assoc($result);
		// =========================================================================
		// Tamu found in db, change signin flag to true and update induction date if neccesary
		// =========================================================================

		$id_tamu = $row['id_tamu'];
		// =========================================================================
		// adding additional uids if exists
		// =========================================================================
		
		$sql = "UPDATE tamu
			SET signed_in = true,
			terakhir_datang = '".$now."'
			WHERE id = ".$id_tamu;

		$result = mysqli_query($conn, $sql);
		if ($_POST['Ind'] == "Belum induksi")
		{
			$sql = "UPDATE tamu
			SET 
			terakhir_ind = '".$now_date."'
			WHERE id = ".$id_tamu;		
			$result = mysqli_query($conn, $sql);
		}

	}	

	// =============================================================================
	// input data kedatangan
	// =============================================================================
	
	$image = base64_decode($_POST['Image']);
	$output = "media/".$id_tamu.".jpg";
	// var_dump($_POST['Image']);
	$noimage = "media/noimage.jpg";
	if($_POST['Image']!=""){
		if (file_exists($output))
			unlink($output);	
		if(!file_put_contents($output,$image))
			$output = $noimage;
		$sql = "UPDATE tamu
			SET image = '".$output."' 
			where id = ".$id_tamu;
		$result = mysqli_query($conn, $sql);
	}


	$suhu = str_replace(",", ".", $_POST['Suhu']);
	$sql = "SELECT value FROM setting where nama = 'max_temp' ";
	$result_tamu = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($result_tamu)) {
		$max_temp = $row['value'];
    }
    $sql = "SELECT count(*) as count FROM uid_tamu where id_tamu = ".$id_tamu;
	$result_tamu = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($result_tamu)) {
		$count = $row['count'];
    }

	$sql = "INSERT INTO kedatangan (tanggal_datang, tanggal_keluar, keperluan, suhu_badan, luka, sakit, signedout, id_tamu, departemen, bertemu, no_pol)
	 		VALUES ('".$now."','".NULL."', '".mysqli_real_escape_string($conn,strtoupper($_POST['Keperluan']))."',".$suhu.",". $_POST['Luka'].",'". mysqli_real_escape_string($conn,$_POST['Sakit'])."','". false."',". $id_tamu.",'".  $_POST['departemen']."','".mysqli_real_escape_string($conn,$_POST['Bertemu'])."','".mysqli_real_escape_string($conn,strtoupper($_POST['nopol']))."')";

	$result = mysqli_query($conn, $sql);	

	if (isset($_POST['uid1'])){

		if ($count<3){
			$sql = "insert into uid_tamu(uid, tipeid, id_tamu) values('".$_POST['uid1']."', '".$_POST['tid1']."', ". $id_tamu .")";
			$result = mysqli_query($conn, $sql);
			$count+=1;
		}
	}

	if (isset($_POST['uid2'])){
		
		if ($count<3){
			$sql = "insert into uid_tamu(uid, tipeid, id_tamu) values('".$_POST['uid2']."', '".$_POST['tid2']."', ". $id_tamu .")";
			$result = mysqli_query($conn, $sql);
			$count+=1;	
		}
	}



	session_start();
	$_SESSION['id']	 = mysqli_insert_id($conn);
	
	
	$flag = $_POST['Luka'] || $_POST['Sakit'] || $_POST['Suhu']> $max_temp;


	// var_dump($_POST);
	$_SESSION['id_tamu'] = $id_tamu;
	$_SESSION['flag'] = $flag;
	header('Location: kartu.php');
?>