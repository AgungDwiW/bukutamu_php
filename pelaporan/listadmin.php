<?php include("template.php") ;
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
                            List Admin
                              
                        </div>
                        <div class="card-body">
                                <!-- Grid -->
                            <div class="col-sm-12" style="overflow-x: scroll">
                            <table id="example1" class="table table-bordered table-hover" style="font-size:10pt; text-align:center;">
                                <thead>
                                    <tr>
                                        <th style="min-width:5%;">No.</th>
                                        <th style="min-width:5%; max-width: 10%">ID</th>
                                        <th style="min-width:5%; max-width: 10%">Status</th>
                                    	<th style="min-width:5%; max-width: 15%">Delete</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php  
                                        require "../db/db_con.php";
                                            $sql = "SELECT * FROM user where is_superman = false";
                                        $result = mysqli_query($conn, $sql);
                                        if ($result &&(mysqli_num_rows($result) !=0)){
                                            $no = 1;
                                        while($row = mysqli_fetch_assoc($result)) {
                                              
                                        ?>

                                        <tr>
                                         <td style="vertical-align:middle;"><?php echo $no; $no+=1; ?></td>
                                        <td style="vertical-align:middle;"><?php echo $row['user']; ?></td>
                                        <td style="vertical-align:middle;"><?php echo $row['is_superman']?"Super User":($row['is_super']?"Supervisor":"User"); ?></td>
                                        <td>
	                                        <a href="" class="nav-link" onclick="document.getElementById('link').href =  '<?php echo "hapusadmin.php?id=".$row["id"]; ?>'" style="color: DodgerBlue;" data-toggle="modal" data-target="#exampleModal2" ><i
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
                        <a class="btn btn-primary" id = "link" href="hapusadmin.php">hapus</a>
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
   

