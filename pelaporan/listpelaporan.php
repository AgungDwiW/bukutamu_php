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
                            List Pelaporan             
                             <select style="position: absolute;right: 10px;"  name="forma" onchange="location = this.value;">
                              <?php
                               require $_SERVER['DOCUMENT_ROOT']."/bukutamu_php"."/db/db_con.php";
                                  $sql = 'SELECT year from year' ;
                                  $result = mysqli_query($conn, $sql);
                                  if ($result&& mysqli_num_rows($result) !=0){
                                      while($row = mysqli_fetch_assoc($result)) {
                                        $selected = "";
                                        if ($row['year'] == $year)
                                          $selected = "selected";
                                        echo "<option value =listpelaporan.php?year=".$row['year'].
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
                            <table id="example1" class="table table-bordered table-hover" style="font-size:10pt; text-align:center;">
                                <thead>
                                    <tr>
                                        <th style="min-width:5%;">No.</th>
                                        <th style="min-width:5%; max-width: 10%">Nama Pelapor</th>
                                        <th style="min-width:5%;">Tanggal Pelanggaran</th>
                                        <th style="min-width:5%;">UID Pelanggar</th>
                                        <th style="min-width:5%; max-width: 10%">Nama Pelanggar</th>
                                        <th style="min-width:5%; max-width: 10%">Departemen</th>
                                        <th style="min-width:5%; max-width: 10%">Area</th>
                                        <th style="min-width:8%;">12 Basic</th>
                                        <th style="min-width:7%;">Sub Kategori</th>
                                        <th style="min-width:5%;">+/-</th>
                                        <th style="min-width:5%; max-width: 15%">Action Plan 1</th>
                                        <th style="min-width:5%; max-width: 15%">Action Plan 2</th>
                                        <th style="min-width:5%; max-width: 15%">Keterangan</th>
                                    	<th style="min-width:5%; max-width: 15%">delete</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php  
                                        require $_SERVER['DOCUMENT_ROOT']."/bukutamu_php"."/db/db_con.php";
                                            $sql = "SELECT * FROM pelaporan  where  YEAR(STR_TO_DATE(tanggal_pelanggaran, '%Y-%m-%d')) = ".$year;
                                        $result = mysqli_query($conn, $sql);
                                        if ($result &&(mysqli_num_rows($result) !=0)){
                                            $no = 1;
                                        while($row = mysqli_fetch_assoc($result)) {
                                              $sql = "SELECT nama_tamu FROM tamu where uid = ".$row['pelanggar'];
                                                $result2 = mysqli_query($conn, $sql);
                                                while($row2 = mysqli_fetch_assoc($result2)) {
                                                    $nama = $row2['nama_tamu'];
                                                }
                                             $sql = "SELECT nama_departemen FROM Departemen where id = ".$row['departemen'];
                                                // echo $sql;
                                                $result2 = mysqli_query($conn, $sql);
                                                while($row2 = mysqli_fetch_assoc($result2)) {
                                                    $departemen = $row2['nama_departemen'];
                                                }

                                        ?>

                                        <tr>
                                         <td style="vertical-align:middle;"><?php echo $no; $no+=1; ?></td>
                                        <td style="vertical-align:middle;"><?php echo $row['nama_pelapor']; ?></td>
                                        <td style="vertical-align:middle;"><?php echo $row['tanggal_pelanggaran']; ?></td>
                                        <td style="vertical-align:middle;">
                                        <a href="user_detail.php?uid=<?php echo $row['pelanggar']; ?>"><?php echo $row['pelanggar']; ?></a>
                                        </td>
                                        <td style="vertical-align:middle;"><?php echo $nama; ?></td>
                                        <td style="vertical-align:middle;"><?php echo $departemen; ?></td>
                                        <td style="vertical-align:middle;"><?php echo $row['area']; ?></td>
                                        <td style="vertical-align:middle;"><?php echo $row['tipe_12']; ?></td>
                                        <td style="vertical-align:middle;"><?php echo $row['subkategori']; ?></td>
                                        <td style="vertical-align:middle;"><?php echo $row['positif']; ?></td>
                                        <td style="vertical-align:middle;"><?php echo $row['ap1']; ?></td>
                                        <td style="vertical-align:middle;"><?php echo $row['ap2']; ?></td>
                                        <td style="vertical-align:middle;"><?php echo $row['keterangan']; ?> </td>
                                        <td style="vertical-align:middle;">
	                                        <a href="" class="nav-link" onclick="document.getElementById('link').href =  '<?php echo "hapus.php?id=".$row["id"]; ?>'" style="color: DodgerBlue;" data-toggle="modal" data-target="#exampleModal2" ><i
						                        class="fa fa-fw fa-trash"></i>
						                    <span class="nav-link-text" >Hapus</span></a>
					               		 </td>
                                         </tr>

                                        <?php
                                        }}

	                                    ?>



                                </tbody>
                               
                            </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </section>
                    <!-- /.content -->
    </div>
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Tekan tombol hapus untuk mengkonfirmasi penghapusan!</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" id = "link" href="auth/logout.php">hapus</a>
                    </div>
                </div>
            </div>
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
   

