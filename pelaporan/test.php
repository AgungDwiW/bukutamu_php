<?php 
if (isset($_GET['year']))
  $year = $_GET['year'];
else
  $year = 2018;

require $_SERVER['DOCUMENT_ROOT']."/bukutamu_php"."/db/db_con.php";
$month = array('01','02','03','04','05','06','07','08','09','10','11','12');
$count_month = array(0,0,0,0,0,0,0,0,0,0,0,0);
for ($x = 0; $x<12; $x+=1){
  $sql = 'SELECT count(*) as count from kedatangan where YEAR(STR_TO_DATE(tanggal_datang, "%Y-%m-%d")) = '.$year.' and MONTH(STR_TO_DATE(tanggal_datang, "%Y-%m-%d")) = '.$month[$x].'';
  // echo $sql;
  // echo "<br>";
  $result = mysqli_query($conn, $sql);
  if ($result&& mysqli_num_rows($result) !=0){
    while($row = mysqli_fetch_assoc($result)) {
        // echo $row['count'];
        // echo "<br>";
      $count_month[$x] = intval($row['count']);
    }
  }
}
// }
// foreach ($count_month as $key ) {
//     echo "$key,";
// }
// echo "<br>";

$area_pel = array(0,0,0,0,0);

for ($x = 0; $x<5; $x++){
    $sql = 'SELECT count(*) as count from pelaporan where YEAR(STR_TO_DATE(tanggal_pelanggaran, "%Y-%m-%d")) = '.$year.' and area = '.($x+1);
    $result = mysqli_query($conn, $sql);
      if ($result&& mysqli_num_rows($result) !=0){
        while($row = mysqli_fetch_assoc($result)) {
          $area_pel[$x] = intval($row['count']);
        }
      }
}

// foreach ($area_pel as $key ) {
//     echo "$key,";
// }
// // echo "<br>";

foreach ($area_pel as $key =>$value) {
    // echo "$key => $value ,";
}
// echo "<br>";

$sql = 'SELECT pelanggar from pelaporan where YEAR(STR_TO_DATE(tanggal_pelanggaran, "%Y-%m-%d")) = '.$year;
$result = mysqli_query($conn, $sql);
$perusahaan_pel = array();
$perusahaan_name = array();
$cur = 0;
if ($result&& mysqli_num_rows($result) !=0){
    while($row = mysqli_fetch_assoc($result)) {
        $sql = 'SELECT perusahaan from tamu where uid = '.$row['pelanggar'];
        $result2 = mysqli_query($conn, $sql);
        if ($result2&& mysqli_num_rows($result2) !=0){
            
            $cur_now = 0;
            while($row2 = mysqli_fetch_assoc($result2)) {
                if (!in_array($row2['perusahaan'], $perusahaan_name)){
                    
                    $perusahaan_name[$cur]=$row2['perusahaan'];
                    $perusahaan_pel[$cur]=1;
                    $cur+=1;}
                else{
                    foreach ($perusahaan_name as $key => $value) {
                        if ($value == $row2['perusahaan']){
                            $cur_now = $key;
                            break;
                        }
                    }
                    $perusahaan_pel[$cur_now]+=1;}
        }
    }
}
}


$sql = 'SELECT tamu from kedatangan where YEAR(STR_TO_DATE(tanggal_datang, "%Y-%m-%d")) = '.$year;
$result = mysqli_query($conn, $sql);
echo "$sql";
if ($result&& mysqli_num_rows($result) !=0){
    while($row = mysqli_fetch_assoc($result)) {
        var_dump($row);
        $sql = 'SELECT perusahaan from tamu where uid = '.$row['tamu'];
        $result2 = mysqli_query($conn, $sql);
        if ($result2&& mysqli_num_rows($result2) !=0){
            
            $cur_now = 0;
            while($row2 = mysqli_fetch_assoc($result2)) {
                if (!in_array($row2['perusahaan'], $perusahaan_name)){
                    $perusahaan_name[$cur]=$row2['perusahaan'];
                    $perusahaan_pel[$cur]=1;
                    $cur+=1;}
                else{
                    foreach ($perusahaan_name as $key => $value) {
                        if ($value == $row2['perusahaan']){
                            $cur_now = $key;
                            break;
                        }
                    }
                    $perusahaan_datang[$cur_now]+=1;}
        }
    }
}
}

$sql = 'SELECT id, nama_departemen from departemen';
$result = mysqli_query($conn, $sql);
$departemen_name = array();
if ($result&& mysqli_num_rows($result) !=0){
    while($row = mysqli_fetch_assoc($result)) {
        $departemen_name[$row['id']] = $row['nama_departemen'];
    }
}
$departemen_pel = array();
foreach ($departemen_name as $key => $value) {
    $departemen_pel[$key] = 0;
}
$sql = 'SELECT departemen from pelaporan where YEAR(STR_TO_DATE(tanggal_pelanggaran, "%Y-%m-%d")) = '.$year;
// echo $sql;
$result = mysqli_query($conn, $sql);
if ($result&& mysqli_num_rows($result) !=0){
    while($row = mysqli_fetch_assoc($result)) {
        // var_dump($row);
        $departemen_pel[$row['departemen']]+=1;
    }
}

// var_dump($departemen_pel);

// foreach ($departemen_name as $key => $value) {
//     echo $value;
//     echo "=>";
//     echo $departemen_pel[$key];
// }

foreach ($perusahaan_name as $key => $value) {
    echo $value;
    echo "=>";
    echo $perusahaan_pel[$key];
}

?>
