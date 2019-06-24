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
                            List Tamu                         
                        </div>
                        <div class="card-body">
                                <!-- Grid -->
                            <table id="example1" class="table table-bordered table-hover" style="font-size:10pt; text-align:center; vertical-align:middle;">
                                <thead>
                                    <tr>
                                        <th style="min-width:5%;">No.</th>
                                        <th style="min-width:5%; max-width: 10%">Nama</th>
                                        <th style="min-width:30%;">Perusahaan</th>
                                        <th style="min-width:30%;">UID</th>
                                        <th style="min-width:25%;">Tipe ID</th>
                                        <th style="min-width:25%;">Terakhir datang</th>
                                        <th style="min-width:25%;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  
                                        require $_SERVER['DOCUMENT_ROOT']."/bukutamu_php"."/db/db_con.php";
                                            $sql = "SELECT * FROM tamu";
                                        $result = mysqli_query($conn, $sql);
                                        if ($result &&(mysqli_num_rows($result) !=0)){
                                            $no = 1;
                                        while($row = mysqli_fetch_assoc($result)) {

                                        ?>
                                              
                                            <tr class='clickable-row' data-href=user_detail.php?uid=<?php echo $row['uid']; ?>>
                                             <td style="vertical-align:middle;"><?php echo $no;$no+=1; ?></td>
                                             <td style="text-align:left;"><?php echo $row['nama_tamu']; ?></td>
                                             <td style="text-align:left;"><?php echo $row['perusahaan']; ?></td>
                                             <td style="text-align:left;"><?php echo $row['uid']; ?></td>
                                             <td style="text-align:left;"><?php echo $row['tipeid']; ?></td>
                                             <td style="text-align:left;"><?php echo $row['terakhir_datang']; ?></td>
                                             <td style="text-align:left;"><?php echo $row['signed_in']; ?></td>

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
   
