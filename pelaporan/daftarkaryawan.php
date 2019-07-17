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
                            Daftar karyawan
                        </div>
                        <div class="card-body">
                                <!-- Grid -->
                            <form id="msform" style="height:auto; width:auto;" method="post" onsubmit="return validateform()" action="submit_karyawan.php" >
                            <!-- fieldsets -->
                           
                                <fieldset>
                                    
                                    <div style="margin:auto;">
                                        
                                        
                                        <br>
                                        <div class="form-group row" style="padding-bottom:1rem;">
                                            <label class="control-label col-sm-4" for="nama">NIK:</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="id" id = "id" class = "form-control inputsm" required placeholder="ID"></div>
                                        </div>
                                            
                                        <div class="form-group row" style="padding-bottom:1rem;"><!-- UID -->
                                          <label class="control-label col-sm-4" for="UID">Nama Karyawan:</label>
                                          <div class="col-sm-8">  
                                            <input type="text" required class="form-control inputsm" name="nama" id="nama" placeholder="Password"> 
                                          </div>
                                          
                                        </div>              
                                        
                                        <?php 
                                            if (isset($_GET['error'])){
                                                echo '<label style = "text-align:center;">Karyawan</label> </br></br>';
                                            }
                                        ?>
                                        <div class="col-sm-12 center"> 
                                           <button type="input" class="btn btn-primary" style="width: 50%">Submit</button>
                                        
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
<script type="text/javascript">

</script>
