<?php
	require "../db/db_con.php";
	require 'auth/super_middleware.php';
	$sql = "UPDATE setting SET value = ".$_POST['max_temp']." where nama = 'max_temp'";
	$result = mysqli_query($conn, $sql);

	// echo "$sql";
	$sql = "UPDATE setting SET value = ".$_POST['max_pel']." where nama = 'max_pel'";
	$result = mysqli_query($conn, $sql);
	$sql = "UPDATE setting SET value = ".$_POST['max_ind']." where nama = 'max_ind'";
	$result = mysqli_query($conn, $sql);
	$sql = "UPDATE setting SET value = ".$_POST['reset']." where nama = 'autoreset'";
	$result = mysqli_query($conn, $sql);
	$sql = "UPDATE setting SET value = ".$_POST['delete']." where nama = 'autodelete'";
	$result = mysqli_query($conn, $sql);

	$sql = "DROP EVENT IF EXISTS `autoresetpel`";
	$result = mysqli_query($conn, $sql);

	$sql = "DROP EVENT IF EXISTS `autodelete_ked`";
	$result = mysqli_query($conn, $sql);
	
	$sql = "DROP EVENT IF EXISTS `autodelete_pel` ";
	$result = mysqli_query($conn, $sql);
	
			
	$sql = 	"
		CREATE EVENT `autoresetpel`
		ON SCHEDULE EVERY 1 MONTH 
		ON COMPLETION PRESERVE 
		ENABLE 
		DO 
		UPDATE tamu SET count_pelanggaran = 0 , terakhir_count =STR_TO_DATE(CURDATE(), '%Y-%m-%d'), blok = 0
		where STR_TO_DATE(CURDATE(), '%Y-%m-%d') - INTERVAL ".$_POST['reset']." MONTH > STR_TO_DATE(`terakhir_count`, '%Y-%m-%d');
		";
	
	$result = mysqli_query($conn, $sql);

	$sql = "
		CREATE EVENT `autodelete_ked`
		ON SCHEDULE EVERY 1 MONTH 
		ON COMPLETION PRESERVE 
		ENABLE 
		DO 
		DELETE FROM kedatangan
		where STR_TO_DATE(CURDATE(), '%Y-%m-%d') - INTERVAL ".$_POST['delete']." MONTH > STR_TO_DATE(`tanggal_datang`, '%Y-%m-%d');
		";
	$result = mysqli_query($conn, $sql);		

	$sql = "
		CREATE EVENT `autodelete_pel`
		ON SCHEDULE EVERY 1 MONTH 
		ON COMPLETION PRESERVE 
		ENABLE 
		DO 
		DELETE FROM pelaporan
		where STR_TO_DATE(CURDATE(), '%Y-%m-%d') - INTERVAL ".$_POST['delete']." MONTH > STR_TO_DATE(`tanggal_pelanggaran`, '%Y-%m-%d');
		";
	$result = mysqli_query($conn, $sql);	
	// echo "$sql";
	header('Location: setting.php');


?>