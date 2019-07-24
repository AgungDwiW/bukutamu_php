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
                           List departemen                 
                        </div>
                        <div class="card-body">
                                <!-- Grid -->
                            <div class="col-sm-12" style="overflow-x: scroll">
                                <a href="daftardepartemen.php"><button type="button" class="btn btn-primary " style="">Daftar Departement Baru</button></a>
                            <table id="example1" class="table table-bordered table-hover" style="font-size:10pt; text-align:center;">
                                <thead>
                                    <tr>
                                        <th style="min-width:5%;">No.</th>
                                        <th style="min-width:5%; max-width: 10%">Nama departemen</th>
                                    	<th style="min-width:5%; max-width: 15%">Penanggung jawab</th>
                                        <th style="min-width:5%; max-width: 15%">Email</th>
                                        <th style="min-width:5%; max-width: 15%">Edit</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php  
                                        require "../db/db_con.php";
                                            $sql = "SELECT * FROM departemen order by nama_departemen";
                                        $result = mysqli_query($conn, $sql);
                                        if ($result &&(mysqli_num_rows($result) !=0)){
                                            $no = 1;
                                        while($row = mysqli_fetch_assoc($result)) {
                                              
                                        ?>

                                        <tr>
                                         <td style="vertical-align:middle;"><?php echo $no; $no+=1; ?></td>
                                        <td style="vertical-align:middle;"><?php echo $row['nama_departemen']; ?></td>
                                        <td style="vertical-align:middle;"><?php echo $row['penanggungjawab']; ?></td>
                                        <td style="vertical-align:middle;"><?php echo $row['email']; ?></td>
                                        <td>
	                                        <a href='<?php echo "editdep.php?id=".$row["id"]; ?>' class="nav-link" style="color: DodgerBlue;"><i class="fa fa-pencil-square-o"></i>

						                    <span class="nav-link-text" >Edit</span></a>
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
   

