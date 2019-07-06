// <?php  
	require "../db/db_con.php";
	$image = base64_decode($_POST['Image']);
	$output = "media/".$_POST['UID'].".jpg";

	try{
		unlink($output);	
	}
	catch(Exception $e){
		echo $e;
	}
	// echo $_POST['TID'];
	file_put_contents($output,$image);
	$uid = (int)$_POST["UID"];
	$sql = "SELECT * FROM tamu where uid = ". $_POST["UID"];
	// var_dump($_POST);
	$tz_object = new DateTimeZone('Asia/Jakarta');
	$datetime = new DateTime();
    $datetime->setTimezone($tz_object);
    $now = $datetime->format('Y\-m\-d\ h:i:s');
	$result_tamu = mysqli_query($conn, $sql);
	$flag_sign = false;
	if (mysqli_num_rows($result_tamu) ==0){
		$sql = "INSERT INTO tamu (uid, tipeid, nama_tamu, jenis_kelamin, signed_in, perusahaan, image, saved, nohp, terakhir_datang, count_pelanggaran)
	 		VALUES (".$_POST['UID'].",'".$_POST['TID']."', '". mysqli_real_escape_string($conn,$_POST['Nama'])."','".
	 		$_POST['Kelamin']."',". true.",'".  mysqli_real_escape_string($conn,strtolower($_POST['Institusi']))."','". $output."',". $_POST['save'].",".$_POST['NoHP'].",'".$now."',0)";
		echo $sql;
		$result = mysqli_query($conn, $sql);

	}

	else{
		while($row = mysqli_fetch_assoc($result_tamu)) {
	    	$flag_sign = $row ['signed_in'];
	    	$saved = $row ['saved'];
	    }
	    if (!$saved){
			$sql = "UPDATE tamu 
			SET signed_in = true,
			nama_tamu ='".mysqli_real_escape_string($conn,$_POST['Nama'])."',
			jenis_kelamin = '".$_POST['Kelamin']."',
			perusahaan = '". mysqli_real_escape_string($conn,strtolower($_POST['Institusi']))."',
			saved = '".$_POST['save']."',
			nohp = '".$_POST['NoHP']."',
			tipeid = '".$_POST['TID']."',
			terakhir_datang = '".$now."',
			image = '$output'
			WHERE UID = ".$uid;}
		else{
			$sql = "UPDATE tamu
			SET signed_in = true,
			saved = '".$_POST['save']."',
			terakhir_datang = '".$now."',
			image = '$output'
			WHERE UID = ".$uid;
		}
		$result = mysqli_query($conn, $sql);

	
	}

	$year =  date("Y");
	$sql = "SELECT * FROM year where year = ".$year;
	$result_year = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result_year) ==0){
		$sql = "insert into year(year) values (".$year.")";
		$result_year = mysqli_query($conn, $sql);
	}

	if($flag_sign){
		header('Location: index.php');
	}
	

	$sql = "INSERT INTO kedatangan (tanggal_datang, tanggal_keluar, keperluan, suhu_badan, luka, sakit, signedout, tamu, departemen, bertemu)
	 		VALUES ('".$now."','".NULL."', '".mysqli_real_escape_string($conn,$_POST['Keperluan'])."',".$_POST['Suhu'].",". $_POST['Luka'].",'". mysqli_real_escape_string($conn,$_POST['Sakit'])."','". false."',". $_POST['UID'].",'".  $_POST['departemen']."','".mysqli_real_escape_string($conn,$_POST['Bertemu'])."')";
	// var_dump($sql);
	$result = mysqli_query($conn, $sql);

	header('Location: index.php');
?>