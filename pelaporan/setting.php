<?php include('template.php'); 

require "../db/db_con.php";

$sql = "select value from setting where nama = 'max_temp'";
$result = mysqli_query($conn, $sql);
$max_temp  =0;
while($row = mysqli_fetch_assoc($result)) {
    $max_temp = $row['value'];
}

$sql = "select value from setting where nama = 'max_pel'";
$result = mysqli_query($conn, $sql);
$max_pel  =0;
while($row = mysqli_fetch_assoc($result)) {
    $max_pel = $row['value'];
}

$sql = "select value from setting where nama = 'max_ind'";
$result = mysqli_query($conn, $sql);
$max_ind  =0;
while($row = mysqli_fetch_assoc($result)) {
    $max_ind = $row['value'];
}

$sql = "select value from setting where nama = 'autoreset'";
$result = mysqli_query($conn, $sql);
$reset  =0;
while($row = mysqli_fetch_assoc($result)) {
    $reset = $row['value'];
}

$sql = "select value from setting where nama = 'autodelete'";
$result = mysqli_query($conn, $sql);
$delete  =0;
while($row = mysqli_fetch_assoc($result)) {
    $delete = $row['value'];
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
                            Setting                        
                        </div>
                        <div class="card-body">
                                <!-- Grid -->
                            <form id="msform" style="height:auto; width:auto; text-align: left;" method="post" onsubmit="return validateform()" action="submit_setting.php" >
                            <!-- fieldsets -->
                           
                                <fieldset>
                                    
                                    <div style="margin:auto;" id = "dynform">
                                        
                                        <div class="form-group row" style="padding-bottom:1rem;">
                                            <label class="control-label col-sm-10" for="nama">Maximum temperature untuk tamu :</label>
                                            <div class="col-sm-2">
                                                <input type="number" name="max_temp" id = "max_temp" class = "form-control inputsm" required value = <?php echo $max_temp ?>></div>
                                        </div>
                                        <div class="form-group row" style="padding-bottom:1rem;">
                                            <label class="control-label col-sm-10" for="nama">Maximum hari untuk induksi :</label>
                                            <div class="col-sm-2">
                                                <input type="number" name="max_ind" id = "max_ind" class = "form-control inputsm" required value="<?php echo $max_ind ?>"></div>
                                        </div>
                                        <div class="form-group row" style="padding-bottom:1rem;">
                                            <label class="control-label col-sm-10" for="nama">Maximum pelanggaran tamu :</label>
                                            <div class="col-sm-2">
                                                <input type="number" name="max_pel" id = "max_pel" class = "form-control inputsm" required value="<?php echo $max_pel ?>"></div>
                                        </div>
                                        <div class="form-group row" style="padding-bottom:1rem;">
                                            <label class="control-label col-sm-10" for="nama">Auto reset count pelanggaran tiap (dalam bulan) :</label>
                                            <div class="col-sm-2">
                                                <input type="number" name="reset" id = "reset" class = "form-control inputsm" required value="<?php echo $reset ?>"></div>
                                        </div>
                                        <div class="form-group row" style="padding-bottom:1rem;">
                                            <label class="control-label col-sm-10" for="nama">Auto hapus data tiap (dalam bulan) :</label>
                                            <div class="col-sm-2">
                                                <input type="number" name="delete" id = "delete" class = "form-control inputsm" required value="<?php echo $delete ?>"></div>
                                        </div>

                                        <div class="col-sm-12 center"> 
                                            <input type="submit" name="submit" id = "submit" class="col-sm-12">
                                        </div>
                        
                                </fieldset>
                            </form>
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
