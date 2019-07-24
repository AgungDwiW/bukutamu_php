<?php  
	require "../db/db_con.php";
	$image = base64_decode($_POST['Image']);
	$output = "media/".$_POST['UID'].".jpg";
	// var_dump($_POST['Image']);
	$noimage = "media/noimage.jpg";
	if($_POST['Image']!=""){
		if (file_exists($output))
			unlink($output);	
			
		if(!file_put_contents($output,$image))
			$output = $noimage;
	}
	else
		$output = $noimage;	

	$uid = $_POST["UID"];


	$tz_object = new DateTimeZone('Asia/Jakarta');
	$datetime = new DateTime();
    $datetime->setTimezone($tz_object);
    $now = $datetime->format('Y\-m\-d\ h:i:s');
    $now_date = $datetime->format('Y\-m\-d\ ');

	$sql = "SELECT id_tamu from uid_tamu where uid = ".$uid;
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) ==0){
		// =========================================================================
		// Tamu not found in db, add uid to uid tables and add tamu to tamu table
		// ========================================================================
	
		if (isset($_POST['subtip']))
			$tip = $_POST['subtip'];
		else
			$tip = $_POST['tipe'];
		$sql = "INSERT INTO tamu ( nama_tamu, jenis_kelamin, signed_in,  image,  nohp, terakhir_datang, count_pelanggaran, blok,  terakhir_ind, tipe )
	 		 VALUES ('". mysqli_real_escape_string($conn,$_POST['Nama'])."','".
	 		$_POST['Kelamin']."',". true.",'". $output."','".$_POST['NoHP']."','".$now."',0,0, '".$now_date."', ".$tip.")";	 	
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
		if (isset($_POST['uid1'])){
			$sql = "insert into uid_tamu(uid, tipeid, id_tamu) values('".$_POST['uid1']."', '".$_POST['tid1']."', ". $id_tamu .")";
			$result = mysqli_query($conn, $sql);
		}
		if (isset($_POST['uid2'])){
			$sql = "insert into uid_tamu(uid, tipeid, id_tamu) values('".$_POST['uid2']."', '".$_POST['tid2']."', ". $id_tamu .")";
			$result = mysqli_query($conn, $sql);
		}
		$sql = "UPDATE tamu
			SET signed_in = true,
			terakhir_datang = '".$now."',
			image = '$output'
			WHERE id = ".$id_tamu;

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

	// =============================================================================
	// input data kedatangan
	// =============================================================================
	
	
	$suhu = str_replace(",", ".", $_POST['Suhu']);
	
	$sql = "INSERT INTO kedatangan (tanggal_datang, tanggal_keluar, keperluan, suhu_badan, luka, sakit, signedout, id_tamu, departemen, bertemu)
	 		VALUES ('".$now."','".NULL."', '".mysqli_real_escape_string($conn,$_POST['Keperluan'])."',".$suhu.",". $_POST['Luka'].",'". mysqli_real_escape_string($conn,$_POST['Sakit'])."','". false."',". $id_tamu.",'".  $_POST['departemen']."','".mysqli_real_escape_string($conn,$_POST['Bertemu'])."')";
	
	$result = mysqli_query($conn, $sql);
	
	$sql = "SELECT value FROM setting where nama = 'max_temp' ";
	$result_tamu = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_assoc($result_tamu)) {
		$max_temp = $row['value'];
    }

	$flag = $_POST['Luka'] || $_POST['Sakit'] || $_POST['Suhu']> $max_temp;

	session_start();
	$_SESSION['id']	 = mysqli_insert_id($conn);
	$_SESSION['id_tamu'] = $id_tamu;
	$_SESSION['flag'] = $flag;
	header('Location: kartu.php');
?>