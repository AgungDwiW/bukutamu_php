<?php include("template.php") ;

if (isset($_GET['year']))
  $year = $_GET['year'];
else
  $year = date('Y');?>
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
                            Buku Tamu            
                            <select style="position: absolute;right: 10px;"  name="forma" onchange="location = this.value;">
                              <?php
                               require "../db/db_con.php";
                                  $sql = 'SELECT year from year' ;
                                  $result = mysqli_query($conn, $sql);
                                  if ($result&& mysqli_num_rows($result) !=0){
                                      while($row = mysqli_fetch_assoc($result)) {
                                        $selected = "";
                                        if ($row['year'] == $year)
                                          $selected = "selected";
                                        echo "<option value =bukutamu.php?year=".$row['year'].
                                          " ".$selected.

                                        ">".$row['year']."</option> " ;
                                    }
                                  }
                              ?>
                            </select>                             
                        </div>
                        <div class="card-body">
                                <!-- Grid -->
                                <div class="col-sm-12" style="overflow-x: scroll">
                            <table id="example1" class="table table-bordered table-hover" style="font-size:10pt; text-align:center; vertical-align:middle;">
                                <thead>
                                    <tr>
                                      <th style="min-width:5%;">No.</th>
                                        <th style="min-width:5%; max-width: 10%">UID</th>
                                        <th style="min-width:5%; max-width: 10%">Nama</th>
                                        <th style="min-width:30%;">Tanggal datang</th>
                                        <th style="min-width:30%;">Tanggal keluar</th>
                                        <th style="min-width:30%;">Bertemu dengan</th>
                                        <th style="min-width:30%;">Departemen</th>
                                        <th style="min-width:25%;">Keperluan</th>
                                        <th style="min-width:25%;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     <?php  
                                       
                                            $sql = "SELECT * FROM kedatangan where  YEAR(STR_TO_DATE(tanggal_datang, '%Y-%m-%d')) = ".$year;
                                        $result = mysqli_query($conn, $sql);
                                        if ($result &&(mysqli_num_rows($result) !=0)){
                                            $no = 1;
                                        while($row = mysqli_fetch_assoc($result)) {
                                              $sql = "SELECT nama_tamu FROM tamu where uid = ".$row['tamu'];
                                                $result2 = mysqli_query($conn, $sql);
                                                while($row2 = mysqli_fetch_assoc($result2)) {
                                                    $nama = $row2['nama_tamu'];
                                                }

                                        ?>
                                                <tr class='clickable-row' data-href=user_detail.php?uid=<?php echo $row['tamu']; ?>>
                                                 <td style="vertical-align:middle;"><?php echo $no; $no+=1;?></td>
                                                 <td style="text-align:left;"><?php echo $row['tamu']; ?></td>
                                                 <td style="text-align:left;"><?php echo $nama; ?></td>
                                                 <td style="text-align:left;"><?php echo $row['tanggal_datang']; ?></td>
                                                 <td style="text-align:left;"><?php echo $row['tanggal_keluar']; ?></td>
                                                 <td style="text-align:left;"><?php echo $row['bertemu']; ?></td>
                                                 <td style="text-align:left;"><?php echo $row['departemen']; ?></td>
                                                 <td style="text-align:left;"><?php echo $row['keperluan']; ?></td>
                                                 <td style="text-align:left;"><?php echo $row['signedout']?"Keluar":"Didalam"; ?></td>
                                                 </tr>

                                        <?php
                                        }}

                                    ?>
                                </tbody>
                               
                            </table>
                            <br>
                        </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </section>
                    <!-- /.content -->
    </div>
  <?php include("footer.php") ; ?>  
</body>

 <script>
        $(function () {
            $('#example1').DataTable({
                "searching": true,
            });
        });
        

        jQuery(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });
    </script>
   
