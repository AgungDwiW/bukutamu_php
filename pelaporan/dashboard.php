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
                                    <h3>Divisi Penanggung Jawab</h3>
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
            data: [ ],
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
            
          ],
          datasets: [{
            data: [
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
            
          ],
          datasets: [
            ],
            backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"],
            hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]
          }
        ,
        options: {
          responsive: true
        }
      });

    //Pelangaran divisi
       new Chart(document.getElementById("Divisibar"), {
        "type": "horizontalBar",
        "data": {
          "labels": [],
          "datasets": [{
            "label": "Pelanggaran Oleh Tamu Divisi",
            "data": [],
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
</body>