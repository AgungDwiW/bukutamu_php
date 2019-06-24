<?php
	require $_SERVER['DOCUMENT_ROOT']."/bukutamu_php"."/db/db_con.php";
	$sql = "SELECT * FROM kedatangan where id = '". $_POST["tgl_langgar"]."'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) ==0){
		header('Location: listpelaporan.php');
	}
	if (mysqli_num_rows($result) !=0){
		$temp2 = array();
		while($row = mysqli_fetch_assoc($result)) {
			$departemen = $row['departemen'];
			$tanggal = $row['tanggal_datang'];
		}
	}
	$tz_object = new DateTimeZone('Asia/Jakarta');
	$datetime = new DateTime();
    $datetime->setTimezone($tz_object);
    $now = $datetime->format('Y\-m\-d\ h:i:s');

	
	$nama_pelapor = $_POST['nama_pelapor'];
    $uid_pelapor = $_POST['uid_pelapor'];
    $tid_pelapor = $_POST['tid_pelapor'];
	$ap1 = $_POST['AP1'];
	$ap2 = $_POST['AP2'];
    $tanggal_pelaporan = $now;
    $tipe_12 = $_POST['aktivitas_12'];
    $subkategori = $_POST['Subkategori'];
    $positif =$_POST['positivity'];
    
    $keterangan = $_POST['keterangan'];
    $area = $_POST['area'];
    $uid = $_POST['uid_pelaku'];
	$sql = "INSERT INTO pelaporan(nama_pelapor, uid_pelapor, tanggal_pelanggaran, 			tanggal_pelaporan, tipe_12, subkategori, positif, area, ap1, ap2, 
				keterangan, pelanggar, departemen)
			VALUES(
				'".$nama_pelapor."',
				'".$uid_pelapor."',
				'".$tanggal."',
				'".$tanggal_pelaporan."',
				'".$tipe_12."',
				'".$subkategori."',
				'".$positif."',
				".$area.",
				'".$ap1."',
				'".$ap2."',
				'".$keterangan."',
				".$uid.",
				".$departemen."
				)
				";
	$result = mysqli_query($conn, $sql);
	echo $sql;

?>