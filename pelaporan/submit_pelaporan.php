<?php
	require "../db/db_con.php";
	require 'auth/login_middleware.php';
	require 'mail.php';
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
	$ap = $_POST['ap'];
    $tanggal_pelaporan = $now;
    $tipe_12 = $_POST['aktivitas_12'];
    $subkategori = $_POST['Subkategori'];
    $positif =$_POST['positivity'];
    
    $keterangan = $_POST['keterangan'];
    $area = $_POST['area'];
    $uid = $_POST['uid_pelaku'];
	$sql = "INSERT INTO pelaporan(nama_pelapor, uid_pelapor, tanggal_pelanggaran, 			tanggal_pelaporan, tipe_12, subkategori, positif, area, ap, 
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
				'".$ap."',
				
				'".$keterangan."',
				".$uid.",
				".$departemen."
				)
				";
	$result = mysqli_query($conn, $sql);
	echo $sql;

	$sql = "SELECT count_pelanggaran AS count FROM tamu WHERE uid = ".$uid;
	// echo $sql;
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) !=0){
		var_dump($result);
		while($row = mysqli_fetch_assoc($result)) {
			$count = $row['count'];
			
			if (!$positif){
			$count+=1;
			$sql2 = "UPDATE tamu SET count_pelanggaran = $count WHERE uid = $uid";
			$result = mysqli_query($conn, $sql2);
			}
			// echo "$sql2";
			echo $row['count'];
			// echo "<br>";
			if ($row['count']>=3){
				// echo "aaaaa";
				$sql = "SELECT * FROM tamu WHERE uid = ".$uid;
				// echo "$sql";
				$result2 = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result2) !=0){
				while($row2 = mysqli_fetch_assoc($result2)) {
					$nama = $row2['nama_tamu'];
				}
				$subject = "Pelanggaran melebihi 3 kali oleh".$nama;
				$body = "Detail pelanggaran :<br>";
				$sql = "SELECT * FROM pelaporan WHERE pelanggar = ".$uid;
				// echo "$sql";
				$result3 = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result3) !=0){
					while($row3 = mysqli_fetch_assoc($result3)) {
					$body = $body."==========================================================<br>";
					$body = $body."tanggal_pelanggaran = ".$row3['tanggal_pelanggaran']."<br>";
					$body = $body."area = ".$row3['area']."<br>";
					$body = $body."tipe aktivitas 12 = ".$row3['tipe_12']."<br>";
					$body = $body."subkategori = ".$row3['subkategori']."<br>";
					$body = $body."action plan = ".$row3['ap']."<br>";
					$body = $body."keterangan= ".$row3['keterangan']."<br>";
				}
				
				$sql = "SELECT * FROM departemen WHERE id = ".$departemen;
				$result4 = mysqli_query($conn, $sql);
				if (mysqli_num_rows($result4) !=0){
					while($row4 = mysqli_fetch_assoc($result4)) {
					$to_name = $row4['nama_departemen'];
					$to_address = $row4['email'];
				}
				// echo "aaa";
				// echo "$body";
				send_mail($subject, $body, $to_address, $to_name);
			}
		}
	}
}}}
	header('Location: listpelaporan.php');	

?>