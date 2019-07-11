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
                            Download CSV
                        </div>
                        <div class="card-body">
                                <!-- Grid -->
                            <form id="msform" style="height:auto; width:auto;" method="post" onsubmit="return validateform()" action="submit_admin.php" >
                            <!-- fieldsets -->
                           
                                <fieldset>
                                    
                                    <div style="margin:auto;">
                                        
                                        
                                        <br>
                                        <div class="form-group row" style="padding-bottom:1rem;">
                                        
                                          <label class="col-sm-3"> Pelaporan:</label>
                                          <div class="col-sm-3">  
                                            <input type="date" name="startpel" id = "startpel" class="form-control form-control-sm ">
                                          </div> - 
                                          <div class="col-sm-3">
                                            <input type="date" name="endpel" id = "endpel" class="form-control form-control-sm " >
                                          </div>
                                          <div class="col-sm-2"> 
                                            <button type="button" onclick="exportpel()"> Download</button>
                                          </div>
                                        
                                        </div>
                                            
                                        <div class="form-group row" style="padding-bottom:1rem;">
                                        
                                          <label class="col-sm-3"> Bukutamu:</label>
                                          <div class="col-sm-3">  
                                            <input type="date" name="startked" id = "startked" class="form-control form-control-sm ">
                                          </div> - 
                                          <div class="col-sm-3">
                                            <input type="date" name="endked" id = "endked" class="form-control form-control-sm " >
                                          </div>
                                          <div class="col-sm-2"> 
                                            <button type="button" onclick="exportked()"> Download</button>
                                          </div>
                                        
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

const startked = document.getElementById('startked');
const startpel = document.getElementById('startpel');
const endked = document.getElementById('endked');
const endpel = document.getElementById('endpel');

function exportked()
        {

            if (startked.value != "" && endked.value !="")
            {

                var conf = confirm("Export data bukutamu ke CSV?");
                if(conf == true)
                {
                    window.open("ajax/exportked.php?start='"+startked.value+"'&end='"+endked.value+"'", '_blank');
                }    
            }
            
        }
function exportpel()
        {

            if (startpel.value != "" && endpel.value !="")
            {

                var conf = confirm("Export data bukutamu ke CSV?");
                if(conf == true)
                {
                    window.open("ajax/exportpel.php?start='"+startpel.value+"'&end='"+endpel.value+"'", '_blank');
                }    
            }
            
        }
</script>
