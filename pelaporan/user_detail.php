<?php include('template.php'); 
if (!isset($_GET['uid']))
  header('Location: users.php');
else
  $uid = $_GET['uid'];
require $_SERVER['DOCUMENT_ROOT']."/bukutamu_php"."/db/db_con.php";
$sql = "SELECT * FROM tamu where uid = ".$uid;

$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)) {
  $tamu = $row;  
}


?> 
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
                            List Pelaporan                           
                        </div>
                        <div class="card-body">
                                <!-- Grid -->
                              <div style="margin: auto;">
                                  <div class="row vertical-align">
                                      <div class="col-sm-6 center" style="margin: auto" >
                                          <img src = "../bukutamu/<?php echo $tamu['image']; ?>" width=80%  ></img>
                                          
                                          
                                      </div>
                                      <div class="col-sm-6 v-divider">
                                          
                                            <form class = "text-left" >
                                          

                                              <div class="form-group row"><!-- UID -->
                                                <label class="control-label col-sm-3" for="UID">UID:</label>
                                                <div class="col-sm-6">  
                                                  <input type="text" class="form-control inputsm" name="UID" id="UID" placeholder="UID" value = <?php echo $tamu['uid']; ?> readonly > 
                                                </div>
                                                <div class="col-sm-3">
                                                  <input class="form-control inputsm" name="TID" id="TID" placeholder="Tipe id"  value = <?php echo $tamu['tipeid']; ?> readonly>
                                                      
                                                </div>
                                              </div>
                                              
                                              <br>
                                              
                                              <div class="form-group row"> <!-- nama -->
                                                <label class="control-label col-sm-3" for="Nama">Nama:</label>
                                                <div class="col-sm-9">  
                                                  <input type="text" class="form-control inputsm" name="Nama" id="Nama"  placeholder="Nama" readonly value = <?php echo $tamu['nama_tamu']; ?>   >
                                                </div>
                                              </div>
                                              
                                              <br>

                                              <div class="form-group row"> <!-- no HP -->
                                                <label class="control-label col-sm-3" for="NoHP">Nomor HP:</label>
                                                <div class="col-sm-9">  
                                                  <input type="number" class="form-control inputsm" name="NoHP" id="NoHP" placeholder="08xxxxxxxxxx"  readonly value = <?php echo $tamu['nohp']; ?> {%endif%} readonly>
                                                </div>
                                              </div>
                                              
                                              <br>

                                              <div class="form-group row"><!-- Jenis kelamin -->
                                                <label class="control-label col-sm-3" for="kelamin">Jenis Kelamin:</label>
                                                <div class="col-sm-9">  
                                                  <input class="form-control inputsm" name="Kelamin" id="Kelamin" placeholder="L/P" value = <?php echo $tamu['jenis_kelamin']; ?>  readonly>
                                                </div>
                                              </div>
                                              
                                              <br>

                                              <div class="form-group row"> <!-- Institusi  -->
                                                <label class="control-label col-sm-3" for="Institusi">Institusi:</label>
                                                <div class="col-sm-9">  
                                                  <input type="text" class="form-control inputsm" name="Institusi" id="Institusi" placeholder="Institusi" required readonly value = <?php echo $tamu['perusahaan']; ?>  readonly>
                                                </div>
                                              </div>
                                              
                                              
                                          </form>
                                      </div>
                                  </div>
                              </div>
                              <br>

                              <div style="margin: auto;">
                                  <div class="row vertical-align">
                                      <div class="col-sm-6 center" style="margin: auto" >
                                          <h3 style="text-align: center;">Data Jam kunjungan</h3>
                                          <canvas id="djampengunjung"></canvas>
                                          
                                      </div>
                                      <div class="col-sm-6 v-divider">
                                          <h3 style="text-align: center;">Data kunjungan</h3>
                                          <canvas id="dpengunjung"></canvas>
                                            
                                      </div>
                                  </div>
                              </div>
                              <br>
                              <div>
                                  <div class="row">
                                          <div class="table-responsive col-sm-12" style="overflow-y: scroll;
                                  max-height:250px;">
                                            <table id="table" class="table table-bordered table-hover"
                                                                  style="font-size:10pt; text-align:center; vertical-align:middle;" >
                                              <thead>
                                                <tr >
                                                  <th class="w-25">Tanggal</th>
                                                   <th class="w-25">Bertemu dengan</th>
                                                  <th class="w-50">Keperluan</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                              <?php
                                              $sql = "SELECT * FROM kedatangan where tamu = ".$uid;

                                              $result = mysqli_query($conn, $sql);

                                              while($row = mysqli_fetch_assoc($result)) {
                                              ?>
                                                <tr >
                                                  <td><?php echo $row['tanggal_keluar']; ?></td>
                                                  <td><?php echo $row['bertemu']; ?></td>
                                                  <td><?php echo $row['keperluan']; ?></td>
                                                </tr>
                                              <?php
                                            }
                                              ?>
                                              </tbody>
                                            </table>
                                          </div>
                                  </div>
                                  <br>
                                  <br>
                                  <div class="row">
                                          <div class="table-responsive col-sm-12" style="overflow-y: scroll;
                                  max-height:250px;">
                                            <table id="table" class="table table-bordered table-hover"
                                                                  style="font-size:10pt; text-align:center; vertical-align:middle;" >
                                                <tr >
                                                  <th style="min-width:5%;">Tanggal Pelanggaran</th>
                                                  <th style="min-width:8%;">12 Basic</th>
                                                  <th style="min-width:7%;">Sub Kategori</th>
                                                  <th style="min-width:5%;">+/-</th>
                                                  <th style="min-width:10%; max-width: 15%">Action Plan 1</th>
                                                  <th style="min-width:10%; max-width: 15%">Action Plan 2</th>
                                                  <th style="min-width:15%; max-width: 25%">Keterangan</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                 <?php
                                              $sql = "SELECT * FROM pelaporan where pelanggar = ".$uid;

                                              $result = mysqli_query($conn, $sql);

                                              while($row = mysqli_fetch_assoc($result)) {
                                              ?>
                                               <tr>
                                                  <td style="vertical-align:middle;"><?php echo $row['tanggal_pelanggaran']; ?></td>
                                                  <td style="vertical-align:middle;"><?php echo $row['tipe_12']; ?></td>
                                                  <td style="vertical-align:middle;"><?php echo $row['subkategori']; ?></td>
                                                  <td style="vertical-align:middle;"><?php echo $row['positif']?'+':'-';?></td>
                                                  <td style="vertical-align:middle;"><?php echo $row['ap1']; ?></td>
                                                  <td style="vertical-align:middle;"><?php echo $row['ap2']; ?></td>
                                                  <td style="vertical-align:middle;"><?php echo $row['keterangan']; ?></td>
                                              </tr>
                                              <?php
                                            }
                                            ?>
                                            
                                              </tbody>
                                            </table>
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
    
</body>

<script type="text/javascript">
var ctxL = document.getElementById("dpengunjung").getContext('2d');
  var mydpengunjung = new Chart(ctxL, {
    type: 'line',
    data: {

      labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli" , "Agustus" , "September", "Oktober","November", "Desember"],
      datasets: [{
          label: "Jumlah kedatangan",
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
          label: "Jumlah Pelanggaran",
          data: [
          
          ],
          backgroundColor: [
            'rgba(0, 137, 132, .2)',
          ],
          borderColor: [
            'rgba(0, 10, 130, .7)',
          ],
          borderWidth: 2
        
      
    ,
    options: {
      responsive: true
    }
  ;

var ctxL = document.getElementById("djampengunjung").getContext('2d');
  var mydpengunjung = new Chart(ctxL, {
    type: 'line',
    data: {

      labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli" , "Agustus" , "September", "Oktober","November", "Desember"],
      datasets: [{
          label: "Jam kedatangan",
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
        
      ]
    },
    options: {
      responsive: true
    }
  );
</script>