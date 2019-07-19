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
                            List tamu                         
                        </div>
                        <div class="card-body">
                                <!-- Grid -->
                            <a href="daftarkaryawan.php"><button type="button" class="btn btn-primary " style="">Daftar Karyawan</button></a>
                            <table id="example1" class="table table-bordered table-hover" style="font-size:10pt; text-align:center; vertical-align:middle;">
                                <thead>
                                    <tr>
                                        <th style="min-width:5%;">No.</th>
                                        <th style="min-width:5%; max-width: 10%">NIK</th>
                                        <th style="min-width:30%;">Nama</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  
                                        require "../db/db_con.php";
                                            $sql = "SELECT * FROM karyawan";
                                        $result = mysqli_query($conn, $sql);
                                        if ($result &&(mysqli_num_rows($result) !=0)){
                                            $no = 1;
                                        while($row = mysqli_fetch_assoc($result)) {

                                        ?>
                                              
                                            
                                             <td style="vertical-align:middle;"><?php echo $no;$no+=1; ?></td>
                                             <td style="text-align:left;"><?php echo $row['nik']; ?></td>
                                             <td style="text-align:left;"><?php echo $row['nama']; ?></td>
                                             
                                             </tr>

                                        <?php
                                        }}

                                    ?>
                                </tbody>
                               
                            </table>
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
   
