<?php
require "../db/db_con.php";
// var_dump($_POST);
$uid_jahat = $_POST['uid_pelaku'];
$uid_baik = $_POST['uid_pelapor'];
$nama = $_POST['nama_pelapor'];
// echo $_POST['fileToUpload'];
$image = base64_decode($_POST['Image']);
$tz_object = new DateTimeZone('Asia/Jakarta');
$datetime = new DateTime();
$datetime->setTimezone($tz_object);
$now = $datetime->format('Y\-m\-d\;h:i:s');
$output = "MOU/".$_POST['uid_pelaku']."-".$now.".jpg";
file_put_contents($output,$image);

// if (isset($_FILES["fileToUpload"])){
// 	$target_dir = "MOU/";
// 	$target_file = $target_dir . basename($_FILES["fileToUpload"]["tmp_name"]);
// 	$name = $target_file;
// 	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
// 	        //success
// 	    } else {
// 	        //failed
// 	}
// }
$sql2 = "UPDATE tamu SET count_pelanggaran = 0 WHERE uid = $uid_jahat";
// echo "$sql2";
$result = mysqli_query($conn, $sql2);


$sql = "insert into pengampunan(uid_pengampun, nama_pengampun, pelanggar, mou) values( $uid_baik, '$nama', $uid_jahat, '$output')";
$result = mysqli_query($conn, $sql);
// echo "$sql";
header('Location: dashboard.php');	
?>