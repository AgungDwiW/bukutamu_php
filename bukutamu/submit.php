<?php  
	require $_SERVER['DOCUMENT_ROOT']."/bukutamu_php"."/db/db_con.php";
	$image = base64_decode($_POST['Image']);
	$output = "media/".$_POST['UID'].".jpg";

	try{
		unlink($output);	
	}
	catch(Exception $e){
		echo $e;
	}
	file_put_contents($output,$image);

	$sql = "INSERT INTO Tamu (uid, tipeid, nama_tamu, jenis_kelamin, signed_in, perusahaan, image, saved, nohp)
	 		VALUES (".$_POST['UID'].",'".$_POST['TID']."', '".$_POST['Nama']."','".
	 		$_POST['Kelamin']."',". true.",'". $_POST['Institusi']."','". $output."',". $_POST['save'].",".$_POST['NoHP'].")";
	// var_dump($sql);
	$result = mysqli_query($conn, $sql);
	if ($result === TRUE) {
    	echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$tz_object = new DateTimeZone('Asia/Jakarta');
	$datetime = new DateTime();
    $datetime->setTimezone($tz_object);
    $now = $datetime->format('Y\-m\-d\ h:i:s');
    // sleep(2);
    // $datetime = new DateTime();
    // $datetime->setTimezone($tz_object);
    // $now2 = $datetime->format('Y\-m\-d\ h:i:s');
    // $d1 = strtotime($now);
    // $d2 =  strtotime($now2);
    // var_dump($d1-$d2);
    // echo "\n";
    // var_dump($d1);
    // echo "\n";
    // var_dump($d2);
	// var_dump($now);
	// $d = new DateTime($now);
	// $d->setTimezone($tz_object);
	// var_dump($d);
	$sql = "INSERT INTO Kedatangan (tanggal_datang, tanggal_keluar, keperluan, suhu_badan, luka, sakit, signedout, tamu, departemen)
	 		VALUES ('".$now."','".NULL."', '".$_POST['Keperluan']."',".$_POST['Suhu'].",". $_POST['Luka'].",'". $_POST['Sakit']."','". false."',". $_POST['UID'].",'".  $_POST['departemen']."')";
	// var_dump($sql);
	$result = mysqli_query($conn, $sql);
	if ($result === TRUE) {
    	echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}
	// header('Location: index.php');
(2019-06-22 11:01:10,'', '123','123',0,'','',11111,'1')
?>