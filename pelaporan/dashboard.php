<?php 
if (isset($_GET['year']))
  $year = $_GET['year'];
else
  $year = date('Y');

require "../db/db_con.php";
$month = array('01','02','03','04','05','06','07','08','09','10','11','12');
$count_month = array(0,0,0,0,0,0,0,0,0,0,0,0);
for ($x = 0; $x<12; $x+=1){
  $sql = 'SELECT count(*) as count from kedatangan where YEAR(STR_TO_DATE(tanggal_datang, "%Y-%m-%d")) = '.$year.' and MONTH(STR_TO_DATE(tanggal_datang, "%Y-%m-%d")) = '.$month[$x].'';
  $result = mysqli_query($conn, $sql);
  if ($result&& mysqli_num_rows($result) !=0){
    while($row = mysqli_fetch_assoc($result)) {
      $count_month[$x] = intval($row['count']);
    }
  }

}
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
// echo "<br>";

// foreach ($area_pel as $key =>$value) {
//     echo "$key => $value ,";
// }
// echo "<br>";

$sql = 'SELECT pelanggar from pelaporan where YEAR(STR_TO_DATE(tanggal_pelanggaran, "%Y-%m-%d")) = '.$year;
$result = mysqli_query($conn, $sql);
$perusahaan_pel = array();
$perusahaan_datang = array();
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
                    $perusahaan_datang[$cur] = 0;
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
if ($result&& mysqli_num_rows($result) !=0){
    while($row = mysqli_fetch_assoc($result)) {
        $sql = 'SELECT perusahaan from tamu where uid = '.$row['tamu'];
        $result2 = mysqli_query($conn, $sql);
        if ($result2&& mysqli_num_rows($result2) !=0){
            
            $cur_now = 0;
            while($row2 = mysqli_fetch_assoc($result2)) {
                if (!in_array($row2['perusahaan'], $perusahaan_name)){
                    $perusahaan_name[$cur]=$row2['perusahaan'];
                    $perusahaan_datang[$cur]=1;
                    $perusahaan_pel[$cur]=0;
                    $cur+=1;}
                else{
                    foreach ($perusahaan_name as $key => $value) {
                        if ($value == $row2['perusahaan']){
                            $cur_now = $key;
                            break;
                        }
                    }
                    $perusahaan_datang[$cur_now]+=1;
                    if (!isset($perusahaan_pel[$cur_now]))
                      $perusahaan_pel[$cur_now] = 0;
                  }
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
$sql = 'SELECT departemen from kedatangan where YEAR(STR_TO_DATE(tanggal_datang, "%Y-%m-%d")) = '.$year;
$result = mysqli_query($conn, $sql);
$departemen_datang = array();
foreach ($departemen_name as $key => $value) {
    $departemen_datang[$key] = 0;
}
if ($result&& mysqli_num_rows($result) !=0){
    while($row = mysqli_fetch_assoc($result)) {
        // var_dump($row);
      if($row['departemen'])
        $departemen_datang[$row['departemen']]+=1;
    }
}
// var_dump($departemen_pel);

// foreach ($departemen_name as $key => $value) {
//     echo $value;
//     echo "=>";
//     echo $departemen_pel[$key];
// }

// foreach ($perusahaan_name as $key => $value) {
//     echo $value;
//     echo "=>";
//     echo $perusahaan_pel[$key];
// }

?>


<?php include('template.php'); ?> 

<body class="hold-transition sidebar-mini">
    <br>
    <br>
    <div class="content-wrapper" style="background: #fbfbfb !important;">
                    <!-- Content Header (Page header) -->
                    
                    <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col">
                            
                    <div class="card table-responsive" style="border-radius: 0px !important;">
                        <!-- /.card-header -->
                        <div class="card-header">                              
                            Dashboard
                            <select style="position: absolute;right: 10px;"  name="forma" onchange="location = this.value;">
                              <?php
                                  $sql = 'SELECT year from year' ;
                                  $result = mysqli_query($conn, $sql);
                                  if ($result&& mysqli_num_rows($result) !=0){
                                      while($row = mysqli_fetch_assoc($result)) {
                                        $selected = "";
                                        if ($row['year'] == $year)
                                          $selected = "selected";
                                        echo "<option value =dashboard.php?year=".$row['year'].
                                          " ".$selected.

                                        ">".$row['year']."</option> " ;
                                    }
                                  }
                              ?>
                            </select>                            
                        </div>
                        <div class="card-body">
                                <!-- Grid -->
                            <div class="wrapper" style="text-align: center;">
                                <h1 style="text-align: center;">Dashboard</h1>
                                <div id="btnContainer">
                                  <button class="btnx" onclick="listView()"><i class="fa fa-bars"></i> List</button> 
                                  <button class="btnx active" onclick="gridView()"><i class="fa fa-th-large"></i> Grid</button>
                                </div>
                                <br>
                                <br>
                                <div class="row">
                                  <div class="column" >
                                    <h3>Data kunjungan</h3>
                                        <canvas id="dpengunjung"></canvas>
                                   </div>
                                  <div class="column" >
                                    <h3>Data Institusi</h3>
                                    <canvas id="institusichart"></canvas>
                                  </div>
                                </div>

                                <br>
                                <div class="row">
                                  
                                  <div class="column" >
                                    <h3> Jumlah Pelanggaran Institusi</h3>
                                    <canvas id="institusipelchart"></canvas>
                                  </div>
                                  <div class="column" >
                                    <h3>Area Pelanggaran</h3>
                                    <canvas id="areapelanggaran" ></canvas>
                                  </div>
                                  <div class="column" >
                                    <h3>Departemen Penanggung Jawab</h3>
                                    <canvas id="Divisibar"></canvas>
                                  </div>
                                </div>
                            </div>
                                                    </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </section>
                    <!-- /.content -->
    </div>
    <script>
    // Get the elements with class="column"
    var elements = document.getElementsByClassName("column");

    // Declare a loop variable
    var i;
    listView()
    // List View
    function listView() {
      for (i = 0; i < elements.length; i++) {
        elements[i].style.width = "100%";
      }
    };

    gridView()
    // Grid View
    function gridView() {
      for (i = 0; i < elements.length; i++) {
        if (i<2){  
            elements[i].style.width = "50%";
          }
        else {
          elements[i].style.width = "33%";
        }
      }

      
    };

    /* Optional: Add active class to the current button (highlight it) */
    var container = document.getElementById("btnContainer");
    var btns = container.getElementsByClassName("btnx");
    for (var i = 0; i < btns.length; i++) {
      btns[i].addEventListener("click", function() {
        var current = document.getElementsByClassName("active");
        current[0].className = current[0].className.replace(" active", "");
        this.className += " active";
      });
    }


    var ctxL = document.getElementById("dpengunjung").getContext('2d');
      var mydpengunjung = new Chart(ctxL, {
        type: 'line',
        data: {

          labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli" , "Agustus" , "September", "Oktober","November", "Desember"],
          datasets: [{
              label: "Jumlah Tamu",
              data: [
              <?php
                  foreach ($count_month as $key ) {
                      echo "$key,";
                  }
                  
                ?>
              ],
              backgroundColor: [
                'rgba(105, 0, 132, .2)',
              ],
              borderColor: [
                'rgba(200, 99, 132, .7)',
              ],
              borderWidth: 2
            },
            {
              label: "Pelanggaran Oleh tamu",
              data: [
              
              ],
              backgroundColor: [
                'rgba(0, 137, 132, .2)',
              ],
              borderColor: [
                'rgba(0, 10, 130, .7)',
              ],
              borderWidth: 2
            }
          ]
        },
        options: {
          responsive: true
        }
      });

    //Area Pelanggaran  
      var ctx = document.getElementById("areapelanggaran").getContext('2d');
      var areapelanggaran = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ["Area 1", "Area 2", "Area 3", "Area 4", "Area 5"],
          datasets: [{
            label: 'Area Pelanggaran',
            data: [
            <?php 
            foreach ($area_pel as $key ) {
                echo "$key,";
            }
            ?>
             ],
            backgroundColor: [
              'rgba(155, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
            ],
            borderColor: [
              'rgba(255,99,132,1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
            ],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
      });

    //Institusi pengunjung
      var ctxP = document.getElementById("institusichart").getContext('2d');
      var myinstitusichart = new Chart(ctxP, {
        type: 'pie',
        data: {
           labels: [
<?php
foreach ($perusahaan_name as $key => $value) {
    echo "'$value',";
}
?>
          ],
           datasets: [{
            data: [<?php
foreach ($perusahaan_datang as $key => $value) {
    echo "$perusahaan_datang[$key],";

}?>
            ],
            backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
            hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
          }]
        },
        options: {
          responsive: true
        }
      });

     //Institusi Pelanggaran
      var ctxP = document.getElementById("institusipelchart").getContext('2d');
      var myinstitusipelchart = new Chart(ctxP, {
        type: 'pie',
        data: {
          labels: [
            <?php
foreach ($perusahaan_name as $key => $value) {
    echo "'$value',";
}
?>
          ],
           datasets: [{
            data: [<?php
foreach ($perusahaan_name as $key => $value) {
    echo "$perusahaan_pel[$key],";

}?>
            ],
            backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
            hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
          }]
        },
        options: {
          responsive: true
        }
      });

    //Pelangaran divisi
       new Chart(document.getElementById("Divisibar"), {
        "type": "horizontalBar",
        "data": {
          "labels": [
          <?php
foreach ($departemen_name as $key => $value) {
    echo "'$departemen_name[$key]',";

}?>
],
          "datasets": [{
            "label": "Pelanggaran Oleh Tamu Divisi",
            "data": [
<?php
foreach ($departemen_name as $key => $value) {
    echo "$departemen_pel[$key],";

}?>
],
            "fill": false,
            "backgroundColor": ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)",
              "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)",
              "rgba(153, 102, 255, 0.2)", "rgba(201, 203, 207, 0.2)"
            ],
            "borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)",
              "rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)", "rgb(201, 203, 207)"
            ],
            "borderWidth": 1
          }]
        },
        "options": {
          "scales": {
            "xAxes": [{
              "ticks": {
                "beginAtZero": true
              }
            }]
          }
        }
      });
       
    </script>

    <?php include("footer.php") ; ?>
</body>