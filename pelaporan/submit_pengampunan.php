<?php
require "../db/db_con.php";
	require 'auth/login_middleware.php';
// var_dump($_POST);
$uid_jahat = $_POST['uid_pelaku'];
$uid_baik = $_POST['uid_pelapor'];
$nama = $_POST['nama_pelapor'];
// echo $_POST['fileToUpload'];
$image = base64_decode($_POST['Image']);


	$tz_object = new DateTimeZone('Asia/Jakarta');
	$datetime = new DateTime();
    $datetime->setTimezone($tz_object);
    $now = $datetime->format('Y\-m\-d\ H:i:s');
    $now_date = $datetime->format('Y\-m\-d\ ');
function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
{
	$pieces = array();
	$max = mb_strlen($keyspace, '8bit') - 1;
	for ($i = 0; $i < $length; ++$i) {
		$pieces []= $keyspace[intval(rand ( 0 , $max ))];
	}
	return implode('', $pieces);
}
$randname = random_str(5);
$output = "MOU/".$_POST['uid_pelaku'].$randname.".jpg";
file_put_contents($output,$image);


$id_tamu = $_POST['id_tamu'];
$id_kary = $_POST['id_kary'];

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
$sql2 = "UPDATE tamu SET count_pelanggaran = 0, blok = 0 WHERE uid = $id_tamu";
// echo "$sql2";
$result = mysqli_query($conn, $sql2);


$sql = "insert into pengampunan(id_karyawan, id_tamu, mou, tanggal_pengampunan) values( '$id_kary',  '$id_tamu', '$output', '$now_date')";
$result = mysqli_query($conn, $sql);
header('Location: listpengampunan.php');	
?>